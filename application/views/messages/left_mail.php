<div class="container" ng-init="sidebar.load();">
	<div class="row m-t-20">
		<aside class="col-sm-3 p-l-00 p-r-05">
			
			<div class="panel">
				<h4 class="panel-heading text-green m-t-00 m-b-00">Messages</h4>
				<ul class="list-group ">
				  	<li class="list-group-item">
				  		<a href="<?=base_url('messages/compose');?>">
					    	compose
				    	</a>
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
			
			<div class="panel">
				<h4 class="panel-heading text-green m-t-00 m-b-00">Extras</h4>
				<ul class="list-group ">
				  	<li class="list-group-item">
				  		<a href="<?=base_url('users/myApplications');?>">
					    	my applications
					    	<span ng-class="sidebar.applications.length > 0 ? 'label pull-right label-info' : 'label pull-right label-danger'" ng-bind="sidebar.applications.length"></span>
				    	</a>
				  	</li>
				  	<li class="list-group-item">
					    <a href="<?=base_url('#');?>">
						    starred disciplines
						    <span ng-class="sidebar.disciplines.length > 0 ? 'label pull-right label-info': 'label pull-right label-danger'" ng-bind="sidebar.disciplines.length"></span>
						</a>
					</li>
					<li class="list-group-item">
					    <a href="<?=base_url('#');?>">
						    starred schools
						    <span ng-class="sidebar.schools.length > 0 ? 'label pull-right label-info' : 'label pull-right label-danger'" ng-bind="sidebar.schools.length"></span>
						</a>
					</li>
				</ul>
			</div>
		</aside>
