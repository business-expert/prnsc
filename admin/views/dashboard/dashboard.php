<?php include_once(CONTROLLERS_ADMIN."/".$_REQUEST['model'].".php");  ?>
	
	<div>
        <ul class="breadcrumb">
            <li><a href="#">Home</a> <span class="divider">/</span></li>
            <li><a href="#">Dashboard</a></li>
       </ul>
    </div>
    <div class="sortable row-fluid">
        <a data-rel="tooltip" class="well span3 top-block" href="index.php?model=athletes">
            <span class="icon32 icon-red icon-user"></span>
            <div>Athletes</div>
            <!--<span class="notification">1</span>-->
        </a>

        <a data-rel="tooltip" class="well span3 top-block" href="index.php?model=events">
            <span class="icon32 icon-color icon-suitcase"></span>
            <div>Manage Events</div>
            <!--<span class="notification green">1</span>-->
        </a>
    </div>
    
  <div class="row-fluid sortable ui-sortable">
	  <div class="box span4"><?php include_once(VIEWS_ADMIN."/dashboard/letest_athletes.php"); ?></div>
	  <div class="box span4"><?php include_once(VIEWS_ADMIN."/dashboard/letest_event.php"); ?></div>
	  <div class="box span4"><?php include_once(VIEWS_ADMIN."/dashboard/most_visited_fan.php"); ?></div>
  </div>

	</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
				<p>Here settings can be configured...</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary">Save changes</a>
			</div>
		</div>
