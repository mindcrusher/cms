<div id="add_comment">
<b>Оставить коментарий:</b>
<form action="/addcomment/" method=post>
<input onfocus="if(this.value=='Кто вы?')this.value=''" onblur="if(this.value=='')this.value='Кто вы?'" value="Кто вы?" type="text" name="name"/><br>
<textarea id="commenttext"  onfocus="if(this.value=='Что хотите сказать?'){this.value='';}" onblur="if(this.value==''){this.value='Что хотите сказать?'};" name="text">Что хотите сказать?</textarea><br>
<input class="submit" type="submit" value="Откоментить">
<input name="parent" type="hidden" value="{_GETid}">
<input name="pid" type="hidden" value="{_GETpid}">
</form>
</div>