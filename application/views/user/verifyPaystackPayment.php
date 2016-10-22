<div class="container" style="margin-top: 60px; " ng-init="application.verifiyPayment();">
	<div class="row">
		<div class="container">
			<div class="col-sm-8 padding-00">
				<div class="panel panel-success">
				
					<h4 class="panel-heading m-t-00">Payment Verification</h4>
					
					<div class="panel-body">

						<p class="p-b-10 text-black " style="font-size: 17px!important; " ng-style="(($index % 2 === 0) && {'font-weight':'bolder'} && {'color':'green'}) || (($index % 2 !== 0) && {'font-size':'17px'})" 
							ng-repeat="status in application.verificationText track by $index">
							<span ng-bind-html="status"></span>
						</p>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>