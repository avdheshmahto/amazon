
<link href="<?=base_url();?>assets/plugins/datepicker/css/bootstrap-datepicker.css" rel="stylesheet">
<link href="<?=base_url();?>assets/plugins/colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet">
<link href="<?=base_url();?>assets/plugins/select2/css/select2.css" rel="stylesheet">


<?php
$this->load->view("header.php");

$entries = "";
if($this->input->get('entries')!="")
{
  $entries = $this->input->get('entries');
}
$s_loc = "";$p_name = "";

if($this->input->get() != ""){
 $s_loc  =   $this->input->get('s_loc');
 $p_name =   $this->input->get('p_name');
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
<h4 class="panel-title">PRODUCT LOCATION REPORT </h4>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><!--<i class="icon-arrows-ccw"></i>--><i class="fa fa-refresh fa-2x" aria-hidden="true" style="color:black;"></i></a></li>
</ul>
</div>
<!--<div class="panel-body panel-center">-->

<div class="panel-body" style="background:#f9f9f9; border-bottom:1px solid #ddd; padding-bottom:0px !important; margin-bottom:15px;">
<form id="rootwizard-2" class="form-wizard validate-form-wizard validate">
<div class="tab-content">
<div class="tab-pane  active" id="tab2-1">
<div class="row"> 
<div class="col-md-4"> 
<div class="form-group">
<label class="form-label">Storage Location</label>
<select name="s_loc" class="form-control ui fluid search dropdown location">
<option value="">--select--</option>
<?php 
$sql = $this->db->query("select * from tbl_master_data where param_id='22' and status='A' order by keyvalue asc");
foreach($sql->result() as $sqlline){ ?>
<option value="<?php echo $sqlline->serial_number;?>" <?=$s_loc==$sqlline->serial_number?'selected':"";?> ><?=$sqlline->keyvalue;?></option>
<?php } ?>
</select>
</div> 
</div>

<div class="col-md-4"> 
<div class="form-group">
<label class="form-label">Product Name </label>
<select name="p_name" class="select2 form-control">
<option value="">--select--</option>
<?php 
$sql = $this->db->query("select * from tbl_product_stock where  status='A' order by Product_id asc");
foreach($sql->result() as $sqlline){ ?>
<option value="<?php echo $sqlline->Product_id;?>" <?=$p_name == $sqlline->Product_id?'selected':"";?> ><?php echo $sqlline->productname;?></option>
<?php } ?>
</select> 
</div>
</div>

<div class="col-md-4"> 
<div class="form-group">
<button class="btn btn-sm btn-black btn-outline" style="margin-top:30px;" name="filter" value="filter">Search</button>
</div> 
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
<select name="DataTables_Table_0_length"  url="<?=base_url();?>report/Report/searchlocation?<?='s_loc='.$_GET['s_loc'].'&p_name='.$_GET['p_name'];?>" aria-controls="DataTables_Table_0" id="entries" class="form-control input-sm">
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
		    <th style="width:50px;">S No.</th>
			<th><div style="width:650px;">Product Name</div></th>   
			<!--<th>CONTRACT</th>
			 <th>Stock In Qty</th> 
			<th>SUPPLIER</th>-->
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

<th><?php echo $rows->serial_number; ?></th>
<th style="width: 18%;"><?php	
	        $qtyQuery  = $this->db->query("select * from tbl_product_stock where Product_id='$rows->product_id' AND status = 'A'");
            $qtyResult = $qtyQuery->row();
            echo $qtyResult->productname;
    ?></th>

<th style="width: 18%;">
	<?php 
	    $sqlgroup11=$this->db->query("select * from tbl_master_data where serial_number = '$rows->location_id' AND status = 'A'");
		$qtyResult = $sqlgroup11->row();
		echo $qtyResult->keyvalue;
	?>
		   
       
</th>
<th>
	<?php	
	      
        echo $rows->quantity;
    ?>
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

<script>

function getdata()
	{
	// alert('sss');
	currentCell          = 0;
    var product1         = document.getElementById("prd").value;
    var product          = product1;
	//var prdId            =  getvalues();
    
	if(xobj)
      {
		var obj=document.getElementById("prdsrch");
		//alert(obj);
		xobj.open("GET","getproduct?con="+product,true);
		xobj.onreadystatechange=function()
		{
		if(xobj.readyState==4 && xobj.status==200)
		  {
			console.log(xobj.responseText);
			obj.innerHTML=xobj.responseText;
		  }
		}
	}
	xobj.send(null);
}


</script>

<script src="<?php echo base_url();?>assets/plugins/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>assets/js/form-advanced-script.js"></script>
