<?php
class PagesController extends AppController {
	var $name = 'Pages';
	var $helpers = array('Time');
	var $uses = array('Topic');
	
	function index() {
		$this->redirect(array('action' => 'display'));
	}
	
	function display() {

	}
}