<div class="crumbs">
<?php echo $html->link('Forums', array('controller' => 'forums'));?>
&nbsp;&raquo;&nbsp; 
<?php echo $html->link($this->data['Forum']['title'], array('controller' => 'forums', 'action' => 'view', $this->data['Forum']['id']));?>
&nbsp;&raquo;&nbsp;
Edit post in thread <?php echo $this->data['Topic']['title'];?>
</div>
<h2>Edit post</h2>
<?php
echo '<div class="newpost">';
echo $form->create(array('controller' => 'posts', 'action' => 'edit', $this->data['Post']['id'])); 
echo $form->input('Post.id');
echo $form->input('Post.post');
echo $form->submit('Submit edit');
echo $form->end();
echo '</div>';
//debug($this->data);
?>