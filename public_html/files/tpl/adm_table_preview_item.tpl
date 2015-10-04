<form method="post" action="actions.php?table={_type}&act=group">
<table class="datagrid" rel="{_type}" border=0 width="100%" cellpading=0 cellmargin=0>
<caption>[{_type}]</caption>
<thead>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<th>
Название
</th>
<th width='80'>
&nbsp;
</th>
<td>
<input value='t_{_type}' type='checkbox' class='checkAll'/>
</td>
</tr>
</thead>
<tbody>
{cicle_result}
</tbody>
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