//<?php
/**
 * phpthumb
 * 
 * Генерация изображений
 *
 * @category 	snippet
 * @version 	1.0
 * @internal	@modx_category Content
 */

if ( ! $input) return;

$replace = array(',' => '&', '_' => '=');
$options = strtr($options, $replace);
$options .= '&f=jpg&q=90';
$docid = $modx->documentIdentifier;
$outputFilename = MODX_BASE_PATH . 'assets/cache/phpthumb/' .
					md5($input . $docid . $options) . '.jpg';

if ( ! file_exists($outputFilename))
{
	require_once MODX_BASE_PATH . 'assets/snippets/phpthumb/phpthumb.class.php';
	$phpThumb = new phpthumb();
	$phpThumb->setSourceFilename(MODX_BASE_PATH . $input);

	$options_arr = explode('&', $options);
	foreach ($options_arr as $param)
	{
	   $param_arr = explode('=', $param);
	   $phpThumb->setParameter($param_arr[0], $param_arr[1]);
	}

	if ($phpThumb->GenerateThumbnail())
	{
		$phpThumb->RenderToFile($outputFilename);
	}
	else return;
}

$output = explode(MODX_BASE_PATH, $outputFilename); 
$output = $output[1];

return $output;
