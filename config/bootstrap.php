<?php
Configure::write('environment', 'default');
Configure::write('blog_name', 'My favorite blog');
if (file_exists(CONFIGS.'local.php')) require_once(CONFIGS.'local.php');
else throw new Exception("Cannot find ./config/local.php");
?>