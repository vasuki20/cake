<body>
    <div id='cssmenu'>

        <ul>
            <li> <?php echo $this->Html->link(__('Home'), array('controller' => 'users', 'action' => 'index')); ?></li>
            <li class = "active"> <?php echo $this->Html->link(__('Movies Free'), array('controller' => 'MoviesFree', 'action' => 'displaymoviesfree')); ?></li>
            <li> <?php echo $this->Html->link(__('Movies hot'), array('controller' => 'MoviesHot', 'action' => 'displaymovieshot')); ?></li>
            <li> <?php echo $this->Html->link(__('Movies New'), array('controller' => 'MoviesNew', 'action' => 'displaymoviesnew')); ?></li>
            <li> <?php echo $this->Html->link(__('Featured Image'), array('controller' => 'FeaturedImage', 'action' => 'displayfeaturedimage')); ?></li>
            <li class="logoutMenu"> <?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></li>
        </ul>    
    </div>
</body>

<?php
//echo "List of" .$count. "Movies";
echo $this->Html->link('Add Movie', array('controller' => 'MoviesContent', 'action' => 'displaymovies', 'movies_free'));
?>
<table>
    <tr>
        <th>Id</th>
        <th>Movie Id</th>
    </tr>
    <?php foreach ($movies as $movie): ?>
        <tr>
            <td><?php echo h($movie['MoviesFree']['id']); ?></td>

            <td><?php echo $movie['MoviesFree']['movie_id']; ?></td>

        </tr>
    <?php endforeach; ?>
</table>
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

