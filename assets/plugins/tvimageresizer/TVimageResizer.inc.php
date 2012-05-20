<?php

defined('IN_MANAGER_MODE') or die();

//***********************************
//TVimageResizer plugin v1.9.4.2 for MODX Evolution 1.x
//Used EasyPhpThumbnail class by JF Nutbroek
//***********************************
//Andchir  http://wdevblog.net.ru
//***********************************
// Copy folder to assets/plugins/
// Description: Resizing images of Template Variables. Rounding the corners, adding watermarks.
// Configuration: &tv_ids=TV IDs;string; &dirs=Thumb folders;string;small~medium &width=Width;string;200~400 &height=Height;string;100~200 &rcorner=Corners percentage of clipping;string; &backgroundColor=Background color;string;#FFFFFF &watermark=Watermark image path (png);string; &watermarkPos=Watermark position;string;90% 90% &cprighttext=Copyright text;string; &quality=Quality;int;90 &mirror=Mirror effect;list;yes,no;no &crop=Cropping;list;yes,no,crop_resized,fill_resized;no &save_o_name=Save only name;list;yes,no;no &rename_images=Rename images;list;yes,no;no &refresh_all_images=Refresh all images;list;yes,no;no
// System Events: OnBeforeDocFormSave,OnSiteRefresh
//***********************************

if(!isset($tv_ids)) $tv_ids = '';
if(!isset($save_o_name)) $save_o_name = "no";

$options = array();
$options['dirs'] = isset($dirs) ? $dirs : 'small~medium';
$options['width'] = isset($width) ? $width : '100~300';
$options['height'] = isset($height) ? $height : '60~200';
$options['rcorner'] = isset($rcorner) ? $rcorner : '';
$options['backgroundColor'] = isset($backgroundColor) ? $backgroundColor : '#FFFFFF';
$options['watermark'] = isset($watermark) ? $watermark : '';
$options['cprighttext'] = isset($cprighttext) ? $cprighttext : '';
$options['watermarkPos'] = isset($watermarkPos) ? $watermarkPos : "90% 90%";
$options['quality'] = isset($quality) ? $quality : 90;
$options['mirror'] = isset($mirror) ? $mirror : 'no';
$options['rename_images'] = isset($rename_images) ? $rename_images : 'no';
$options['crop'] = isset($crop) ? $crop : 'no';
$options['scaleWithBG'] = isset($scaleWithBG) ? $scaleWithBG : 'yes';
$options['refreshAllImages'] = isset($refresh_all_images) ? $refresh_all_images : 'no';

if(!$tv_ids) return;
$tv_ids_arr = explode(',',str_replace(' ','',$tv_ids));

require_once MODX_BASE_PATH.'/assets/plugins/tvimageresizer/easyphpthumbnail.class.php';
require_once MODX_BASE_PATH.'/assets/plugins/tvimageresizer/imageUtil.php';

$e = &$modx->Event;
$output = "";

$tb_tmplvars = $modx->getFullTableName('site_tmplvars');
$tb_tmplvar_values = $modx->getFullTableName('site_tmplvar_contentvalues');

