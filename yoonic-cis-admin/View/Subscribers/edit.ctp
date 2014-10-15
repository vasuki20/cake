<!-- File: /app/View/Posts/add.ctp -->

<div id='cssmenu'>
    <ul>
        <li> <?php echo $this->Html->link(__('Home'), array('controller' => 'users', 'action' => 'index')); ?></li>

        <li class="logoutMenu"> <?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></li>
    </ul>
</div>
<?php
echo $this->Form->create('Subscriber');
echo $this->Form->input('msisdn');
echo $this->Form->input('password');
echo $this->Form->input('email');
echo $this->Form->input('status', array("options" =>
    array("1" => "active",
        "2" => "inactive",
        "3" => "suspended",
        "4" => "pending",
        "1" => "active",
)));
echo $this->Form->input('name');
echo $this->Form->input('address');
//echo $this->Form->input('telco_id');
echo $this->Form->input('postal_code');
echo $this->Form->end('Save');
?>
