<?php
/***/
require "init.php";
$PSE->BackUpDb(ENGINE_ROOT.'/files/backups/'.date('Y_m_d_H:i:s').'.sql');
$exec = 'tar -czf backup.tar.gz '.ENGINE_ROOT;
exec($exec);
?>