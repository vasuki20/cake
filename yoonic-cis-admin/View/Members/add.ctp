<div class="members form">
<?php echo $this->Form->create('Member');?>
	<fieldset>
		<legend><?php echo __('Add Member'); ?></legend>
	<?php
		echo $this->Form->input('msisdn');
		echo $this->Form->input('vcode');
		echo $this->Form->input('device_name');
		echo $this->Form->input('device_model');
		echo $this->Form->input('language');
		echo $this->Form->input('email');
		echo $this->Form->input('password');
		echo $this->Form->input('status', array("options"=>array("active"=>"Active", "inactive"=>"Inactive", "suspended"=>"Suspended", "pending"=>"Pending")));
		echo $this->Form->input('name');
		echo $this->Form->input('address');
		echo $this->Form->input('postal_code');
		if($user["admin_role_id"]>0 and $user["admin_role_id"]<2):
			echo $this->Form->hidden('telco_id', array("value"=>$user["telco_id"]));
		elseif($user["admin_role_id"]==0):
			echo $this->Form->input('telco_id', array("options"=>$telcos));
		endif;
		echo $this->Form->input('date_join');
		echo $this->Form->input('date_trial_expired');
		echo $this->Form->input('wallet_balance');
		echo $this->Form->hidden('created_by', array("value"=>$user["id"]));
		echo $this->Form->hidden('date_created', array("value"=>date("Y-m-d H:i:s")));
		echo $this->Form->hidden('modified_by', array("value"=>$user["id"]));
		echo $this->Form->hidden('date_modified', array("value"=>date("Y-m-d H:i:s")));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Members'), array('action' => 'index'));?></li>
		<?php if($user["telco_id"]=="0"): ?>
		<li><?php echo $this->Html->link(__('List Telcos'), array('controller' => 'telcos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Telco'), array('controller' => 'telcos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Subscriptions'), array('controller' => 'subscriptions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subscription'), array('controller' => 'subscriptions', 'action' => 'add')); ?> </li>
		<?php endif; ?>
	</ul>
</div>
