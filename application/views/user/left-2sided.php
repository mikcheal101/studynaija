<div class="container" >
	<div class="row">
		<aside class="col-sm-3 background-white-complete m-t-05" style="border:1px solid #dedede!important;">
			<div class="row p-b-10" style="border-bottom: 1px solid #dedede;">
				<div class="col-sm-12">
					<h4 class="text-purple">Degree Awards</h4>
					<p ng-repeat="award in search.degree_awards">
						<span class="">
							<input class="m-r-10" type="checkbox" checklist-model="search.selected_opts.degree_award" checklist-value="award.id" />
							<span class="">{{award.name}}</span> 
							<!-- <small class="text-ash-01">({{award.count}})</small> -->
						</span>
					</p>
				</div>
			</div>
			
			<div class="row p-b-10" style="border-bottom: 1px solid #dedede;">
				<div class="col-sm-12">
					
					<h4 class="text-purple">Discipline</h4>
					{{search.selected_faculties}}
					<p ng-repeat="faculty in search.faculties" class="p-b-10">
						<input type="checkbox" class="form-input m-r-10" checklist-model="search.selected_opts.faculties" checklist-value="faculty.id" />  <span class="text-black">{{faculty.name}}</span>
					</p>
					
				</div>
			</div>
			
			<div class="row p-b-10" style="border-bottom: 1px solid #dedede;">
				<div class="col-sm-12">
					<h4 class="text-purple">Location</h4>
					<select class="form-control m-t-15 m-b-20 multiselect" multiple="multiple" ng-model="search.states.select" >
						<?php foreach($all_states as $state):?>
						<option value="<?=$state->id;?>"><?=$state->name;?></option>
						<?php endforeach;?>
					</select>

				</div>
			</div>
			
			<div class="row p-b-10" style="border-bottom: 1px solid #dedede;">
				<div class="col-sm-12 m-b-05">
					<h4 class="text-purple">Duration</h4>
					<p ng-repeat="duration in search.duration">
						<input type="checkbox" class="form-input m-r-10" checklist-model="search.selected_opts.duration" checklist-value="duration.id" name="" value="{{duration.id}}" ng-model="duration.checked" />  <span class="text-black">{{duration.name}}</span>
					</p>
				</div>
			</div>
			
			<div class="row" style="border-bottom: 1px solid #dedede;" >
				<div class="col-sm-12 m-b-15">
					<h4 class="text-purple">Study Type</h4>
					<p ng-repeat="variant in search.variants">
						<input type="checkbox" class="form-input m-r-10" checklist-model="search.selected_opts.variants" checklist-value="variant.id" ng-model="variant.checked" />  <span class="text-black">{{variant.name}}</span>
					</p>
				</div>
			</div>
			
			<div class="row p-b-20">
				<div class="col-sm-12">
					<h4 class="text-purple">Pricing ($ / <?=NGN;?>)</h4>
					<div class="row p-b-10 p-r-05 p-l-05">
						<div class="col-sm-12 p-l-10">
							<fieldset class="m-b-10 col-sm-12 p-l-00">
								<legend class="font-14 m-b-00 no-border text-blue col-sm-4 padding-00">Minimum:</legend>
								<input type="number" class="form-control no-padding col-sm-8" 
									ng-model="search.pricing.minimum.value"
									style="box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;" 
									name="" placeholder="enter the minimum amount" value="" />
							</fieldset>
							<fieldset class="m-t-05 m-b-05 col-sm-12 p-l-00">
								<legend class="font-14 m-b-00 no-border text-blue col-sm-4 padding-00">Maximum:</legend>
								<input type="number" class="form-control no-padding col-sm-8" 
									ng-model="search.pricing.maximum.value"
									style="box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;" 
									name="" placeholder="enter the maximum amount" value="" />
							</fieldset>
						</div>
					</div>
					
					<div class="row p-b-10">
						<div class="col-sm-4 p-t-05">Per: </div>
						<div class=" col-sm-8 p-l-00">
							<div class="p-b-05">
								<input type="radio" class="appliesTo m-r-05" ng-model="search.pricing.per.value" value="1" /> Annum 
							</div>
							<div class="p-b-05">
								<input type="radio" class="appliesTo m-r-05" ng-model="search.pricing.per.value" value="2" /> Semester 
							</div>
						</div>		
					</div>
					
					<div class="row form-inline">
						<div class="col-sm-4 p-t-05">Apllies to: </div>
						<div class=" col-sm-8 p-l-00">
							<div class="p-b-05">
								<input type="radio" class="appliesTo m-r-05" value="1" ng-model="search.pricing.applies.value"/>International Students
							</div>
							<div>
								<input type="radio" class="appliesTo m-r-05" value="2" ng-model="search.pricing.applies.value"/>Nigerian Students
							</div>
						</div>	
					</div>
					
				</div>
			</div>
			
		</aside>
		