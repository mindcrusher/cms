<form name="Profile" method='POST' action='/cms/actions.php?act=edit&return=&table=vovcosmoru__users' border='1' enctype="multipart/form-data" >
<table id='profileform' width='98%'><tr>
  <td>�����</td>
  <td>{name}<br></td></tr>
    <tr>
      <td>������ ������</td>
      <td><input maxlength='50'  name='oldpass' type='password' />
          <br />      </td>
    </tr>
	 <tr>
      <td>����� ������</td>
      <td><input  maxlength='50'  name='newpass' type='password' />
          <br />      </td>
    </tr>
    <tr>
      <td>�������������</td><td>
	  	<input maxlength='50'  name='pass' type='password'><br> 
 
</td></tr><tr><td>�������</td><td><input maxlength='200'  name='surname' type='text' value='{surname}'><br> 
 
</td></tr><tr><td>���</td><td><input maxlength='255'  name='firstname' type='text' value='{firstname}'><br> 
 
</td></tr><tr><td>��. �����</td><td><input maxlength='200'  name='email' type='text' value='{email}'><br> 
 
</td></tr><tr><td>�������</td><td><input maxlength='50'  name='phone' type='text' value='{phone}'><br> 
 
</td></tr><tr><td>����� ��������</td><td><input maxlength='255'  name='address' type='text' value='{address}'><br> 
 
</td></tr><tr><td></td><td>
	<input style='width:20px;' checked  title="none" onclick="describeData(this)" type=radio name='client' id='client' value='��������� ����������' />��������� ���������� 
	<input style='width:20px;' title="����� �������,<br />��� � ����� �����. ���� ������� - ����������� ����������� ������� ���������� ��������" onclick="describeData(this)"  type=radio name='client' id='client' value='��������' />�������� 
	<input style='width:20px;'  title="�������� ��,<br />
���������� ������:
  �����,<br /> �����,<br />
  ��� � ����� �����
����� ��������,<br />
���,<br />
����,<br />
���������� ���������:
  ���. ����.,<br />
  ���,<br />
  ��������� ����,<br />
  ������������ �����" onclick="describeData(this)" type=radio name='client' id='client' value='�������������� ���������������' />��.
	<input style='width:20px;' title="�������� �����,<br />
����������� �������(���),<br />
����������� �����,<br />
����������� �����,<br />
���,<br />
���,<br />
����,<br />
�����,<br />
���������� ���������:
  ���. ����.,<br />
  ���,<br />
  ��������� ����,<br />
  ������������ �����" onclick="describeData(this)"  type=radio name='client' id='client' value='����������� ����' />����������� ���� <br> 
 
</td></tr>
<tr>
  <td><span id="additional_text">�������������</span></td>
  <td><textarea name="additional"  cols="50" rows="8" id="additional"></textarea></td>
</tr><tr><td width='150'>&nbsp;</td><td><input type='submit' style='width:150px;' value='���������'> <input type='button' onclick='javascript:history.back(-1)' style='width:150px;' value='������'></td></tr></table>
<input name='id' type='hidden' value='1000'><br> 
 
</form>
<script type="text/javascript">
function describeData(object)
{
	var type = object.title;
	var cvalue = object.value;
//	alert(type);
	text = document.getElementById('additional');
	descr = document.getElementById('additional_text');
	
	if(type != 'none')
	{
		descr.innerHTML = type;
		text.style.display = "block";
		descr.style.display = "block";
	}
	else
	{
		text.style.display = "none";
		descr.style.display = "none";
	}
	text.clientWidth = descr.clientWidth;
}
checkCur = function()
{

	inp = window.document.Profile.client;
	for(i in inp)
	{
		val = inp[i].checked;
		if(val)
		{
			describeData(inp[i]);
		}
	
	}
	
}
window.onload = checkCur();
</script>