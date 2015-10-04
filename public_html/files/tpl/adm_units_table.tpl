<form method="post" action="actions.php?table={_type}&act=group">
<table class='table'>
	<tr>
		<th>Фото</th>
		<th>Информация</th>
		<th>&nbsp;</th>
		<th><input value='1' type='checkbox' id='checkAll'/></th>
	</tr>
	{cicle_result}
</table>
<div class='right'>
<b>C отмечеными:</b>
<select name="act" style='width:150px;'>
	<option value='none'>ничего не делать</option>
	<option value="display:Нет">Скрыть</option>
	<option value="display:Да">Отображать</option>
	<option value='delete'>Удалить</option>
</select>
<input type="submit" style="width:35px" value="Ок"/>
</div>
</form>