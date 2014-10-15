<div class="subscriptions form">
<?php echo $this->Form->create('Subscription');?>
	<fieldset>
		<legend><?php echo __('Edit Subscription'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('telco_id');
		echo $this->Form->input('member_id', array("type"=>"text"));
		echo $this->Form->input('subscription_name');
		echo $this->Form->input('subscription_code');
		echo $this->Form->input('subscription_channel');
		echo $this->Form->input('subscription_start_date');
		echo $this->Form->input('subscription_end_date');
		echo $this->Form->input('status', array("options"=>array("active"=>"Active", "inactive"=>"Inactive", "suspended"=>"Suspended", "pending"=>"Pending", "failure"=>"Failure")));
		echo $this->Form->input('amount');
		echo $this->Form->hidden('date_modified');
		echo $this->Form->hidden('modified_by');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Subscription.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Subscription.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Subscriptions'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Members'), array('controller' => 'members', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Member'), array('controller' => 'members', 'action' => 'add')); ?> </li>
	</ul>
</div>
