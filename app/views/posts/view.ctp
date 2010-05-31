<h3><?php echo $this->Html->link($post['Post']['title'], array('controller' => 'posts', 'action' => 'view', 'slug' => $post['Post']['slug'])); ?></h3>
<div><?php echo $post['Post']['content']; ?></div>

<p>
	Posted by <?php echo $this->Html->link($post['User']['name'], array('controller' => 'users', 'action' => 'view', $post['User']['id'])); ?> on <?php echo $post['Post']['scheduled']; ?>
	<?php
	if ($this->Html->is_user($post['User']['id'])) {
		echo ' | ' . $this->Html->link('Edit', array('controller' => 'posts', 'action' => 'edit', $post['Post']['id'], 'backstage' => true));
	}
	?>
</p>
<?php if ($post['Post']['comment_count'] > 0): ?>
		<h3><?php echo sprintf(__n('%d comments', '%d comments', $post['Post']['comment_count'], true), $post['Post']['comment_count']); ?></h3>
		<ul>
	<?php foreach ($post['Comment'] as $comment): ?>
			<li><p><?php echo $comment['content']; ?><br />By <?php echo $comment['name']; ?></p></li>
	<?php endforeach; ?>
		</ul>
<?php endif; ?>
			<h3>Add your comment</h3>			
<?php
			echo $this->Form->create('Comment', array('url' => $this->Html->url()));
			echo $this->Form->input('name');
			echo $this->Form->input('email');
			echo $this->Form->input('content', array('type' => 'textarea'));
			echo $this->Form->end(__('Submit comment', true));
?>