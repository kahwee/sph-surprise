<?php
$this->Session->flash('auth');
echo $this->Form->create('User', array('action' => 'login'));
?>
<fieldset>
	<legend><?php __('Sign in with your email and password'); ?></legend>
	<?php
	echo $this->Form->input('email');
	echo $this->Form->input('password_hash', array('label' => 'Password', 'type' => 'password'));
	?>
</fieldset>
<?php echo $this->Form->end(__('Login', true)); ?>