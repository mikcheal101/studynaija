<div class="container">
	<div class="row">
		<div class="col-sm-3 padding-00">
			<div class="col-sm-12">
				<!-- ads -->
			</div>
		</div>
		<div class="col-sm-9 padding-00">
			<div class="col-sm-12 p-r-00 border-ash background-white-complete m-t-05 p-t-10 p-r-05">
				<fieldset class="m-b-10 col-sm-12 p-l-00  p-r-05">
					<legend class="font-14 m-b-00 no-border text-blue">Graphing</legend>
					
				</fieldset>
			</div>
			
			
			<div class="col-sm-12 m-t-05 padding-10 border-ash background-white-complete">
				<table class="table table-responsive">
					<thead>
						<td width="10%"></td>
						<td width="20%">Applicant's Name</td>
						<td width="25%">Instituition</td>
						<td width="">Discipline</td>
						<td width="10%">Date</td>
						<td width="10%"></td>
					</thead>
					<tbody>
						<?php for($i=0; $i<30; $i++):?>
						<tr>
							<td class="font-12">
								<img class="im-responsive img-fluid img-rounded" style="height: 50px; max-height: 50px; min-height: 50px;" src="http://placekitten.com/300/300" />
							</td>
							<td class="font-12"><a href="<?=base_url('admin/applicant/1');?>">Samuel Eto</a></td>
							<td class="font-12"><a href="<?=base_url('admin/applications');?>">University of Nsuka</a></td>
							<td class="font-12"><a href="<?=base_url('admin/applications');?>">Computer engineering</a></td>
							<td class="font-12">12 / 02 / 2016</td>
							<td class="font-12">Pending</td>
						</tr>
						<?php endfor;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>