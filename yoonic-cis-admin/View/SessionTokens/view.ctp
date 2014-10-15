<div class="sessionTokens view">
<h2><?php  echo __('Session Token');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($sessionToken['SessionToken']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Session Token'); ?></dt>
		<dd>
			<?php echo h($sessionToken['SessionToken']['session_token']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Expiry Date'); ?></dt>
		<dd>
			<?php echo h($sessionToken['SessionToken']['expiry_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Session Token'), array('action' => 'edit', $sessionToken['SessionToken']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Session Token'), array('action' => 'delete', $sessionToken['SessionToken']['id']), null, __('Are you sure you want to delete # %s?', $sessionToken['SessionToken']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Session Tokens'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Session Token'), array('action' => 'add')); ?> </li>
	</ul>
</div>
