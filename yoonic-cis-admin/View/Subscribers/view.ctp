<div id='cssmenu'>
    <ul>
        <li> <?php echo $this->Html->link(__('Home'), array('action' => 'index')); ?></li>
        <li class="logoutMenu"> <?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></li>
    </ul>
</div>


<?php 
// Shows the page numbers


echo '<div>';


echo '<table id="user_table" cellpadding="0" cellspacing="0">
					<tbody>
						<tr>
							<th>Column</th>
							<th>Values</th>
						</tr>';

//echo $this->Form->input('FirstName');
echo "<tr><td class=\"columnName\">ID:</td><td class=\"userDetailsValues\">".$Subscriber['Subscriber']['id']."</td></tr>";
echo "<tr><td class=\"columnName\">msisdn:</td><td class=\"userDetailsValues\">".$Subscriber['Subscriber']['msisdn']."</td></tr>";
echo "<tr><td class=\"columnName\">Password:</td><td class=\"userDetailsValues\">".$Subscriber['Subscriber']['password']."</td></tr>";
echo "<tr><td class=\"columnName\">Email:</td><td class=\"userDetailsValues\">".$Subscriber['Subscriber']['email']."</td></tr>";
echo "<tr><td class=\"columnName\">Status:</td><td class=\"userDetailsValues\">".$Subscriber['Subscriber']['status']."</td></tr>";
echo "<tr><td class=\"columnName\">Name:</td><td class=\"userDetailsValues\">".$Subscriber['Subscriber']['name']."</td></tr>";
echo "<tr><td class=\"columnName\">Address:</td><td class=\"userDetailsValues\">".$Subscriber['Subscriber']['address']."</td></tr>";
echo "<tr><td class=\"columnName\">Postal_Code:</td><td class=\"userDetailsValues\">".$Subscriber['Subscriber']['postal_code']."</td></tr>";
echo "<tr><td class=\"columnName\">Telco_Id:</td><td class=\"userDetailsValues\">".$Subscriber['Subscriber']['telco_id']."</td></tr>";
echo "<tr><td class=\"columnName\">Date_Join:</td><td class=\"userDetailsValues\">".$Subscriber['Subscriber']['date_join']."</td></tr>";
echo "<tr><td class=\"columnName\">Last_Join:</td><td class=\"userDetailsValues\">".$Subscriber['Subscriber']['last_login']."</td></tr>";
echo "<tr><td class=\"columnName\">Incomplete:</td><td class=\"userDetailsValues\">".$Subscriber['Subscriber']['incomplete']."</td></tr>";
echo "<tr><td class=\"columnName\">Date_Created:</td><td class=\"userDetailsValues\">".$Subscriber['Subscriber']['date_created']."</td></tr>";
echo "<tr><td class=\"columnName\">Created_By:</td><td class=\"userDetailsValues\">".$Subscriber['Subscriber']['created_by']."</td></tr>";
echo "<tr><td class=\"columnName\">Date_Modified:</td><td class=\"userDetailsValues\">".$Subscriber['Subscriber']['date_modified']."</td></tr>";
echo "<tr><td class=\"columnName\">Modified_By:</td><td class=\"userDetailsValues\">".$Subscriber['Subscriber']['modified_by']."</td></tr>";
echo '	</tbody></table>';
echo '</div>';
?>



 