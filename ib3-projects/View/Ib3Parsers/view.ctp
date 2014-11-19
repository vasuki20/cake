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
echo '<div>';


echo '<table id="user_table" cellpadding="0" cellspacing="0">
					<tbody>
						<tr>
							<th>Column</th>
							<th>Values</th>
						</tr>';

//echo $this->Form->input('FirstName');
echo "<tr><td class=\"columnName\">Role:</td><td class=\"userDetailsValues\">".$User['Role']['Role']."</td></tr>";
echo "<tr><td class=\"columnName\">First Name:</td><td class=\"userDetailsValues\">".$User['User']['FirstName']."</td></tr>";
echo "<tr><td class=\"columnName\">Last Name:</td><td class=\"userDetailsValues\">".$User['User']['LastName']."</td></tr>";
echo "<tr><td class=\"columnName\">Username:</td><td class=\"userDetailsValues\">".$User['User']['username']."</td></tr>";
echo "<tr><td class=\"columnName\">Email Id:</td><td class=\"userDetailsValues\">".$User['User']['emailId']."</td></tr>";
echo "<tr><td class=\"columnName\">Password:</td><td class=\"userDetailsValues\">".$User['User']['password']."</td></tr>";
echo "<tr><td class=\"columnName\">Contact No:</td><td class=\"userDetailsValues\">".$User['User']['contactno']."</td></tr>";
echo "<tr><td class=\"columnName\">Telco name:</td><td class=\"userDetailsValues\">".$User['Telconame']['Telconame']."</td></tr>";
echo "<tr><td class=\"columnName\">Is Active</td><td class=\"userDetailsValues\">".$User['Isactive']['IsActive']."</td></tr>";
echo "<tr><td class=\"columnName\">Created Date:</td><td class=\"userDetailsValues\">".$User['User']['created']."</td></tr>";
echo "<tr><td class=\"columnName\">Modified Date:</td><td class=\"userDetailsValues\">".$User['User']['modified']."</td></tr>";
echo '	</tbody></table>';
echo '</div>';
?>
 