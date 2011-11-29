/**
 * feedbackForm
 * 
 * Default feedback form
 * 
 * @category	chunk
 * @version 	1.0.0
 * @internal	@properties
 * @internal 	@modx_category Forms
 */

<div id="feedbackErrors">[+validationmessage+]</div>

<form method="post">
	<input type="hidden" name="formid" value="feedbackForm">
	
	<table id="feedbackTable">
		<tr>
			<td align="right">Контакное лицо:</td>
			<td><input type="text" name="name" size="25" maxlength="50" eform="Контакное лицо:text:1"></td>
		</tr>
		
		<tr>
			<td align="right">Телефон:</td>
			<td><input type="text" name="phone" size="25" maxlength="40" eform="Телефон:text:1"></td>
		</tr>
		
		<tr>
			<td align="right">Электронный ящик:</td>
			<td><input type="text" name="email" size="25" maxlength="40" eform="Электронный ящик:email:1"></td>
		</tr>
		
		<tr>
			<td align="right" valign="top">Текст сообщения:</td>
			<td><textarea cols="40" rows="10" name="comment" eform="Текст сообщения:text:1"></textarea></td>
		</tr>
		
		<tr>
			<td></td>
			<td><img src="[+verimageurl+]" alt="Код проверки"></td>
		</tr>
		
		<tr>
			<td align="right">Введите этот код:</td>
			<td><input type="text" size="25" name="vericode"></td>
		</tr>
		
		<tr>
			<td></td>
			<td><input type="submit" value="Отправить"></td>
		</tr>
	</table>
</form>
