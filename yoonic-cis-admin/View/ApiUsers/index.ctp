<div class="apiUsers index">
	<h2><?php echo __('Api Users');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('admin_role_id');?></th>
			<th><?php echo $this->Paginator->sort('telco_id');?></th>
			<th><?php echo $this->Paginator->sort('username');?></th>
			<th><?php echo $this->Paginator->sort('password');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('created_by');?></th>
			<th><?php echo $this->Paginator->sort('date_created');?></th>
			<th><?php echo $this->Paginator->sort('modified_by');?></th>
			<th><?php echo $this->Paginator->sort('date_modified');?></th>
			<th><?php echo $this->Paginator->sort('deleted');?></th>
			<th><?php echo $this->Paginator->sort('date_deleted');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($apiUsers as $apiUser): ?>
	<tr>
		<td><?php echo h($apiUser['ApiUser']['id']); ?>&nbsp;</td>
		<td><?php echo h($apiUser['ApiUser']['admin_role_id']); ?>&nbsp;</td>
		<td><?php echo h($apiUser['ApiUser']['telco_id']); ?>&nbsp;</td>
		<td><?php echo h($apiUser['ApiUser']['username']); ?>&nbsp;</td>
		<td><?php echo h($apiUser['ApiUser']['password']); ?>&nbsp;</td>
		<td><?php echo h($apiUser['ApiUser']['status']); ?>&nbsp;</td>
		<td><?php echo h($apiUser['ApiUser']['created_by']); ?>&nbsp;</td>
		<td><?php echo h($apiUser['ApiUser']['date_created']); ?>&nbsp;</td>
		<td><?php echo h($apiUser['ApiUser']['modified_by']); ?>&nbsp;</td>
		<td><?php echo h($apiUser['ApiUser']['date_modified']); ?>&nbsp;</td>
		<td><?php echo h($apiUser['ApiUser']['deleted']); ?>&nbsp;</td>
		<td><?php echo h($apiUser['ApiUser']['date_deleted']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $apiUser['ApiUser']['id'])); ?>
			<?php if(!isset($telco_normal) or $telco_normal!="1"): ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $apiUser['ApiUser']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $apiUser['ApiUser']['id']), null, __('Are you sure you want to delete # %s?', $apiUser['ApiUser']['id'])); ?>
			<?php endif; ?>
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
		<li><?php echo $this->Html->link(__('New Api User'), array('action' => 'add')); ?></li>
	</ul>
</div>
