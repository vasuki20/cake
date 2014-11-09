<?php
echo $this->Form->create();
echo $this->Form->input('search',array(
    'id'=>'q',
    'name'=> 'q',
    'placeholder'=>'Enter Search Term'
));
echo $this->Form->input('number', array(
    'id'=>'maxResults',
    'name'=>'maxResults',
    'min'=> 1,
    'max'=>50,
    'step'=>1,
    'value'=>25
    
));
echo $this->Form->input('text', array(
    'id'=>'location',
    'name'=>'location',
    'placeholder'=> "37.42307,-122.08427"
));

echo $this->Form->input('text', array(
    'id'=>'locationRadius',
    'name'=>'locationRadius',
    'placeholder'=> "5km"
));
     
echo $this->Form->end('Submit');


?>
