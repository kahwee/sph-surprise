<div class="posts index">
	<h2><?php __('My blog'); ?></h2>
	<hr />
	<?php foreach ($posts as $post): ?>
		<h3><?php echo $this->Html->link($post['Post']['title'], array('controller' => 'posts', 'action' => 'view', 'slug' => $post['Post']['slug'])); ?></h3>
		<div><?php echo $post['Post']['content']; ?></div>
		
		<p>Posted by <?php echo $this->Html->link($post['User']['full_name'], array('controller' => 'users', 'action' => 'view', $post['User']['id'])); ?> on <?php echo $post['Post']['scheduled']; ?></p>
		<p>
		<?php echo $this->Html->link(__('View', true), array('action' => 'view', $post['Post']['id'])); ?>
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
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Post', true)), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Users', true)), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('User', true)), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>