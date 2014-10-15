<div class="adminRoles view">
<h2><?php  echo __('Admin Role');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($adminRole['AdminRole']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role'); ?></dt>
		<dd>
			<?php echo h($adminRole['AdminRole']['role']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Access'); ?></dt>
		<dd>
			<?php echo h($adminRole['AdminRole']['access']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Created'); ?></dt>
		<dd>
			<?php echo h($adminRole['AdminRole']['date_created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo h($adminRole['AdminRole']['created_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Modified'); ?></dt>
		<dd>
			<?php echo h($adminRole['AdminRole']['date_modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified By'); ?></dt>
		<dd>
			<?php echo h($adminRole['AdminRole']['modified_by']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Admin Role'), array('action' => 'edit', $adminRole['AdminRole']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Admin Role'), array('action' => 'delete', $adminRole['AdminRole']['id']), null, __('Are you sure you want to delete # %s?', $adminRole['AdminRole']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Admin Roles'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Admin Role'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Admins'), array('controller' => 'admins', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Admin'), array('controller' => 'admins', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Admins');?></h3>
	<?php if (!empty($adminRole['Admin'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Level'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Admin Role Id'); ?></th>
		<th><?php echo __('Telco Id'); ?></th>
		<th><?php echo __('Site Url'); ?></th>
		<th><?php echo __('Date Created'); ?></th>
		<th><?php echo __('Created By'); ?></th>
		<th><?php echo __('Date Modified'); ?></th>
		<th><?php echo __('Modified By'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($adminRole['Admin'] as $admin): ?>
		<tr>
			<td><?php echo $admin['id'];?></td>
			<td><?php echo $admin['username'];?></td>
			<td><?php echo $admin['password'];?></td>
			<td><?php echo $admin['name'];?></td>
			<td><?php echo $admin['level'];?></td>
			<td><?php echo $admin['status'];?></td>
			<td><?php echo $admin['admin_role_id'];?></td>
			<td><?php echo $admin['telco_id'];?></td>
			<td><?php echo $admin['site_url'];?></td>
			<td><?php echo $admin['date_created'];?></td>
			<td><?php echo $admin['created_by'];?></td>
			<td><?php echo $admin['date_modified'];?></td>
			<td><?php echo $admin['modified_by'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'admins', 'action' => 'view', $admin['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'admins', 'action' => 'edit', $admin['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'admins', 'action' => 'delete', $admin['id']), null, __('Are you sure you want to delete # %s?', $admin['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Admin'), array('controller' => 'admins', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
