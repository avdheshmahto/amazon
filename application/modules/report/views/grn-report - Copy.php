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
<h4 class="panel-title">GRN REPORT </h4>
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
<div class="row">
<div class="col-md-3 col-lg-4">
<div class="form-group">
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
</div>
</div>

<div class="form-group">
<label class="form-label">Purchase Order Number</label>
<input type="text" name="po_no" class="form-control" value="" />
</div>

<div class="form-group">
<label class="form-label">Invoice Number</label>
<input type="text" name="in_no" class="form-control" value="" />
</div>

<div class="form-group">
<label class="form-label">Grn Number</label>
<input type="text" name="grn_no" class="form-control" value="" />
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
<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries"  url="<?=base_url('/report/Report/searchStock');?>" class="form-control input-sm">
	<option value="10">10</option>
	<option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
	<option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
	<option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
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
						   <th>Storage Location</th>
                           <th>Purchase Order No.</th>
                           					   
                           <th>GRN Date</th>
                           <th>Grn No.</th>
						   <th>Invoice No.</th>
		</tr>
	</thead>
<tbody id="getDataTable">
<tr>
<?php
						$i=1;
						foreach($result as $sales)
					    {
						?>
<td>

                            <?php 
                               $sqlpoComp  = $this->db->query("select * from tbl_master_data  where serial_number='".$sales->storage_location."'");
							   $getComp    = $sqlpoComp->row();
							   echo $getComp->keyvalue;
							?>
                            </td>
                            <td><?php
							
                            $poNumberQuery=$this->db->query("select *from tbl_purchase_order_hdr where purchaseid='$sales->po_no'");
							$getPoNumber=$poNumberQuery->row();
                            echo $getPoNumber->purchase_no;
							
							?></td>
                            
							<?php $sqlpoContact  = $this->db->query("select first_name from tbl_contact_m  where contact_id='".$sales->purchase_contact."'");
							   $sqlporesult  = $sqlpoContact->row();
							?>
                            
                            <?php $sqlpoSupplier  = $this->db->query("select first_name from tbl_contact_m  where contact_id='".$sales->supplier_contact."'");
							   $getSupplier  = $sqlpoSupplier->row();
							?>
                            <td><?=$sales->grn_date;?></td>
							<td><?=$sales->grn_no;?></td>
                            <td><?=$sales->invoice_no;?></td>
							
                           
</tr>
<?php } //} ?>
</tbody>
</table>
<div class="row">
   <div class="col-md-12 text-right">
      <div class="col-md-6 text-left">  </div>
    	  <div class="col-md-6">  <?=$pagination; ?>  </div>
          <div class="popover fade right in displayclass" role="tooltip" id="popover" style=" background-color: #ffffff;border-color: #212B4F;">
		  <div class="popover-content" id="showParent"></div>
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