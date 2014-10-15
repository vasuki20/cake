<div class="admins index">
	<h2><?php echo __('Admins');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('username');?></th>
			<th><?php echo $this->Paginator->sort('password');?></th>
			<th><?php echo $this->Paginator->sort('api_user_id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('level');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('admin_role_id');?></th>
			<th><?php echo $this->Paginator->sort('telco_id');?></th>
			<th><?php echo $this->Paginator->sort('site_url');?></th>
			<th><?php echo $this->Paginator->sort('date_created');?></th>
			<th><?php echo $this->Paginator->sort('created_by');?></th>
			<th><?php echo $this->Paginator->sort('date_modified');?></th>
			<th><?php echo $this->Paginator->sort('modified_by');?></th>
			<th><?php echo $this->Paginator->sort('deleted');?></th>
			<th><?php echo $this->Paginator->sort('date_deleted');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($admins as $admin): ?>
	<tr>
		<td><?php echo h($admin['Admin']['id']); ?>&nbsp;</td>
		<td><?php echo h($admin['Admin']['username']); ?>&nbsp;</td>
		<td><?php echo h($admin['Admin']['password']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($admin['ApiUser']['id'], array('controller' => 'api_users', 'action' => 'view', $admin['ApiUser']['id'])); ?>
		</td>
		<td><?php echo h($admin['Admin']['name']); ?>&nbsp;</td>
		<td><?php echo h($admin['Admin']['level']); ?>&nbsp;</td>
		<td><?php echo h($admin['Admin']['status']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($admin['AdminRole']['id'], array('controller' => 'admin_roles', 'action' => 'view', $admin['AdminRole']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($admin['Telco']['id'], array('controller' => 'telcos', 'action' => 'view', $admin['Telco']['id'])); ?>
		</td>
		<td><?php echo h($admin['Admin']['site_url']); ?>&nbsp;</td>
		<td><?php echo h($admin['Admin']['date_created']); ?>&nbsp;</td>
		<td><?php echo h($admin['Admin']['created_by']); ?>&nbsp;</td>
		<td><?php echo h($admin['Admin']['date_modified']); ?>&nbsp;</td>
		<td><?php echo h($admin['Admin']['modified_by']); ?>&nbsp;</td>
		<td><?php echo h($admin['Admin']['deleted']); ?>&nbsp;</td>
		<td><?php echo h($admin['Admin']['date_deleted']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $admin['Admin']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $admin['Admin']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $admin['Admin']['id']), null, __('Are you sure you want to delete # %s?', $admin['Admin']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Admin'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Admin Roles'), array('controller' => 'admin_roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Admin Role'), array('controller' => 'admin_roles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Api Users'), array('controller' => 'api_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Api User'), array('controller' => 'api_users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Telcos'), array('controller' => 'telcos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Telco'), array('controller' => 'telcos', 'action' => 'add')); ?> </li>
	</ul>
</div>
