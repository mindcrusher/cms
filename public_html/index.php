<?
require("init.php");
ob_start('main_handling');
// ���������� ������� �������
require("compare.php");
/* �������� �� ��� ���� � ����� �������� */
$PSE->setTemplate('index');
$PSE->parseBuffer($PSE_VARS);
$PSE->cleanBuffer();
$PSE->showBuffer();
?>
