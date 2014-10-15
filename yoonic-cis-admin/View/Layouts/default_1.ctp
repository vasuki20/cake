<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'Yoonic CIS Admin');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?> 
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('report');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link($cakeDescription, 'http://cakephp.org'); ?></h1>
			
			<?php if($this->Session->read('Auth.User') || 1): ?>
			<span><?php echo $this->Html->link('Logout', array('controller'=>'admins', 'action'=>'logout'), array('class'=>'logout')); ?></span>
			<div id='cssmenu'>
			<ul>
			   <li class='active '><?php echo $this->Html->link('API Users', array('controller'=>'api_users', 'action'=>'index')); ?></li>
			   <?php if($this->Session->read('Auth.User.telco_id')=="0"): ?>
			   <li><?php echo $this->Html->link('Telcos', array('controller'=>'telcos', 'action'=>'index')); ?></li>
			   <?php endif; ?>
			   <li><?php echo $this->Html->link('Members', array('controller'=>'members', 'action'=>'index')); ?></li>
			   <?php if($this->Session->read('Auth.User.telco_id')=="0"): ?>
			   <li class='has-sub '><a href='#'><span>Sessions</span></a>
			      <ul>
			         <li><?php echo $this->Html->link('Purge', array('controller'=>'session_tokens', 'action'=>'purge')); ?></li>
			      </ul>
			   </li>
			   <?php endif; ?>
			   <li><?php echo $this->Html->link('Reports', array('controller'=>'reports', 'action'=>'index')); ?></li>
			</ul>
			</div>
			                                                                                                                                                                                                                   
			<?php endif; ?>
			
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
