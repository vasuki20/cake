<div id='cssmenu'>
    <ul>
        <li> <?php ?></li>
                <li> <?php echo $this->Html->link(__('Home'), array('controller' => 'movies', 'action' => 'index')); ?></li> 
                <li> <?php echo $this->Html->link(__('Add Movie'), array('controller' => 'movies', 'action' => 'add')); ?></li> 
                <li> <?php echo $this->Html->link(__('Edit Movie'), array('controller' => 'movies', 'action' => 'edit')); ?></li>    
                <li class = active> <?php echo $this->Html->link(__('Featured Image'), array('controller' => 'MoviesContent', 'action' => 'displaymovies', 'featured_image')); ?></li>
                <li class = active> <?php echo $this->Html->link(__('Featured Image'), array('controller' => 'MoviesContent', 'action' => 'displaymovies', 'movies_free')); ?></li>
    </ul>
</div>
<!-- Back to Movies -->
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
<div id='cssmenu'>
    <ul>
        <li> <?php // echo $this->Html->link('Back To ' . $controller, array('controller' => $controller, 'action' => $action)); ?></li>
    </ul>
</div>
<!--*******-->
<?php
echo '<div>';
echo $this->Form->create('MoviesContent', array('enctype' => 'multipart/form-data'));
//echo $this->Form->create('MoviesContent');
if ($fromtablename == "featured_image") {
    echo $this->Form->input('image', array('type' => 'file','accept' => 'image/*',
            'after' => '<p class = "note" >Maximum dimensions 720* <br> 405 pixels.Only JPG format</p>'
            ));
}
echo $this->Form->input('id', array('value' => $movie['MoviesContent']['id'], 'readonly' => 'readonly', 'type' => 'text'));
echo $this->Form->input('title', array('value' => $movie['MoviesContent']['title'], 'readonly' => 'readonly'));
echo $this->Form->hidden('target', array('value' => $fromtablename, 'display' => 'none'));
echo $this->Form->end('Save');
?>
<?php
if ($fromtablename == "movies_free") {
    $tableName = "Movies Free";
} else if ($fromtablename == "movies_hot") {
    $tableName = "Movies Hot";
} else if ($fromtablename == "movies_new") {
    $tableName = "Movies New";
} else if ($fromtablename == "featured_image") {
    $tableName = "Featured Image";
}
?>
<div style="margin-top: 8%;margin-left: 33%;color: rgb(175, 10, 10);">
    Clicking submit will save the movie in  <?php echo $tableName; ?>
</div>
