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
                <li class = active> <?php echo $this->Html->link(__('Home'), array('action' => 'index')); ?></li>
                <?php
                if ($Role['Role'] == 'Admin') {
                    echo "<li >" . $this->Html->link(__('Add User'), array('action' => 'add')) . "</li>";
                }
                ?>

                <li> <?php echo $this->Html->link(__('Reports'), array('controller' => 'reports', 'action' => 'export_day/display')); ?></li>
                <li> <?php echo $this->Html->link(__('Subscription'), array('controller' => 'subscribers', 'action' => 'index')); ?></li>
               <!-- <li> <?php echo $this->Html->link(__('Content'), array('controller' => 'movies', 'action' => 'index')); ?></li> -->
                <li class="logoutMenu"> <?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></li>

            </ul>
        </div>

    </body>
    </html>

        <?php
        echo $this->Form->create('User');
        echo '<div><div id="searchText" style="width: 40%;float:left;margin-top: 3px;margin-left: 70px;">';
        echo $this->Form->input('SearchParam');
        echo '</div>';
        echo '<div id="searchBtn" style="float: left;clear: none;padding: 0;">';
        echo $this->Form->end('Search');
        echo '</div></div>';
        ?>
        <?php $this->log($Users, 'debug'); ?>
    
        <table>
            <tr>
                <th>ID</th>
                <th>Role</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>Username</th>
                <th>EmailID</th>
                <th>Password</th>
                <th>ContactNo</th>
                <th>Telconame</th>
                <th>IsActive</th>
                <th>Edit</th>
                <?php
                if ($Role['Role'] == 'Admin') {
                    echo '<th>Delete</th>';
                }
                ?>
            </tr>
            <!-- Here is where we loop through our $posts array, printing out post info -->

            <?php foreach ($Users as $User): ?>

                <tr>
                    <td>
                        <?php
                        echo $this->Html->link
                                (
                                $User['User']['id'], array('controller' => 'Users',
                            'action' => 'view', $User['User']['id']
                                )
                        );
                        ?>
                    </td>
                    <td><?php echo $User['Role']['Role']; ?></td>
                    <td><?php echo $User['User']['FirstName']; ?></td>
                    <td><?php echo $User['User']['LastName']; ?></td>
                    <td><?php echo $User['User']['username']; ?> </td>
                    <td style="max-width: 120px;"><?php echo $User['User']['emailId']; ?></td>
                    <td style="max-width: 200px;"><?php echo $User['User']['password']; ?></td>
                    <td><?php echo $User['User']['contactno']; ?></td>
                    <td><?php echo $User['Telconame']['Telconame']; ?></td>
                    <td><?php echo $User['Isactive']['IsActive']; ?></td>
                    <td>
                        <?php
                        echo $this->Html->link(
                                'Edit', array('action' => 'edit', $User['User']['id']));
                        ?>
                    </td>
                    <td>

    <?php
    if ($Role['Role'] == 'Admin') {
        echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $User['User']['id']), null, __('Are you sure you want to delete # %s?', $User['User']['id']));
    }
    ?>

                    </td>

                </tr>

<?php endforeach; ?>
<?php unset($User); ?>
        </table>

<?php
// Shows the next and previous links
echo '<div id="prev_btn">';
echo $this->Paginator->prev(
  '« Previous',
  null,
  null,
  array('class' => 'disabled')
);
echo '</div>';
echo '<div id="page_numbers">';
// Shows the page numbers
echo $this->Paginator->numbers();
echo '</div>';
echo '<div id="next_btn">';

echo $this->Paginator->next(
  'Next »',
  null,
  null,
  array('class' => 'disabled')
);
echo '</div>';

?>



