<?php

#Declarations for RSS, copy and paste
$this->set('document', array(
	'xmlns:dc' => 'http://purl.org/dc/elements/1.1/'));

$this->set('channel', array(
	'title' => __("Recent posts from " . Configure::read('blog_name'), true),
	'link' => $html->url('/', true),
	'description' => __("Recent posts from " . Configure::read('blog_name'), true),
	'language' => 'en-us'));

#Now for all the 20 past posts.
foreach ($posts as $post) {
	$post_time = strtotime($post['Post']['scheduled']);

	$post_link = array(
		'controller' => 'posts',
		'action' => 'view',
		'slug' => $post['Post']['slug'],
	);
	#Just in case, sanitize so that feeds can nicely validate
	App::import('Sanitize');
	$post_content = preg_replace('=\(.*?\)=is', '', $post['Post']['content']);
	$post_content = $this->Text->stripLinks($post_content);
	$post_content = Sanitize::stripAll($post_content);
	$post_content = $this->Text->truncate($post_content, 800, array('ending' => '...', 'exact' => true, 'html' => true));

	echo $this->Rss->item(array(), array(
		'title' => $post['Post']['title'],
		'link' => $post_link,
		'guid' => array('url' => $post_link, 'isPermaLink' => 'true'),
		'description' => $post_content,
		'dc:creator' => $post['User']['name'],
		'pubDate' => $post['Post']['scheduled'])
	);
}
?>