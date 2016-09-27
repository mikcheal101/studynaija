<style>
	div.note-editor {
		margin-bottom: 10px!important;
	}
</style>
		<div class="col-sm-10 p-r-00" ng-controller="messagesController">
			<div class="col-sm-12 m-b-05 padding-00">
				
				<div class="panel">
					<h5 class="m-t-00 m-b-00 panel-heading">Compose</h5>
					<div class="panel-body">
						<div class="col-sm-12 p-l-00 p-r-00">
							<div class="col-sm-12 input-box m-b-10">
								<label for="to" class="text-green">To:</label><br>
								<select class="form-control select selectpicker" id="search_select" multiple 
									ng-model="currentMessage.to" 
									ng-options="option.username for option in myRecipients track by option.id"></select>
							</div>
							<div class="col-sm-12 input-box m-b-10">
								<label for="subject" class="text-green">Subject:</label><br>
								<input class="font-13" type="text" placeholder="enter subject" ng-model="currentMessage.sub"/>
								<div class="font-11 text-red"><?=form_error('subject');?></div>
							</div>
						</div>
						
						<div class="col-sm-12 padding-00 m-b-10"> 
							<div id="" class="border-ash summernote"></div>
						</div>
						
						<div class=" col-sm-12 padding-00 text-right">
							<span class="btn btn-sm btn-success" ng-click="sendMessage ();">send</span>
							<span class="btn btn-sm btn-default" ng-click="saveMessage ();">save</span>
						</div>
							
					</div>	
				</div>
				
				
					
				</div>
				
			</div>
			
			<div class="col-sm-12 m-b-00 padding-00">
				
			</div>
			
			
		</div>
		
	</div>
</div>