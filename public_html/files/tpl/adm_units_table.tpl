<form method="post" action="actions.php?table={_type}&act=group">
<table class='table'>
	<tr>
		<th>����</th>
		<th>����������</th>
		<th>&nbsp;</th>
		<th><input value='1' type='checkbox' id='checkAll'/></th>
	</tr>
	{cicle_result}
</table>
<div class='right'>
<b>C ����������:</b>
<select name="act" style='width:150px;'>
	<option value='none'>������ �� ������</option>
	<option value="display:���">������</option>
	<option value="display:��">����������</option>
	<option value='delete'>�������</option>
</select>
<input type="submit" style="width:35px" value="��"/>
</div>
</form>