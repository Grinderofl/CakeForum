<div class="form">
<?php 

echo $form->create('User', array('action' => 'register'));
echo $form->input('User.handle', array('label' => 'Handle:'));
echo $form->input('User.email', array('label' => 'E-mail:'));
echo $form->input('User.passwd', array('label' => 'Password:'));
echo $form->submit('Register');
echo $form->end();

?>
</div>