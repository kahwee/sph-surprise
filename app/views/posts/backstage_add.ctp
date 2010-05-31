<div class="posts form">
	<?php echo $this->Form->create('Post'); ?>
	<fieldset>
		<legend><?php __('Add a new post'); ?></legend>
		<?php
		echo $this->Form->input('title', array('type' => 'text'));
		echo $this->Wysiwyg->editor('content',
			array(),
			array(
				'mode' => 'textareas',
				'theme' => 'advanced',
				'theme_advanced_buttons1' => "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
				'theme_advanced_buttons2' => "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
				'theme_advanced_toolbar_location' => "top",
				'theme_advanced_toolbar_align' => "left",
				'theme_advanced_statusbar_location' => "bottom",
				'theme_advanced_resizing' => true,
			)
		);
		echo $this->Form->input('scheduled');
		echo $this->Form->input('user_id', array('label' => 'Assign to user', 'selected' => $this->Session->read('Auth.User.id')));
		?>
	</fieldset>
	<?php echo $this->Form->end(__('Add', true)); ?>
	</div>
	<div class="actions">
		<h3><?php __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Posts', true)), array('action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Users', true)), array('controller' => 'users', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('User', true)), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>