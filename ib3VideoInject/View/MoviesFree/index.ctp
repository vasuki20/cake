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
            
        </ul>    
    </div>


<?php
//echo "List of" .$count. "Movies";
echo $this->Html->link('Add Movie', array('controller' => 'MoviesContent', 'action' => 'displaymovies', 'movies_free'));
?>
<table>
    <tr>
        <th>Id</th>
        <th>Movie Id</th>
        <th>Youtube_Url</th>
    </tr>
    <?php print_r($movies); ?>
    <?php foreach ($movies as $movie): ?>
        <tr>
            <td><?php echo h($movie['MoviesFree']['id']); ?></td>

            <td><?php echo $movie['MoviesFree']['movie_id']; ?></td>

        </tr>
    <?php endforeach; ?>
</table>
</html>
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
<?php unset($movie); ?>

