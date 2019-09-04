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
<h4 class="panel-title">Daily STOCK REPORT </h4>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><!--<i class="icon-arrows-ccw"></i>--><i class="fa fa-refresh fa-2x" aria-hidden="true" style="color:black;"></i></a></li>
</ul>
</div>
<!--<div class="panel-body panel-center">-->
<div class="panel-body" style="padding-bottom:0px !important; margin-bottom:15px;">
<form class="form-inline">
<!--<div class="form-group">
<label class="form-label">Contract</label>
<input type="text" name="contr" class="form-control" value="" />
</div>-->
<!-- <div class="form-group">
<label class="form-label">Product Name</label>
<input type="text" name="p_name" class="form-control" value="" />
</div>
<div class="form-group filter-btn">
<button class="btn btn-sm btn-black btn-outline" style="margin-top:20px;" name="filter" value="filter">Search</button>
</div> -->
<!-- <br><br> -->
        <div class="row datatable-wrapper form-inline">
			<div class="col-lg-12">
				<div class="data-col-first clearfix">
					<div class="col-selectbox">
					  <input type="date" value="date" name="date" class="form-control input-sm">
					</div>
					 
                 <!--    <div class="col-selectbox">
						<select class="form-control input-sm" name="location">
							<option value="">Location</option>
							<?php 
								$sqlprotype=$this->db->query("select * from tbl_master_data where param_id=22");
								foreach ($sqlprotype->result() as $fetch_protype){
							?>
					 	   <option value="<?php echo $fetch_protype->serial_number;?>"><?php echo $fetch_protype->keyvalue; ?></option>
							<?php } ?>
							
						</select>
					</div> -->
					<div class="col-selectbox">
						<select class="form-control input-sm" name="monthly">
							<option value="">Monthly</option>
							<option value="1">Jan</option>
							<option value="2">Feb</option>
							<option value="3">Mar</option>
							<option value="4">Apr</option>
							<option value="5">May</option>
							<option value="6">Jun</option>
							<option value="7">Jul</option>
							<option value="8">Aug</option>
							<option value="9">Sep</option>
							<option value="10">Oct</option>
							<option value="11">Nov</option>
							<option value="12">Dec</option>
						</select>
					</div>

                    <div class="col-selectbox">
						<select class="form-control input-sm" name="yearly">
							<option value="">yearly</option>
							<option value="2018">2018</option>
							<option value="2019">2019</option>
							<option value="2020">2020</option>
							<option value="2021">2021</option>
						</select>
						&nbsp;
                       <button class="btn btn-sm btn-black btn-outline" name="filter" value="filter">Go</button>
					</div>
				</div>
			</div>
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
<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries"  url="<?=base_url('/report/Report/dailyWiseReport');?>?<?='date='.$_GET['date'].'&monthly='.$_GET['monthly'].'&yearly='.$_GET['yearly'].'&filter='.$_GET['filter'];?>" class="form-control input-sm">
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
		    <th style="width:50px;">S No.</th>
			<th> Product Name </th>
			<th> Location </th> 
			<th>Opening Qty</th>
			<th>Inbound Qty</th> 
			<th>Outbound Qty</th> 
			<th>Closing Qty</th>
			<!-- <th>Total Stock</th> -->
			<th>Date</th>
			
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

<th><?php echo $rows->id; ?></th>
<th style="width: 18%;"><?php 
  $query1 = $this->db->query("Select productname from tbl_product_stock where Product_id = '".$rows->product_id."'");
  $result1 =$query1->row();

echo $result1->productname; ?></th>
<th><?=$rows->location; ?></th> 
<th><?=$rows->opening; ?></th>
<th><?=$rows->inbound; ?></th> 
<th><?=$rows->outbound; ?></th>

<th><?=($rows->opening+$rows->inbound)-$rows->outbound; ?></th>
<!-- <th><?=($rows->opening+$rows->inbound)-$rows->outbound; ?></th> -->
<th><?=$rows->create_on; ?></th>

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