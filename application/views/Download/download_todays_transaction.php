<?php 
	ini_set('memory_limit', '-1');
	//ini_set('MAX_EXECUTION_TIME', '-1');
	ini_set('max_execution_time', 300);
?>
<style>
	.simpleTable{
		text-align:left;
	}
	
	.simpleTable th, .simpleTable td{
		line-height:normal;
		text-align:left;
		font-weight:normal;
	}
	
	#subjectNameList{
		line-height:20px;
	}
	
	
	@media print{
		pageBreak{
			page-break-after:always;
			page-break-inside:avoid;
		}
	}
</style>

<html>
	<head>
		<title> Dokani: It Lab Solutions </title>
		<link rel="stylesheet" href="<?php echo base_url(); ?>style/transcript_style.css" type="text/css"/> 
		<!--script src="<?php echo base_url();?>assets/js/jquery.min.js"></script-->
	</head>
	
	<body>
		<div id="main">
			<div id="controller">
				<htmlpageheader name="myheader">
					<div id="header">
						<img style="width:10%;" class="schoolLogoHeaderSmall" src="<?php echo base_url();?>images/top_logo.png"/>
						<h1 style="font-size:18px; line-height:normal;width:90%;" class="schoolNameHeaderSmall"> 
							<?php echo $this->tank_auth->get_shopname().' ( '. $this->tank_auth->get_shopaddress().' ) '; ?>
						</h1>
						<h3 class="pageTitleSmall" style="margin:10px 0px 5px 0px;"> All Transactions </h3>
					</div>
				</htmlpageheader>
				<htmlpagefooter name="myfooter">
					<div id="printFooter">
						<div class="part70P"> 
							<div class="developPart">
								<img class="companyLogo" src="<?php echo base_url();?>images/itlablogo.png" alt="IT Lab Solutions Ltd."/>
								
								<p> 
									Generated By : <b>Dokani</b> 
									<br/>
									Developed By : <b>IT Lab Solutions Ltd.</b> +8801842485222, www.itlabsolutions.com
								</p> 
							</div>
						</div>
						
						
						<div class="part30P">
							<div class="orgNameBottom textAlginRight">
								<p> <b>&copy; Copyright </b> <br/>  <?php echo $this->tank_auth->get_shopname();?>  </p>
								<p> <?php echo $this->tank_auth->get_shopaddress();?> </p>
							</div>
						</div>
					</div>
				</htmlpagefooter>
				<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
				<sethtmlpagefooter name="myfooter" value="on" />
				<div class="row">
					<table class="simpleTable" style="margin-top:20px;">
						<thead>
							<tr class="tableRowBG">
								<th colspan="3" style="text-align:center;">Date Duration</th>
							</tr>
						</thead>	
						<tbody>	
							<tr>
								<th colspan="3" style="text-align:center;"> <?php echo $this->uri->segment(3) .'- -'. $this->uri->segment(4); ?>  </th>
							</tr>
						</tbody>
					</table>
				</div>
				<br>
				<div class="row">
					<div style="float:left;">
						<table class="simpleTable">
							<thead>
								<tr class="tableRowBG">
								  <th colspan="3" style="text-align:center;">Cash In Hand</th>
								  <th colspan="3" style="text-align:center;">Cash In Bank</th>
								</tr>
							</thead>	
							<tbody>	
								<tr>
									<th colspan="3" style="text-align:center;"> <?php echo sprintf('%0.2f',$transaction8); ?>  </th>
									<th colspan="3" style="text-align:center;"> <?php echo sprintf('%0.2f',$transaction9); ?>  </th>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<?php
					foreach($transaction_sum as $field_sum):
					$transaction_purposes=$field_sum['transaction_purpose'];
					endforeach;
				?>
							<div class="row">
								<div style="float:left;">
									<div class="box-header with-border" style="background: #bbbfc1;">
										<center><h3 class="box-title" style="text-align:center;font-family:Helvetica Neue,Helvetica,Arial,sans-serif;font-weight:noraml;">Sale</h3></center>
									</div>
									<table class="simpleTable">
										<thead>
											<tr class="tableRowBG">
											  <th colspan="3">SL No</th>
											  <th colspan="3">Date</th>
											  <th colspan="3">Ledger Name</th>
											  <th colspan="3">Particular</th>
											  <th colspan="3">Remarks</th>
											  <th colspan="3" style="text-align:right;">Amount</th>
											</tr>
										</thead>	
										<tbody>	
										<?php
										$in =1;
										$total_sale =0.00;
										foreach($transaction2 as $field2):
										?>
											<tr>
												<th colspan="3"> <?php echo $in; ?>  </th>
												<th colspan="3"> <?php echo $field2['date']; ?>  </th>
												<th colspan="3"> <?php echo $field2['customer_name']; ?>  </th>
												<th colspan="3"> <?php echo $field2['transaction_purpose']; ?>  </th>
												<th colspan="3"> <?php echo $field2['remarks']; ?>  </th>
												<th colspan="3" style="text-align:right;"> <?php echo sprintf('%0.2f',$field2['amount']); ?> </th>
												<?php $total_sale += $field2['amount'];?>
											</tr>
										<?php
											$in++;
											endforeach;
											
										?>
											<tr class="tableRowBG">
												<th colspan="3"></th>
												<th colspan="3"></th>
												<th colspan="3"></th>
												<th colspan="3"></th>
												<th colspan="3">Total</th>
												<th colspan="3" style="text-align:right;"> <?php echo sprintf('%0.2f',$total_sale); ?> </th>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="row">
								<div style="float:left;margin-top:40px;">
									<div class="box-header with-border" style="background: #bbbfc1;">
										<center><h3 class="box-title" style="text-align:center;font-family:Helvetica Neue,Helvetica,Arial,sans-serif;font-weight:noraml;">Collection</h3></center>
									</div>
									<table class="simpleTable">
										<thead>
											<tr class="tableRowBG">
											  <th colspan="3">SL No</th>
											  <th colspan="3">Date</th>
											  <th colspan="3">Ledger Name</th>
											  <th colspan="3">Particular</th>
											  <th colspan="3">Remarks</th>
											  <th colspan="3" style="text-align:right;">Amount</th>
											</tr>
										</thead>	
										<tbody>	
										<?php
										$in2 =1;
										$total_collection =0.00;
										foreach($transaction as $field):
										?>
											<tr>
												<th colspan="3"> <?php echo $in2; ?>  </th>
												<th colspan="3"> <?php echo $field['date']; ?>  </th>
												<th colspan="3"> <?php echo $field['customer_name']; ?>  </th>
												<th colspan="3"> <?php echo $field['transaction_purpose']; ?>  </th>
												<th colspan="3"> <?php echo $field['remarks']; ?>  </th>
												<th colspan="3" style="text-align:right;"> <?php echo sprintf('%0.2f',$field['amount']); ?> </th>
												<?php $total_collection += $field['amount'];?>
											</tr>
										<?php
											$in2++;
											endforeach;
											
										?>
											<tr class="tableRowBG">
												<th colspan="3"></th>
												<th colspan="3"></th>
												<th colspan="3"></th>
												<th colspan="3"></th>
												<th colspan="3">Total</th>
												<th colspan="3" style="text-align:right;"> <?php echo sprintf('%0.2f',$total_collection); ?> </th>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="row">
								<div style="float:left;">
									<div class="box-header with-border" style="background: #bbbfc1;">
										<center><h3 class="box-title" style="text-align:center;font-family:Helvetica Neue,Helvetica,Arial,sans-serif;font-weight:noraml;">Credit Collection</h3></center>
									</div>
									<table class="simpleTable">
										<thead>
											<tr class="tableRowBG">
											  <th colspan="3">SL No</th>
											  <th colspan="3">Date</th>
											  <th colspan="3">Ledger Name</th>
											  <th colspan="3">Particular</th>
											  <th colspan="3">Remarks</th>
											  <th colspan="3" style="text-align:right;">Amount</th>
											</tr>
										</thead>	
										<tbody>	
										<?php
										$in3 =1;
										$total_credit_collection =0.00;
										foreach($transaction3 as $field3):
										?>
											<tr>
												<th colspan="3"> <?php echo $in3; ?>  </th>
												<th colspan="3"> <?php echo $field3['date']; ?>  </th>
												<th colspan="3"> <?php echo $field3['customer_name']; ?>  </th>
												<th colspan="3"> <?php echo $field3['transaction_purpose']; ?>  </th>
												<th colspan="3"> <?php echo $field3['remarks']; ?>  </th>
												<th colspan="3" style="text-align:right;"> <?php echo sprintf('%0.2f',$field3['amount']); ?> </th>
												<?php $total_credit_collection += $field3['amount'];?>
											</tr>
										<?php
											$in3++;
											endforeach;
											
										?>
											<tr class="tableRowBG">
												<th colspan="3"></th>
												<th colspan="3"></th>
												<th colspan="3"></th>
												<th colspan="3"></th>
												<th colspan="3">Total</th>
												<th colspan="3" style="text-align:right;"> <?php echo sprintf('%0.2f',$total_credit_collection); ?> </th>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="row">
								<div style="float:left;">
									<div class="box-header with-border" style="background: #bbbfc1;">
										<center><h3 class="box-title" style="text-align:center;font-family:Helvetica Neue,Helvetica,Arial,sans-serif;font-weight:noraml;">Purchase</h3></center>
									</div>
									<table class="simpleTable">
										<thead>
											<tr class="tableRowBG">
											  <th colspan="3">SL No</th>
											  <th colspan="3">Date</th>
											  <th colspan="3">Ledger Name</th>
											  <th colspan="3">Particular</th>
											  <th colspan="3">Remarks</th>
											  <th colspan="3" style="text-align:right;">Amount</th>
											</tr>
										</thead>	
										<tbody>	
										<?php
										$in4 =1;
										$total_purchase =0.00;
										foreach($transaction4 as $field4):
										?>
											<tr>
												<th colspan="3"> <?php echo $in4; ?>  </th>
												<th colspan="3"> <?php echo $field4['date']; ?>  </th>
												<th colspan="3"> <?php echo $field4['distributor_name']; ?>  </th>
												<th colspan="3"> <?php echo $field4['transaction_purpose']; ?>  </th>
												<th colspan="3"> <?php echo $field4['remarks']; ?>  </th>
												<th colspan="3" style="text-align:right;"> <?php echo sprintf('%0.2f',$field4['amount']); ?> </th>
												<?php $total_purchase += $field4['amount'];?>
											</tr>
										<?php
											$in4++;
											endforeach;
											
										?>
											<tr class="tableRowBG">
												<th colspan="3"></th>
												<th colspan="3"></th>
												<th colspan="3"></th>
												<th colspan="3"></th>
												<th colspan="3">Total</th>
												<th colspan="3" style="text-align:right;"> <?php echo sprintf('%0.2f',$total_purchase); ?> </th>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="row">
								<div style="float:left;">
									<div class="box-header with-border" style="background: #bbbfc1;">
										<center><h3 class="box-title" style="text-align:center;font-family:Helvetica Neue,Helvetica,Arial,sans-serif;font-weight:noraml;">Purchase Payment</h3></center>
									</div>
									<table class="simpleTable">
										<thead>
											<tr class="tableRowBG">
											  <th colspan="3">SL No</th>
											  <th colspan="3">Date</th>
											  <th colspan="3">Ledger Name</th>
											  <th colspan="3">Particular</th>
											  <th colspan="3">Remarks</th>
											  <th colspan="3" style="text-align:right;">Amount</th>
											</tr>
										</thead>	
										<tbody>	
										<?php
										$in5 =1;
										$total_purchase_payment =0.00;
										foreach($transaction5 as $field5):
										?>
											<tr>
												<th colspan="3"> <?php echo $in5; ?>  </th>
												<th colspan="3"> <?php echo $field5['date']; ?>  </th>
												<th colspan="3"> <?php echo $field5['distributor_name']; ?>  </th>
												<th colspan="3"> <?php echo $field5['transaction_purpose']; ?>  </th>
												<th colspan="3"> <?php echo $field5['remarks']; ?>  </th>
												<th colspan="3" style="text-align:right;"> <?php echo sprintf('%0.2f',$field5['amount']); ?> </th>
												<?php $total_purchase_payment += $field5['amount'];?>
											</tr>
										<?php
											$in5++;
											endforeach;
											
										?>
											<tr class="tableRowBG">
												<th colspan="3"></th>
												<th colspan="3"></th>
												<th colspan="3"></th>
												<th colspan="3"></th>
												<th colspan="3">Total</th>
												<th colspan="3" style="text-align:right;"> <?php echo sprintf('%0.2f',$total_purchase_payment); ?> </th>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="row">
								<div style="float:left;">
									<div class="box-header with-border" style="background: #bbbfc1;">
										<center><h3 class="box-title" style="text-align:center;font-family:Helvetica Neue,Helvetica,Arial,sans-serif;font-weight:noraml;">Expense</h3></center>
									</div>
									<table class="simpleTable">
										<thead>
											<tr class="tableRowBG">
											  <th colspan="3">SL No</th>
											  <th colspan="3">Date</th>
											  <th colspan="3">Ledger Name</th>
											  <th colspan="3">Particular</th>
											  <th colspan="3">Remarks</th>
											  <th colspan="3" style="text-align:right;">Amount</th>
											</tr>
										</thead>	
										<tbody>	
										<?php
										$in6 =1;
										$total_expense =0.00;
										foreach($transaction6 as $field6):
										?>
											<tr>
												<th colspan="3"> <?php echo $in6; ?>  </th>
												<th colspan="3"> <?php echo $field6['date']; ?>  </th>
												<th colspan="3"> <?php echo $field6['type_type']; ?>  </th>
												<th colspan="3"> <?php echo $field6['expense_details']; ?>  </th>
												<th colspan="3"> <?php echo $field6['remarks']; ?>  </th>
												<th colspan="3" style="text-align:right;"> <?php echo sprintf('%0.2f',$field6['amount']); ?> </th>
												<?php $total_expense += $field6['amount'];?>
											</tr>
										<?php
											$in6++;
											endforeach;
											
										?>
											<tr class="tableRowBG">
												<th colspan="3"></th>
												<th colspan="3"></th>
												<th colspan="3"></th>
												<th colspan="3"></th>
												<th colspan="3">Total</th>
												<th colspan="3" style="text-align:right;"> <?php echo sprintf('%0.2f',$total_expense); ?> </th>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="row">
								<div style="float:left;">
									<div class="box-header with-border" style="background: #bbbfc1;">
										<center><h3 class="box-title" style="text-align:center;font-family:Helvetica Neue,Helvetica,Arial,sans-serif;font-weight:noraml;">Expense Payment</h3></center>
									</div>
									<table class="simpleTable">
										<thead>
											<tr class="tableRowBG">
											  <th colspan="3">SL No</th>
											  <th colspan="3">Date</th>
											  <th colspan="3">Ledger Name</th>
											  <th colspan="3">Particular</th>
											  <th colspan="3">Remarks</th>
											  <th colspan="3" style="text-align:right;">Amount</th>
											</tr>
										</thead>	
										<tbody>	
										<?php
										$in7 =1;
										$total_expense_payment =0.00;
										foreach($transaction7 as $field7):
										?>
											<tr>
												<th colspan="3"> <?php echo $in7; ?>  </th>
												<th colspan="3"> <?php echo $field7['date']; ?>  </th>
												<th colspan="3"> <?php echo $field7['type_type']; ?>  </th>
												<th colspan="3"> <?php echo $field7['expense_details']; ?>  </th>
												<th colspan="3"> <?php echo $field7['remarks']; ?>  </th>
												<th colspan="3" style="text-align:right;"> <?php echo sprintf('%0.2f',$field7['amount']); ?> </th>
												<?php $total_expense_payment += $field7['amount'];?>
											</tr>
										<?php
											$in7++;
											endforeach;
											
										?>
											<tr class="tableRowBG">
												<th colspan="3"></th>
												<th colspan="3"></th>
												<th colspan="3"></th>
												<th colspan="3"></th>
												<th colspan="3">Total</th>
												<th colspan="3" style="text-align:right;"> <?php echo sprintf('%0.2f',$total_expense_payment); ?> </th>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
				
			</div> <!---------- END OF DIV CONTROLLER ---------->
		</div>	<!--------- END OF DIV MAIN --------->
	</body>
</html>
