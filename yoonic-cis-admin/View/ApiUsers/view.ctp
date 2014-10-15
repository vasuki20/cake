<div class="apiUsers view">
<h2><?php  echo __('Api User');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($apiUser['ApiUser']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Admin Role Id'); ?></dt>
		<dd>
			<?php echo h($apiUser['ApiUser']['admin_role_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telco Id'); ?></dt>
		<dd>
			<?php echo h($apiUser['ApiUser']['telco_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($apiUser['ApiUser']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($apiUser['ApiUser']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($apiUser['ApiUser']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo h($apiUser['ApiUser']['created_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Created'); ?></dt>
		<dd>
			<?php echo h($apiUser['ApiUser']['date_created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified By'); ?></dt>
		<dd>
			<?php echo h($apiUser['ApiUser']['modified_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Modified'); ?></dt>
		<dd>
			<?php echo h($apiUser['ApiUser']['date_modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deleted'); ?></dt>
		<dd>
			<?php echo h($apiUser['ApiUser']['deleted']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Deleted'); ?></dt>
		<dd>
			<?php echo h($apiUser['ApiUser']['date_deleted']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Api User'), array('action' => 'edit', $apiUser['ApiUser']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Api User'), array('action' => 'delete', $apiUser['ApiUser']['id']), null, __('Are you sure you want to delete # %s?', $apiUser['ApiUser']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Api Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Api User'), array('action' => 'add')); ?> </li>
	</ul>
</div>
