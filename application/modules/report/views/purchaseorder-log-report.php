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
<h4 class="panel-title">Purchase Order Log Report</h4>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><!--<i class="icon-arrows-ccw"></i>--><i class="fa fa-refresh fa-2x" aria-hidden="true" style="color:black;"></i></a></li>
</ul>
</div>

<!--<div class="panel-body">-->
<div class="panel-body" style="background:#f9f9f9; border-bottom:1px solid #ddd; padding-bottom:0px !important; margin-bottom:15px;">
<form class="form-inline">
<div class="form-group">
<label class="form-label">Purchase Order No</label>
<input type="text" name="p_no" class="form-control" value="" />
</div>

<div class="form-group">
<label class="form-label">Storage Location</label>
<select name="s_loc"  class="form-control" id="company" >
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
<label class="form-label">Supplier Contact</label>
<input type="text" name="s_cont" class="form-control" value="" />
</div>

<div class="form-group">
<label class="form-label">Purchaser Contact</label>
<select name="v_name"  class="form-control">
<option value="">--select--</option>
<?php 
$sql = $this->db->query("select * from tbl_contact_m where group_name='5' and status='A' order by first_name asc");
foreach($sql->result() as $sqlline){ ?>
<option value="<?php echo $sqlline->contact_id;?>"><?php echo $sqlline->first_name;?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label class="form-label">From Date</label>
<input type="date" name="f_date" class="form-control" value="" />
</div>

<div class="form-group">
<label class="form-label">To Date</label>
<input type="date" name="t_date" class="form-control" value="" />
</div>

<div class="form-group filter-btn">
<button class="btn btn-sm btn-black btn-outline" style="margin-top:20px;" name="filter" value="filter">Search</button> 
</div>
</form>
</div>
<br />
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
<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries"  url="<?=base_url();?>/report/Report/searchPurchaseOrderlog?<?='p_no='.$_GET['p_no'].'&v_name='.$_GET['v_name'].'&f_date='.$_GET['f_date'].'&t_date='.$_GET['t_date'];?>" class="form-control input-sm">
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

	   <th><div style="width:130px">Purchase Order No.</div></th>
	   <th><div style="width:140px">Storage Location</div></th>
	   <th><div style="width:100px">Date</div></th>
       <th><div style="width:130px">Purchaser Contact</div></th>
	   <th><div style="width:100px">Due Date</div></th>
	   <th><div style="width:230px">SUPPLIER CONTACT</div></th>
       <th><div style="width:100px">Grand Total</div></th>
       <th><div style="width:100px">Action</div></th>
</tr>
</thead>
<tbody id="getDataTable">
<?php
$yy=1;
//if(!empty($purchaseOrderSearch)) {
foreach($result as $sales) {
?>
<tr class="gradeC record">

<th><?=$sales->purchase_no;?></th>

<th><?php 
                               $sqlpoComp  = $this->db->query("select * from tbl_master_data  where serial_number='".$sales->company."'");
							   $getComp    = $sqlpoComp->row();
							   echo $getComp->keyvalue;
							?>
                            </th>

<th><?=$sales->order_date;?></th>
<th><?php 
		$sqlgroup=$this->db->query("select * from tbl_contact_m where  contact_id='$sales->purchase_contact'");
		$res1 = $sqlgroup->row();
		echo $res1->first_name;?></th>
<th>
<?php 
$idt=$sales->invoice_date;
$date = new DateTime("$idt");
$fdate=$date->format("Y-m-d");
$dt=$sales->due_date;
if($dt!=''){
echo $idate= date('Y-m-d', strtotime($fdate. " + $dt days"));
}else{
echo $fdate;
}
?>
</th>

<?php $sqlpoSupplier  = $this->db->query("select first_name from tbl_contact_m  where contact_id='".$sales->supplier_contact."'");
							   $getSupplier  = $sqlpoSupplier->row();
							?>
                            <th><?=$getSupplier->first_name;?></th>


<th><?php 
		$sqlgroup=$this->db->query("SELECT SUM(qty) as sumqty FROM `tbl_purchase_order_dtl` WHERE purchaseorderhdr = '$sales->purchaseid'");
		$res1 = $sqlgroup->row();
		echo $res1->sumqty;?></th>
        
        <th> <button class="btn btn-xs btn-black"  type="button" data-toggle="modal" data-target="#modal-1" onclick="viewPoStock('<?=$sales->purchaseid;?>');"> <i class="icon-eye"></i></button>
                            </th>

</tr>
<?php } //} ?>
</tbody>
</table>
<div id="modal-1" class="modal fade" tabindex="-1" role="dialog">
					<div class="modal-dialog modal-lg">
					  <div class="modal-content" >
						<div class="panel-body" id ="inboundOutbond">
                        
					    </div>

					  </div><!-- /.modal-content -->
			      </div><!-- /.modal-dialog -->
             </div>
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
function viewPoStock(viewId){

 	$.ajax({   
	    type: "POST",  
		url: "<?=base_url();?>report/view_po_stock_log",  
		cache:false,  
		data: {'id':viewId},  
		success: function(data)  
		{  
		
		// $("#loading").hide();  
		
		 $("#inboundOutbond").empty().append(data).fadeIn();
		//referesh table
		}   
	});

 }


function exportTableToExcel(tableID, filename = ''){
 
 	//alert();
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'PurchaseOrderReport_<?php echo date('d-m-Y');?>.xls';
    
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