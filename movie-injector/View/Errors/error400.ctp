<?php
if (Configure::read('debug') > 0 ):
	echo $this->element('exception_stack_trace');
endif;
?>
