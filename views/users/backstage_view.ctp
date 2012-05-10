<div class="users view">
	<h2><?php __('User'); ?></h2>
	<dl><?php $i = 0;
$class = ' class="altrow"'; ?>
		<dt<?php if ($i % 2 == 0)
			echo $class; ?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0)
				echo $class; ?>>
				<?php echo $user['User']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0)
					echo $class; ?>><?php __('Email'); ?></dt>
			<dd<?php if ($i++ % 2 == 0)
					echo $class; ?>>
				<?php echo $user['User']['email']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0)
					echo $class; ?>><?php __('Last Ip'); ?></dt>
			<dd<?php if ($i++ % 2 == 0)
					echo $class; ?>>
				<?php echo $user['User']['last_ip']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0)
					echo $class; ?>><?php __('Name'); ?></dt>
			<dd<?php if ($i++ % 2 == 0)
					echo $class; ?>>
				<?php echo $user['User']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0)
					echo $class; ?>><?php __('Created'); ?></dt>
			<dd<?php if ($i++ % 2 == 0)
					echo $class; ?>>
				<?php echo $user['User']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0)
					echo $class; ?>><?php __('Modified'); ?></dt>
			<dd<?php if ($i++ % 2 == 0)
					echo $class; ?>>
				<?php echo $user['User']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('Edit %s', true), __('User', true)), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Delete %s', true), __('User', true)), array('action' => 'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Users', true)), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('User', true)), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Posts', true)), array('controller' => 'posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Post', true)), array('controller' => 'posts', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php printf(__('Related %s', true), __('Posts', true)); ?></h3>
	<?php if (!empty($user['post'])): ?>
					<table cellpadding = "0" cellspacing = "0">
						<tr>
							<th><?php __('Id'); ?></th>
							<th><?php __('Title'); ?></th>
							<th><?php __('User Id'); ?></th>
							<th><?php __('Scheduled'); ?></th>
							<th class="actions"><?php __('Actions'); ?></th>
						</tr>
		<?php
					$i = 0;
					foreach ($user['post'] as $post):
						$class = null;
						if ($i++ % 2 == 0) {
							$class = ' class="altrow"';
						}
		?>
						<tr<?php echo $class; ?>>
							<td><?php echo $post['id']; ?></td>
							<td><?php echo $post['title']; ?></td>
							<td><?php echo $post['user_id']; ?></td>
							<td><?php echo $post['scheduled']; ?></td>
							<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'posts', 'action' => 'view', $post['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'posts', 'action' => 'edit', $post['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'posts', 'action' => 'delete', $post['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $post['id'])); ?>
					</td>
				</tr>
		<?php endforeach; ?>
					</table>
	<?php endif; ?>

						<div class="actions">
							<ul>
								<li><?php echo $this->Html->link(sprintf(__('Write a new %s', true), __('Post', true)), array('controller' => 'posts', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
