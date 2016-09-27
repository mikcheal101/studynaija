<?=form_open();?>
<div class="container">
	<div class="row m-t-05">
		<div class="col-sm-9 padding-00">
			
			<div class="col-sm-12 padding-00 background-white-complete border-ash m-b-05">
				<div class="col-sm-12">
					<h3 class="text-black"><?=$discipline->discipline_name;?></h3>
					<p class="text-green font-14"><?=$this->session->school->name;?></p>
				</div>
				
				<div class="col-sm-12">
					<div class="col-sm-3 p-l-00">
						<div class="input-group">
							<span class="input-group-addon"><?=NGN;?></span>
							<input type="number" name="local" id="local" class="form-control" 
								placeholder="tuition for local students" value="<?=set_value('local', ($discipline->local >0 ?  $discipline->local:''));?>"/>
							<span class="input-group-addon">.00</span>
						</div>
						<?=form_error("local", "<div class='text-red'>", "</div>");?>
					</div>
					<div class="col-sm-3 p-l-00">
						<div class="input-group">
							<span class="input-group-addon"><?=NGN;?></span>
							<input type="number" name="intl" id="intl" class="form-control" 
								placeholder="tuition for Int'l students" value="<?=set_value('intl', ($discipline->intl > 0 ? $discipline->intl:''));?>"/>
							<span class="input-group-addon">.00</span>
						</div>
						<?=form_error("intl", "<div class='text-red'>", "</div>");?>
					</div>
					<div class="col-sm-2 p-l-00">
						<div class="input-group">
							<input type="text" name="duration" id="duration" class="form-control" 
								placeholder="duration" value="<?=set_value('duration', $discipline->duration);?>"/>
							<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
						</div>
						<?=form_error("duration", "<div class='text-red'>", "</div>");?>
					</div>
					<div class="col-sm-2 padding-00">
						<?=form_multiselect('variant', $variants, $discipline->variant, array('class'=>'form-control'));?>
						<?=form_error("variant", "<div class='text-red'>", "</div>");?>
					</div>
					<div class="col-sm-2 padding-00">
						<?=form_multiselect('delivery_mode', $delivery_modes, $discipline->delivery_mode, array('class'=>'form-control'));?>
						<?=form_error("delivery_mode", "<div class='text-red'>", "</div>");?>
					</div>
				</div>
				
				<div class="col-sm-12">
					<h5 class="text-black">Description</h5>
					<textarea id="description" name="description" class="border-ash summernote"><?=base64_decode($discipline->description);?></textarea>
					<?=form_error("description", "<div class='text-red'>", "</div>");?>
				</div>
			</div>
			
			<div class="col-sm-12 padding-10 background-white-complete border-ash m-b-05">
				<h4 class="text-green m-t-00 m-b-05">Details</h4>
				<h5 class="text-black">Course Content</h5>
				<textarea id="content" name="content" class="border-ash summernote"><?=base64_decode($discipline->content);?></textarea>
				<?=form_error("content", "<div class='text-red'>", "</div>");?>
			</div>
			
			<div class="col-sm-12 padding-10 background-white-complete border-ash m-b-05">
				<h4 class="text-green m-t-00 m-b-05">Requirements</h4>
				<h5 class="text-black">Admission Requirements</h5>
				<textarea id="adm_experience" name="adm_experience" class="border-ash summernote"><?=base64_decode($discipline->adm_experience);?></textarea>
				<?=form_error("adm_experience", "<div class='text-red'>", "</div>");?>
				
				<h5 class="text-black">Work Experience Requirements</h5>
				<textarea id="work_experience" name="work_experience" class="border-ash summernote"><?=base64_decode($discipline->work_experience);?></textarea>
				<?=form_error("work_experience", "<div class='text-red'>", "</div>");?>
			</div>
			
			<div class="col-sm-12 padding-00 text-right">
				<button class="btn btn-sm btn-success" type="submit" id="submitBtn" name="save">update course details</button>
			</div>
			
		</div>
		
<?=form_close();?>
<script type="text/javascript">
	<?php if(isset($_SESSION['updated'])): $flash = $this->session->flashdata('updated');?>
		goodAlert ('<?=$flash['title'];?>', '<?=$flash['message'];?>');
	<?php endif;?>
</script>