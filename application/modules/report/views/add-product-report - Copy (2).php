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
<!--<div class="form-group">
<label class="form-label">Contract</label>
<input type="text" name="contr" class="form-control" value="" />
</div>-->
<div class="form-group">
<label class="form-label">Product Name</label>
<input type="text" name="p_name" class="form-control" value="" />
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
<select name="DataTables_Table_0_length" url="<?=base_url();?>report/Report/searchStock?<?='p_name='.$_GET['p_name'];?>" aria-controls="DataTables_Table_0" id="entries" class="form-control input-sm">
	<option value="10" <?=$entries=='10'?'selected':'';?>>10</option>
	<option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
	<option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
	<option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
	<option value="500" <?=$entries=='500'?'selected':'';?>>500</option>
	<option value="1000" <?=$entries=='1000'?'selected':'';?>>1000</option>
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
		    <th><div style="width:40px;">S No.</div></th>
			<th><div style="width:220px;">Product Name</div></th>  
			<th><div style="width:120px;">CONTRACT</div></th>
			<!-- <th>Stock In Qty</th> -->
			<th><div style="width:100px;">SUPPLIER</div></th>
			<th><div style="width:120px;">Storage Location</div></th>
			<!--<th>Stock In Qty</th>-->
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


<th>
<?php	$contactQuery = $this->db->query("select * from tbl_contact_m where contact_id='$rows->Product_id'");
        $contactResult= $contactQuery->row();
        echo $contactResult->contract;
  ?>
</th>
<th>	

<?php 
		$i = 0;
			$sqlgroup11=$this->db->query("select * from tbl_product_mapping where product_id = '".$rows->Product_id."'");
			foreach ($sqlgroup11->result() as $fetchgroup11){
			
			$sqlcont=$this->db->query("select * from tbl_contact_m where contact_id = '".$fetchgroup11->suplier_id."' ");
			$queryciont=$sqlcont->row();						
		?>
		<p style="<?=($i%2)==0?'color:#000;':'color:red;'?>;margin: 0px !important;"><?=$queryciont->first_name;?></p>	
		   
       <?php $i++; } ?>

</th>

<th>
		<?php 
		$i = 0;
			$sqlgroup11=$this->db->query("select * from tbl_product_mapping where product_id = '".$rows->Product_id."'");
			foreach ($sqlgroup11->result() as $fetchgroup11){						
		?>
		<p style="<?=($i%2)==0?'color:#000;':'color:red;'?>;margin: 0px !important;"><?=$fetchgroup11->location111;?></p>	
		   
       <?php $i++; } ?>
</th>

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