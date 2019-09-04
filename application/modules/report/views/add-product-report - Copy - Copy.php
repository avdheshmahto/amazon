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
<h4 class="panel-title">PRODUCT STOCK REPORT </h4>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><!--<i class="icon-arrows-ccw"></i>--><i class="fa fa-refresh fa-2x" aria-hidden="true" style="color:black;"></i></a></li>
</ul>
</div>
<!--<div class="panel-body panel-center">-->
<div class="panel-body" style="background:#f9f9f9; border-bottom:1px solid #ddd; padding-bottom:0px !important; margin-bottom:15px;">
<form class="form-inline">
<div class="form-group">
<label class="form-label">Product Id</label>
<input type="text" name="p_id" class="form-control" value="" />
</div>
<div class="form-group">
<label class="form-label">Product Name</label>
<input type="text" name="p_name" class="form-control" value="" />
</div>
<div class="form-group filter-btn">
<button class="btn btn-sm btn-black btn-outline" style="margin-top:20px;">Search</button> <button class="btn btn-sm btn-black btn-outline" style="margin-top:20px;">Clear</button>
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
		    <th>Item Id</th>
			<th>Item Name</th>   
			<th>CONTRACT</th>
			<!-- <th>Stock In Qty</th> -->
			<th>SUPPLIER</th>
			<th>Storage Location</th>
			<th>Stock In Qty</th>
		</tr>
	</thead>
<tbody id="getDataTable">
<?php
$yy=1;
//if(!empty($stockSearch)) {
// echo "<pre>";
//   print_r($result);
// echo "</pre>";
foreach($result as $rows) {
?>
<tr class="gradeC record">

<th><?php echo $rows->Product_id; ?></th>
<th style="width: 18%;"><?php echo $rows->productname; ?></th>
<th><?=$rows->contract;?></th>
<!-- <th>
<?php
$proQ1=$this->db->query("select * from tbl_master_data where serial_number='$rows->usageunit'");
$fProQ12=$proQ1->row();
echo $fProQ12->keyvalue;
?>
</th> -->
<th>
<?php	$contactQuery = $this->db->query("select * from tbl_contact_m where contact_id='$rows->supplier_id'");
        $contactResult= $contactQuery->row();
        echo $contactResult->first_name;
  ?>
</th>

<!-- <th>
<?php	$contactQuery = $this->db->query("select * from tbl_contact_m where contact_id='$rows->supplier_id'");
        $contactResult= $contactQuery->row();
        echo $contactResult->first_name;
  ?>
</th> -->
<th>
		<?php 
		$i = 0;
			$sqlgroup11=$this->db->query("select * from tbl_master_data where param_id = 22 AND serial_number IN ( ".$rows->location.")");
			foreach ($sqlgroup11->result() as $fetchgroup11){						
		?>
		<p style="<?=($i%2)==0?'color:#000;':'color:red;'?>;margin: 0px !important;"><?=$fetchgroup11->keyvalue;?></p>	
		   
       <?php $i++; } ?>
</th>
<th>
	<?php	
	        $qtyQuery  = $this->db->query("select quantity from tbl_product_serial where product_id='$rows->Product_id' AND location_id = '$rows->location'");
            $qtyResult = $qtyQuery->row();
            echo $qtyResult->quantity;
    ?>
 </th>

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
    filename = filename?filename+'.xls':'ProductStockReport_<?php echo date('d-m-Y');?>.xls';
    
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