<?php echo $this->Form->create('User'); ?>
<fieldset>
	<legend><?php __('Register an account'); ?></legend>
	<?php
	echo $this->Form->input('email', array('after' => 'This would be equivalent to your username.'));
	echo $this->Form->input('password_confirm1', array('label' => 'Password', 'type' => 'password'));
	echo $this->Form->input('password_confirm2', array('label' => 'Confirm password', 'type' => 'password'));
	echo $this->Form->input('first_name');
	echo $this->Form->input('last_name');
	?>
</fieldset>
<?php echo $this->Form->end(__('Submit', true)); ?>