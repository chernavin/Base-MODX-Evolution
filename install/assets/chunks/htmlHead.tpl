/**
 * htmlHead
 * 
 * Содержимое HTML тега head
 * 
 * @category	chunk
 * @version 	1.11
 * @internal	@properties
 * @internal 	@modx_category Template
 */

<base href="[(site_url)]">

<meta http-equiv="Content-Type" content="text/html; charset=[(modx_charset)]">
[*metaKeywords:ifnotempty=`<meta name="keywords" content="[*metaKeywords*]">`*]
[*metaDesc:ifnotempty=`<meta name="description" content="[*metaDesc*]">`*]
[*noIndex*]

<title>[*title:ifempty=`[*pagetitle*], [(site_name)]`*]</title>
