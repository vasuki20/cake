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
                <li> <?php echo $this->Html->link(__('Edit Movie'), array('controller' => 'movies', 'action' => 'edit')); ?></li>    
                <li class = active>  <?php echo $this->Html->link(__('Featured Image'), array('controller' => 'MoviesContent', 'action' => 'displaymovies', 'featured_image')); ?></li>
                <li> <?php echo $this->Html->link(__('Movies Free'), array('controller' => 'MoviesContent', 'action' => 'displaymoviesfree','movies_free')); ?></li>
            </ul>
        </div>

        <?php
        echo $this->requestAction(
                array('controller' => 'FeaturedImage',
            'action' => 'displayfeaturedimage'), array('return')
        );
        ?>
        <?php echo "<br><br>"; ?>  
        <div style="margin-right: 10%;color: rgb(40, 60, 123); font-size: 150%;">
            <ul>
                <?php echo "Upload image to Featured Table" ?>
            </ul>
        </div>

        <?php
        echo $this->Form->create('MoviesContent');
        echo '<div><div id="searchText" style="width: 40%;float:left;margin-top: 3px;margin-left: 70px;">';
        echo $this->Form->input('SearchParam', array(placeholder => 'Search for movie title'));
        echo '</div>';
        echo '<div id="searchBtn" style="width:20%;float:left;clear: none;padding: 0;">';
        echo $this->Form->end('Search');
        echo '</div></div>';
        ?>
        <?php
        if ($fromtablename == "movies_free") {
            $tableName = "Movies Free";
            $controller = "MoviesFree";
            $action = "displaymoviesfree";
        } else if ($fromtablename == "movies_hot") {
            $tableName = "Movies Hot";
            $controller = "MoviesHot";
            $action = "displaymovieshot";
        } else if ($fromtablename == "movies_new") {
            $tableName = "Movies New";
            $controller = "MoviesNew";
            $action = "displaymoviesnew";
        } else if ($fromtablename == "featured_image") {
            $tableName = "Featured Image";
            $controller = "FeaturedImage";
            $action = "displayfeaturedimage";
        }
        ?>
        <!-- Back to home -->
        <div style="margin-top: 8%;color: rgb(175, 10, 10);">
            <?php //echo $this->Html->link('Back To ' . $controller, array('controller' => $controller, 'action' => $action));  ?>
        </div>
        <div style="margin-left: 20%;color: rgb(175, 10, 10);font-size: 120%;">
            Please select a movie to insert in  <?php echo $tableName; ?> table
        </div>
        <?php echo"<br>"; ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Select</th>
            </tr>
            <!-- Here is where we loop through our $posts array, printing out post info -->

            <?php foreach ($movies as $movie): ?>

                <tr>
                    <td><?php echo $movie['MoviesContent']['id']; ?></td>
                    <td><?php echo $movie['MoviesContent']['title']; ?></td>
                    <td>
                        <?php
                        echo $this->Html->link('Select', array('controller' => 'MoviesContent', 'action' => 'select', $movie['MoviesContent']['id'], $fromtablename));
                        ?>
                    </td>

                </tr>


            <?php endforeach; ?>
            <?php unset($movies); ?>
        </table>
    </body>
    <?php
// Shows the next and previous links
    echo '<div id="prev_btn">';
    echo $this->Paginator->prev(
            '« Previous', null, null, array('class' => 'disabled')
    );
    echo '</div>';
    echo '<div id="page_numbers">';
// Shows the page numbers
    echo $this->Paginator->numbers();
    echo '</div>';
    echo '<div id="next_btn">';

    echo $this->Paginator->next(
            'Next »', null, null, array('class' => 'disabled')
    );
    echo '</div>';
    ?>



