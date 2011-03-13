
<div id="forumwrapper">
<div class="tablewrapper">
	<!-- <div class="tableheader">
		<span>Public forums</span>
	</div> -->
	<table>
		<thead>
			<tr><th colspan="2" class="forumheading">Forum</th><th class="threads">Threads</th><th class="posts">Posts</th></tr>
		</thead>
		<tbody>
		<?php $cnt = 0; foreach($forums as $forum):
		if((isset($allowed) && in_array($forum['Forum']['group_id'], $allowed)) ||  !strlen($forum['Forum']['group_id'])):
		$cnt += 1;
		?>
		<tr<?php echo ($cnt % 2)?' class="odd"':'';?>>
			<td class="center newposts">&nbsp;</td>
			<td><b class="forumtitle"><?php echo $html->link($forum['Forum']['title'], array('controller' => 'forums', 'action' => 'view', $forum['Forum']['id']));?></b> - <?php echo $forum['Forum']['description'];?></td>
			<td class="center"><?php echo $forum['Forum']['topic_count'];?></td>
			<td class="center">
				<?php
				$posts = 0; 
				foreach($forum['Topic'] as $topic){
					$posts += $topic['post_count'];
				}
				
				echo $posts;
				?>
			</td>
		</tr>		
		<?php endif; endforeach;?>
		</tbody>
	
	</table>
</div>
</div>
<?php //debug($forums);?>