<?php
$this->load->view("header.php");

$entries = "";
if($this->input->get('entries')!="")
{
  $entries = $this->input->get('entries');
}

?>
<!-- Main content -->
<div class="main-content">
	
<?php
$this->load->view("reportheader");
?>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
<h4 class="panel-title">ORDER REPORT </h4>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><!--<i class="icon-arrows-ccw"></i>--><i class="fa fa-refresh fa-2x" aria-hidden="true" style="color:black;"></i></a></li>
</ul>
</div>
<!--<div class="panel-body panel-center">-->
<div class="panel-body" style="background:#f9f9f9; border-bottom:1px solid #ddd; padding-bottom:0px !important; margin-bottom:15px;">
<form class="form-inline">
<!--<div class="form-group">
<label class="form-label">Contract</label>
<input type="text" name="contr" class="form-control" value="" />
</div>-->

<div class="form-group col-md-3">
<label class="form-label">Storage Location</label>
	<select name="s_loc"  class="form-control" id="company" onchange="getPO();" >
	<option value="">----Select ----</option>
	<?php 
		$sqlprotype=$this->db->query("select * from tbl_master_data where param_id=22");
		foreach ($sqlprotype->result() as $fetch_protype){
	?>
	<option value="<?php echo $fetch_protype->serial_number;?>"><?php echo $fetch_protype->keyvalue; ?></option>
	<?php } ?>
	</select>

</div>


<div class="form-group">
<label class="form-label">Requestor Name </label>
<select name="r_name"   id="contact_id_copy" class="form-control">
							<option value="" >Select</option>
							<?php
							$contQuery=$this->db->query("select * from tbl_contact_m where status='A' and group_name='5'");
							foreach($contQuery->result() as $contRow)
							{
							?>
								<option value="<?php echo $contRow->contact_id; ?>">
								<?php echo $contRow->first_name.' '.$contRow->middle_name.' '.$contRow->last_name; ?>
								</option>
							<?php } ?>
						</select>
</div>

<div class="form-group">
<label class="form-label">Requestor LOCATION</label>
<select name="dest"   id="destination" class="form-control">
							<option value="" >Select</option>
							<?php
							$contQuery=$this->db->query("select * from tbl_contact_m where status='A' and group_name='7'");
							foreach($contQuery->result() as $contRow)
							{
							?>
								<option value="<?php echo $contRow->contact_id; ?>">
								<?php echo $contRow->first_name.' '.$contRow->middle_name.' '.$contRow->last_name; ?>
								</option>
							<?php } ?>
					   	 </select>
</div>

<div class="form-group">
<label class="form-label">Docket Number</label>
<input type="text" name="doc_no" class="form-control" value="" />
</div>

<div class="form-group">
<label class="form-label">Vehicle Number</label>
<input type="text" name="veh_no" class="form-control" value="" />
</div>

<div class="form-group"> 
<label class="form-label"> Transporter Name:</label>  
 <input type="text" class="form-control" name="transporter_name" value="">
</div> 

<div class="form-group"> 
<label class="form-label">Docket Date:</label> 			
<input type="date" name="vehicle_date" id="vehicle_date" value="" class="form-control">
</div> 


<div class="form-group">
<div class="col-sm-12">
<label class="form-label">From Date</label>
<input type="date" name="f_date" class="form-control" value="" />
</div>
</div>

<div class="form-group">
<div class="col-sm-12">
<label class="form-label">To Date</label>
<input type="date" name="t_date" class="form-control" value="" />
</div>
</div>

<div class="form-group filter-btn">
<button class="btn btn-sm btn-black btn-outline" style="margin-top:20px;" name="filter" value="filter">Search</button> 
</div>
</form>
</div>


<div class="row">
<div class="col-sm-12">
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
<div class="html5buttons">
<div class="dt-buttons">
<button class="dt-button buttons-excel buttons-html5" onclick="exportTableToExcel('tblData')">Excel</button>
<a class="dt-button buttons-excel buttons-html5" style="display:none" tabindex="0" aria-controls="DataTables_Table_0" onclick="exportTableToExcel('tblData')"><span>Excel</span></a>
</div>
</div>

