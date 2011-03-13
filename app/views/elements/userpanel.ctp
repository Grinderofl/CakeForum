<div class="userbox">
<?php 

if(!$auth) {
?>
You are not logged in. 
<?php echo $html->link('Log in', array('controller' => 'users', 'action' => 'login')); ?> 
/
<?php echo $html->link('Register', array('controller' => 'users', 'action' => 'register')); ?>
<?php 
} else {
	//debug($auth);
?>
You are logged in as 
<?php echo $html->link($auth['User']['handle'], array('controller' => 'users', 'action' => 'edit', $auth['User']['id']))?>  
(<?php echo $auth['Role']['title']?>) |  
<?php echo $html->link('Logout', array('controller' => 'users', 'action' => 'logout'))?>
<?php 
	//debug($auth);
}
?>
</div>