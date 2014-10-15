<div class="sessionTokens index">
	<h2><?php echo __('Session Tokens');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('session_token');?></th>
			<th><?php echo $this->Paginator->sort('expiry_date');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($sessionTokens as $sessionToken): ?>
	<tr>
		<td><?php echo h($sessionToken['SessionToken']['id']); ?>&nbsp;</td>
		<td><?php echo h($sessionToken['SessionToken']['session_token']); ?>&nbsp;</td>
		<td><?php echo h($sessionToken['SessionToken']['expiry_date']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $sessionToken['SessionToken']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $sessionToken['SessionToken']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $sessionToken['SessionToken']['id']), null, __('Are you sure you want to delete # %s?', $sessionToken['SessionToken']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Session Token'), array('action' => 'add')); ?></li>
	</ul>
</div>
