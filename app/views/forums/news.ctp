<ul class="split">
	<li>
		<div class="moduleblock">
			<div class="module mod">
				<div class="moduleheader">Menu</div>
				<div class="modulecontent recruitment">
					<ul id="recruitment">
						<li><div class="classblock">Menuitem 1</div></li>
						<li><div class="classblock">Menuitem 2</div></li>
						<li><div class="classblock">Menuitem 3</div></li>
						<li><div class="classblock">Menuitem 4</div></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="newsblock">
				<?php //debug($news);
				
				foreach($news as $topic): 
				?>
				<div class="module news">
					<div class="moduleheader">
						<?php echo $topic['Topic']['title'];?>
					</div>
					<div class="modulecontent">
						<?php echo $bbcode->format($topic['Post'][0]['post']);?>
					</div>
					<div class="modulefooter">
						Posted <?php echo $time->niceShort($topic['Topic']['created']);?>, by <?php echo $html->link($topic['User']['handle'], array('controller' => 'users', 'action' => 'view', $topic['User']['id']));?>  | 
						<?php echo $html->link('Comments ('.($topic['Topic']['post_count']-1).')', array('controller' => 'topics', 'action' => 'view', $topic['Topic']['id']));?>
					</div>
				</div>
				<?php endforeach;?>
				<?php echo $this->element('paging');?>
		</div>
	</li>
</ul>
<?php //debug($news);?>