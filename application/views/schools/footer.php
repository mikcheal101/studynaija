		<div class="container p-t-10 p-r-10 p-l-10 p-b-10 m-t-10 background-white-complete full-width" 
			style="border-top: 1px solid #DEDEDE; position: relative; bottom: -10px;"> 
			
			<div class="row">
				<div class="col-sm-12">
					<div class="container-fluid no-border">
						<div class="row" >
							<div class="col-sm-12 p-l-10 p-t-05">
								<div class="col-sm-7 text-left p-l-00">
									<p>copyright &copy; <?=date('Y');?> studynaija.com. All rights reserved</p>
								</div>
								<div class="col-sm-5 text-right p-l-00">
									<p>customer support: <a href="mailto:support@studynaija.com">support@studynaija.com</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		
		<script src="<?=base_url('assets/js/jquery.js');?>"></script>
		<script src="<?=base_url('assets/js/bootstrap.3.0.2.min.js');?>"></script>>
		<script src="<?=base_url('assets/js/tether.min.js');?>"></script>
		<script src="<?=base_url('assets/js/bootstrap-notify.js');?>"></script>
		<script src="<?=base_url('assets/js/Date.js');?>"></script>
		
		<script src="<?=base_url('assets/js/angular.1.5.7.min.js');?>"></script>
		<script src="<?=base_url('assets/js/angular-animate.1.5.7.min.js');?>"></script>
		<script src="<?=base_url('assets/js/angular-sanitize.js');?>"></script>
		
	
		
		<!-- include summernote css/js-->
		<script src="<?=base_url('assets/js/tinymce.min.js');?>"></script>
		
		
		<script src="<?=base_url('assets/js/dirPagination.js');?>"></script>
		<script src="<?=base_url('assets/js/alert.js');?>"></script>
		<script src="<?=base_url('assets/js/truncate.js');?>"></script>
		
		<script src="<?=base_url('assets/js/ng-file-upload-all.min.js');?>"></script>
		<script src="<?=base_url('assets/js/ng-file-upload-shim.min.js');?>"></script>
		
		<script src="<?=base_url('assets/js/controllers/schoolController.js');?>"></script>
		<script src="<?=base_url('assets/js/controllers/school.Applications.Controller.js');?>"></script>
		<script src="<?=base_url('assets/js/controllers/school.News.Controller.js');?>"></script>
		<script src="<?=base_url('assets/js/controllers/school.Scholarships.Controller.js');?>"></script>
		
		
		<script src="<?=base_url('assets/js/controllers/messagesController.js');?>"></script>
		
		<script>
			/*
			$('.selectpicker').selectpicker({
		  		style: 'btn-default',
		  		size: 5,
			});
			*/
			tinymce.init({ selector:'.textarea' });
		</script>

	</body>
</html>