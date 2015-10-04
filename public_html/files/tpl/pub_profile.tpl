<form name="Profile" method='POST' action='/cms/actions.php?act=edit&return=&table=vovcosmoru__users' border='1' enctype="multipart/form-data" >
<table id='profileform' width='98%'><tr>
  <td>Логин</td>
  <td>{name}<br></td></tr>
    <tr>
      <td>Старый пароль</td>
      <td><input maxlength='50'  name='oldpass' type='password' />
          <br />      </td>
    </tr>
	 <tr>
      <td>Новый пароль</td>
      <td><input  maxlength='50'  name='newpass' type='password' />
          <br />      </td>
    </tr>
    <tr>
      <td>Подтверждение</td><td>
	  	<input maxlength='50'  name='pass' type='password'><br> 
 
</td></tr><tr><td>Фамилия</td><td><input maxlength='200'  name='surname' type='text' value='{surname}'><br> 
 
</td></tr><tr><td>Имя</td><td><input maxlength='255'  name='firstname' type='text' value='{firstname}'><br> 
 
</td></tr><tr><td>Эл. Адрес</td><td><input maxlength='200'  name='email' type='text' value='{email}'><br> 
 
</td></tr><tr><td>Телефон</td><td><input maxlength='50'  name='phone' type='text' value='{phone}'><br> 
 
</td></tr><tr><td>Адрес доставки</td><td><input maxlength='255'  name='address' type='text' value='{address}'><br> 
 
</td></tr><tr><td></td><td>
	<input style='width:20px;' checked  title="none" onclick="describeData(this)" type=radio name='client' id='client' value='Розничный покупатель' />Розничный покупатель 
	<input style='width:20px;' title="Номер диплома,<br />кем и когда выдан. Если студент - наименвание организации которая производит обучение" onclick="describeData(this)"  type=radio name='client' id='client' value='Визажист' />Визажист 
	<input style='width:20px;'  title="Название ИП,<br />
Паспортные данные:
  серия,<br /> номер,<br />
  Кем и когда выдан
Адрес прописки,<br />
ИНН,<br />
ОГРН,<br />
Банковские реквизиты:
  Кор. счёт.,<br />
  БИК,<br />
  расчётный счёт,<br />
  Наименование банка" onclick="describeData(this)" type=radio name='client' id='client' value='Индивидуальный предприниматель' />ИП.
	<input style='width:20px;' title="Название фирмы,<br />
Генеральный директо(ФИО),<br />
Фактический адрес,<br />
Юридический адрес,<br />
КПП,<br />
ИНН,<br />
ОГРН,<br />
ОКАТО,<br />
Банковские реквизиты:
  Кор. счёт.,<br />
  БИК,<br />
  расчётный счёт,<br />
  Наименование банка" onclick="describeData(this)"  type=radio name='client' id='client' value='Юридическое лицо' />Юридическое лицо <br> 
 
</td></tr>
<tr>
  <td><span id="additional_text">Дополнительно</span></td>
  <td><textarea name="additional"  cols="50" rows="8" id="additional"></textarea></td>
</tr><tr><td width='150'>&nbsp;</td><td><input type='submit' style='width:150px;' value='Сохранить'> <input type='button' onclick='javascript:history.back(-1)' style='width:150px;' value='Отмена'></td></tr></table>
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