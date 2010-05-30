<h3><?php echo $this->Html->link($post['Post']['title'], array('controller' => 'posts', 'action' => 'view', 'slug' => $post['Post']['slug'])); ?></h3>
<div><?php echo $post['Post']['content']; ?></div>

<p>
	Posted by <?php echo $this->Html->link($post['User']['name'], array('controller' => 'users', 'action' => 'view', $post['User']['id'])); ?> on <?php echo $post['Post']['scheduled']; ?>
	<?php
	if ($this->Html->is_user($post['User']['id'])) {
		echo ' | '.$this->Html->link('Edit', array('controller' => 'posts', 'action' => 'edit', $post['Post']['id'], 'backstage' => true));
	}
	?>
</p>
<h3><?php echo sprintf(__n('%d comments', '%d comments', $post['Post']['comment_count'], true), $post['Post']['comment_count']); ?></h3>