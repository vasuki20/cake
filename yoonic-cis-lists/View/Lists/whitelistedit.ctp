<!-- File: /app/View/Posts/add.ctp -->
 
<div id='cssmenu'>
    <ul>
        <li> <?php echo $this->Html->link(__('Home'), array('action' => 'whitelist')); ?></li>
    </ul>
</div>
<?php
echo $this->Form->create('WhiteList');
echo $this->Form->input('value');
echo $this->Form->end('Save');
?>
