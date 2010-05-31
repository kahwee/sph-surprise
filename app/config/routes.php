<?php

Router::parseExtensions('rss');
Router::connect('/archives/:slug', array('controller' => 'posts', 'action' => 'view'));
Router::connect('/register', array('controller' => 'users', 'action' => 'register'));
Router::connect('/login', array('controller' => 'users', 'action' => 'login'));
Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));
Router::connect('/', array('controller' => 'posts', 'action' => 'index'));
Router::connect('/feed', array('controller' => 'posts', 'action' => 'index'));
Router::connect('/backstage', array('controller' => 'posts', 'action' => 'index', 'backstage' => true));
#Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
?>