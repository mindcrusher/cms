<tr>
<td  class="d{display}" style="height:40px;width:40px;background:url({xsmall});overflow:hidden;"><a class='zoom block' style='width:40px;height:40px;'  href="{pic}"></a></td>
<td  class="d{display}">
	<a href="index.php?type={_type}&id={id}&pid={parent}&act=edit">{name}</a>
</td>
<td>
	<a class='ajaxLoad' href="form.php?type={_type}&id={id}&pid={parent}&act=edit&form=show">[изм.]</a>
	<a href="index.php?type={_type}&id={id}&pid={parent}&act=edit">[&darr;&darr;&darr;]</a>
	<!--a title="{name}" class='del' href='actions.php?table={_type}s&act=del&id={id}'>[x]</a-->
</td>
<td>
	<input type="checkbox" style="width:18px;" name="check[]" value="{id}" />
</td>
</tr>
