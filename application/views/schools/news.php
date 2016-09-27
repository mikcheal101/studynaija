		<div class="col-sm-10 p-r-00 p-l-05" ng-controller="schoolCntrl.news" ng-init="loadNews ();">
			<div class="col-sm-6 p-l-00 p-r-05">
				<form name="form" novalidate>
					<div class="panel m-b-05">
						<div class="panel-body">
							<div class="col-sm-12 input-box m-b-10">
								<label for="name" class="text-green">Subject:</label><br>
								<input class="font-13" required name="subject" type="text" placeholder="enter the discipline" 
									ng-model="newsDetails.subject" />
								<div ng-show="form.$submitted">
									<small class="text-red" ng-show="form.subject.$error.required">enter a subject!</small>
									<small class="text-red" ng-show="form.subject.$error.minLenght < 2">enter a subject!</small>
								</div>
							</div>
							
							<div class="col-sm-12 input-box m-b-10">
								<label for="name" class="text-green">
									Resources : 
									<small class="font-12 text-info">images, videos etc not more than 10MB in size</small>
								</label><br>
								<span class="btn btn-sm btn-default" ngf-max-total-size="10MB" 
									ngf-select="newsuploadImage ($files);" multiple
									ng-model="newsDetails.files" accept="image/*">
									<i class="fa fa-camera text-info"></i>
									<span class="text-600 font-12 text-info"> &nbsp; select photo</span>
								</span>
								<div class="flex" ng-show="newsDetails.files.length > 0" style="overflow-x:auto;">
									<img ngf-thumbnail="img" ng-repeat="img in newsDetails.files track by $index"
										class=" m-t-10 padding-05 img-responsive img-fluid img-rounded" 
										style="height:100px; width:100px;"/>
								</div>
							</div>
							
							<div class="col-sm-12 input-box m-b-10">
								<label for="name" class="text-green">Details:</label><br>
								<textarea rows="10" class="font-13" name="details" placeholder="enter news details" ng-model="newsDetails.details">
								</textarea>
							</div>
							
							<div class="btn-group">
								<button class="btn btn-default" ng-click="commitNews (form);" type="submit">
									commit change(s)
								</button>
								<span class="btn btn-danger" ng-click="clearNews ();">
									clear
								</span>
								
							</div>
							
						</div>
					</div>
				</form>
			</div>
			
			<div class="col-sm-6 p-l-00 p-r-05">				
				<div class="panel m-b-05">
					<div class="panel-body">
					{{news}}
						<div class="col-sm-12 input-box m-b-10">
							<input class="font-13" placeholder="news search..." 
								ng-model="newsSearch" />
						</div>
						<div class="col-sm-12 padding-00">
							<ul class="list-group">
								<li class="list-group-item" dir-paginate="n in news | filter:newsSearch | itemsPerPage : 50" >
									<div class="pull-right">
										<p class=" font-12 text-ash-01" ng-bind="n.date | myDate | date : 'd , yyyy. h:mm a'"></p>
										<p class="text-danger fa fa-trash pull-right m-t-10" ng-click="dropNews ($index);"></p>
									</div>
									
									<h4 ng-click="editNews ($index);">
										<p class="text-600" ng-bind="n.subject"></p>
										<small ng-bind-html="n.details"></small>
										
									</h4>
									<div class="flex" ng-show="n.resources.length > 0" style="overflow-x:auto;">
										<img ng-src="<?=base_url();?>/{{img.resource}}" ng-repeat="img in n.resources track by $index"
											class=" m-t-10 padding-05 img-responsive img-fluid img-rounded" 
											style="height:50px; width:50px;"/>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>