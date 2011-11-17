<?php

if(!isset($options)) $options = '';
if(!isset($output)) $output = '';

$replace = explode(',',$options);
if(count($replace)<2) return '';

return str_replace($replace[0],$replace[1],$output);

?>