<div class="dataTables_length" id="DataTables_Table_0_length">
<label>&nbsp;&nbsp; Show
<select name="DataTables_Table_0_length" url="<?=base_url();?>report/Report/order_report?<?='doc_no='.$_GET['doc_no'].'&veh_no='.$_GET['veh_no'].'&r_name='.$_GET['r_name'].'&dest='.$_GET['dest'].'&transporter_name='.$_GET['transporter_name'].'&vehicle_date='.$_GET['vehicle_date'].'&f_date='.$_GET['f_date'].'&t_date='.$_GET['t_date'];?>" aria-controls="DataTables_Table_0" id="entries" class="form-control input-sm">
	<option value="10" <?=$entries=='10'?'selected':'';?>>10</option>
	<option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
	<option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
	<option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
	<option value="500" <?=$entries=='500'?'selected':'';?>>500</option>
	<option value="1000" <?=$entries=='1000'?'selected':'';?>>1000</option>
	<option value="<?=$dataConfig['total'];?>" <?=$entries==$dataConfig['total']?'selected':'';?>>All</option>
</select>
Entries</label>

<div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite" style="    margin-top: -6px;margin-left: 12px;float: right;">
	Showing <?=$dataConfig['page']+1;?> to 
	<?php
	$m=$dataConfig['page']==0?$dataConfig['perPage']:$dataConfig['page']+$dataConfig['perPage'];
	echo $m >= $dataConfig['total']?$dataConfig['total']:$m;
	?> of <?php echo $dataConfig['total'];?> Entries
</div>
</div>
<div id="DataTables_Table_0_filter" class="dataTables_filter">
<label>Search:
<input type="text" class="form-control input-sm" id="searchTerm"  onkeyup="doSearch()" placeholder="What you looking for?">
</label>
</div>
</div>
</div>
</div>
<br />

<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example1" id="tblData" >
	<thead>
		<tr>
						  <th>S.No&nbsp;</th>
						   <th>Storage Location</th>
                           <th>Requestor Name</th>
                           <th>Requestor LOCATION </th>
                            <th>STN Number</th>
						   <th>STN Date</th>
						   <th>DOCKET NO. </th>
                           <th>Vehicle NO.</th>
						   <th>Transporter Name</th>
						   <th>Docket Date</th>
		</tr>
	</thead>
<tbody id="getDataTable">

						<?php
						$i=1;
						foreach($result as $sales)
					    {
						?>
                         <tr class="gradeC record">
							<td><?=$i++;?><!-- <input name="cid[]" type="checkbox" id="cid[]" class="sub_chk" data-id="40" value="40"> --></td>
							<td>
                            <?php 
                               $sqlpoComp  = $this->db->query("select * from tbl_master_data  where serial_number='".$sales->company."'");
							   $getComp    = $sqlpoComp->row();
							   echo $getComp->keyvalue;
							?>
                            </td>
                            <?php $sqlpoSupplier  = $this->db->query("select first_name from tbl_contact_m  where contact_id='".$sales->contact_id."'");
							       $getSupplier  = $sqlpoSupplier->row();
							  ?>
                            <td><?=$getSupplier->first_name;?></td>
                            <?php $sqlpoSupplier  = $this->db->query("select first_name from tbl_contact_m  where contact_id='".$sales->destination_contact."'");
							   $getSupplier  = $sqlpoSupplier->row();
							?>

                            <td><?=$getSupplier->first_name;?>
                            <!-- <a data-toggle="modal" data-target="#modal-2" onclick="inbondviewlog('<?=$sales->purchaseid;?>');"></a>--></td>
                            
							<td><?=$sales->stn_no;?></td>
							<td><?=$sales->order_date;?></td>
							<td><?=$sales->docket_no;?></td>
							<td><?=$sales->vehicle_no;?></td>
							<td><?=$sales->transporter_name;?></td>
							<td><?=$sales->vechicle_date;?></td>
							  </tr>
<?php } //} ?>
</tbody>
</table>
<div class="row">
<div class="col-md-12 text-right">
	<div class="col-md-6 text-left"> 
	<!-- <h6>Showing 1 to 10 of <?php echo $totalrow; ?> entries</h6> -->
	</div>
	<div class="col-md-6"> 
		<?php echo $pagination; ?>
	</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
$this->load->view("footer.php");
?>

<script>

function exportTableToExcel(tableID, filename = ''){
 
 	//alert();
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'GRN REPORT<?php echo date('d-m-Y');?>.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{

        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
</script>