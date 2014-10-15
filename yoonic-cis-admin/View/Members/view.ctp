<div class="members view">
<h2><?php  echo __('Member');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($member['Member']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Msisdn'); ?></dt>
		<dd>
			<?php echo h($member['Member']['msisdn']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vcode'); ?></dt>
		<dd>
			<?php echo h($member['Member']['vcode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Device Name'); ?></dt>
		<dd>
			<?php echo h($member['Member']['device_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Device Model'); ?></dt>
		<dd>
			<?php echo h($member['Member']['device_model']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Language'); ?></dt>
		<dd>
			<?php echo h($member['Member']['language']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($member['Member']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($member['Member']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($member['Member']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($member['Member']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($member['Member']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Postal Code'); ?></dt>
		<dd>
			<?php echo h($member['Member']['postal_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telco'); ?></dt>
		<dd>
			<?php echo $this->Html->link($member['Telco']['id'], array('controller' => 'telcos', 'action' => 'view', $member['Telco']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Join'); ?></dt>
		<dd>
			<?php echo h($member['Member']['date_join']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Trial Expired'); ?></dt>
		<dd>
			<?php echo h($member['Member']['date_trial_expired']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Wallet Balance'); ?></dt>
		<dd>
			<?php echo h($member['Member']['wallet_balance']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Created'); ?></dt>
		<dd>
			<?php echo h($member['Member']['date_created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo h($member['Member']['created_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Modified'); ?></dt>
		<dd>
			<?php echo h($member['Member']['date_modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified By'); ?></dt>
		<dd>
			<?php echo h($member['Member']['modified_by']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Member'), array('action' => 'edit', $member['Member']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Member'), array('action' => 'delete', $member['Member']['id']), null, __('Are you sure you want to delete # %s?', $member['Member']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Members'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Member'), array('action' => 'add')); ?> </li>
		<?php if($user["telco_id"]=="0"): ?>
		<li><?php echo $this->Html->link(__('List Telcos'), array('controller' => 'telcos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Telco'), array('controller' => 'telcos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Subscriptions'), array('controller' => 'subscriptions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subscription'), array('controller' => 'subscriptions', 'action' => 'add')); ?> </li>
		<?php endif; ?>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Subscriptions');?></h3>
	<?php if (!empty($member['Subscription'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Telco Id'); ?></th>
		<th><?php echo __('Member Id'); ?></th>
		<th><?php echo __('Subscription Name'); ?></th>
		<th><?php echo __('Subscription Code'); ?></th>
		<th><?php echo __('Subscription Channel'); ?></th>
		<th><?php echo __('Subscription Start Date'); ?></th>
		<th><?php echo __('Subscription End Date'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Amount'); ?></th>
		<th><?php echo __('Date Created'); ?></th>
		<th><?php echo __('Created By'); ?></th>
		<th><?php echo __('Date Modified'); ?></th>
		<th><?php echo __('Modified By'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($member['Subscription'] as $subscription): ?>
		<tr>
			<td><?php echo $subscription['id'];?></td>
			<td><?php echo $subscription['telco_id'];?></td>
			<td><?php echo $subscription['member_id'];?></td>
			<td><?php echo $subscription['subscription_name'];?></td>
			<td><?php echo $subscription['subscription_code'];?></td>
			<td><?php echo $subscription['subscription_channel'];?></td>
			<td><?php echo $subscription['subscription_start_date'];?></td>
			<td><?php echo $subscription['subscription_end_date'];?></td>
			<td><?php echo $subscription['status'];?></td>
			<td><?php echo $subscription['amount'];?></td>
			<td><?php echo $subscription['date_created'];?></td>
			<td><?php echo $subscription['created_by'];?></td>
			<td><?php echo $subscription['date_modified'];?></td>
			<td><?php echo $subscription['modified_by'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'subscriptions', 'action' => 'view', $subscription['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'subscriptions', 'action' => 'edit', $subscription['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'subscriptions', 'action' => 'delete', $subscription['id']), null, __('Are you sure you want to delete # %s?', $subscription['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Subscription'), array('controller' => 'subscriptions', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
