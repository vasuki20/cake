<div class="subscriptions view">
<h2><?php  echo __('Subscription');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($subscription['Subscription']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telco Id'); ?></dt>
		<dd>
			<?php echo h($subscription['Subscription']['telco_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Member'); ?></dt>
		<dd>
			<?php echo $this->Html->link($subscription['Member']['name'], array('controller' => 'members', 'action' => 'view', $subscription['Member']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Subscription Name'); ?></dt>
		<dd>
			<?php echo h($subscription['Subscription']['subscription_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Subscription Code'); ?></dt>
		<dd>
			<?php echo h($subscription['Subscription']['subscription_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Subscription Channel'); ?></dt>
		<dd>
			<?php echo h($subscription['Subscription']['subscription_channel']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Subscription Start Date'); ?></dt>
		<dd>
			<?php echo h($subscription['Subscription']['subscription_start_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Subscription End Date'); ?></dt>
		<dd>
			<?php echo h($subscription['Subscription']['subscription_end_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($subscription['Subscription']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($subscription['Subscription']['amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Created'); ?></dt>
		<dd>
			<?php echo h($subscription['Subscription']['date_created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo h($subscription['Subscription']['created_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Modified'); ?></dt>
		<dd>
			<?php echo h($subscription['Subscription']['date_modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified By'); ?></dt>
		<dd>
			<?php echo h($subscription['Subscription']['modified_by']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Subscription'), array('action' => 'edit', $subscription['Subscription']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Subscription'), array('action' => 'delete', $subscription['Subscription']['id']), null, __('Are you sure you want to delete # %s?', $subscription['Subscription']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Subscriptions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subscription'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Members'), array('controller' => 'members', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Member'), array('controller' => 'members', 'action' => 'add')); ?> </li>
	</ul>
</div>
