<!-- File: /app/View/Posts/add.ctp -->
<!doctype html>
<html lang=''>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles.css">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <script src="script.js"></script>
        <title>CSS MenuMaker</title>
    </head>
    <body>
        <div id='cssmenu'>

            <ul>
                <li> <?php echo $this->Html->link(__('Home'), array('controller' => 'movies', 'action' => 'index')); ?></li> 
                <li> <?php echo $this->Html->link(__('Add Movie'), array('controller' => 'movies', 'action' => 'add')); ?></li> 
                <li class = active> <?php echo $this->Html->link(__('Edit Movie'), array('controller' => 'movies', 'action' => 'edit')); ?></li>    

            </ul>
        </div>  


        <?php
        echo $this->Form->create('Movie');
        echo $this->Form->input('categoryId', array(
            'default' => 7,
            'disabled' => 'disabled'
        ));
        echo $this->Form->input('channelId', array(
            //  'options' => array("IB3Media", 'IB3 Xclusive', 'IB3 Trailers', 'IB3 Presents: STAR WARS VII', 'The Automotive Channel'),
            'options' => array('IB3Media' => 'IB3Media', 'IB3 Xclusive' => 'IB3 Xclusive', 'IB3 Trailers' => 'IB3 Trailers', 'IB3 Presents: STAR WARS VII' => 'IB3 Presents: STAR WARS VII', 'The Automotive Channel' => 'The Automotive Channel', 'LifeHacks' => 'LifeHacks'),
            'empty' => '(choose one)'
        ));

        echo $this->Form->input('title');
        echo $this->Form->input('type');
        echo $this->Form->input('description');
        echo $this->Form->input('image_thumb');
        echo $this->Form->input('director');
        echo $this->Form->input('cast');
        echo $this->Form->input('genre');
        echo $this->Form->input('tag', array(
            'default' => '-',
            'disabled' => 'disabled'
        ));
        echo $this->Form->input('language', array(
            'default' => 'English',
            'disabled' => 'disabled'
        ));
        echo $this->Form->input('subtitile', array(
            'default' => '-',
            'disabled' => 'disabled'
        ));
        echo $this->Form->input('credit', array(
            'default' => '-',
            'disabled' => 'disabled'
        ));
        echo $this->Form->input('duration');
        echo $this->Form->input('Cp', array(
            'default' => 'JJJ',
            'disabled' => 'disabled'
        ));
        echo $this->Form->input('abr', array('label' => 'VideoLink'));
        echo $this->Form->input('Bundle Id', array(
            'default' => 1,
            'disabled' => 'disabled'
        ));
        echo $this->Form->input('Published', array(
            'default' => 0,
            'disabled' => 'disabled'
        ));
        echo $this->Form->input('Telco Region', array(
            'default' => 'ib3 media',
            'disabled' => 'disabled'
        ));
        echo $this->Form->end('Save');
        ?>
        <script>

            var channelId = {25: "IB3 Trailers", 22: "IB3Media", 24: "IB3 Xclusive", 27: "IB3 Presents: STAR WARS VII", 28: "The Automotive Channel", 29: "LifeHacks"};
            document.getElementById("MovieChannelId").value = channelId[<?php print_r($this->request->data['Movie']['channel_id']); ?>];

        </script>