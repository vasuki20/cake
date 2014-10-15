<div class="members index">
	<h2><?php echo __('Members');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('msisdn');?></th>
			<th><?php echo $this->Paginator->sort('vcode');?></th>
			<th><?php echo $this->Paginator->sort('device_name');?></th>
			<th><?php echo $this->Paginator->sort('device_model');?></th>
			<th><?php echo $this->Paginator->sort('language');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('password');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('address');?></th>
			<th><?php echo $this->Paginator->sort('postal_code');?></th>
			<th><?php echo $this->Paginator->sort('telco_id');?></th>
			<th><?php echo $this->Paginator->sort('date_join');?></th>
			<th><?php echo $this->Paginator->sort('date_trial_expired');?></th>
			<th><?php echo $this->Paginator->sort('wallet_balance');?></th>
			<th><?php echo $this->Paginator->sort('date_created');?></th>
			<th><?php echo $this->Paginator->sort('created_by');?></th>
			<th><?php echo $this->Paginator->sort('date_modified');?></th>
			<th><?php echo $this->Paginator->sort('modified_by');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($members as $member): ?>
	<tr>
		<td><?php echo h($member['Member']['id']); ?>&nbsp;</td>
		<td><?php echo h($member['Member']['msisdn']); ?>&nbsp;</td>
		<td><?php echo h($member['Member']['vcode']); ?>&nbsp;</td>
		<td><?php echo h($member['Member']['device_name']); ?>&nbsp;</td>
		<td><?php echo h($member['Member']['device_model']); ?>&nbsp;</td>
		<td><?php echo h($member['Member']['language']); ?>&nbsp;</td>
		<td><?php echo h($member['Member']['email']); ?>&nbsp;</td>
		<td><?php echo h($member['Member']['password']); ?>&nbsp;</td>
		<td><?php echo h($member['Member']['status']); ?>&nbsp;</td>
		<td><?php echo h($member['Member']['name']); ?>&nbsp;</td>
		<td><?php echo h($member['Member']['address']); ?>&nbsp;</td>
		<td><?php echo h($member['Member']['postal_code']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($member['Member']['telco_id'], array('controller' => 'telcos', 'action' => 'view', $member['Member']['telco_id'])); ?>
		</td>
		<td><?php echo h($member['Member']['date_join']); ?>&nbsp;</td>
		<td><?php echo h($member['Member']['date_trial_expired']); ?>&nbsp;</td>
		<td><?php echo h($member['Member']['wallet_balance']); ?>&nbsp;</td>
		<td><?php echo h($member['Member']['date_created']); ?>&nbsp;</td>
		<td><?php echo h($member['Member']['created_by']); ?>&nbsp;</td>
		<td><?php echo h($member['Member']['date_modified']); ?>&nbsp;</td>
		<td><?php echo h($member['Member']['modified_by']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $member['Member']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $member['Member']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $member['Member']['id']), null, __('Are you sure you want to delete # %s?', $member['Member']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Member'), array('action' => 'add')); ?></li>
		<?php if($user["telco_id"]=="0"): ?>
		<li><?php echo $this->Html->link(__('List Telcos'), array('controller' => 'telcos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Telco'), array('controller' => 'telcos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Subscriptions'), array('controller' => 'subscriptions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subscription'), array('controller' => 'subscriptions', 'action' => 'add')); ?> </li>
		<?php endif; ?>
	</ul>
</div>
