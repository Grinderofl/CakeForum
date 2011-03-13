<div id="forumwrapper">
<div class="tablewrapper">
	<table>
		<thead>
			<tr>
				<th>Handle</th>
				<th class="center latest newposts">Registered</th>
				<th class="center latest newposts">Threads</th>
				<th class="center latest newposts">Posts</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$cnt = 0; 
			foreach($users as $user):
			$cnt ++;
			?>
				<tr<?php echo $cnt % 2 ? ' class="odd"':'';?>>
					<td><?php echo $html->link($user['User']['handle'], array('action' => 'view', $user['User']['id']))?></td>
					<td class="center"><?php echo $time->ago($time->toUnix($user['User']['created']))?> ago</td>
					<td class="center"><?php echo $user['User']['topic_count']?></td>
					<td class="center"><?php echo $user['User']['post_count']?></td>
				</tr>
			<?php endforeach;?>
		</tbody>
	</table>
</div>
</div>

<?php 
//debug($users);
?>