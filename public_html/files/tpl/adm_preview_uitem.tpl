<tr id="position_{id}">
<td  class="handle" style="width:20px;cursor:move;">
	<span class='ui-icon ui-icon-arrowthick-2-n-s'></span>
</td>
<td  class="d{display}" style="height:40px;width:40px;background:url({xsmall});overflow:hidden;"><a class='zoom block' style='width:40px;height:40px;'  href="{pic}"></a></td>
<td style="width:90%;" class="d{display}" rel="parent:{parent};">
	{indent}<a href="index.php?type={_type}&id={id}&pid={parent}&act=edit"><b>{nomenclature}</b> {name}</a>
</td>
<td style="width:50px;">
	<a class='ajaxLoad' href="form.php?type={_type}&id={id}&pid={parent}&act=edit&form=show">[изм.]</a>
	<a href="index.php?type={_type}&id={id}&pid={parent}&act=edit">[&darr;&darr;&darr;]</a>
	<!--a title="{name}" class='del' href='actions.php?table={_type}s&act=del&id={id}'>[x]</a-->
</td>
<td style="width:30px;text-align:center;">
	<input class='t_{_type}s' type="checkbox" style="width:18px;" name="check[]" value="{id}" />
</td>
</tr>
