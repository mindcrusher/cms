<?
require("init.php");
ob_start('main_handling');
// подключаем сборщик страниц
require("compare.php");
/* собираем всё что есть и отдаём браузеру */
$PSE->setTemplate('index');
$PSE->parseBuffer($PSE_VARS);
$PSE->cleanBuffer();
$PSE->showBuffer();
?>
