<div class="telcos view">
<h2><?php  echo __('Telco');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($telco['Telco']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telco Name'); ?></dt>
		<dd>
			<?php echo h($telco['Telco']['telco_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($telco['Telco']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deleted'); ?></dt>
		<dd>
			<?php echo h($telco['Telco']['deleted']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Deleted'); ?></dt>
		<dd>
			<?php echo h($telco['Telco']['date_deleted']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Telco'), array('action' => 'edit', $telco['Telco']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Telco'), array('action' => 'delete', $telco['Telco']['id']), null, __('Are you sure you want to delete # %s?', $telco['Telco']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Telcos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Telco'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Api Users'), array('controller' => 'api_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Api User'), array('controller' => 'api_users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Members'), array('controller' => 'members', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Member'), array('controller' => 'members', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Api Users');?></h3>
	<?php if (!empty($telco['ApiUser'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Admin Role Id'); ?></th>
		<th><?php echo __('Telco Id'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created By'); ?></th>
		<th><?php echo __('Date Created'); ?></th>
		<th><?php echo __('Modified By'); ?></th>
		<th><?php echo __('Date Modified'); ?></th>
		<th><?php echo __('Deleted'); ?></th>
		<th><?php echo __('Date Deleted'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($telco['ApiUser'] as $apiUser): ?>
		<tr>
			<td><?php echo $apiUser['id'];?></td>
			<td><?php echo $apiUser['admin_role_id'];?></td>
			<td><?php echo $apiUser['telco_id'];?></td>
			<td><?php echo $apiUser['username'];?></td>
			<td><?php echo $apiUser['password'];?></td>
			<td><?php echo $apiUser['status'];?></td>
			<td><?php echo $apiUser['created_by'];?></td>
			<td><?php echo $apiUser['date_created'];?></td>
			<td><?php echo $apiUser['modified_by'];?></td>
			<td><?php echo $apiUser['date_modified'];?></td>
			<td><?php echo $apiUser['deleted'];?></td>
			<td><?php echo $apiUser['date_deleted'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'api_users', 'action' => 'view', $apiUser['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'api_users', 'action' => 'edit', $apiUser['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'api_users', 'action' => 'delete', $apiUser['id']), null, __('Are you sure you want to delete # %s?', $apiUser['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Api User'), array('controller' => 'api_users', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Members');?></h3>
	<?php if (!empty($telco['Member'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Msisdn'); ?></th>
		<th><?php echo __('Vcode'); ?></th>
		<th><?php echo __('Device Name'); ?></th>
		<th><?php echo __('Device Model'); ?></th>
		<th><?php echo __('Language'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('Postal Code'); ?></th>
		<th><?php echo __('Telco Id'); ?></th>
		<th><?php echo __('Date Join'); ?></th>
		<th><?php echo __('Date Trial Expired'); ?></th>
		<th><?php echo __('Wallet Balance'); ?></th>
		<th><?php echo __('Date Created'); ?></th>
		<th><?php echo __('Created By'); ?></th>
		<th><?php echo __('Date Modified'); ?></th>
		<th><?php echo __('Modified By'); ?></th>
		<th><?php echo __('Deleted'); ?></th>
		<th><?php echo __('Date Deleted'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($telco['Member'] as $member): ?>
		<tr>
			<td><?php echo $member['id'];?></td>
			<td><?php echo $member['msisdn'];?></td>
			<td><?php echo $member['vcode'];?></td>
			<td><?php echo $member['device_name'];?></td>
			<td><?php echo $member['device_model'];?></td>
			<td><?php echo $member['language'];?></td>
			<td><?php echo $member['email'];?></td>
			<td><?php echo $member['password'];?></td>
			<td><?php echo $member['status'];?></td>
			<td><?php echo $member['name'];?></td>
			<td><?php echo $member['address'];?></td>
			<td><?php echo $member['postal_code'];?></td>
			<td><?php echo $member['telco_id'];?></td>
			<td><?php echo $member['date_join'];?></td>
			<td><?php echo $member['date_trial_expired'];?></td>
			<td><?php echo $member['wallet_balance'];?></td>
			<td><?php echo $member['date_created'];?></td>
			<td><?php echo $member['created_by'];?></td>
			<td><?php echo $member['date_modified'];?></td>
			<td><?php echo $member['modified_by'];?></td>
			<td><?php echo $member['deleted'];?></td>
			<td><?php echo $member['date_deleted'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'members', 'action' => 'view', $member['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'members', 'action' => 'edit', $member['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'members', 'action' => 'delete', $member['id']), null, __('Are you sure you want to delete # %s?', $member['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Member'), array('controller' => 'members', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
