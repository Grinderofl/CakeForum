<h2>Edit profile</h2>

<h3>Change password</h3>
<div class="newpost">
<?php
echo $form->create(array('controller' => 'users', 'action' => 'edit', $this->data['User']['id']));
echo $form->input('User.id');

echo $form->input('User.password', array('value' => ''));
if($auth['Role']['admin']) {
	echo $form->input('User.role_id');
}
echo $form->submit('Submit'); 
?>
</div>