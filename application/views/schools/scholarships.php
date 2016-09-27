<div class="container" ng-init="scholarships.getScholarships();">
	<div class="row m-t-05">
		<div class="col-sm-9 padding-00">
			<div class="col-sm-12 background-white-complete border-ash m-b-05 p-b-10">
				<h3 class="text-black m-b-10 col-sm-12 padding-00">Scholarships</h3>
				<form name="myForm">
				<div class="col-sm-12 padding-00">
					<fieldset class="m-b-20 col-sm-12 p-l-00">
						<legend class="font-14 m-b-00 no-border text-blue">Scholarship Name / Title : <span class="text-red bold">*</span></legend>
						<input type="text" class="form-control no-padding"  ng-model="scholarships.name"  ng-required="true"
						style="box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;" 
						name="" placeholder="enter Scholarship Name / Title" value="" />
					</fieldset>
					<fieldset class="m-b-05 col-sm-12 p-l-00">
						<legend class="font-14 m-b-05 no-border text-blue">Scholarship Details : <span class="text-red bold">*</span></legend>
						<div id="" class="border-ash summernote"></div>
					</fieldset>
				</div>
				
				<div class="col-sm-12 text-right">
					<button ng-if="scholarships.saving" class="btn btn-sm btn-success" ng-click="myForm.$valid && scholarships.saveScholarships();">save</button>
					<button ng-if="scholarships.delete" class="btn btn-sm btn-danger" ng-click="myForm.$valid && scholarships.deleteScholarships();">delete</button>
					<button ng-if="scholarships.updating" class="btn btn-sm btn-info" ng-click="myForm.$valid && scholarships.updateScholarships();">update</button>
				</div>
				</form>
			</div>
			
			<!-- all the scholarships below -->
			
			<div class="col-sm-12 background-white-complete border-ash p-t-20 p-b-10 p-r-30 p-l-30">

				<div class="col-sm-12 padding-00 p-b-10 m-b-10"
					ng-click="scholarships.getSingleScholarship(scholarship);" 
					dir-paginate="scholarship in scholarships.scholarshipsItems.slice().reverse() | itemsPerPage: 5" 
					style="border-bottom: 1px solid #f9f9f9;">

						<p class="text-green font-14">{{scholarship.name | uppercase}}</p>
						<p class="text-justify text-black font-12" ng-bind-html="scholarship.abbr"></p>
				</div>
				
			</div>
			<!-- pagination -->
			<dir-pagination-controls></dir-pagination-controls>
		</div>