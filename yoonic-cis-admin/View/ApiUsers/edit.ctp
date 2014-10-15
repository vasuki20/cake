<div class="apiUsers form">
<?php echo $this->Form->create('ApiUser');?>
	<fieldset>
		<legend><?php echo __('Edit Api User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		if($user["admin_role_id"]>0 and $user["admin_role_id"]<2):
			echo $this->Form->input('admin_role_id', array("options"=>array("1"=>"Telco Admin","2"=>"Telco User")));
		elseif($user["admin_role_id"]==0):
			echo $this->Form->input('admin_role_id', array("options"=>array("0"=>"Super Admin","1"=>"Telco Admin","2"=>"Telco User")));
		endif;
		
		if($user["admin_role_id"]>0 and $user["admin_role_id"]<2):
			echo $this->Form->input('telco_id', array("options"=>$telco));
		elseif($user["admin_role_id"]==0):
			$telco[0]=array("0"=>"Yoonic");
			echo $this->Form->input('telco_id', array("options"=>$telco));
		endif;
		echo $this->Form->input('username', array("disabled"=>"disabled"));
		echo $this->Form->input('status', array("options"=>array("active"=>"Active", "inactive"=>"Inactive", "suspended"=>"Suspended")));
		echo $this->Form->hidden('modified_by');
		echo $this->Form->hidden('date_modified');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ApiUser.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ApiUser.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Api Users'), array('action' => 'index'));?></li>
	</ul>
</div>
