<form method="post" action="/commons/edit_tpl.php?file=../{template_file}">
  <textarea name="content" id="content">{content}</textarea>
  <input style="width:150px;" type="submit" value="Изменить" />
  <input style="width:150px;" type="button" value="Отменить" onclick="history.back(-1);" />
</form>
