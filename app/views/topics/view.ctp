<div class="crumbs">
<?php echo $html->link('Forums', array('controller' => 'forums'));?>
&nbsp;&raquo;&nbsp; 
<?php echo $html->link($forum['Forum']['title'], array('controller' => 'forums', 'action' => 'view', $forum['Forum']['id']));?>
&nbsp;&raquo;&nbsp;
<?php echo $topic['Topic']['title'];?>
</div>
<?php echo $this->element('paging');?>
<div id="postswrapper">
<ul class="postlist">
<?php 
$cnt = 0; 
foreach($posts as $post):
$cnt += 1;
?>
	<li<?php echo ($cnt %2)?' class="odd"':'';?>>
		<a name="<?php echo $post['Post']['id'];?>"></a>
		<div class="userside">
			<div class="username">
				<?php echo $post['User']['handle']?>
			</div>
			<div class="rank">
				<?php echo $post['User']['Role']['title'];?>
			</div>
			<div class="status online">
				Online status
			</div>
			<div class="postcount">
				Posts: <?php echo $post['User']['post_count']?>
			</div>
		</div>
		<div class="postside">
			<?php if($auth && $post['User']['id'] == $auth['User']['id']): ?>
			 <div class="posttitle">
				<?php echo $html->link('Edit', array('controller' => 'posts', 'action' => 'edit', $post['Post']['id']));?>
			</div>
			<?php endif;?>
			<div class="postcontent">
				<?php echo $bbcode->format($post['Post']['post'])?>
			</div>
			<div class="postfooter">
				Posted <?php echo $time->ago($time->toUnix($post['Post']['created']))?> ago
			</div>
		</div>

	</li>
<?php endforeach;?>
</ul>

</div>

<?php 
echo $this->element('paging');
echo $this->element('quickreply');
//debug($posts);
?>