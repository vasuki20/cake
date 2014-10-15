<?php
foreach ($movies as $movie):
?>
<h1><?php echo h($movie['VodTbl']['channel_dir']); ?> </h1>
<h1><?php echo h($movie['VodTbl']['director']); ?></h1>
<p>Length: <?php echo h($movie['VodTbl']['language']); ?></p>
<div><?php echo h($movie['VodTbl']['description']); ?></div>
<?php
endforeach;
?>