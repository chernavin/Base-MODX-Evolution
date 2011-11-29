//<?php
/**
 * tvList
 * 
 * Наполняет tv список (<select>) дочерними ресурсами соответствующего контейнера
 *
 * @category 	snippet
 * @version 	1.0
 * @internal	@modx_category Manager and Admin
 */

// @EVAL return $modx->runSnippet('categoryList', array('docid' => 1));

$output = 'Выберите==0||';
$docid = intval($docid);
$list = $modx->getAllChildren($docid);

if(count($list) > 0)
{
    //$nbsp=chr(0xC2).chr(0xA0);

    foreach($list as $doc)
    {
        $output .= $doc['pagetitle'] . '==' . $doc['id'] . '||';
    }

    $output = substr($output, 0, strlen($output) - 2);
}

return $output;
