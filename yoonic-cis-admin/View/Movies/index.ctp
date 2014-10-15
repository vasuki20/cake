<body>
    <div id='cssmenu'>

        <ul>
            <li> <?php echo $this->Html->link(__('Home'), array('controller' => 'users', 'action' => 'index')); ?></li>
            <li> <?php echo $this->Html->link(__('Reports'), array('controller' => 'reports', 'action' => 'export_day/display')); ?></li>
            <li> <?php echo $this->Html->link(__('Subscription'), array('controller' => 'subscribers', 'action' => 'index')); ?></li>
            <li class = active> <?php echo $this->Html->link(__('Content'), array('controller' => 'movies', 'action' => 'index')); ?></li>
            <li class="logoutMenu"> <?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></li>
        </ul>    
    </div>
</body>
<?php
        echo $this->Form->create('Movie');
        echo '<div><div id="searchText" style="width: 40%;float:left;margin-top: 3px;margin-left: 50px;">';
        echo $this->Form->input('SearchParam');
        echo '</div>';
        echo '<div id="searchBtn" style="float: left;clear: none;padding: 0;">';
        echo $this->Form->end('Search');
        echo '</div></div>';
        ?>
<h3>List of <?php echo $count ?> Movies</h3>
<?php 
//echo "List of" .$count. "Movies";
//echo $this->Html->link('Add Movie', array('controller' => 'movies', 'action' => 'add')); ?>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Channel</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($movies as $movie): ?>
        <tr>
            <td><?php echo h($movie['Movie']['id']); ?></td>
            <td>
                <?php echo $this->Html->link($movie['Movie']['title'], array('controller' => 'movies', 'action' => 'view', $movie['Movie']['id']));
                ?>
            </td>
            <td>
                <?php
                echo $movie['Channel']['name'];
                ?>
            </td>
            <td>
                <?php
                if ($movie['Movie']['published'] == 0) {
                    $status = 'Unpublished';
                } else {
                    $status = 'Published';
                }
                echo $status;
                ?>
            </td>
            <td>
                <?php echo $this->Html->link('Edit', array('action' => 'edit', $movie['Movie']['id']));
                ?> | 
                <?php
                //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $movie['Movie']['id']), array('confirm' => 'Are you sure you want to delete movie, ' . $movie['Movie']['title'] . '?'));
                echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $movie['Movie']['id']), array('confirm' => 'Are you sure you want to delete movie, ' . $movie['Movie']['title']));
                //  echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $User['u']['id']), null, __('Are you sure you want to delete # %s?', $User['u']['id']));
                ?>       
            </td>
        </tr>
    <?php endforeach; ?>
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
<?php unset($movie); ?>

