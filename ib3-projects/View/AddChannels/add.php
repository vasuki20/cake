<!-- File: /app/View/Posts/add.ctp -->

<div id='cssmenu'>
    <ul>
        <li> <?php echo $this->Html->link(__('Home'), array('action' => 'blacklist')); ?></li>
    </ul>
</div>
<?php
echo $this->Form->create('AddChannel');
//echo $this->Form->input('id');
//echo $this->Form->input('title');
echo $this->Form->end('Add');
?>

