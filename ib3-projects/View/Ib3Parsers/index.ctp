<?php

echo $this->Form->create();
echo $this->Form->input('Search by keyword', array(
    'id' => 'q',
    'name' => 'q',
    'placeholder' => 'Enter Search Term'
));

echo $this->Form->input('Search by Channel', array(
    'id' => 'c',
    'name' => 'c',
    'placeholder' => 'Enter Search Term'
));

echo $this->Form->input('number', array(
    'id' => 'maxResults',
    'name' => 'maxResults',
    'min' => 1,
    'max' => 50,
    'step' => 1,
    'value' => 25
));
echo $this->Form->end('Submit');
?>
