<div class="container-fluid no-border p-t-10">
	<div class="row-fluid">
		<div class="col-sm-2 hidden-xs p-r-10 p-l-05">
			<div class="panel m-t-00 m-b-10">
				<ul class="list-group">
					<li class="list-group-item">
						<?=anchor('messages/compose', 'compose');?>
					</li>
					<li class="list-group-item">
						<?=anchor('messages/inbox', 'inbox');?>
						<span class="label label-info pull-right" >0</span>
					</li>
					<li class="list-group-item">
						<?=anchor('messages/sent', 'sent');?>
						<span class="label label-info pull-right" >0</span>
					</li>
					<li class="list-group-item">
						<?=anchor('messages/saved', 'drafts');?>
						<span class="label label-info pull-right" >0</span>
					</li>
					<li class="list-group-item">
						<?=anchor('messages/trash', 'trash');?>
						<span class="label label-info pull-right" >0</span>
					</li>
				</ul>
			</div>
			
			<div class="panel m-t-05">
				<ul class="list-group">
					<li class="list-group-item">
						<?=anchor('#', 'welcome note');?>
					</li>
					<li class="list-group-item">
						<?=anchor('#', 'instituition\'s staff');?>
					</li>
					<li class="list-group-item">
						<?=anchor('#', 'accounting / payments');?>
						<span class="label label-info pull-right" >0</span>
					</li>
				</ul>
			</div>
		</div>