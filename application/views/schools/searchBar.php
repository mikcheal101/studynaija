<div id="searchPage">
	<div class="container" style="margin-top: 55px; height: 55px;">
		<div class="row full-height">
			<div class="col-sm-12 full-height p-t-10 p-l-10 p-r-10" style="background-color: #fbfbfb; border: 1px solid #dedede;" >
				<div class="col-sm-4">
					<p>
						<span class="bold green">We are here</span><br>
						<?php 
							$last = count($positions) - 1;
							$counter = 0;
							$string = "";
							foreach($positions as $position) {
								$position = urldecode($position);
								if ($counter == $last) {
									$position = mb_strimwidth($position, 0, 80, "...");
									$string.= "<u style='color: #000;'>{$position}</u>";			
								} else {
									$counter++;
									$string.= "{$position} <img src='".base_url('assets/images/icons/right-arrow.svg')."' style='height:10px;' /> &nbsp;&nbsp;";
								}
							}
							
							echo $string;
						?>
					</p>
				</div>
				
				<div class="col-sm-7">
					<div class=" input-group">
						<input class="form-control searchBar" ng-model="searchBar" type="text" placeholder="Search for courses here..." aria-describedby="searchBtn" />
						<a class="input-group-addon searchBtn" ng-click="search();" id="searchBtn" style="text-decoration: none;">
							<i class="fa fa-search "></i> search
						</a>
					</div>
				</div>
				
				<?php if($this->session->user !== NULL): ?>
				<div class="col-sm-1">
					<a class="col-sm-12 text-right padding-00" href="<?=base_url('users/signOut');?>">
						<span style="font-size: 14px; font-weight: bolder;">SignOut</span><br>
						<span>Account</span>
					</a>
				</div>
				<?php endif;?>
			</div>		
		</div>
	</div>