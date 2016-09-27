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
		<script src="<?=base_url('assets/js/bootstrap.3.0.2.min.js');?>"></script>

		<script src="<?=base_url('assets/js/tether.min.js');?>"></script>
		<script src="<?=base_url('assets/js/bootstrap-notify.js');?>"></script>
		
		<script src="<?=base_url('assets/js/Date.js');?>"></script>
		
		<script src="<?=base_url('assets/js/angular.1.5.7.min.js');?>"></script>
		<script src="<?=base_url('assets/js/angular-animate.1.5.7.min.js');?>"></script>
		
		<script src="<?=base_url('assets/js/angular-sanitize.js');?>"></script>
		<script src="<?=base_url('assets/js/bootstrap-multiselect.js');?>"></script>
		<script src="<?=base_url('assets/js/jquery.parseparams.js');?>"></script>
		

		<!-- include summernote css/js-->
		<script src="<?=base_url('assets/js/tinymce.min.js');?>"></script>
		<script src="<?=base_url('assets/js/dirPagination.js');?>"></script>
		<script src="<?=base_url('assets/js/alert.js');?>"></script>
		<script src="<?=base_url('assets/js/directives/checklist-model.js');?>"></script>
		
		<script src="<?=base_url('assets/js/money.min.js');?>"></script>
		
		<script src="<?=base_url('assets/js/bootcards.1.0.0.min.js');?>"></script>
		<script src="<?=base_url('assets/js/controllers/applicantController.js');?>"></script>
		<script src="<?=base_url('assets/js/controllers/generalController.js');?>"></script>
		
		<script>
			/*
			$('.selectpicker').selectpicker({
		  		style: 'btn-default',
		  		size: 5,
			});
			*/
			
			$(document).ready(function() {
		        $('.multiselect').multiselect();
		    });
		    
		    var _parent = $('.parent');
		    var _child 	= $('.child');
		    var _innerChild	= $('.innerChild');
		    
		    _child.css({"position":'absolute', 'z-index':'2', 'height':_parent.height(), 'width':_parent.width(), 'background-color':'rgba(255, 255, 255, 0.9)'});
		   _innerChild.css({'position':'relative', 'top':'25%'});
		   
		   $(function() {
				$('#passportid').css({'visibility': 'hidden', 'height':'0px'});
				console.log()
			});
			
			$('.passportFile').change(function () {
				// file has changed
				var file = $(this).val();
				if (file) {
					$('#passportid').css({'visibility': 'visible', 'height':'20px'});
				} else {
					$('#passportid').css({'visibility': 'hidden', 'height':'0px'});
				}
				readURL(this);
			});
			
			function readURL(input) {
			    if (input.files && input.files[0]) {
			        var reader = new FileReader();
			        reader.onload = function (e) {
			            $('.passport').attr('src', e.target.result);
			        }
			        reader.readAsDataURL(input.files[0]);
			    }
			}
		</script>

	</body>
</html>