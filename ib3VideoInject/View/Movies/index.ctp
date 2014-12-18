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
                <li class = active> <?php echo $this->Html->link(__('Home'), array('controller' => 'movies', 'action' => 'index')); ?></li> 
                <li> <?php echo $this->Html->link(__('Add Movie'), array('controller' => 'movies', 'action' => 'add')); ?></li> 
                <li> <?php echo $this->Html->link(__('Edit Movie'), array('controller' => 'movies', 'action' => 'edit')); ?></li>    
                <li> <?php echo $this->Html->link(__('Featured Image'), array('controller' => 'MoviesContent', 'action' => 'displaymovies', 'featured_image')); ?></li>
                <li> <?php echo $this->Html->link(__('Movies Free'), array('controller' => 'MoviesFree', 'action' => 'displaymoviesfree', 'movies_free')); ?></li>
            </ul>
        </div>
        <div class="layout">
            <div class="layout-image">
                <img src="img/layout.png" alt="">
            </div>
        </div>

    </body>
</html>