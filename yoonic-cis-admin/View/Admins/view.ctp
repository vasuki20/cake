<div class="admins view">
<h2><?php  echo __('Admin');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($admin['Admin']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($admin['Admin']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($admin['Admin']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Api User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($admin['ApiUser']['id'], array('controller' => 'api_users', 'action' => 'view', $admin['ApiUser']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($admin['Admin']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Level'); ?></dt>
		<dd>
			<?php echo h($admin['Admin']['level']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($admin['Admin']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Admin Role'); ?></dt>
		<dd>
			<?php echo $this->Html->link($admin['AdminRole']['id'], array('controller' => 'admin_roles', 'action' => 'view', $admin['AdminRole']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telco'); ?></dt>
		<dd>
			<?php echo $this->Html->link($admin['Telco']['id'], array('controller' => 'telcos', 'action' => 'view', $admin['Telco']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Site Url'); ?></dt>
		<dd>
			<?php echo h($admin['Admin']['site_url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Created'); ?></dt>
		<dd>
			<?php echo h($admin['Admin']['date_created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo h($admin['Admin']['created_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Modified'); ?></dt>
		<dd>
			<?php echo h($admin['Admin']['date_modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified By'); ?></dt>
		<dd>
			<?php echo h($admin['Admin']['modified_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deleted'); ?></dt>
		<dd>
			<?php echo h($admin['Admin']['deleted']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Deleted'); ?></dt>
		<dd>
			<?php echo h($admin['Admin']['date_deleted']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Admin'), array('action' => 'edit', $admin['Admin']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Admin'), array('action' => 'delete', $admin['Admin']['id']), null, __('Are you sure you want to delete # %s?', $admin['Admin']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Admins'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Admin'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Admin Roles'), array('controller' => 'admin_roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Admin Role'), array('controller' => 'admin_roles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Api Users'), array('controller' => 'api_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Api User'), array('controller' => 'api_users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Telcos'), array('controller' => 'telcos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Telco'), array('controller' => 'telcos', 'action' => 'add')); ?> </li>
	</ul>
</div>
