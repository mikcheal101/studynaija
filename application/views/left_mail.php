<div class="container">
	<div class="row m-t-05">
		<aside class="col-sm-3 p-l-00 p-r-05">
			<div class="col-sm-12 m-b-05 border-ash background-white-complete padding-10">
				<h4 class="text-green m-t-00 m-b-10">Messages</h4>
				<ul style="list-style: none!important;" class="p-l-00">
					<li style="border-bottom: 1px solid #F9F9F9;" class="p-l-05 p-b-05 p-t-05">
						<i class="fa fa-pencil text-purple"> </i> &nbsp; &nbsp;
						<a href="<?=base_url($msg_usr.'/compose');?>" class="m-b-10">Compose </a>	
					</li>
					<li style="border-bottom: 1px solid #F9F9F9;" class="p-l-05 p-b-10 p-t-10">
						<i class="fa fa-inbox text-purple"> </i> &nbsp; &nbsp;
						<a href="<?=base_url($msg_usr.'/inbox');?>" class="m-b-10">Inbox <small class="text-green bold" style="float:right;">100</small></a>	
					</li>
					<li style="border-bottom: 1px solid #F9F9F9!important;" class="p-l-05 p-b-10 p-t-10">
						<i class="fa fa-paper-plane text-purple"> </i> &nbsp; &nbsp;
						<a href="<?=base_url($msg_usr.'/outbox');?>">Outbox <small class="text-green bold" style="float:right;">100</small></a>	
					</li>
					<li style="border-bottom: 1px solid #F9F9F9!important;" class="p-l-05 p-b-10 p-t-10">
						<i class="fa fa-floppy-o text-purple"> </i> &nbsp; &nbsp;
						<a href="<?=base_url($msg_usr.'/saved');?>">Drafts <small class="text-green bold" style="float:right;">100</small></a>	
					</li>
					<li style="" class="p-l-05 p-b-00 p-t-10">
						<i class="fa fa-trash text-purple"> </i> &nbsp; &nbsp;
						<a href="<?=base_url($msg_usr.'/trash');?>">Trash <small class="text-green bold" style="float:right;">100</small></a>	
					</li>
				</ul>
				
			</div>
			
			<div class="col-sm-12 m-b-05 border-ash background-white-complete padding-10">
				<!-- Ads -->
				
			</div>
		</aside>
