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
                <li> <?php echo $this->Html->link(__('Search by Channel'), array('controller' => 'channels', 'action' => 'index')); ?></li>
                <li class = active> <?php echo $this->Html->link(__('Channels List'), array('controller' => 'addchannels', 'action' => 'index')); ?></li>
                 
            </ul>
        </div>

<?php
echo $this->Form->create();
echo $this->Form->input('ChannelName',array(
    'id'=>'q',
    'name'=> 'q',
    'placeholder'=>'Enter Search Term'
));
//
//echo $this->Form->input('MaxResults', array(
//    'id' => 'maxResults',
//    'name' => 'maxResults',
//    'type' => 'select',
//    'options' => array_combine(range(10, 100, 10), range(10, 100, 10))
//));

echo $this->Form->end('Search');
?>
        <?php //print_r($channelsResponses);?>
        <?php // print_r($channelsResponses[0]['id']); ?>
        <table>
            <tr>
                <th>Channel ID</th>
                <th>Channel Title</th>
                <th>Add</th>
            </tr>           
                <tr>
                    <td><?php print_r($channelsResponses[0]['id']); ?></td>
                    <td><?php print_r($channelsResponses[0]['snippet']['title']); ?></td>                  
                    <td>
                        <?php
                        echo $this->Html->link('Add', array('controller' => 'addchannels', 'action' => 'add')); ?>                         
                    </td>                  
                </tr>         
            <!-- Here is where we loop through our $posts array, printing out post info -->
        </table>
        <?php
// Shows the next and previous links
        echo '<div id="prev_btn">';
        echo $this->Paginator->prev(
                '« Previous', null, null, array('class' => 'disabled')
        );
        echo '</div>';
        echo '<div id="page_numbers">';
// Shows the page numbers
        echo $this->Paginator->numbers();
        echo '</div>';
        echo '<div id="next_btn">';

        echo $this->Paginator->next(
                'Next »', null, null, array('class' => 'disabled')
        );
        echo '</div>';
        ?>
    </body>
</html>