if ($e->name == 'OnBeforeDocFormSave' || ($e->name == 'OnSiteRefresh' && $options['refreshAllImages'] == 'yes')){

define(IMAGE_CLASS,"GD");

if(!function_exists('createThumb')){
function createThumb($target_path,$opt,$src_path,$src_image){
    $thumb = new easyphpthumbnail;
		
    if(!is_dir($target_path)) @mkdir($target_path, 0777);
    if(file_exists($target_path.$image_name)) @unlink($target_path.$image_name);

    $src_ratio = $src_image['width']/$src_image['height'];
    $ratio = $opt['width']/$opt['height'];
    $th_size = $ratio>=1 ? $opt['width'] : $opt['height'];
    $thumb -> Thumbsize = $th_size;
    $thumb -> Backgroundcolor = $opt['backgroundColor'];    
    //$thumb -> Thumbwidth = $opt['width'];
    //$thumb -> Thumbheight = $opt['height'];
    
    if($opt['width']>$src_image['width'] && $opt['height']>$src_image['height'] && $opt['scaleWithBG']=='yes'){

        $thumb -> Createcanvas($opt['width'],$opt['height'],IMAGETYPE_JPEG,$opt['backgroundColor'],false);
        $thumb -> Watermark = $src_path;
        $thumb -> Watermarkposition = '50% 50%';
        $thumb -> Watermarktransparency = 100;
        $opt['crop'] = 'no';
        if(!empty($opt['watermark'])) $opt['watermark_thumb'] = $opt['watermark'];
        
    }else if(($opt['width']>$src_image['width'] || $opt['height']>$src_image['height']) && $opt['crop']=="no"){
    
        $thumb -> Inflate = true;
        if($opt['width']>$src_image['width']) $thumb -> Thumbwidth = $opt['width'];
        else $thumb -> Thumbheight = $opt['height'];
    
    }

    if($opt['crop']=="yes"){
      
        if ($ratio>$src_image['ratio']) $src_image['height'] = $src_image['width']/$src_image['ratio'];
        else $src_image['width'] = $src_image['height']*$src_image['ratio'];
        
        $thumb -> Cropimage = array(2,1,round($opt['width']/2),round($opt['width']/2),round($opt['height']/2),round($opt['height']/2));
      
    }else if($opt['crop']=="crop_resized"){
        
        if($ratio == 1){
            $thumb -> Cropimage = array(3,0,0,0,0,0);
        }else{
            $persent = $src_ratio > $ratio ? $src_image['height'] / $opt['height'] : $src_image['width'] / $opt['width'];
            $thumb -> Cropimage = array(2,1,floor(($opt['width']*$persent)/2),floor(($opt['width']*$persent)/2),floor(($opt['height']*$persent)/2),floor(($opt['height']*$persent)/2));
        }
        
    }else if($opt['crop']=="fill_resized"){
        
        $thumb -> Polaroidframecolor = $opt['backgroundColor'];
        $persent = $src_ratio < $ratio ? $src_image['height'] / $opt['height'] : $src_image['width'] / $opt['width'];
        $w = $opt['width']*$persent;
        $h = $opt['height']*$persent;
        $x1 = floor(floor($src_image['width']/2) - floor($w/2));
        $x2 = floor(floor($src_image['width']/2) - floor($w/2));
        $y1 = floor(floor($src_image['height']/2) - floor($h/2));
        $y2 = floor(floor($src_image['height']/2) - floor($h/2));
        $thumb -> Cropimage = array(1,1,$x1,$x2,$y1,$y2);      
        
        if($x1<0){
            $thumb -> filledTwoRectangle = array(array(0,0,abs($x1),floor($h)),array(floor($w-abs($x1)),0,ceil($w),floor($h)));
        }else if($y1<0){
            $thumb -> filledTwoRectangle = array(array(0,0,ceil($w),abs($y1)),array(0,0,0,0));
        }
        
    }

    if(!empty($opt['rcorner'])){
      $thumb -> Clipcorner = array(2,$opt['rcorner'],0,1,1,1,1);
    }
    if((!empty($opt['watermark']) || !empty($opt['watermark_thumb'])) && !empty($opt['watermarkPos'])){
      $thumb -> Watermarkpngthumb = !empty($opt['watermark_thumb']) ? '../'.$opt['watermark_thumb'] : '../'.$opt['watermark'];
      $thumb -> Watermarktransparency = 100;
      $thumb -> Watermarkthumbposition = $opt['watermarkPos'];
    }
    if(!empty($opt['cprighttext']) && !empty($opt['watermarkPos'])){
      $thumb -> Copyrightfonttype = "../assets/plugins/tvimageresizer/CONSOLAZ.TTF";
      $thumb -> Copyrightposition = $opt['watermarkPos'];
      $thumb -> Copyrightfontsize = 12;
      $thumb -> Copyrighttextcolor = '#FFFFFF';
      $thumb -> Copyrighttext = $opt['cprighttext'];
    }
    if(!empty($opt['mirror']) && $opt['mirror']=='yes'){
      $thumb -> Mirror = array(1,20,100,40,2);
      $thumb -> Mirrorcolor = $opt['backgroundColor'];
    }

    $thumb -> Quality = $opt['quality'];
    $thumb -> Thumbprefix = '';
    $thumb -> Thumblocation = $target_path;
    $thumb -> Thumbfilename = $opt['image_name'];
    
    $thumb -> Createthumb($src_path,"file");
}
}

$cleaned_dirs = array();
$optionsArr = array();
foreach($options as $key => $val){
	$optionsArr[$key] = explode('~',$val);
}
unset($key,$val);

foreach ($tv_ids_arr as $tv_id){
	
	$tv_values = array();
	$tmplvars = array();
	$OnSiteRefresh = $e->name == 'OnSiteRefresh' ? true : false;
	
	if($OnSiteRefresh){
		
		@ini_set("max_execution_time","600"); //10 min.
		
		//выбираем из базы значения всех TV с нужным нам ID
		$tvval_query = $modx->db->select("contentid, value",$tb_tmplvar_values,"tmplvarid = '$tv_id'");
		if($modx->db->getRecordCount($tvval_query)>0){
			while($row = $modx->db->getRow($tvval_query)){
				$filepath = preg_replace('/(('.implode(')|(',$optionsArr['dirs']).'))\//', '', $row['value']);
				if(file_exists("../".$filepath."")) $tv_values[$row['contentid']] = $filepath;
			}
			unset($row,$filepath);
		}
			
	}else{
		
		global $content, $tmplvars;
		
		if(isset($_POST['id']) && !empty($_POST['tv'.$tv_id])) $tv_values[$_POST['id']] = $_POST['tv'.$tv_id];
		else continue;
		
	}
	
	/*echo '<pre>';
	print_r($tv_values);
	echo '</pre>';
	exit;*/
	
	foreach($tv_values as $tv_value){
	
	    if(!empty($tv_value)){
				
	        $s_value = $tv_value;
	        $image_name = $options['rename_images']=='yes' ? date("d.m.y_H.i").'.'.substr(basename($s_value),-3) : basename($s_value);
	        $location = '../'.dirname($s_value).'/';
	
	        if(count($optionsArr['dirs'])==0 || count($optionsArr['width'])==0 || count($optionsArr['height'])==0) continue;
	        if(!file_exists("../".$s_value)) continue;
	
	        $src_image = array();
	        list($src_image['width'], $src_image['height']) = getimagesize("../".$s_value);
	        $src_image['ratio'] = round(($src_image['width']/$src_image['height']),2);
	        
	        if(strpos($location,$optionsArr['dirs'][0])!==false) continue;
	        
	        foreach($optionsArr['dirs'] as $index => $th_dirname){
	            $th_options = array();
	            foreach($optionsArr as $key => $val){
	                $th_options[$key] = isset($val[$index]) ? $val[$index] : $val[0];
	            }
	            unset($key,$val);
	            $th_options['image_name'] = $image_name;
	            createThumb($location.$th_dirname.'/',$th_options,"../$s_value",$src_image);
	        }
	
	        if(!$OnSiteRefresh) $tmplvars[$tv_id][1] = $save_o_name=="yes" ? $image_name : substr($location,3).$optionsArr['dirs'][0].'/'.$image_name;
	
	    }
	    
	 }
}

}

?>