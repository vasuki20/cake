<div class="telcos index">
	<h2><?php echo __('Telcos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('telco_name');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('deleted');?></th>
			<th><?php echo $this->Paginator->sort('date_deleted');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($telcos as $telco): ?>
	<tr>
		<td><?php echo h($telco['Telco']['id']); ?>&nbsp;</td>
		<td><?php echo h($telco['Telco']['telco_name']); ?>&nbsp;</td>
		<td><?php echo h($telco['Telco']['status']); ?>&nbsp;</td>
		<td><?php echo h($telco['Telco']['deleted']); ?>&nbsp;</td>
		<td><?php echo h($telco['Telco']['date_deleted']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $telco['Telco']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $telco['Telco']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $telco['Telco']['id']), null, __('Are you sure you want to delete # %s?', $telco['Telco']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Telco'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Api Users'), array('controller' => 'api_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Api User'), array('controller' => 'api_users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Members'), array('controller' => 'members', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Member'), array('controller' => 'members', 'action' => 'add')); ?> </li>
	</ul>
</div>
