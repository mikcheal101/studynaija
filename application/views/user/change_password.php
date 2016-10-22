<div class="container">
	<div class="row m-b-00 m-t-10">
		<div class="col-sm-6 col-sm-offset-3 border-ash p-b-40 p-t-10 background-white-complete">
			<div class="col-sm-12">
				<h3>Request Password Change from ngschools</h3>
			</div>
			<div class="col-sm-12 m-b-20">
				<span>Enter your old password and new password to reset your password.</span>
			</div>
			<div class="col-sm-12"></div>
			<div class="col-sm-12 p-l-00 p-r-00">
				<?=form_open('', array('class'=>'form'));?>
					<div class="col-sm-12 m-b-15">
						<div class="input-group">
							<input class="form-control" name="password"  type="password" placeholder="enter password" aria-describedby="searchBtn" />
							<span class="input-group-addon" ><i class="fa fa-lock"></i></span>
						</div>
					</div>
					
					<div class="col-sm-12 m-b-25">
						<div class="input-group">
							<input class="form-control" name="repassword" type="password" placeholder="enter new password" aria-describedby="searchBtn" />
							<span class="input-group-addon" ><i class="fa fa-key"></i></span>
						</div>
					</div>
					
					<div class="col-sm-12 m-b-10">
						<button class="btn btn-success btn-block">Request Password</button>
					</div>
					
					<div class="col-sm-12 right text-right">
						<p class="p-r-20">Already have an account? <a  href="<?=base_url('');?>" >Sign In</a></p>
					</div> 
					
					<div class="col-sm-12 m-t-25">
						<div class=" line-ash"></div>
					</div>
					
					<div class="col-sm-12">
						<div class="btn-block text-right">
							<button class="btn btn-sm btn-default" id="fb"><i class="fa fa-facebook"></i></button>
							<button class="btn btn-sm btn-default" id="fb"><i class="fa fa-twitter"></i></button>
							<button class="btn btn-sm btn-default" id="fb"><i class="fa fa-google-plus"></i></button>
							<button class="btn btn-sm btn-default" id="fb"><i class="fa fa-linkedin"></i></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>