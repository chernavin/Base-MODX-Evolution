//<?php
/**
 * MultiPhotos
 *
 * Вывод фотографий
 *
 * @category 	snippet
 * @version 	1.22
 * @license 	http://www.gnu.org/copyleft/gpl.html GNU Public License (GPL)
 * @author      Temus (temus3@gmail.com)
 * @internal	@properties
 * @internal	@modx_category Content
 */

 
$tvname = isset($tvname) ? $tvname : 'photos';
$outerTpl = isset($outerTpl) ? $modx->getChunk($outerTpl) : '<div class="thumbs">[+photos+]</div>';
$rowTpl = isset($rowTpl) ? $modx->getChunk($rowTpl) : '<a href="[+link+]" id="thumb_[+num+]"><img src="[+url+]" alt="" title="[+title+]" /></a>';
$fid = isset($fid) ? $fid : false;

if (isset($id)) {
	$tvf = $modx->getTemplateVar($tvname,'*',$id);
	$tvv = $tvf['value'];
} else {
	$id = $modx->documentObject['id']; 
	$tvf = $modx->documentObject[$tvname];
	$tvv = $tvf[1];
}
if (!$tvv) return;
$fotoArr=json_decode($tvv);
$fotoRes=array();
$num=1;
foreach ($fotoArr as $v) {
	$fields = array ('[+url+]','[+link+]','[+title+]','[+num+]');
	$values = array ($v[0],$v[1],$v[2],$num);
	$fotoRes[$num] = str_replace($fields, $values, $rowTpl);
	$num++;
}
$output = $fid ? $fotoRes[$fid] : implode('',$fotoRes);
if (isset($random)) $output = $fotoRes[array_rand($fotoRes)];
if ($output) return str_replace('[+photos+]',$output,$outerTpl);
