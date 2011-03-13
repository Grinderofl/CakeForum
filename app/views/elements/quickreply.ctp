<?php 
if($auth) {
	echo '<div class="quickbox">';
	echo $form->create('Posts', array('controller' => 'posts', 'action' => 'create'));
	echo $form->input('Post.topic_id', array('type' => 'hidden', 'value' => $topic['Topic']['id']));
	echo $form->input('Post.forum_id', array('type' => 'hidden', 'value' => $forum['Forum']['id']));
	echo $form->input('Post.post', array('label' => false, 'class' => 'quickreply'));
	echo $form->submit('Post reply');
	echo $form->end();
	echo '</div>';
} else {
	echo '<h2 class="center">You must be logged in to reply to topics.</h2>';
}
?>