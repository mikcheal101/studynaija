<div class="container">
	<div class="row">
		<?php 
			$i=1; 
			foreach ($all_states as $state) {
				$link = str_replace(',', '_', $state->name);
				$link = str_replace(' ', '_', $link);
				$link = strtolower($link);
		?>
		
		<a name="<?="$link";?>"></a>
		<div class="col-sm-6 <?=($i % 2 !== 0)? "p-l-00 p-r-05":"p-r-00 p-l-05";?>">
			<div class="col-sm-12 background-white-complete p-b-10 m-b-05 m-t-05 " style="border:1px solid #DEDEDE;">
				<div class="col-sm-12 p-b-10 p-l-00 p-r-00">
					<div class="col-md-12 padding-00">
						<h3 class="m-b-00 text-blue"><?=$state->name;?></h3>
						<span class="text-black m-t-05 font-12 text-ash-01"><?=$state->slogan;?></span>
					</div>
				</div>
				
				<div class="col-sm-12 padding-00">
					<p class="text-black">
						<?=base64_decode($state->description);?>
					</p>
				</div>
				
				<div class="col-sm-12 text-right padding-00">
					<a  href="<?=base_url("users/searchResults?state={$state->name}&state_selected={$state->id}");?>" style="width: 225px!important;" class="btn btn-info btn-sm">Schools / Disciplines in <?=$state->name;?> State</a>
				</div>
			</div>
		</div>
		<? $i++; } ?>
	</div>
</div>