<div class="login"> 
<h2>Login</h2>    
	<?php echo $this->Form->create('ApiUser', array('action' => 'login')); ?> 
        <?php echo $this->Form->input('username');?> 
        <?php echo $this->Form->input('password');?> 
        <?php echo $this->Form->submit('Login');?> 
    <?php echo $this->Form->end(); ?> 
</div> 