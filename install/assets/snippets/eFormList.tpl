//<?php
/**
 * eFormList
 * 
 * Наполняет список (<select>) дочерними ресурсами соответствующего контейнера
 *
 * @category 	snippet
 * @version 	1.0
 * @internal	@modx_category Forms
 */

// &eFormOnBeforeFormParse=`populateList`

function populateList(&$fields, &$templates)
{
	global $modx;

	$list = $modx->runSnippet('Ditto', array(
		'startID' => 1,
		'tpl' => '@CODE <option value="[+id+]">[+pagetitle+]</option>',
		'sortBy' => 'menuindex',
		'sortDir' => 'ASC',
		'showInMenuOnly' => 1
	));

	$templates['tpl'] = str_replace('[+list+]', $list, $templates['tpl']);

	return true;
}
