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
                <li> <?php echo $this->Html->link(__('Search by Keyword'), array('controller' => 'ib3parsers', 'action' => 'index')); ?></li>
                 <li class = active> <?php echo $this->Html->link(__('Search by Channel'), array('action' => 'index')); ?></li>

<?php
echo $this->Form->create();
echo $this->Form->input('search',array(
    'id'=>'q',
    'name'=> 'q',
    'placeholder'=>'Enter Search Term'
));

echo $this->Form->input('number', array(
   'id' => 'maxResults',
    'name' => 'maxResults',
    'min' => 1,
    'max' => 50,
    'step' => 1,
    'value' => 25
));
echo $this->Form->end('Submit');
?>
