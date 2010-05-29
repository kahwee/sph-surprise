<?php

Router::connect('/login', array('controller' => 'users', 'action' => 'login'));
Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));
Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
?>