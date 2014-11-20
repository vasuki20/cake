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
                <li class = active> <?php echo $this->Html->link(__('Search by Keyword'), array('controller' => 'ib3parsers', 'action' => 'index')); ?></li>
                <li> <?php echo $this->Html->link(__('Search by Channel'), array('controller' => 'channels', 'action' => 'index')); ?></li>
            </ul>
        </div>
    </body>
</html>
<?php
echo $this->Form->create();
echo $this->Form->input('Search by keyword', array(
    'id' => 'q',
    'name' => 'q',
    'placeholder' => 'Enter Search Term'
));

echo $this->Form->input('number', array(
    'id' => 'maxResults',
    'name' => 'maxResults',
    'type' => 'select',
    'options' => array_combine(range(10, 100, 10), range(10, 100, 10))
));
echo $this->Form->end('Submit');

 $this->log($tableDatas, 'debug'); 
 ?>
<table>
    
    <tr>
        <th>VideoID</th>
        <th>ChannelID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Thumbnails_Default</th>
        <th>Thumbnails_Medium</th>
        <th>Thumbnails_High</th>
        <th>ChannelTitle</th>
        <th>Video_URL</th>
        <th>PublishedAt</th>
        <th>Duration</th>
        <th>Save</th>
        <th>Edit</th>
        <?php
        echo '<th>Delete</th>';
        ?>
    </tr>
<?php foreach ($tableDatas as $tableData): ?>

        <tr>
            <td>
    <?php
    echo $this->Html->link
            (
            $tableData['Vod_Detail']['id_videoId'], array('controller' => 'ib3parsers',
        'action' => 'view', $tableData['Vod_Detail']['id_videoId']
            )
    );
    ?>
            </td>
            <td><?php echo $tableData['Vod_Detail']['channelId']; ?></td>
            <td><?php echo $tableData['Vod_Detail']['title'] ?></td>
            <td><?php echo $tableData['Vod_Detail']['description']; ?></td>
            <td><?php echo $tableData['Vod_Detail']['thumbnails_default']; ?> </td>
            <td><?php echo $tableData['Vod_Detail']['thumbnails_medium']; ?> </td>
            <td><?php echo $tableData['Vod_Detail']['thumbnails_high']; ?> </td>
            <td><?php echo $tableData['Vod_Detail']['channelTitle']; ?> </td>                  
            <td style="max-width: 120px;"><?php echo $tableData['Vod_Detail']['video_url']; ?></td>                   
            <td><?php echo $tableData['Vod_Detail']['publishedAt']; ?> </td>
            <td><?php echo $tableData['Vod_Detail']['duration']; ?> </td>  
            <td>
     <?php
    echo $this->Html->link(
            'Save', array('action' => 'edit', $tableData['Vod_Detail']['id_videoId']));
    ?>
     </td>         
    <?php
    echo $this->Html->link(
            'Edit', array('action' => 'edit', $tableData['Vod_Detail']['id_videoId']));
    ?>
            </td>
            <td>

    <?php
    echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $tableData['Vod_Detail']['id_videoId']), null, __('Are you sure you want to delete # %s?', $tableData['Vod_Detail']['id_videoId']));
    ?>

            </td>

        </tr>

<?php endforeach; ?>
<?php unset($tableData); ?>
</table>
</html>

