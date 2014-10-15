<div class="subscriptions form">
<?php echo $this->Form->create('Subscription');?>
	<fieldset>
		<legend><?php echo __('Add Subscription'); ?></legend>
	<?php
		if($user["admin_role_id"]>0 and $user["admin_role_id"]<2):
			echo $this->Form->hidden('telco_id', array("value"=>$user["telco_id"]));
		elseif($user["admin_role_id"]==0):
			echo $this->Form->input('telco_id', array("options"=>$telcos));
		endif;
		echo $this->Form->input('member_id', array("type"=>"text", "label"=>"Member ID"));
		echo $this->Form->input('subscription_name');
		echo $this->Form->input('subscription_code');
		echo $this->Form->input('subscription_channel');
		echo $this->Form->input('subscription_start_date');
		echo $this->Form->input('subscription_end_date');
		echo $this->Form->input('status');
		echo $this->Form->input('amount');
		echo $this->Form->hidden('date_created', array("value"=>date("Y-m-d H:i:s")));
		echo $this->Form->hidden('created_by', array("value"=>$user["id"]));
		echo $this->Form->hidden('date_modified', array("value"=>date("Y-m-d H:i:s")));
		echo $this->Form->hidden('modified_by', array("value"=>$user["id"]));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Subscriptions'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Members'), array('controller' => 'members', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Member'), array('controller' => 'members', 'action' => 'add')); ?> </li>
	</ul>
</div>
