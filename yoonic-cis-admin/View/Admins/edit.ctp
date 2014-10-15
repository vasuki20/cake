<div class="admins form">
<?php echo $this->Form->create('Admin');?>
	<fieldset>
		<legend><?php echo __('Edit Admin'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('api_user_id');
		echo $this->Form->input('name');
		echo $this->Form->input('level');
		echo $this->Form->input('status');
		echo $this->Form->input('admin_role_id');
		echo $this->Form->input('telco_id');
		echo $this->Form->input('site_url');
		echo $this->Form->input('date_created');
		echo $this->Form->input('created_by');
		echo $this->Form->input('date_modified');
		echo $this->Form->input('modified_by');
		echo $this->Form->input('deleted');
		echo $this->Form->input('date_deleted');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Admin.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Admin.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Admins'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Admin Roles'), array('controller' => 'admin_roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Admin Role'), array('controller' => 'admin_roles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Api Users'), array('controller' => 'api_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Api User'), array('controller' => 'api_users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Telcos'), array('controller' => 'telcos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Telco'), array('controller' => 'telcos', 'action' => 'add')); ?> </li>
	</ul>
</div>
