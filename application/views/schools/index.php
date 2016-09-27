		<div class="col-sm-10 p-l-00 col-xs-12">
			<style>
				.jumbo {
					background-image: url('<?=$school->cover_photo;?>'); 
					color:#fdfdfd; 
					height: 400px; 
					margin: 0px -15px;
				}
				
				.next-jumbo {
					max-height: 300px;
					width: 200px; max-width: 300px; border: 1px solid #f3f3f3; text-align: -webkit-center; 
					background-color:rgba(255, 255, 255, 0.4); border-radius: 5px;
				}
			</style>
			<div class="jumbotron background-image jumbo p-t-20 p-b-20 m-l-00" >
				<span class="glyphicon glyphicon-pencil padding-10 pull-right" style="border: 1px solid #f3f3f3; background-color: rgba(0, 0, 0, 0.2);"></span>
				<div class="col-sm-12 m-l-15 p-r-15 p-l-00 text-center next-jumbo">
					<span class="glyphicon glyphicon-pencil padding-10 pull-left" style="background-color: rgba(0, 0, 0, 0.2);"></span>
					<img class="img-responsive padding-20" style="max-height: 300px; max-width: 300px; width: 200px;" src="<?=$school->logo;?>" />	
				</div>
				<h1 class="bold col-sm-12"><?="{$school->name} ({$school->year_of_est})";?></h1>
				<p class="bold col-sm-12"><?="{$school->email}";?></p>
				<p class=" col-sm-12 m-b-20"><?="{$school->url}";?></p>
			</div>
			<div class="row">
				<div class="col-sm-12 p-l-15 p-r-00 p-b-00 m-t-10 m-b-00">
					<div class="panel">
						<h4 class="panel-heading m-t-00 m-b-00 text-600">History</h4>
						<div class="panel-body">
							<?=base64_decode($school->history);?>
						</div>
					</div>
				</div>
				
				<!--
				<div class="col-sm-12 p-l-00 p-r-00 m-t-05 m-b-05">
					
					<div class="" ></div>
					<div class="col-sm-3 p-l-00">
						<div class="col-sm-12 padding-10 border-ash  background-white-complete">
							<h3 class="text-green m-t-00 m-b-00">Agriculture & Forestry</h3>
							<p class="m-t-05 m-b-05">Agriculture & Forestry</p>
							<p class="text-justify font-12">
								Duis sollicitudin hendrerit magna eu dictum. In at sapien vel nunc maximus dictum. Pellentesque orci quam, volutpat vitae placerat vel, bibendum non tellus. Donec turpis ipsum, porta in nulla ac, scelerisque pretium nulla. Nunc in arcu a lectus tincidunt fringilla vel malesuada felis. Nulla pellentesque vestibulum lorem, ut pretium tortor. Curabitur dictum dolor ut ex ullamcorper, nec luctus dui tristique. Pellentesque congue nibh sed diam tincidunt feugiat at id nunc. Etiam vitae lorem aliquet, mollis ante eu, eleifend risus. Pellentesque vel consectetur magna. Integer vitae quam auctor, blandit ligula eu, auctor ligula. Proin quis libero at nibh fringilla euismod. Phasellus ut suscipit libero. Maecenas congue, tellus quis dictum blandit, magna turpis ullamcorper sem, a accumsan mi massa vel arcu.
							</p>
						</div>
					</div>
					<div class="col-sm-3 m-b-10 p-l-00">
						<div class="col-sm-12 padding-10 border-ash  background-white-complete">
							<h3 class="text-green m-t-00 m-b-00">Agriculture & Forestry</h3>
							<p class="m-t-05 m-b-05">Agriculture & Forestry</p>
							<p class="text-justify font-12">
								Duis sollicitudin hendrerit magna eu dictum. In at sapien vel nunc maximus dictum. Pellentesque orci quam, volutpat vitae placerat vel, bibendum non tellus. Donec turpis ipsum, porta in nulla ac, scelerisque pretium nulla. Nunc in arcu a lectus tincidunt fringilla vel malesuada felis. Nulla pellentesque vestibulum lorem, ut pretium tortor. Curabitur dictum dolor ut ex ullamcorper, nec luctus dui tristique. Pellentesque congue nibh sed diam tincidunt feugiat at id nunc. Etiam vitae lorem aliquet, mollis ante eu, eleifend risus. Pellentesque vel consectetur magna. Integer vitae quam auctor, blandit ligula eu, auctor ligula. Proin quis libero at nibh fringilla euismod. Phasellus ut suscipit libero. Maecenas congue, tellus quis dictum blandit, magna turpis ullamcorper sem, a accumsan mi massa vel arcu.
							</p>
						</div>
					</div>
					<div class="col-sm-3 m-b-10 p-l-00">
						<div class="col-sm-12 padding-10 border-ash  background-white-complete">
							<h3 class="text-green m-t-00 m-b-00">Agriculture & Forestry</h3>
							<p class="m-t-05 m-b-05">Agriculture & Forestry</p>
							<p class="text-justify font-12">
								Duis sollicitudin hendrerit magna eu dictum. In at sapien vel nunc maximus dictum. Pellentesque orci quam, volutpat vitae placerat vel, bibendum non tellus. Donec turpis ipsum, porta in nulla ac, scelerisque pretium nulla. Nunc in arcu a lectus tincidunt fringilla vel malesuada felis. Nulla pellentesque vestibulum lorem, ut pretium tortor. Curabitur dictum dolor ut ex ullamcorper, nec luctus dui tristique. Pellentesque congue nibh sed diam tincidunt feugiat at id nunc. Etiam vitae lorem aliquet, mollis ante eu, eleifend risus. Pellentesque vel consectetur magna. Integer vitae quam auctor, blandit ligula eu, auctor ligula. Proin quis libero at nibh fringilla euismod. Phasellus ut suscipit libero. Maecenas congue, tellus quis dictum blandit, magna turpis ullamcorper sem, a accumsan mi massa vel arcu.
							</p>
						</div>
					</div>
					<div class="col-sm-3  m-b-10 p-r-00 p-l-00">
						<div class="col-sm-12 padding-10 border-ash background-white-complete">
							<h3 class="text-green m-t-00 m-b-00">Agriculture & Forestry</h3>
							<p class="m-t-05 m-b-05">Agriculture & Forestry</p>
							<p class="text-justify font-12">
								Duis sollicitudin hendrerit magna eu dictum. 
							</p>
						</div>
					</div>
				</div>
				-->
			</div>
		</div>
	</div>
</div>