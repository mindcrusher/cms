<form method="post" action="actions.php?table={_type}&act=group">
<table class="datagrid" rel="{_type}" border=0 width="100%" cellpading=0 cellmargin=0>
<caption>[{_type}]</caption>
<thead>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<th>
��������
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