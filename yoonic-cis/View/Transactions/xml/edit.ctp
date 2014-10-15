<div class="transactions form">
<?php echo $this->Form->create('Transaction');?>
	<fieldset>
		<legend><?php echo __('Edit Transaction'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('transaction_type');
		echo $this->Form->input('user_id');
		echo $this->Form->input('application_id');
		echo $this->Form->input('product_id');
		echo $this->Form->input('product_type');
		echo $this->Form->input('amount');
		echo $this->Form->input('telco_id');
		echo $this->Form->input('vendor_txn_id');
		echo $this->Form->input('response_code');
		echo $this->Form->input('created_by');
		echo $this->Form->input('date_created');
		echo $this->Form->input('modified_by');
		echo $this->Form->input('date_modified');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Transaction.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Transaction.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Transactions'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Telcos'), array('controller' => 'telcos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Telco'), array('controller' => 'telcos', 'action' => 'add')); ?> </li>
	</ul>
</div>
