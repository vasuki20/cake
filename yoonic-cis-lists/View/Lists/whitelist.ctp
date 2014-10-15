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
                <li class = active> <?php echo $this->Html->link(__('White List'), array('action' => 'whitelist')); ?></li>
                <li> <?php echo $this->Html->link(__('Black List'), array('controller' => 'lists', 'action' => 'blacklist')); ?></li>               
            </ul>
        </div>
        <div>
            <?php echo $this->Html->link(__('Add White List'), array('controller' => 'lists', 'action' => 'whitelistadd')); ?>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Value</th>
                <th>Timestamp</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
         
             <?php foreach ($Lists as $List): ?>
               <tr>
                   <td><?php print_r($List['WhiteList']['id']);?></td>
                   <td><?php print_r($List['WhiteList']['value']);?></td>
                   <td><?php print_r($List['WhiteList']['created']);?></td>
                   <td>
                        <?php
                           echo $this->Html->link('Edit', array('action' => 'whitelistedit', $List['WhiteList']['id']));
                        ?>
                    </td>
                   <td>
                        <?php
                            echo $this->Form->postLink(__('Delete'), array('action' => 'whitelistdelete', $List['WhiteList']['id']), null, __('Are you sure you want to delete # %s?', $List['WhiteList']['id']));
                        ?>
                    </td>
               </tr>
             <?php endforeach; ?>
             <?php unset($Lists); ?>
            <!-- Here is where we loop through our $posts array, printing out post info -->
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
    </body>
</html>

