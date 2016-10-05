<div class="container search-bar" style="">
	<div class="row full-height">
		<div class="col-sm-12 full-height p-t-10 p-l-10 p-r-10 no-scroll" style="background-color: #fbfbfb; border: 1px solid #dedede;" >
			<div class="col-md-4 col-sm-4 m-b-05 p-l-00 p-r-00">
				<ol class="breadcrumb success">

				<?php 
					foreach($positions as $position) {
						$position 	= urldecode($position);
						$string 	= explode(':', $position);
						$url 		= $string[1] ?? '#';
						$position = mb_strimwidth($string[0], 0, 20, "...");
						echo '<li><a href="'.$url.'">'.strtolower ($position).'</a></li>';
					}
				?>
				</ol>
			</div>
			<?php
				$valid = false; 
				if ($this->session->user !== null)  
					if ($this->session->user->usertype === APPLICANT) 
						$valid = true;
			?>
			<div class="<?=(($valid)? 'col-md-6 col-sm-5':'col-md-8  col-sm-8');?>">
				<?=form_open('users/searchResults', array('method'=>'get'));?>
				<div class=" input-group">
					<input class="form-control font-12" ng-model="search.searchBar" type="text" placeholder="Search for courses and schools here..." aria-describedby="searchBtn" 
						value="<?php if(isset($search))echo urldecode($search);?>" name="searchbar" ng-change="search.reset();" />
					<span class="input-group-addon btn btn-white background-white-complete" style="background-color: #FFF;">
						<button class="glyphicon glyphicon-search" style="color: #607D8B; background-color: rgba(0, 0, 0, 0)!important; border:none!important;"></button>
					</span>
					
				</div>
				<?=form_close();?>
			</div>
			<?php if($valid): ?>
			<div class="col-md-2 col-sm-3">
				<a class="col-sm-6 col-xs-6 text-right" href="<?=base_url('users/myApplications');?>" >
					<span style="font-size: 14px; font-weight: bolder;">My</span><br>
					<div style="margin-left: -10px;">Applications</div>
				</a>
				
				<a class="col-sm-6 col-xs-6 text-left" href="<?=base_url('users/signOut');?>" style="border-left: 1px solid #dedede;">
					<span style="font-size: 14px; font-weight: bolder;">SignOut</span><br>
					<span>Account</span>
				</a>
			</div>
			<?php endif;?>
		</div>		
	</div>
</div>