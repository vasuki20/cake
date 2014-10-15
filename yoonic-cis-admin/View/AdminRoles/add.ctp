<div class="adminRoles form">
<?php echo $this->Form->create('AdminRole');?>
	<fieldset>
		<legend><?php echo __('Add Admin Role'); ?></legend>
	<?php
		echo $this->Form->input('role');
		echo $this->Form->input('access');
		echo $this->Form->input('date_created');
		echo $this->Form->input('created_by');
		echo $this->Form->input('date_modified');
		echo $this->Form->input('modified_by');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Admin Roles'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Admins'), array('controller' => 'admins', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Admin'), array('controller' => 'admins', 'action' => 'add')); ?> </li>
	</ul>
</div>
