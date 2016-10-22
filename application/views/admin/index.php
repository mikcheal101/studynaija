
	<div class="col-sm-10 p-r-00 p-l-00">
		<div class="col-sm-9 p-l-00 p-r-10">
			<div class="col-sm-6 p-r-05 p-l-05">
				<div class="panel m-b-05">
					<h4 class="panel-heading m-t-00 m-b-00">Top Visited Instituitions</h4>
					<!-- live chart -->
				</div>
			</div>
			<div class="col-sm-6 p-l-05 p-r-00">
				<div class="panel m-b-05">
					<h4 class="panel-heading m-t-00 m-b-00">Disciplines most applied for.</h4>
					<!-- live chart -->
				</div>
			</div>
			<div class="col-sm-12 p-l-05 p-r-00 m-t-00">
				<div class="panel m-t-05 m-b-05">
					<h4 class="panel-heading m-t-00 m-b-00">Disciplines most applied for.</h4>
					<!-- live chart -->
				</div>
			</div>
		</div>
		
		<div class="col-sm-3 p-r-00 p-l-00">
			<div class="panel">
				<h4 class="panel-heading text-blue m-t-00 m-b-00">School News</h4>
				<ul class="list-group">
					<?php for($i=0; $i<3; $i++):?>
					<li class="list-group-item">
						
							<h5>colleges of education (1)</h5>
							<?php 
								$str ="Sed elementum eget eros nec sodales. Nam feugiat mauris aliquet neque posuere, ornare ullamcorper erat mattis. Cras malesuada, est in tincidunt congue, lacus mauris euismod ex, sit amet congue ante leo quis lectus. Praesent scelerisque elementum bibendum. Fusce finibus malesuada nunc, id consequat massa malesuada ac. Aenean bibendum nisl a venenatis mollis. Interdum et malesuada fames ac ante ipsum primis in faucibus. In nulla elit, consequat nec ante eu, consectetur convallis nisl. Nunc ut enim vel urna aliquam sodales vel id erat. Sed sit amet commodo nisi, non egestas lacus. Quisque tempor pulvinar efficitur. Aliquam pulvinar, elit in volutpat maximus, nisi lacus egestas dui, ut tristique nunc dui nec dolor. Fusce interdum vel nulla sit amet congue. In ac tortor et diam viverra malesuada non nec ex.";
								$str = mb_strimwidth("{$str}", 0, 200, "   <a href='#' class='text-green font-12'>read more...</a>");
							?>
							<p><?=$str;?></p>
						
					</li>
					<?php endfor; ?>
				</ul>
			</div>
			
		</div>
	</div>
</div>
</div>