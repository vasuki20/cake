<!-- File: /app/View/Posts/add.ctp -->

<h1>Enter the Movie details</h1>

<?php
echo $this->Form->create('Movie');
echo $this->Form->input('Category Id',array(
         'default' => 7,
        'disabled'=>'disabled'
        ));
echo $this->Form->input('Channel Id',array(
  //  'options' => array("IB3Media", 'IB3 Xclusive', 'IB3 Trailers', 'IB3 Presents: STAR WARS VII', 'The Automotive Channel'),
      'options' => array('IB3Media' => 'IB3Media', 'IB3 Xclusive' => 'IB3 Xclusive', 'IB3 Trailers' => 'IB3 Trailers', 'IB3 Presents: STAR WARS VII' => 'IB3 Presents: STAR WARS VII'),
    'empty' => '(choose one)'
    ));

echo $this->Form->input('Title');
echo $this->Form->input('Type');
echo $this->Form->input('Description');
echo $this->Form->input('image_thumb');
echo $this->Form->input('Director');
echo $this->Form->input('Cast');
echo $this->Form->input('Genre');
echo $this->Form->input('Tag',array(
    'default'=> '-',
    'disabled'=>'disabled'
    ));
echo $this->Form->input('Language',array(
    'default'=> 'English',
    'disabled'=>'disabled'
        ));
echo $this->Form->input('Subtitile',array(
    'default'=> '-',
    'disabled'=>'disabled'
    ));
echo $this->Form->input('Credit',array(
    'default'=> '-',
    'disabled'=>'disabled'
    ));
echo $this->Form->input('Duration');
echo $this->Form->input('Cp',array(
    'default'=> 'JJJ',
    'disabled'=>'disabled'
    ));
echo $this->Form->input('VideoLink');
echo $this->Form->input('Bundle Id',array(
    'default'=>1,
    'disabled'=>'disabled'
    ));
echo $this->Form->input('Published',array(
    'default' => 0,
    'disabled'=>'disabled'
  ));
echo $this->Form->input('Telco Region',array(
    'default'=> 'ib3 media',
    'disabled'=>'disabled'
  ));
echo $this->Form->end('Submit');
?>


