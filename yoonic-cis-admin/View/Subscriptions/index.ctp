<div class="subscriptions index">
	<h2><?php echo __('Subscriptions');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('telco_id');?></th>
			<th><?php echo $this->Paginator->sort('member_id');?></th>
			<th><?php echo $this->Paginator->sort('subscription_name');?></th>
			<th><?php echo $this->Paginator->sort('subscription_code');?></th>
			<th><?php echo $this->Paginator->sort('subscription_channel');?></th>
			<th><?php echo $this->Paginator->sort('subscription_start_date');?></th>
			<th><?php echo $this->Paginator->sort('subscription_end_date');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('amount');?></th>
			<th><?php echo $this->Paginator->sort('date_created');?></th>
			<th><?php echo $this->Paginator->sort('created_by');?></th>
			<th><?php echo $this->Paginator->sort('date_modified');?></th>
			<th><?php echo $this->Paginator->sort('modified_by');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($subscriptions as $subscription): ?>
	<tr>
		<td><?php echo h($subscription['Subscription']['id']); ?>&nbsp;</td>
		<td><?php echo h($subscription['Subscription']['telco_id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($subscription['Member']['name'], array('controller' => 'members', 'action' => 'view', $subscription['Member']['id'])); ?>
		</td>
		<td><?php echo h($subscription['Subscription']['subscription_name']); ?>&nbsp;</td>
		<td><?php echo h($subscription['Subscription']['subscription_code']); ?>&nbsp;</td>
		<td><?php echo h($subscription['Subscription']['subscription_channel']); ?>&nbsp;</td>
		<td><?php echo h($subscription['Subscription']['subscription_start_date']); ?>&nbsp;</td>
		<td><?php echo h($subscription['Subscription']['subscription_end_date']); ?>&nbsp;</td>
		<td><?php echo h($subscription['Subscription']['status']); ?>&nbsp;</td>
		<td><?php echo h($subscription['Subscription']['amount']); ?>&nbsp;</td>
		<td><?php echo h($subscription['Subscription']['date_created']); ?>&nbsp;</td>
		<td><?php echo h($subscription['Subscription']['created_by']); ?>&nbsp;</td>
		<td><?php echo h($subscription['Subscription']['date_modified']); ?>&nbsp;</td>
		<td><?php echo h($subscription['Subscription']['modified_by']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $subscription['Subscription']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $subscription['Subscription']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $subscription['Subscription']['id']), null, __('Are you sure you want to delete # %s?', $subscription['Subscription']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Subscription'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Members'), array('controller' => 'members', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Member'), array('controller' => 'members', 'action' => 'add')); ?> </li>
	</ul>
</div>
