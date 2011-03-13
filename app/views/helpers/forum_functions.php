<?php 

class ForumFunctionsHelper extends AppHelper {
	
	var $helpers = array('Html');
	
	function pages($topic, $posts = 1, $limit = 20, $class = 'topicpages') {
		$result = array();
		
		$pages = ceil($posts / $limit);
		if($pages == 1) {
			return false;
		}
			
		for($i = 1; $i <= $pages; $i++) {
			$result[] = $this->Html->link($i, array('controller' => 'topics', 'action' => 'view', $topic, 'page' => $i));
		}
		
		return '<span class="'.$class.'">'.'Pages: ' . implode(' | ', $result).'</span';
	}
}