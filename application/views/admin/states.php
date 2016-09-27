<div class="container">
	<div class="row">
		<div class="col-sm-12 padding-00">
			<div class="col-sm-3">
				<!-- ads -->
			</div>
			
			<?=form_open('', array('class'=>'form'));?>
			<div class="col-sm-9 padding-20 p-r-00 m-t-05 border-ash background-white-complete">
				<div class="padding-00 col-sm-12">
					<fieldset class="m-b-05 m-t-05 col-sm-4 p-l-00">
						<legend class="font-14 m-b-00 no-border text-blue">State Name : <span class="text-red bold">*</span></legend>
						<input type="text" class="form-control no-padding" 
						style="box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;" 
						name="" placeholder="enter the subject" value="" />
					</fieldset>
					<fieldset class="m-b-05 m-t-05 col-sm-4 p-l-00">
						<legend class="font-14 m-b-00 no-border text-blue">State Slogan : <span class="text-red bold">*</span></legend>
						<input type="password" class="form-control no-padding" 
						style="box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;" 
						name="" placeholder="enter the subject" value="" />
					</fieldset>	
					<fieldset class="m-b-05 m-t-05 col-sm-4 p-l-00">
						<legend class="font-14 m-b-00 no-border text-blue">State Emblem : </legend>
						<input type="file" class="form-control no-padding" 
						style="box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;" 
						name="" placeholder="Select the emblem" value="" />
					</fieldset>
				</div>
				
				<div class="padding-00 col-sm-12">
					<fieldset class="m-b-05 m-t-05 col-sm-12 p-l-00">
						<legend class="font-14 m-b-00 no-border text-blue">Passsword : <span class="text-red bold">*</span></legend>
						<div class="summernote"></div>
					</fieldset>	
				</div>
				
				<div class=" col-sm-12 text-right">
					<input class="btn btn-sm btn-success" value="save" id="statesSaveBtn"  />	
				</div>
			</div>
			<?=form_close();?>
		</div>
	</div>
</div>