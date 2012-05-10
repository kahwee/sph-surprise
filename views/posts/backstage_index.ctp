<div class="posts index">
	<h2><?php __('Posts'); ?></h2>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('scheduled'); ?></th>
			<th class="actions"><?php __('Actions'); ?></th>
		</tr>
		<?php
		$i = 0;
		foreach ($posts as $post):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
			<tr<?php echo $class; ?>>
				<td><?php echo $post['Post']['id']; ?>&nbsp;</td>
				<td><?php echo $post['Post']['title']; ?>&nbsp;</td>
				<td>
				<?php echo $this->Html->link($post['User']['email'], array('controller' => 'users', 'action' => 'view', $post['User']['id'])); ?>
			</td>
			<td><?php echo $post['Post']['scheduled']; ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('action' => 'view', 'slug' => $post['Post']['slug'], 'backstage' => false)); ?>
				<?php
				if ($this->Html->is_user($post['User']['id'])) {
					echo $this->Html->link(__('Edit', true), array('action' => 'edit', $post['Post']['id']));
					echo $this->Html->link(__('Delete', true), array('action' => 'delete', $post['Post']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $post['Post']['id']));
				}
				?>
			</td>
		</tr>
		<?php endforeach; ?>
			</table>
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