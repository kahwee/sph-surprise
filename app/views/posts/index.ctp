<div class="posts index">
	<h2><?php __('My blog'); ?></h2>
	<hr />
	<?php foreach ($posts as $post): ?>
		<h3><?php echo $this->Html->link($post['Post']['title'], array('controller' => 'posts', 'action' => 'view', 'slug' => $post['Post']['slug'])); ?></h3>
		<div><?php echo $post['Post']['content']; ?></div>

		<p>Posted by <?php echo $this->Html->link($post['User']['name'], array('controller' => 'users', 'action' => 'view', $post['User']['id'])); ?> on <?php echo $post['Post']['scheduled']; ?></p>
		<p>
		<?php echo $this->Html->link(sprintf(__n('%d comments', '%d comments', $post['Post']['comment_count'], true), $post['Post']['comment_count']), array('controller' => 'posts', 'action' => 'view', 'slug' => $post['Post']['slug'], '#' => 'comments')); ?>
	</p>
	<hr />
	<?php endforeach; ?>
		<p>
		<?php
		echo $this->Paginator->counter(array(
			'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
		));
		?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class' => 'disabled')); ?>
	 | 	<?php echo $this->Paginator->numbers(); ?>
			|
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled')); ?>
	</div>
</div>
<div class="actions">
	<?php if ($auth_user = $this->Html->get_logged_in()): ?>
			<h3><?php __("Hi $auth_user[name]"); ?></h3>
			<ul>
				<li><?php echo $this->Html->link('Add a new post', array('controller' => 'posts', 'action' => 'add', 'backstage' => true)); ?></li>
				<li><?php echo $this->Html->link('View all posts', array('controller' => 'posts', 'action' => 'index', 'backstage' => true)); ?></li>
			</ul>

	<?php else: ?>

				<h3><?php __('Actions'); ?></h3>
				<ul>
					<li><?php echo $this->Html->link('Register', array('controller' => 'users', 'action' => 'register')); ?></li>
					<li><?php echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login')); ?></li>
				</ul>
	<?php endif; ?>
				<h3><?php __('Search'); ?></h3>
	<?php echo $this->element('search'); ?>
</div>