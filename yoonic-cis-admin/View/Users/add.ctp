<!-- File: /app/View/Posts/add.ctp -->

<div id='cssmenu'>
    <ul>

        <li> <?php echo $this->Html->link(__('Home'), array('action' => 'index')); ?></li>
        <li class="logoutMenu"> <?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></li>
    </ul>
</div>
<?php
echo $this->Form->create('User');
echo $this->Form->input('Role', array("options" => $Role));
echo $this->Form->input('FirstName');
echo $this->Form->input('LastName');
echo $this->Form->input('username');
echo $this->Form->input('emailId');
echo $this->Form->input('password');
echo $this->Form->input('contactno');
echo $this->Form->input('Telconame', array("options" => $Telconame));
echo $this->Form->input('IsActive', array("options" => $Isactive));
echo $this->Form->end('Save');
?>


