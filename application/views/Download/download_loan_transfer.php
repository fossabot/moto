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
						<h3 class="pageTitleSmall" style="margin:10px 0px 5px 0px;"> Loan Transfer Report </h3>
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
					<div style="width:50%;float:left;margin-top:120px;">
						<div class="box-header with-border" style="background: #bbbfc1;width:98%;">
							<center><h3 class="box-title" style="text-align:center;font-family:Helvetica Neue,Helvetica,Arial,sans-serif;font-weight:noraml;">Loan Receive</h3></center>
						</div>
						<table class="simpleTable" style="width:98%;">
							<thead>
								<tr class="tableRowBG">
									<th colspan="3">Date</th>
									<th colspan="3">Person Name</th>
									<th colspan="3">Particular</th>
									<th colspan="3" style="text-align:right;">Amount</th>
								</tr>
							</thead>	
							<tbody>	
							<?php
							$total_credit =0.00;
							foreach($credit as $field):
							?>
								<tr>
									<th colspan="3"> <?php echo $field['date']; ?>  </th>
									<th colspan="3"> <?php echo $field['loan_person_name']; ?>  </th>
									<th colspan="3"> <?php echo $field['transaction_purpose']; ?>  </th>
									<th colspan="3" style="text-align:right;"> <?php echo sprintf('%0.2f',$field['amount']); ?> </th>
									<?php $total_credit += $field['amount'];?>
								</tr>
							<?php
								endforeach;
								
							?>
								<tr class="tableRowBG">
									<th colspan="3"></th>
									<th colspan="3"></th>
									<th colspan="3">Total</th>
									<th colspan="3" style="text-align:right;"> <?php echo sprintf('%0.2f',$total_credit); ?> </th>
								</tr>
							</tbody>
						</table>
					</div>
					<div style="width:50%;float:right;">
						<div class="box-header with-border" style="background: #bbbfc1;">
							<center><h3 class="box-title" style="text-align:center;font-family:Helvetica Neue,Helvetica,Arial,sans-serif;font-weight:noraml;">Loan Payment</h3></center>
						</div>
						<table class="simpleTable" style="width:100%;">
							<thead>
								<tr class="tableRowBG">
									<th colspan="3">Date</th>
									<th colspan="3">Person Name</th>
									<th colspan="3">Particular</th>
									<th colspan="3" style="text-align:right;">Amount</th>
								</tr>
							</thead>	
							<tbody>	
							<?php
							$total_debit =0.00;
							foreach($debit as $field2):
							?>
								<tr>
									<th colspan="3"> <?php echo $field2['date']; ?>  </th>
									<th colspan="3"> <?php echo $field2['loan_person_name']; ?></th>
									<th colspan="3"> <?php echo $field2['transaction_purpose']; ?></th>
									<th colspan="3" style="text-align:right;"> <?php echo sprintf('%0.2f',$field2['amount']); ?> </th>
									<?php $total_debit += $field2['amount'];?>
								</tr>
							<?php
								endforeach;
								
							?>
								<tr class="tableRowBG">
									<th colspan="3"></th>
									<th colspan="3"></th>
									<th colspan="3">Total</th>
									<th colspan="3" style="text-align:right;"> <?php echo sprintf('%0.2f',$total_debit); ?> </th>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<h3 class="pageTitleSmall" style="margin:20px 0 5px 0;"> Summary </h3>
					<table class="simpleTable" style="margin-top:20px;">
						<thead>
							<tr class="tableRowBG">
								<th colspan="3" style="text-align:center;">Total Balance</th>
							</tr>
						</thead>	
						<tbody>	
							<tr>
								<th colspan="3" style="text-align:center;"> <?php echo sprintf('%0.2f',$total_credit - $total_debit); ?>  </th>
							</tr>
						</tbody>
					</table>
				</div>
			</div> <!---------- END OF DIV CONTROLLER ---------->
		</div>	<!--------- END OF DIV MAIN --------->
	</body>
</html>
