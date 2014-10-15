<div class="sessionTokens form">
<?php echo $this->Form->create('SessionToken');?>
	<fieldset>
		<legend><?php echo __('Add Session Token'); ?></legend>
	<?php
		echo $this->Form->input('session_token');
		echo $this->Form->input('expiry_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Session Tokens'), array('action' => 'index'));?></li>
	</ul>
</div>
