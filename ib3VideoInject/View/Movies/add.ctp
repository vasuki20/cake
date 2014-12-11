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
                <li class = active> <?php echo $this->Html->link(__('Add Movie'), array('controller' => 'movies', 'action' => 'add')); ?></li> 
                <li > <?php echo $this->Html->link(__('Edit Movie'), array('controller' => 'movies', 'action' => 'edit')); ?></li>    
                 <li> <?php echo $this->Html->link(__('Featured Image'), array('controller' => 'MoviesContent', 'action' => 'displaymovies', 'featured_image')); ?></li>
            </ul>
        </div>       

        <h1>Enter the Movie details</h1>
        <?php
        echo $this->Form->create('Movie', array('type' => 'file'));
        echo $this->Form->input('Category Id', array(
            'default' => 7,
            'disabled' => 'disabled'
        ));
        echo $this->Form->input('Channel Id', array(
            //  'options' => array("IB3Media", 'IB3 Xclusive', 'IB3 Trailers', 'IB3 Presents: STAR WARS VII', 'The Automotive Channel'),
            'options' => array('IB3Media' => 'IB3Media', 'IB3 Xclusive' => 'IB3 Xclusive', 'IB3 Trailers' => 'IB3 Trailers', 'IB3 Presents: STAR WARS VII' => 'IB3 Presents: STAR WARS VII', 'The Automotive Channel' => 'The Automotive Channel', 'LifeHacks' => 'LifeHacks'),
        ));
        echo $this->Form->input('Title', array(
            'placeholder' => '-'
        ));
        echo $this->Form->input('Type', array(
            'placeholder' => '-'
        ));
        echo $this->Form->input('Description', array(
            'type' => 'textarea',
            'rows' => '5', 'cols' => '4',
            'placeholder' => '-'
        ));
        echo $this->Form->input('image_thumb', array(
            'after' => '<p class = "note" >Maximum dimensions 200*200 <br> pixels.Only JPG format</p>',
            'action' => 'upload',
            'type' => 'file'
        ));
        echo $this->Form->input('Director', array(
            'placeholder' => '-',
        ));
        echo $this->Form->input('Cast', array(
            'type' => 'textarea',
            'rows' => '2', 'cols' => '4',
            'placeholder' => '-'         
        ));
        echo $this->Form->input('Genre', array(
            'placeholder' => '-'
        ));
        echo $this->Form->input('Tag', array(
            'default' => '-',
            'disabled' => 'disabled'
        ));
        echo $this->Form->input('Language', array(
            'default' => 'English',
            'disabled' => 'disabled'
        ));
        echo $this->Form->input('Subtitile', array(
            'default' => '-',
            'disabled' => 'disabled'
        ));
        echo $this->Form->input('Credit', array(
            'default' => '-',
            'disabled' => 'disabled'
        ));
        echo $this->Form->input('Duration', array(
            'placeholder' => '-'
        ));
        echo $this->Form->input('Cp', array(
            'default' => 'JJJ',
            'disabled' => 'disabled'
        ));
        echo $this->Form->input('VideoLink', array(
            'placeholder' => '-'
        ));
        echo $this->Form->input('Bundle Id', array(
            'default' => 1,
            'disabled' => 'disabled'
        ));
        echo $this->Form->input('Published', array(
            'default' => 0,
            'disabled' => 'disabled'
        ));
        echo $this->Form->input('Telco Region', array(
            'default' => 'ib3 media',
            'disabled' => 'disabled'
        ));
        echo $this->Form->end('Save');
        ?>


