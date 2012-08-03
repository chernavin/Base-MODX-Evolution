<?php
$settings['display'] = 'vertical';
$settings['fields'] = array(
	'image' => array(
		'caption' => 'Изображение',
		'type' => 'image'
	),
	'thumb' => array(
		'type' => 'thumb',
		'thumbof' => 'image'
	),
	'title' => array(
		'caption' => 'Название',
		'type' => 'text',
	)
);
$settings['templates'] = array(
	'outerTpl' => '<ul>[+wrapper+]</ul>',
	'rowTpl' => '<li><img src="[+image+]" alt="[+title+]"></li>'
);
$settings['paste'] = array(
	'csvseparator' => ';'
);
?>
