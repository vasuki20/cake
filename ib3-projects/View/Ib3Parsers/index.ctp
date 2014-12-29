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
                 <li> <?php echo $this->Html->link(__('Channels List'), array('controller' => 'addchannels', 'action' => 'index')); ?></li>
            </ul>
        </div>
  
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
echo $this->Form->end('Search');
?>
<?php
if (isset($tableDatas)):
    $this->log($tableDatas, 'debug');
    $this->tableData = $tableDatas;
    ?>
    <?php
    echo $this->Form->create('ib3parsers', array('action' => 'save'));
    ?>
    <table>

        <tr>
            <th>Save</th>
            <th style="width: 300px;">Video</th>
            <th>VideoID</th>
            <th>ChannelID</th>
            <th>Title</th>
            <th>Description</th>
            <th>ChannelTitle</th>
            <th>Video_URL</th>
            <th>PublishedAt</th>
            <th>Duration</th>

        </tr>
        <?php
        $count = 0;
        ?>
        <?php foreach ($tableDatas as $tableData): ?>
            <?php 
            $modelPrefix='data[Vod_Detail]['.  strval($count) . ']['; 
            $modelSuffix=']'; 
            ?>

            <tr>
                <?php
                echo $this->Form->input('text', array(
                    'id' => $modelPrefix . 'id_videoId' .$modelSuffix,
                    'name' => $modelPrefix . 'id_videoId' . $modelSuffix,
                    'type' => 'hidden',
                    'value' => $tableData['Vod_Detail']['id_videoId']
                ));

                echo $this->Form->input('text', array(
                    'id' => $modelPrefix . 'channelId' . $modelSuffix,
                    'name' => $modelPrefix . 'channelId' . $modelSuffix,
                    'type' => 'hidden',
                    'value' => $tableData['Vod_Detail']['channelId']
                ));

                echo $this->Form->input('text', array(
                    'id' => $modelPrefix . 'title' . $modelSuffix,
                    'name' => $modelPrefix . 'title' . $modelSuffix,
                    'type' => 'hidden',
                    'value' => $tableData['Vod_Detail']['title']
                ));

                echo $this->Form->input('text', array(
                    'id' => $modelPrefix . 'description' . $modelSuffix,
                    'name' => $modelPrefix . 'description' . $modelSuffix,
                    'type' => 'hidden',
                    'value' => $tableData['Vod_Detail']['description']
                ));

                echo $this->Form->input('text', array(
                    'id' => $modelPrefix . 'thumbnails_default' . $modelSuffix,
                    'name' => $modelPrefix . 'thumbnails_default' . $modelSuffix,
                    'type' => 'hidden',
                    'value' => $tableData['Vod_Detail']['thumbnails_default']
                ));

                echo $this->Form->input('text', array(
                    'id' => $modelPrefix . 'thumbnails_medium' . $modelSuffix,
                    'name' => $modelPrefix . 'thumbnails_medium' . $modelSuffix,
                    'type' => 'hidden',
                    'value' => $tableData['Vod_Detail']['thumbnails_medium']
                ));
                echo $this->Form->input('text', array(
                    'id' => $modelPrefix . 'thumbnails_high' . $modelSuffix,
                    'name' => $modelPrefix . 'thumbnails_high' . $modelSuffix,
                    'type' => 'hidden',
                    'value' => $tableData['Vod_Detail']['thumbnails_high']
                ));

                echo $this->Form->input('text', array(
                    'id' => $modelPrefix . 'channelTitle' . $modelSuffix,
                    'name' => $modelPrefix . 'channelTitle' . $modelSuffix,
                    'type' => 'hidden',
                    'value' => $tableData['Vod_Detail']['channelTitle']
                ));

                echo $this->Form->input('text', array(
                    'id' => $modelPrefix . 'video_url' . $modelSuffix,
                    'name' => $modelPrefix . 'video_url' . $modelSuffix,
                    'type' => 'hidden',
                    'value' => $tableData['Vod_Detail']['video_url']
                ));

                echo $this->Form->input('text', array(
                    'id' => $modelPrefix . 'publishedAt' . $modelSuffix,
                    'name' => $modelPrefix . 'publishedAt' . $modelSuffix,
                    'type' => 'hidden',
                    'value' => $tableData['Vod_Detail']['publishedAt']
                ));

                echo $this->Form->input('text', array(
                    'id' => $modelPrefix . 'duration' . $modelSuffix,
                    'name' => $modelPrefix . 'duration' . $modelSuffix,
                    'type' => 'hidden',
                    'value' => $tableData['Vod_Detail']['duration']
                ));
                ?>
                <td>
                    <?php
                            echo $this->Form->checkbox('text', array(
                                'id' => $modelPrefix . 'checked' . $modelSuffix,
                                'name' => $modelPrefix . 'checked' . $modelSuffix,
                                'type' => 'hidden',
                                'value' => 1
                            ));
                    ?>
                </td>
                <td>
                    <object style="width: 100%;" 
                            data="http://www.youtube.com/v/<?php echo $tableData['Vod_Detail']['id_videoId'] ?>" 
                            type="application/x-shockwave-flash">
                        <param name="src" value="http://www.youtube.com/v/<?php echo $tableData['Vod_Detail']['id_videoId'] ?>" />
                    </object>
                </td>
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
                <td><?php echo $tableData['Vod_Detail']['channelTitle']; ?> </td>                  
                <td style="max-width: 120px;"><?php echo $tableData['Vod_Detail']['video_url']; ?></td>                   
                <td><?php echo $tableData['Vod_Detail']['publishedAt']; ?> </td>
                <td><?php echo $tableData['Vod_Detail']['duration']; ?> </td>  






            </tr>
        <?php $count++; ?>

        <?php endforeach; ?>
        <?php unset($tableData); ?>
              </body>
    </table>

        <?php
        echo $this->Form->end('Save');
        ?>
<?php endif; ?>



</html>

