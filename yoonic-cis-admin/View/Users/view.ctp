<div id='cssmenu'>
    <ul>
        <li> <?php echo $this->Html->link(__('Home'), array('action' => 'index')); ?></li>
        <li class="logoutMenu"> <?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></li>
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
 