<div id="add_comment">
<b>�������� ����������:</b>
<form action="/addcomment/" method=post>
<input onfocus="if(this.value=='��� ��?')this.value=''" onblur="if(this.value=='')this.value='��� ��?'" value="��� ��?" type="text" name="name"/><br>
<textarea id="commenttext"  onfocus="if(this.value=='��� ������ �������?'){this.value='';}" onblur="if(this.value==''){this.value='��� ������ �������?'};" name="text">��� ������ �������?</textarea><br>
<input class="submit" type="submit" value="�����������">
<input name="parent" type="hidden" value="{_GETid}">
<input name="pid" type="hidden" value="{_GETpid}">
</form>
</div>