<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php __('Pneumonia guild'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		//echo $this->Html->meta('icon');

		echo $this->Html->css('style');

		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<div id="logo"></div>
		
			<ul id="menu">
			<?php 
			$menu = array(
				'Home' => array('controller' => 'forums', 'action' => 'news'), 
				'Forums' => array('controller' => 'forums', 'action' => 'index'),
				'Members' => array('controller' => 'users', 'action' => 'index')
			); 
			
			foreach($menu as $k => $v): 
			?>
			<li class="menuitem">
				<?php echo $html->link($k, $v)?>
			</li>
			
			<?php endforeach;?>
			</ul>	
		</div>
		<div style="clear:both;"></div>
		
		<div id="content">
		<?php echo $this->element('userpanel');?>
			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>
		<div id="footer">

		</div>
		<div style="clear:both;"></div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>