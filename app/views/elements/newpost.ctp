<?php
if($auth) {
	echo '<div class="threadtools">'; 
	echo $form->create('Topics', array('action' => 'create'));
	echo $form->input('Topic.forum_id', array('type' => 'hidden', 'value' => $forum['Forum']['id']));
	echo $form->submit('New thread');
	echo $form->end();
	echo '</div>';
}
?>