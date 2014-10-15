<div class="sessionTokens index">
<h2><?php  echo __('Purge Session Tokens');?></h2>
	<p>Are you sure you want to purge all the session tokens?</p>
	<div class="actions">
		<form method="post">
			<input type="submit" name="Yes. Purge everything" /><br />
			<?php 
				if (isset($response) and $response==1):
					echo "Purge Successful";
				elseif(isset($response) and $response!=1):
					echo "Purge Unsuccessful";
				endif;
			?>
		</form>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Session Tokens'), array('action' => 'index')); ?> </li>
	</ul>
</div>
