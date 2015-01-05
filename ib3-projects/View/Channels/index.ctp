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
                <li class = active> <?php echo $this->Html->link(__('Search by Channel'), array('controller' => 'channels', 'action' => 'index')); ?></li>
                <li> <?php echo $this->Html->link(__('Channels List'), array('controller' => 'addchannels', 'action' => 'index')); ?></li>
            </ul>
        </div>

        <?php
        echo $this->Form->create();
        echo $this->Form->input('Search by Channel', array(
            'id' => 'q',
            'name' => 'q',
            'type' => 'select',
            'options' => array('themingthing' => 'TheMingThing', 'education' => 'Education', 'StarWorldIndia' => 'StarWorldIndia', 'Vijay Television' => 'Vijay Television','Movies'=>'Movies')
        ));

        echo $this->Form->input('MaxResults', array(
            'id' => 'maxResults',
            'name' => 'maxResults',
            'type' => 'select',
            'options' => array_combine(range(10, 100, 10), range(10, 100, 10))
        ));

        echo $this->Form->end('Submit');
        ?>
        <h1>Channel Details</h1> 
        <table>
            <tr>
                <th>Video ID</th>
                <th>Channel ID</th>                
                <th>Title</th>
                <th>Description</th>
                <th>Channel Title</th>
                <th>Video URL </th>
                <th>Playlist</th>
                <th>Duration</th>
                <th> Delete </th>
            </tr>  
            <?php foreach ($posts as $post): ?>               
                <tr>
                    <td>
                        <?php print_r($post['Vod_Detail']['id_videoId']); ?>
                    </td>
                    <td>
                        <?php print_r($post['Vod_Detail']['channelId']); ?>
                    </td>   
                    <td>
                        <?php print_r($post['Vod_Detail']['title']); ?>
                    </td>  
                    <td>
                        <?php print_r($post['Vod_Detail']['description']); ?>
                    </td> 
                    <td>
                        <?php print_r($post['Vod_Detail']['channelTitle']); ?>
                    </td> 
                    <td>
                        <?php print_r($post['Vod_Detail']['video_url']); ?>
                    </td> 
                    <td>
                        <?php print_r($post['Vod_Detail']['playlist']); ?>
                    </td> 
                    <td>
                        <?php print_r($post['Vod_Detail']['duration']); ?>
                    </td> 

                    <td>
                        <?php
                        echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $post['Vod_Detail']['id_videoId']), null, __('Are you sure you want to delete # %s?', $post['Vod_Detail']['title']));
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php unset($post); ?>
        </table>   
