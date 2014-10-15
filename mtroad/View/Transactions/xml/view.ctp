<div class="transactions view">
<h2><?php  echo __('Transaction');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transaction Type'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['transaction_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Application Id'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['application_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product Id'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['product_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product Type'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['product_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telco'); ?></dt>
		<dd>
			<?php echo $this->Html->link($transaction['Telco']['id'], array('controller' => 'telcos', 'action' => 'view', $transaction['Telco']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vendor Txn Id'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['vendor_txn_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Response Code'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['response_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['created_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Created'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['date_created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified By'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['modified_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Modified'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['date_modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Transaction'), array('action' => 'edit', $transaction['Transaction']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Transaction'), array('action' => 'delete', $transaction['Transaction']['id']), null, __('Are you sure you want to delete # %s?', $transaction['Transaction']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Transactions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transaction'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Telcos'), array('controller' => 'telcos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Telco'), array('controller' => 'telcos', 'action' => 'add')); ?> </li>
	</ul>
</div>
