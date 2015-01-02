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
       <?php echo $this->element('sql_dump');?>
        <?php
        echo $this->Form->create();
        echo $this->Form->input('ChannelName', array(
            'id' => 'q',
            'name' => 'q',
            'placeholder' => 'Enter Search Term'
        ));
        echo $this->Form->end('Search');
        ?>
        <?php // print_r(isset($channelsResponses));?>
        <?php // print_r($channelsResponses[0]['id']); ?>
        <table>
            <tr>
                <th>Channel ID</th>
                <th>Channel Title</th>
                <th>Add</th>
            </tr>           
            <tr>
                <td><?php
                    if (isset($channelsResponses)) {
                        print_r($channelsResponses[0]['id']);
                    }
                    ?></td>
                <td><?php if (isset($channelsResponses))
                        print_r($channelsResponses[0]['snippet']['title']);
                    ?></td>                  
                <td>
                    <?php
                    if (isset($channelsResponses)) {
                        echo $this->Html->link('Add', array('controller' => 'addchannels', 'action' => 'add',
                            '?' => array('id' => $channelsResponses[0]['id'], 'title' => $channelsResponses[0]['snippet']['title'])));
                    }
                    ?>                         
                </td>                  
            </tr>                 
        </table><br> </br>        
        <h1>Channel table details</h1> 
        <table>
            <tr>
                <th>Channel ID</th>
                <th>Channel Title</th>               
            </tr>  
        </table>
        <?php //foreach ($posts as $post): ?>
        <?php //endforeach; ?>
    </body>
</html>
