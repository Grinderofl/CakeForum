<div class="crumbs">
<?php echo $html->link('Forums', array('controller' => 'forums'));?>
&nbsp;&raquo;&nbsp; 
<?php echo $forum['Forum']['title'];?>

</div>
<?php echo $this->element('newpost');?>
<div id="postswrapper">

<div id="forumwrapper">
<div class="tablewrapper">
	<table>
		<thead>
			<tr><th colspan="2" class="forumheading">Topic</th><th class="threads">Posts</th><th class="lastposter">Last Poster</th><th class="posts">Age</th></tr>
		</thead>
		<tbody>
		<?php $cnt = 0; foreach($topics as $topic):
		$cnt += 1;
		?>
		<tr<?php echo ($cnt % 2)?' class="odd"':'';?>>
			<td class="center newposts">&nbsp;</td>
			<td><b class="forumtitle"><?php echo $html->link($topic['Topic']['title'], array('controller' => 'topics', 'action' => 'view', $topic['Topic']['id']));?></b>
				 <?php echo $forumFunctions->pages($topic['Topic']['id'], $topic['Topic']['post_count'], $limit);?>
			</td>
			<td class="center"><?php echo $topic['Topic']['post_count'];?></td>
			<td class="center">
				<?php echo $html->link($topic['Post'][count($topic['Post'])-1]['User']['handle'], array('controller' => 'users', 'action' => 'view', $topic['Post'][count($topic['Post'])-1]['User']['id']));?>
			</td>
			<td class="center">
				<?php echo $time->ago($time->toUnix($topic['Post'][count($topic['Post'])-1]['created'])); ?>
			</td>
		</tr>		
		<?php endforeach;?>
		</tbody>
	
	</table>
</div>
</div>
<?php echo $this->element('paging');//debug($forum);?>
<?php //debug($topics);?>