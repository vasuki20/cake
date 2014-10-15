<!--<div class="apiUsers form">-->
<body>

    <div id='cssmenu'>

        <ul>
            <li> <?php echo $this->Html->link(__('Home'), array('controller' => 'users', 'action' => 'index')); ?></li>
            <li> <?php echo $this->Html->link(__('Reports'), array('controller' => 'reports', 'action' => 'export_day/display')); ?></li>
            <li> <?php echo $this->Html->link(__('Content'), array('controller' => 'movies', 'action' => 'index')); ?></li>
            <li class="logoutMenu"> <?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></li>

        </ul>
    </div>

</body>
<?php echo $this->Form->create('Movie'); ?>
<fieldset>
    <legend><?php echo __('Edit Movie -- '. $movie['Movie']['title']); ?></legend>
    <?php
    echo $this->Form->input('id');
    echo $this->Form->input('category_id', array("options" =>
        array("1" => "Entertainment",
            "2" => "Lifestyle",
            "3" => "Music",
            "4" => "Sports",
            "5" => "Variety",
            "6" => "Free to View")));
    echo $this->Form->input('channel_id', array("options" =>
        array("1" => "Indo TV",
            "2" => "Hollywood News",
            "3" => "BollyHolly",
            "6" => "Dragons TV",
            "7" => "Dhaka TV",
            "8" => "ZonKu",
            "9" => "Men's TV",
            "10" => "Mystery TV",
            "11" => "Pinoy Ako",
            "12" => "Football TV",
            "13" => "Fight TV",
            "14" => "Laugh TV",
            "15" => "YooMusic",
            "16" => "K-Pop",
            "17" => "Hollywood Movies",
            "18" => "Masak Masak TV",
            "19" => "Living Asia Channel",
            "20" => "Kids TV",
            "21" => "Hantu TV",
            "22" => "Yooview",
            "24" => "YooView Maxis",
    )));
    echo $this->Form->input('title');
    echo $this->Form->input('type');
    echo $this->Form->input('director');
    echo $this->Form->input('cast', array('type'=>'textarea'));
    echo $this->Form->input('genre');
    echo $this->Form->input('language');
    echo $this->Form->input('subtitle');
    echo $this->Form->input('credit');
    echo $this->Form->input('duration');
    echo $this->Form->input('cp');
    echo $this->Form->input('description', array('rows' => '5'));
    echo $this->Form->input('published', array("options" => array("0" => "Unpublished", "1" => "Published")));
//    echo "Created"; 
//    echo $this->Form->text('created', array("disabled" => "disabled"));
//    echo "Edited"; 
//    echo $this->Form->text('edited', array("disabled" => "disabled"));
    ?>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
<!--</div>-->

