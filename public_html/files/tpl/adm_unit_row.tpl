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
				<th style='width:120px'>График работ</th>
				<td>{shedule}</td>
			</tr>
			<tr>
				<th style='width:120px'>Возраст</th>
				<td>{age}</td>
			</tr>
			<tr>
				<th style='width:120px'>Гражданство</th>
				<td>{citizenship}</td>
			</tr>
			<tr>
				<th style='width:120px'>Национальность</th>
				<td>{nationality}</td>
			</tr>
			<tr>
				<th style='width:120px'>Образование</th>
				<td>{education}</td>
			</tr>
			<tr>
				<th style='width:120px'>Специальность</th>
				<td>{speciality}</td>
			</tr>
			<tr>
				<th style='width:120px'>Опыт работы (лет)</th>
				<td>{exp}</td>
			</tr>
			<tr>
				<th style='width:120px'>Професиональные навыки</th>
				<td>{skills}</td>
			</tr>
			<tr>
				<th style='width:120px'>Дополнительная информация</th>
				<td>{additional}</td>
			</tr>
		</table>
	</td>
	<td>
		<a class='ajaxLoad' href="form.php?type=unit&id={id}&act=edit&form=show">[изм.]</a>
	</td>
	<td>
		<input type="checkbox" style="width:18px;" name="check[]" value="{id}" />
	</td>
</tr>