<div class="container-fluid p-t-10 no-border ">
	<div class="row p-r-20 p-l-20">
		<div class="col-sm-2 hidden-xs p-l-00 p-r-05">
			<div class="panel m-b-10">
				<div class="panel-heading"><i class="glyphicon glyphicon-list"></i></div>
				<ul class="list-group">
					<li class="list-group-item">
						<?=anchor('admin/users', 'Users');?>
					</li>
					<?php if ($this->session->user->usertype === SUPER_ADMIN): ?>
					<li class="list-group-item">
						<?=anchor('admin/webAdmins', 'Web Administrators');?>
					</li>
					<?php endif; ?>
					<li class="list-group-item">
						<?=anchor('admin/schAdmins', 'School Administrators');?>
					</li>
					<li class="list-group-item">
						<?=anchor('admin/scholarships', 'Scholarship(s)');?>
					</li>
					<li class="list-group-item">
						<?=anchor('admin/assign', 'Assign Courses To Instituition');?>
					</li>
					<li class="list-group-item">
						<?=anchor('admin/news', 'News');?>
					</li>
					<li class="list-group-item">
						<?=anchor('admin/faculties', 'Faculties');?>
					</li>
					<li class="list-group-item">
						<?=anchor('admin/instituition_types', 'Instituition Types');?>
					</li>
				</ul>
			</div>
			
			<div class="panel">
				<h4 class="panel-heading text-green m-t-00 m-b-00">Messages</h4>
				<ul class="list-group ">
				  	<li class="list-group-item">
				  		<?=anchor('messages/compose', 'compose');?>
				  	</li>
				  	<li class="list-group-item">
					    <a href="<?=base_url('messages/inbox');?>" >
						    inbox
						    <span ng-class="sidebar.inbox.length > 0 ? 'label pull-right label-info' : 'label pull-right label-danger'" ng-bind="sidebar.inbox.length"></span>
						</a>
					</li>
					<li class="list-group-item">
					    <a href="<?=base_url('messages/sent');?>">
						    sent messages
						    <span ng-class="sidebar.sent.length > 0 ? 'label pull-right label-info' : 'label pull-right label-danger'" ng-bind="sidebar.sent.length"></span>
						</a>
					</li>
					<li class="list-group-item">
					    <a href="<?=base_url('messages/saved');?>">
						    saved messages
						    <span ng-class="sidebar.saved.length > 0 ? 'label pull-right label-info' : 'label pull-right label-danger'" ng-bind="sidebar.saved.length"></span>
						</a>
					</li>
					<li class="list-group-item">
					    <a href="<?=base_url('messages/trash');?>">
						    trash
						    <span ng-class="sidebar.trash.length > 0 ? 'label pull-right label-info' : 'label pull-right label-danger'" ng-bind="sidebar.trash.length"></span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	