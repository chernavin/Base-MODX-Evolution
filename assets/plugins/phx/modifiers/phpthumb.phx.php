<?php

if(!isset($options)) return;
if(!isset($output)) return;

return $modx->runSnippet('phpthumb', array(
	'input' => $output,
	'options' => $options
));

?>
