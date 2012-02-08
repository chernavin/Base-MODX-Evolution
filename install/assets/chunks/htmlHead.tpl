/**
 * htmlHead
 * 
 * Содержимое HTML тега head
 * 
 * @category	chunk
 * @version 	1.1
 * @internal	@properties
 * @internal 	@modx_category Template
 */

<base href="[(site_url)]">
<meta http-equiv="Content-Type" content="text/html; charset=[(modx_charset)]">
<title>[+phx:if=`[*id*]`:isnot=`1`:then=`[*pagetitle*], `+][(site_name)]</title>
