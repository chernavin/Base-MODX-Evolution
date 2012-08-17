<?php

if(!isset($options)) return;
if(!isset($output)) return;

return $modx->runSnippet('phpthumbof', array(
	'input' => $output,
	'options' => $options
));

?>
