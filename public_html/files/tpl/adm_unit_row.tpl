<tr>
	<td>
		<div style="background:url({icon}) center top no-repeat;width:150px;height:195px;"></div>
	</td>
	<td>
		<table border="1" class='table'>
			<tr>
				<th class='header' colspan="2">{sname}</th>
			</tr>
			<tr>
				<th style='width:120px'>������ �����</th>
				<td>{shedule}</td>
			</tr>
			<tr>
				<th style='width:120px'>�������</th>
				<td>{age}</td>
			</tr>
			<tr>
				<th style='width:120px'>�����������</th>
				<td>{citizenship}</td>
			</tr>
			<tr>
				<th style='width:120px'>��������������</th>
				<td>{nationality}</td>
			</tr>
			<tr>
				<th style='width:120px'>�����������</th>
				<td>{education}</td>
			</tr>
			<tr>
				<th style='width:120px'>�������������</th>
				<td>{speciality}</td>
			</tr>
			<tr>
				<th style='width:120px'>���� ������ (���)</th>
				<td>{exp}</td>
			</tr>
			<tr>
				<th style='width:120px'>��������������� ������</th>
				<td>{skills}</td>
			</tr>
			<tr>
				<th style='width:120px'>�������������� ����������</th>
				<td>{additional}</td>
			</tr>
		</table>
	</td>
	<td>
		<a class='ajaxLoad' href="form.php?type=unit&id={id}&act=edit&form=show">[���.]</a>
	</td>
	<td>
		<input type="checkbox" style="width:18px;" name="check[]" value="{id}" />
	</td>
</tr>