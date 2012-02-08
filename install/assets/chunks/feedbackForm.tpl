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
			<td>Контакное лицо:</td>
			<td><input type="text" name="name" size="25" eform="Контакное лицо:text:1"></td>
		</tr>
		
		<tr>
			<td>Телефон:</td>
			<td><input type="text" name="phone" size="25" eform="Телефон:text:1"></td>
		</tr>
		
		<tr>
			<td>Электронный ящик:</td>
			<td><input type="text" name="email" size="25" eform="Электронный ящик:email:1"></td>
		</tr>
		
		<tr>
			<td>Текст сообщения:</td>
			<td><textarea cols="40" rows="10" name="comment" eform="Текст сообщения:text:1"></textarea></td>
		</tr>
		
		<tr>
			<td></td>
			<td><img src="[+verimageurl+]" alt="Код проверки"></td>
		</tr>
		
		<tr>
			<td>Введите этот код:</td>
			<td><input type="text" size="25" name="vericode"></td>
		</tr>
		
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="Отправить"></td>
		</tr>
	</table>
</form>

<style type="text/css">
	#feedbackErrors{margin:10px 0px;color:#F22}
	#feedbackTable td{padding:5px;text-align:right;vertical-align:top}
</style>
