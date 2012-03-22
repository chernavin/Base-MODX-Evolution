//<?php
/**
 * tvList
 * 
 * Наполняет tv (выпадающий список) дочерними ресурсами соответствующего контейнера
 *
 * @category 	snippet
 * @version 	1.1
 * @internal	@modx_category Manager and Admin
 */

// @EVAL return $modx->runSnippet('tvList', array('docid' => 1));

$docid  = intval($docid);
$sort   = isset($sort) ? $sort : 'menuindex';
$dir    = isset($dir)  ? $dir  : 'ASC';

$output = 'Выберите...==0||';
$list = $modx->getAllChildren($docid, $sort, $dir);

if(count($list) > 0)
{
    foreach($list as $doc)
    {
        $output .= $doc['pagetitle'] . '==' . $doc['id'] . '||';
    }

    $output = substr($output, 0, strlen($output) - 2);
}

return $output;
