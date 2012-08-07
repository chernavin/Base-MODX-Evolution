//<?php
/**
 * multiTV
 * 
 * Выводит позиции добавленные при помощи multiTV
 *
 * @category 	snippet
 * @version 	5420e2b
 * @internal	@modx_category Content
 */

// @INCLUDE/assets/tvs/multitv/multitv.customtv.php

/*
[!multiTV?
&tvName=`event`
&docid=`[*id*]`
&outerTpl=`@CODE:<ul>((wrapper))</ul>`
&rowTpl=`@CODE:<li>((event)), ((location)), ((price))</li>`
&display=`5`
&rows=`all`
&toPlaceholder=`0`
&randomize=`0`
!]
*/

// published (0|1|2)

return include(MODX_BASE_PATH.'assets/tvs/multitv/multitv.snippet.php');

