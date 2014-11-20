<div id='cssmenu'>
    <ul>
        <li> <?php echo $this->Html->link(__('Home'), array('action' => 'index')); ?></li>
       <!-- <li class="logoutMenu"> <?php //echo $this->Html->link('Logout', array('controller' => 'ib3parsers', 'action' => 'logout')); ?></li> -->
    </ul>
</div>
<?php 
echo '<div>';


echo '<table id="user_table" cellpadding="0" cellspacing="0">
					<tbody>
						<tr>
							<th>Column</th>
							<th>Values</th>
						</tr>';

//echo $this->Form->input('FirstName');
echo "<tr><td class=\"columnName\">VideoID:</td><td class=\"userDetailsValues\">".$tableData['Vod_Detail']['id_videoId']."</td></tr>";
echo "<tr><td class=\"columnName\">ChannelID:</td><td class=\"userDetailsValues\">".$tableData['Vod_Detail']['channelId']."</td></tr>";
echo "<tr><td class=\"columnName\">Title:</td><td class=\"userDetailsValues\">".$tableData['Vod_Detail']['title']."</td></tr>";
echo "<tr><td class=\"columnName\">Description:</td><td class=\"userDetailsValues\">".$tableData['Vod_Detail']['description']."</td></tr>";
echo "<tr><td class=\"columnName\">Thumbnails_Default:</td><td class=\"userDetailsValues\">".$tableData['Vod_Detail']['thumbnails_default']."</td></tr>";
echo "<tr><td class=\"columnName\">Thumbnails_Medium:</td><td class=\"userDetailsValues\">".$tableData['Vod_Detail']['thumbnails_medium']."</td></tr>";
echo "<tr><td class=\"columnName\">Thumbnails_High:</td><td class=\"userDetailsValues\">".$tableData['Vod_Detail']['thumbnails_high']."</td></tr>";
echo "<tr><td class=\"columnName\">ChannelTitle:</td><td class=\"userDetailsValues\">".$tableData['Vod_Detail']['channelTitle']."</td></tr>";
echo "<tr><td class=\"columnName\">Video_URL:</td><td class=\"userDetailsValues\">".$tableData['Vod_Detail']['video_url']."</td></tr>";
echo "<tr><td class=\"columnName\">PublishedAt:</td><td class=\"userDetailsValues\">".$tableData['Vod_Detail']['publishedAt']."</td></tr>";
echo "<tr><td class=\"columnName\">Duration:</td><td class=\"userDetailsValues\">".$tableData['Vod_Detail']['duration']."</td></tr>";
echo '	</tbody></table>';
echo '</div>';
?>
 