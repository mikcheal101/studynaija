<div class="container" style="margin-top: 60px; " ng-init="application.getCartItems();">
	<div class="row">
		<div class="container">
			<div class="col-sm-12 padding-00 father" style="visibility: hidden; height:0px;">
				
				<div class="col-sm-8 child" >
					<div class="sk-cube-grid innerChild">
					  	<div class="sk-cube sk-cube1"></div>
					  	<div class="sk-cube sk-cube2"></div>
					  	<div class="sk-cube sk-cube3"></div>
					  	<div class="sk-cube sk-cube4"></div>
					  	<div class="sk-cube sk-cube5"></div>
				  		<div class="sk-cube sk-cube6"></div>
				  		<div class="sk-cube sk-cube7"></div>
				  		<div class="sk-cube sk-cube8"></div>
						<div class="sk-cube sk-cube9"></div>
					</div>
				</div>
			</div>
			<div class="col-sm-8 panel padding-00 parent">
				<h4 class="text-purple panel-heading m-t-00 m-b-00">Payment Details</h4>
				<?=form_open('', array('class'=>'panel-body', 'name'=>'myForm'));?>

					<div class="col-sm-12 input-box">
						<label for="name" class="text-green">Card Holder's name:</label><br>
						<input class="font-13" required ng-model="application.payment.name" ng-disabled="!application.cartCount === 0"  name="name" value="" placeholder="Enter Name as it appears on card" autocomplete="off" />
						<div class="font-11 text-red" ng-show="!application.errors.name"><span ng-bind="application.errorText.name"></span></div>
					</div>
					<div class="col-sm-12 input-box m-t-10">
						<label for="email" class="text-green">Card Holder's Email Address:</label><br>
						<input class="font-13" required ng-model="application.payment.email" ng-disabled="!application.cartCount === 0" name="email" type="email" value="" placeholder="Enter a valid email address eg johndoe@mail.com" autocomplete="off"  />
						<div class="font-11 text-red" ng-show="!application.errors.email"><span ng-bind="application.errorText.email"></span></div>
					</div>
					<div class="col-sm-12 input-box m-t-10">
						<label for="tel" class="text-green">Card Holder's Mobile Number:</label><br>
						<input name="tel" required class="font-13" 
							ng-model="application.payment.tel" ng-disabled="!application.cartCount === 0" 
							type="tel"  
							placeholder="Enter valid mobile Number eg 00 234 902 111 1111" autocomplete="off"  />
							
					</div>
					<div class="col-sm-12 input-box m-t-10">
						<label for="address" class="text-green">Card Holder's Address:</label><br>
						<textarea class="font-13" required rows="4" ng-model="application.payment.address" name="address" ng-disabled="!application.cartCount === 0" type="tel" value="" placeholder="Enter Card Owner's Address" autocomplete="off"  ></textarea>
						<div class="font-11 text-red" ng-show="!application.errors.address"><span ng-bind="application.errorText.address"></span></div>
					</div>
					<div class="col-sm-12 btn-group m-t-10 p-r-00" >
						<span ng-disabled="application.cartCount === 0" ng-click="application.validatePayment();" class="btn btn-success btn-sm pull-right">
							<span class="fa fa-credit-card pull-left" style="line-height: 18px;"></span>  make payment
						</span>
					</div>
				</form>
			</div>
			
			
			<div class="col-sm-4 p-r-00 p-l-05">
				<div class="panel">
					
					<h4 class="panel-heading m-t-00 m-b-00">Order Summary</h4>
					
					<div class="panel-body">
						<p class="col-sm-12 padding-00 text-black"><span ng-bind="application.cartCount"></span> course(s) applied for</p>
						<div class="col-sm-12 padding-00 line-ash m-t-10"></div>
						
						<div class="col-sm-12 p-t-05 p-b-05 p-r-00 p-l-00" ng-style="$last && {'border-bottom':'1px solid #f3f3f3'} || !($last) && {'border-bottom':'1px dashed #f3f3f3'}" 
							ng-repeat="item in application.cartItems track by $index">
							<div class="col-sm-9 padding-00">
								<p class="font-14 text-orange"><span ng-bind="item.course_name"></span></p>
								<p class="font-12 text-purple"><span ng-bind="item.school_name"></span></p>
							</div>
							<div class="col-sm-3 padding-00">
								<h5 class="text-green font-15"><span ng-bind="100 | currency : '$ '"></span></h5>
							</div>
						</div>
						
						<div class="col-sm-12 p-t-05 p-b-05 p-r-00 p-l-00" style="border-bottom: 1px solid #f3f3f3;">
							<div class="col-sm-9 padding-00">
								<p class="font-14 text-orange m-t-10">Total:</p>
							</div>
							<div class="col-sm-3 padding-00">
								<h4 class="text-green font-15"><span ng-bind="(application.cartCount * 100) | currency : '$ '"></span></h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>