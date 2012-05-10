<div class="users form">
	<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php printf(__('Backstage Add %s', true), __('User', true)); ?></legend>
		<?php
		echo $this->Form->input('email', array('after' => 'This would be equivalent to username.'));
		echo $this->Form->input('password_confirm1', array('label' => 'Password', 'type' => 'password'));
		echo $this->Form->input('password_confirm2', array('label' => 'Confirm password', 'type' => 'password'));
		echo $this->Form->input('name');
		?>
	</fieldset>
	<?php echo $this->Form->end(__('Submit', true)); ?>
	</div>
	<div class="actions">
		<h3><?php __('Actions'); ?></h3>
		<ul>

			<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Users', true)), array('action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Posts', true)), array('controller' => 'posts', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Post', true)), array('controller' => 'posts', 'action' => 'add')); ?> </li>
	</ul>
</div>