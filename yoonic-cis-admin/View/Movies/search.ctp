<?php 
echo $this->Form->create('Movie', array('type' => 'get'));
echo $this->Form->input('Movie.title');
echo $this->Form->end('Search');
