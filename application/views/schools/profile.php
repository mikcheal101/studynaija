<div class="container">
	<div class="row m-t-05">
		<div class="col-sm-12 padding-00">
			<div class="col-sm-3">
				<!-- ads -->
			</div>
			
			<div class="col-sm-9 padding-00">
				<?=form_open_multipart('', array('class'=>'form', 'name'=>'myForm'));?>
				
					<div class="col-sm-12 panel panel-success padding-00 parent">
						<div class="col-sm-12 panel-heading text-green ">
							<h4 class="col-xs-11 m-b-00 m-t-05">Basic Information</h4>
						</div>
						
						
						<div class="panel-body" id="basicinfo">
						
							<div class="col-sm-12 input-box m-t-10">
								<label for="name" class="text-green">University Name : <span class="text-red bold">*</span></label><br>
								<input class="font-13" required placeholder="enter University Name" name="name" value="<?=$school->name;?>" autocomplete="off" />
								<div class="font-11 text-red" ><?=form_error('name');?></div>
							</div>
							
							<div class="col-sm-12 input-box m-t-10">
								<label for="name" class="text-green">Year of Establishment : <span class="text-red bold">*</span></label><br>
								<input class="font-13" required placeholder="enter Year of Establishment" name="year" type="date" value="<?=date('Y-m-d', strtotime($school->year_of_est));?>" autocomplete="off" />
								<div class="font-11 text-red" ><?=form_error('year');?></div>
							</div>
							
							<div class="col-sm-12 input-box m-t-10">
								<label for="name" class="text-green">Official Website (url) : <span class="text-red bold">*</span></label><br>
								<input class="font-13" required placeholder="enter Official Website (url)" name="url" value="<?=$school->url;?>" type="url" autocomplete="off" />
								<div class="font-11 text-red" ><?=form_error('url');?></div>
							</div>
							
							<div class="col-sm-12 input-box m-t-10">
								<label for="name" class="text-green">Official Emblem : <span class="text-red bold">*</span></label><br>
								<input class="font-13"  placeholder="select Official Emblem" type="file" name="emblem" value="<?=$school->logo;?>" autocomplete="off" />
								<div class="font-11 text-red" ><?=form_error('emblem');?></div>
							</div>
							
							<div class="col-sm-12 input-box m-t-10">
								<label for="name" class="text-green">Cover Photo : <span class="text-red bold">*</span></label><br>
								<input class="font-13" placeholder="enter cover photo url" type="file" name="cover" value="<?=$school->logo;?>" type="url" autocomplete="off" />
								<div class="font-11 text-red" ><?=form_error('cover');?></div>
							</div>
							
							<div class="col-sm-12 input-box m-t-10">
								<label for="name" class="text-green">Official Email Address : <span class="text-red bold">*</span></label><br>
								<input class="font-13" required placeholder="enter Official Email Address" name="email" value="<?=$school->email;?>" type="email" autocomplete="off" />
								<div class="font-11 text-red" ><?=form_error('email');?></div>
							</div>
							
							<div class="col-sm-12 input-box m-t-10">
								<label for="name" class="text-green">state : <span class="text-red bold">*</span></label><br>
								<select name="state" class="selectpicker show-tick" data-live-search="true" data-width="auto">
									<?php foreach($states as $state):?>
										<option value="<?=$state->id;?>" <?=($state->id === $school->state)? "selected":"";?>><?=$state->name;?></option>
									<?php endforeach;?>
								</select>
								<div class="font-11 text-red" ><?=form_error('state');?></div>
							</div>
							
							<div class="col-sm-12 input-box m-t-10">
								<label for="name" class="text-green">Official Address : <span class="text-red bold">*</span></label><br>
								<textarea class="font-13 textarea" required placeholder="enter Official Address" name="address" value="" rows="2" ><?=base64_decode($school->address);?></textarea>
								<div class="font-11 text-red" ><?=form_error('address');?></div>
							</div>
							
							<div class="col-sm-12 input-box m-t-10">
								<label for="name" class="text-green">Instituition History : <span class="text-red bold">*</span></label><br>
								<textarea class="font-13 textarea" placeholder="enter History" name="history" value="" rows="2" ><?=base64_decode($school->history);?></textarea>
								<div class="font-11 text-red" ><?=form_error('history');?></div>
							</div>
						</div>
					</div>
					
										
					<style>
						.active {
							background-color: #5bc0de!important;
							border:color: #46b8da!important;
							color: #fff!important;
						}
					</style>
					<div class="col-sm-12 panel panel-success padding-00 parent">
					
						<div class="col-sm-12 panel-heading text-green ">
							<h4 class="col-xs-11 m-b-00 m-t-05">Semesters</h4>
						</div>
						
						
						<div class="panel-body" id="semesters">
						
							<div class="col-sm-12 input-box m-t-10">
								<label for="name" class="text-green">Admission Semesters:</label><br>
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-default active font-13"  style="max-height: 32px;">
								    	<input type="radio" name="options" id="option1" autocomplete="off" checked /> First Semester
								  	</label>
								  	<label class="btn btn-default font-13" style="max-height: 32px;">
									    <input type="radio" name="options" id="option2" autocomplete="off" /> Second Semester
								  	</label>
								</div>
								<div class="font-11 text-red" ng-show="!application.errors.name"><span ng-bind="application.errorText.name"></span></div>
							</div>
						</div>
					</div>
					
					<div class="col-sm-12 padding-00 text-right">
						<input type="submit" class="btn btn-sm btn-success" value="save profile details" />
					</div>
				<?=form_close();?>
			</div>
		</div>
	</div>
</div>