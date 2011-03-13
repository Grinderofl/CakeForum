<div class="form">
<?php 

echo $form->create();
echo $form->input('User.email', array('label' => 'E-mail:'));
echo $form->input('User.password', array('label' => 'Password:'));
echo $form->submit('Log in');
echo $form->end();

?>
</div>