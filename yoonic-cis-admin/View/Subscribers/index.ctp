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
                <li> <?php echo $this->Html->link(__('Home'), array('controller' => 'users', 'action' => 'index')); ?></li>
                <li> <?php echo $this->Html->link(__('Reports'), array('controller' => 'reports', 'action' => 'export_day/display')); ?></li>
                <li  class = active> <?php echo $this->Html->link(__('Subscription'), array('controller' => 'subscribers', 'action' => 'index')); ?></li>
              <!--  <li> <?php echo $this->Html->link(__('Content'), array('controller' => 'movies', 'action' => 'index')); ?></li> -->
                <li class="logoutMenu"> <?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></li>

            </ul>
        </div>
    </body>
    <html>
        <?php
        echo $this->Form->create('Subscriber');
        echo '<div><div id="searchText" style="width: 40%;float:left;margin-top: 3px;margin-left: 70px;">';
        echo $this->Form->input('SearchParam');
        echo '</div>';
        echo '<div id="searchBtn" style="float: left;clear: none;padding: 0;">';
        echo $this->Form->end('Search');
        echo '</div></div>';
        ?>
        <?php $this->log($Subscribers, 'debug'); ?>
        <table>
            <tr>
                <th>ID</th>
                <th>msisdn</th>
                <th>Password</th>
                <th>Email</th>
                <th>Status</th>
                <th>Name</th>
                <th>Address</th>
                <th>Postal_Code</th>
                <th>Telco_Id</th>
                <th>Date_Join</th>
                <th>Last_Join</th>
                <th>Incomplete</th>
                <th>Date_Created</th>
                <th>Created_By</th>
                <th>Date_Modified</th>
                <th>Modified_By</th>
                <th>Edit</th>
            </tr>
            <!-- Here is where we loop through our $posts array, printing out post info -->
            <?php $this->log($Subscribers, 'debug'); ?>

            <?php foreach ($Subscribers as $Subscriber): ?>

                <tr>
                    <td>
                        <?php
                        echo $this->Html->link
                                (
                                $Subscriber['Subscriber']['id'], array('controller' => 'Subscribers',
                            'action' => 'view', $Subscriber['Subscriber']['id']
                                )
                        );
                        ?>
                    </td>

                    <td><?php echo $Subscriber['Subscriber']['msisdn']; ?></td>
                    <td><?php echo $Subscriber['Subscriber']['password']; ?></td>
                    <td style="max-width: 120px;"><?php echo $Subscriber['Subscriber']['email']; ?></td>
                    <td><?php echo $Subscriber['Subscriber']['status']; ?> </td>
                    <td><?php echo $Subscriber['Subscriber']['name']; ?> </td>
                    <td style="max-width: 200px;"><?php echo $Subscriber['Subscriber']['address']; ?></td>
                    <td><?php echo $Subscriber['Subscriber']['postal_code']; ?></td>
                    <td><?php echo $Subscriber['Subscriber']['telco_id']; ?></td>
                    <td><?php echo $Subscriber['Subscriber']['date_join']; ?></td>
                    <td><?php echo $Subscriber['Subscriber']['last_login']; ?></td>
                    <td><?php echo $Subscriber['Subscriber']['incomplete']; ?></td>
                    <td><?php echo $Subscriber['Subscriber']['date_created']; ?></td>
                    <td><?php echo $Subscriber['Subscriber']['created_by']; ?></td>
                    <td><?php echo $Subscriber['Subscriber']['date_modified']; ?></td>
                    <td><?php echo $Subscriber['Subscriber']['modified_by']; ?></td>
                    <td>
                        <?php
                        echo $this->Html->link(
                                'Edit', array('action' => 'edit', $Subscriber['Subscriber']['id']));
                        ?>
                    </td>
                </tr>

            <?php endforeach; ?>
            <?php unset($Subscriber); ?>               

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





