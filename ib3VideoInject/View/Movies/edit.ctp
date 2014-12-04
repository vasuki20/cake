<!-- File: /app/View/Posts/add.ctp -->
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
                <li> <?php echo $this->Html->link(__('Home'), array('controller' => 'movies', 'action' => 'index')); ?></li> 
                <li> <?php echo $this->Html->link(__('Add Movie'), array('controller' => 'movies', 'action' => 'add')); ?></li> 
                <li class = active> <?php echo $this->Html->link(__('Edit Movie'), array('controller' => 'movies', 'action' => 'edit')); ?></li>    
                
            </ul>
        </div>       
        <?php
        echo $this->Form->create('Movie');
        echo '<div><div id="searchText" style="width: 33%;float:left;margin-top: 3px;margin-left: 50px;">';
        echo $this->Form->input('SearchParam', array('placeholder' => 'Search by title'));
        echo '</div>';
        echo '<div id="searchBtn" style="float: left;clear: none;padding: 0;">';
        echo $this->Form->end('Search');
        echo '</div></div>';
        ?>
        <table>
            <tr> 
                <th>ID</th>
                <th>Edit</th>
                <th>Title</th>
                <th>Type</th>
                <th>Description</th>               
                <th>Genre</th>              
                <th>Duration</th>
                <th>Video Link</th>                
                <th>Delete</th> 
            </tr>
            <?php// print_r($Movies); ?>
             <?php foreach ($Movies as $Movie): ?>
               <tr>
                   <td><?php print_r($Movie['Movie']['id']);?></td>
                   <td>
                        <?php
                           echo $this->Html->link('Edit', array('action' => 'editmovie', $Movie['Movie']['id']));
                        ?>
                    </td>
                   <td><?php print_r($Movie['Movie']['title']);?></td>
                   <td><?php print_r($Movie['Movie']['type']);?></td>
                   <td><?php print_r($Movie['Movie']['description']);?></td>                 
                   <td><?php print_r($Movie['Movie']['genre']);?></td>
                   <td><?php print_r($Movie['Movie']['duration']);?></td>
                   <td><?php print_r($Movie['Movie']['abr']);?></td>                                     
                   <td>
                        <?php
                            echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $Movie['Movie']['id']), null, __('Are you sure you want to delete # %s?', $Movie['Movie']['title']));
                        ?>
                    </td>
               </tr>
             <?php endforeach; ?>
             <?php unset($Movie); ?>
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
<?php unset($Movie); ?>




