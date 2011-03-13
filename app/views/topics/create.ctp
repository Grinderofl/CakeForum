<div class="crumbs">
<?php echo $html->link('Forums', array('controller' => 'forums'));?>
&nbsp;&raquo;&nbsp; 
<?php echo $html->link($forum['Forum']['title'], array('controller' => 'forums', 'action' => 'view', $forum['Forum']['id']));?>
&nbsp;&raquo;&nbsp;
New thread
</div>
<?php 
echo '<div class="newpost">';
echo $form->create('Topics', array('action' => 'create'));
echo $form->input('Topic.forum_id', array('type' => 'hidden'));
echo $form->input('Topic.title');
echo $form->input('Post.0.post');
echo $form->submit('Create thread', array('name' => 'submit'));
echo '</div>';
//debug($this->data);
?>