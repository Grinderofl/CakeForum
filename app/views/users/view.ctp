<h2>View user <?php echo $user['User']['handle']?></h2>

<p>User registered <?php echo $time->ago($time->toUnix($user['User']['created']));?> ago, @ <?php echo $time->nice($user['User']['created']);?></p>

<?php
if($auth['User']['role_id'] == 1) {
	echo $html->link('Edit', array('action' => 'edit', $user['User']['id']));
}
//debug($user);

?>