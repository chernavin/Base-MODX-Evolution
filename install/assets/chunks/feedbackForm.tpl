/**
 * feedbackForm
 * 
 * Форма обратной связи
 * 
 * @category	chunk
 * @version 	1.1
 * @internal	@properties
 * @internal 	@modx_category eForm
 */

<div id="feedbackErrors">[+validationmessage+]</div>

<form method="post">
	<input type="hidden" name="formid" value="feedbackForm">
	
	<table id="feedbackTable">
		<tr>
			<td class="right">Контакное лицо<span class="red">*</span>:</td>
			<td><input type="text" name="name" size="25" eform="Контакное лицо:string:1"></td>
		</tr>
		
		<tr>
			<td class="right">Телефон<span class="red">*</span>:</td>
			<td><input type="text" name="phone" size="25" eform="Телефон:string:1"></td>
		</tr>
		
		<tr>
			<td class="right">Электронный ящик<span class="red">*</span>:</td>
			<td><input type="text" name="email" size="25" eform="Электронный ящик:email:1"></td>
		</tr>
		
		<tr>
			<td class="right">Текст сообщения<span class="red">*</span>:</td>
			<td><textarea cols="40" rows="10" name="msg" eform="Текст сообщения:html:1"></textarea></td>
		</tr>
		
		<tr>
			<td>&nbsp;</td>
			<td><img src="[+verimageurl+]" alt="Код проверки"></td>
		</tr>
		
		<tr>
			<td class="right">Введите этот код<span class="red">*</span>:</td>
			<td><input type="text" size="25" name="vericode"></td>
		</tr>
		
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="Отправить"></td>
		</tr>
	</table>
</form>

<style type="text/css">
	#feedbackErrors{margin:10px 0px;color:#F22;}
	#feedbackTable td{padding:5px;text-align:left;vertical-align:top;}
	#feedbackTable td.right{text-align:right;}
	#feedbackTable td.right span.red{color:red;}
</style>
