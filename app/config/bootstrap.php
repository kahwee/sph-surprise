<?php
Configure::write('environment', 'default');
if (file_exists(CONFIGS.'local.php')) require_once(CONFIGS.'local.php');
else throw new Exception("Cannot find ./config/local.php");
?>