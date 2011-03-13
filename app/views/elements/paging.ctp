<div class="pager">
<?php echo $this->Paginator->prev("« Previous", null, null, array('class' => 'disabled', 'escape' => false))?>&nbsp;&nbsp;
<?php echo $this->Paginator->numbers();?>
&nbsp;&nbsp;&nbsp;<?php echo $this->Paginator->next("Next »", null, null, array('class' => 'disabled', 'escape' => false))?>
</div>