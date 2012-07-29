//<?php
/**
 * DocInfo
 *
 * Returns any document field or template variable from any document
 *
 * @category	snippet
 * @version		1.0
 * @license		http://www.gnu.org/copyleft/gpl.html GNU Public License (GPL)
 * @internal	@properties
 * @internal	@modx_category Content
*/

/* 
*	Returns any document field or template variable from any document
*	[[DocInfo? &docid=`15` &field=`pagetitle`]]
*	[[DocInfo? &docid=`10` &tv=`1` &field=`tvname`]]
*/
$docid = (isset($docid) && (int)$docid>0) ? (int)$docid : $modx->documentIdentifier;
$field = (isset($field)) ? $field : 'pagetitle';
$output='';
if(isset($tv) && $tv==1){
   $tv=$modx->getTemplateVar($field,'*',$docid,1);
   if($tv['value']!=''){
      $output=$tv['value'];
   }else{
      $output=$tv['defaultText'];
   }
}else{
   $doc=$modx->getPageInfo($docid,'1',$field);
   $output=$doc[$field];
}
return $output;
