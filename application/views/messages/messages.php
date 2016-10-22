		<style>
			.fi {
				box-shadow: none; 
				border-radius: 0px; 
				border-bottom: 1px solid #F9F9F9; 
				border-top:0; 
				border-left:0; 
				border-right:0;
			}
			.m-b-neg-30 { margin-bottom : -30px!important;}
		</style>
		
		<?php 
			$var = "";
			switch ($msg_type) {
				case INBOX:
					$var = "From";
					break;
				case SENT:
					$var = "To";
					break;
				case DRAFT:
					$var = "";
					break;
				case TRASH:
					$var = "";
					break;
				default:
					$var = "";
					break;
			}
		?>

		<div class="col-sm-10 p-r-00 p-l-05" ng-controller="messagesController">
			<div class="col-sm-12 m-b-05 padding-00 ">
				<div class="panel m-b-05">
					<h5 class="panel-heading m-b-00 m-t-00 text-600"><?=$msg_link;?></h5>
					<div class="panel-body">
						<table class="table table-stripped table-responsive">
							<thead>
								<tr class="font-14 text-600">
									<?php if ($msg_type <= SENT){ ?>
									<td width="20%" class="p-l-15"><?=$var;?></td>
									<?php }?>
									<td width="50%">Subject</td>
									<td width="15%">Date</td>
									<?php if ($msg_type <= SENT){ ?>
									<td width="5%"><i class="fa fa-cog"></i></td>
									<?php }?>
								</tr>
							</thead>
							<tbody ng-init="getMessages(<?=$msg_type;?>);">
								<tr class="font-12 text-600" dir-paginate="msg in messages | itemsPerPage:50">
									<?php if ($msg_type <= SENT){ ?>
									<td class="p-l-15">
										<span ng-class="['hand', 'text-600']" ng-click="readMessage (msg);" ng-bind="msg.left_side"></span>		
									</td>
									<?php }?>
									<td>
										<span ng-class="['hand']" ng-click="readMessage (msg);" ng-bind="msg.msg_subject"></span>
									</td>
									<td>
										<span ng-class="['hand']" ng-click="readMessage (msg);" ng-bind="msg.msg_date"></span>
									</td>
									<?php if ($msg_type <= SENT){ ?>
									<td>
										<i ng-click="deleteMessage (msg);" class="fa hand fa-times-circle text-red"></i>
									</td>
									<?php }?>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="padding-00 col-sm-12">
				<dir-pagination-controls></dir-pagination-controls>
			</div>
			
			<div class="col-sm-12 m-b-00 padding-00" ng-show="selectedMessage.id != 0">
				<div class="panel">
					<div class="panel-body">
						<?php if ($msg_type <= SENT){ ?>
						<div class="col-sm-12 p-t-10">
							<fieldset class="m-b-10 col-sm-12 p-l-00 p-b-05 fi" >
								<legend class="font-14 m-b-00 no-border text-blue"><?=$var;?>:  &nbsp;<span ng-bind="selectedMessage.left_side"></span></legend>
							</fieldset>
						</div>
						<?php }?>
						<div class="col-sm-12 p-t-00 m-b-neg-30">
							<fieldset class="m-b-30 col-sm-12 p-l-00 p-b-10 fi">
								<legend class="font-14 m-b-00 no-border text-blue">Subject:  &nbsp;<span ng-bind="selectedMessage.msg_subject"></span></legend>
							</fieldset>
						</div>
						
						<div class="col-sm-12 p-t-10" ng-bind-html="selectedMessage.msg_message"></div>
						
						<div class="col-sm-12 p-t-10 text-right">
							<div class="btn-group">
								<?php if ((int)$msg_type <= SENT){ ?>
									<span class="btn btn-default" ng-click="deleteMessage (selectedMessage);"><i class="fa fa-trash text-danger"></i></span>
									<!-- <span class="btn btn-default" ng-click="junkMessage ();"><i class="fa fa-thumbs-o-down text-info"></i></span>-->
								<?php } else if ((int)$msg_type === TRASH){ ?>
									<span class="btn btn-default" ng-click="restoreMessage (selectedMessage);"><i class="fa fa-thumbs-o-up text-info"></i></span>
								<?php } else if ((int)$msg_type === TRASH || (int)$msg_type === INBOX || (int)$msg_type === DRAFT){ ?>
									<span class="btn btn-default" ng-click="replyMessage ();"><i class="fa fa-reply text-success"></i></span>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>