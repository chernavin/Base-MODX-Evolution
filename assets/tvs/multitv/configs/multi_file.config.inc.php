<?php
$settings['display'] = 'vertical';
$settings['fields'] = array(
	'file' => array(
		'caption' => 'Файл',
		'type' => 'file'
	),
	'title' => array(
		'caption' => 'Название',
		'type' => 'text',
	)
);
$settings['templates'] = array(
	'outerTpl' => '<ul>[+wrapper+]</ul>',
	'rowTpl' => '<li><a href="[+file+]">[+title+]</a></li>'
);
$settings['paste'] = array(
	'csvseparator' => ';'
);
?>
