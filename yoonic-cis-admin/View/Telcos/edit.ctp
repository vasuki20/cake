<div class="telcos form">
<?php echo $this->Form->create('Telco');?>
	<fieldset>
		<legend><?php echo __('Edit Telco'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('telco_name');
		echo $this->Form->input('status', array("options"=>array("active"=>"Active", "inactive"=>"Inactive", "suspended"=>"Suspended")));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Telco.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Telco.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Telcos'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Api Users'), array('controller' => 'api_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Api User'), array('controller' => 'api_users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Members'), array('controller' => 'members', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Member'), array('controller' => 'members', 'action' => 'add')); ?> </li>
	</ul>
</div>
