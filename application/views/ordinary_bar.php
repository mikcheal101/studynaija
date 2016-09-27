<div class="container-fluid no-border" style="margin-top: 55px; height: 55px;">
	<div class="row full-height">
		<div class="col-sm-12 full-height p-t-10 p-l-10 p-r-10 no-scroll" style="background-color: #fbfbfb; border: 1px solid #dedede;" >
			<div class="col-sm-12 p-l-10 p-r-10">
				<ol class="breadcrumb">
				<?php 
					foreach($positions as $position) {
						$position = urldecode($position);
						$position = mb_strimwidth($position, 0, 50, "...");
						echo '<li><a href="#">'.strtolower ($position).'</a></li>';
					}
				?>
				</ol>
			</div>
		</div>		
	</div>
</div>