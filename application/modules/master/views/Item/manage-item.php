<!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/dropdown-customer/semantic.js"></script>
<link type="text/css" href="<?php echo base_url();?>assets/dropdown-customer/semantic.css" rel="stylesheet" />
-->
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
			<!-- Breadcrumb -->
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
                <li><a href="#">Master</a></li> 
                <li class="active"><strong>Add Item</strong></li>
				
                <div class="pull-right">
                   <button type="button" class="btn btn-sm btn-black btn-outline" data-toggle="modal" formid = "#ItemForm" data-target="#modal-0" id="formreset"><i class="fa fa-plus" aria-hidden="true"></i>Add Item</button>
                   <button type="button" class="btn btn-sm btn-black btn-outline delete_all" ><i class="fa fa-trash-o"></i>Delete</button>
               </div>
			</ol>
			<div class="row">
				<div class="col-lg-12" id="listingData">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h4 class="panel-title">Add Product</h4>
							<ul class="panel-tool-options"> 
								<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
								<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
								<!-- <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li> -->
							</ul> 
						</div>
						
						<div class="panel-body" style="padding-bottom:0px;">
						<div class="row">
                        <div class="col-sm-5">
						<label>Show 
	                        <select name="DataTables_Table_0_length" url="<?=base_url();?>master/Item/manage_item?<?='sku_no='.$_GET['sku_no'].'&productname='.$_GET['productname'].'&contract='.$_GET['contract'].'&usages_unit='.$_GET['usages_unit'].'&comodity='.$_GET['comodity'].'&supplier='.$_GET['supplier'].'&filter='.$_GET['filter'];?>" id="entries" class="">
							<option value="10" <?=$entries=='10'?'selected':'';?>>10</option>
							<option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
							<option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
							<option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
							<option value="<?=$dataConfig['total'];?>" <?=$entries==$dataConfig['total']?'selected':'';?>>ALL</option>
							</select> entries
						</label>
						<p>Showing <?=$dataConfig['page']+1;?> to <?php
						$m=$dataConfig['page']==0?$dataConfig['perPage']:$dataConfig['page']+$dataConfig['perPage'];
						echo $m >= $dataConfig['total']?$dataConfig['total']:$m;
						?> of <?=$dataConfig['total'];?> Entries</p>
						</div>
						
                        <div class="col-sm-7">
						<div class="pull-right">
						<label>Search: &nbsp;&nbsp;<input type="text" id="searchTerm" class="form-control input-sm" onkeyup="doSearch()"  placeholder="What you looking for?" aria-controls="" style="float:right; width:auto;"></label>&nbsp;&nbsp;
						<!-- <button type="button" class="btn btn-sm btn-black btn-outline">Copy</button> -->
						<button type="button" class="btn btn-sm btn-black btn-outline" onclick="exportTableToExcel('tblData')">Excel</button>
						<!-- <button type="button" class="btn btn-sm btn-black btn-outline">PDF</button>
						<button type="button" class="btn btn-sm btn-black btn-outline">Column visibility</button> -->
						</div>
						</div>
						</div> 
						
						</div>
						
						<div class="panel-body">
                        <div class="table-responsive">
				          <table class="table table-striped table-bordered table-hover dataTables-example1" id="tblData" >
							<thead>
							 <tr>
								    <th id="ab"></th>
								    <th style="display:none;">Item Code </th>
							        <th>Item Name </th>
									<!-- <th>Category</th> -->
							        <th style="display:none;">Contract</th>
									<th >UOM</th>
							        <th style="display:none;">Commodity</th>
									<th style="display:none;">Supplier</th>
									
									<th><div style="width:100px;">Action</div></th>
							 </tr>
							</thead>

								<tbody id="dataTable" >
								<form method="get">
								<tr>
									<td style="display:none;"></td>
									<td><input name="check_all" type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></td>
									<!-- <td><input name="category"  type="text"  class="search_box form-control input-sm" value="" /></td> -->
									<td><input name="productname"  type="text"  class="search_box form-control input-sm" value="" /></td>
									<td style="display:none;"><input name="contract"  type="text"  class="search_box form-control input-sm"  value="" /></td>
									<td><input name="usages_unit"  type="text"  class="search_box form-control input-sm" value="" /></td>
									<td style="display:none;"><input name="comodity" type="text"  class="search_box form-control input-sm" value="" /></td>
									<td style="display:none;"><input name="supplier" type="text"  class="search_box form-control input-sm" value="" /></td>
									<td ><button type="submit" class="btn btn-sm btn-black btn-outline" name="filter" value="filter"><span>Search</span></button>
									</td>
								</tr>
								</form>

								<?php  
								$yy=1;
								//if(!empty($result)) {
								// echo "<pre>";
								// print_r($result);
								// echo  "</pre>";
								  foreach($result as $fetch_list)
								  {
								?>

									<tr  class="gradeC record" data-row-id="<?php echo $fetch_list->Product_id; ?>">
									<td id="ab1">
									<?php
									//$productId= $fetch_list->Product_id;
									//$checkProduct=$productId;
									// if($checkProduct=='1')
									//{
									?>
									<input name="cid[]" type="checkbox" id="cid[]" class="sub_chk" data-id="<?php echo $fetch_list->Product_id; ?>" value="<?php echo $fetch_list->Product_id;?>" />
									<?php //} else{	?>
									<?php //}?>
									</td>
									
									<td style="display:none;"><?=$fetch_list->sku_no;?></td>
									<td><?=$fetch_list->productname;?></td>
									
									<td style="display:none;">
                                        <?php
								            $compQuery11 = $this->db->query("select contract,first_name from tbl_product_mapping M,tbl_contact_m C where C.contact_id = M.suplier_id AND M.product_id = '".$fetch_list->Product_id."'");
								            $suplier_name1 = $compQuery11->result();
								            echo $suplier_name1->contract;		  
										?>

										<?=$fetch_list->contract;?>
									</td>
									<td ><?php
									$compQuery1 = $this -> db
									           -> select('*')
									           -> where('serial_number',$fetch_list->usageunit)
									           -> get('tbl_master_data');
											  $keyvalue1 = $compQuery1->row();
									          echo $keyvalue1->keyvalue;		  
									?></td>
									<td style="display:none;"><?=$fetch_list->comodity;?></td>
									<td style="display:none;">
										 <?php
								            $compQuery11 = $this->db->query("select contract,first_name from tbl_product_mapping M,tbl_contact_m C where C.contact_id = M.suplier_id AND M.product_id = '".$fetch_list->Product_id."'");
								            $suplier_name1 = $compQuery11->result();
								            $i = 1;
								           	 foreach ($suplier_name1 as $dtt) {
								           	 	echo '<span >'.$dtt->first_name ."</span>".'&nbsp;/ &nbsp;&nbsp;&nbsp;<br>';
								           	 }	  
										?>
										
										<?php 
										
								           	  
										?>
								    </td>
									<td>
									<?php if($view!=''){ ?>
							         <button class="btn btn-xs btn-black" type="button" onclick ="viewItem(<?=$fetch_list->Product_id;?>);" type="button" data-toggle="modal" data-target="#modal-1" data-backdrop='static' data-keyboard='false'> <i class="fa fa-eye"></i> </button>
							        <?php } if($edit!=''){ ?>
							         <button class="btn btn-xs btn-black" type="button" data-toggle="modal" data-target="#modal-0" arrt= '<?=json_encode($fetch_list);?>' onclick="editItem(this)"> <i class="icon-pencil"></i> </button>
							         <?php }
									$pri_col='Product_id';
									$table_name='tbl_product_stock';
									?>
							         <button class="btn btn-xs btn-black delbutton" type="button" id="<?php echo $fetch_list->Product_id."^".$table_name."^".$pri_col ; ?>"> <i class="icon-trash"></i> </button> 
						            </td>
									
									</tr>
								<!-- /.modal -->
								<?php $i++; } //}?>
								</tbody>
							<input type="text" style="display:none;" id="table_name" value="tbl_product_stock">  
							<input type="text" style="display:none;" id="pri_col" value="Product_id">
					</table>
                    </div>
					<nav aria-label="Page navigation" class="pull-right">
                    <?php echo $pagination; ?>
                </nav> 
            </div>
          </div>
       </div>
       <div id="modal-1" class="modal fade" tabindex="-1" role="dialog">
					<div class="modal-dialog modal-lg">
					  <div class="modal-content">
						<div class="modal-header">
						<button  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Product Details</h4>
						<!-- <div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div>  -->
						</div>
                        <div class="modal-body overflow"  id="viewData">
                        </div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
                    </div>
        </div>

       <div id="modal-0" class="modal fade" tabindex="-1" role="dialog">
					<div class="modal-dialog modal-lg">
					  <div class="modal-content">
						<div class="modal-header">
						<button  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Add Item</h4>
						<div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div> 
						</div>

						<form class="form-horizontal" role="form" method="post"  enctype="multipart/form-data" id="ItemForm" >	
						<div class="modal-body overflow">

						<div class="form-group" style="display: none;"> 
						<label class="col-sm-2 control-label">*Item Type:</label> 
						<div class="col-sm-4"> 
							<select name="type"  class="form-control" id="type">
								<option value="">----Select ----</option>
									<?php 
										$sqlprotype=$this->db->query("select * from tbl_master_data where param_id=17");
											foreach ($sqlprotype->result() as $fetch_protype){
											?>
											<option value="<?php echo $fetch_protype->serial_number;?>"><?php echo $fetch_protype->keyvalue; ?></option>
											<?php } ?>
	                        </select>
						</div> 
						<label class="col-sm-2 control-label" style="display:none;">*Category:</label> 
						<div class="col-sm-4" style="display:none;"> 
						<select name="category"  class="form-control" onchange="changing(this.value)" id="category">
							<option value="">----Select ----</option>
							<?php 
							$sqlgroup=$this->db->query("select * from tbl_category where status = 1  AND inside_cat = 0");
							foreach ($sqlgroup->result() as $fetchgroup){						
							?>					
						      <option value="<?php echo $fetchgroup->id; ?>" ><?php echo $fetchgroup->name ; ?></option>
							<?php } ?>
						</select>
						</div>  
						</div>

						<div class="form-group"> 
						<label class="col-sm-2 control-label">*Item Number:</label> 
						<div class="col-sm-4"> 
							<?php 
								$query=$this->db->query("select * from tbl_product_stock order by Product_id desc");
								$fetchR=$query->row();
								$productId=$fetchR->Product_id+1;
							?>
									
						<input type="hidden" class="hiddenField" id="Product_id"   name="Product_id" value="" />
						<input type="text" class="form-control" name="sku_no" value=""  id="sku_no"> 
						</div> 
						<label class="col-sm-2 control-label" >*Item Name:</label> 
						<div class="col-sm-4"> 
						<input name="item_name"  type="text" value="" class="form-control" id="productname" > 
						</div>
						<!-- <label class="col-sm-2 control-label">*Industry Type:</label> 
						<div class="col-sm-4"> 
						<select name="industry" required class="form-control" id="industry">
							<option value="">----Select ----</option>
							<?php 
							$sqlprotype=$this->db->query("select * from tbl_master_data where param_id=20");
							foreach ($sqlprotype->result() as $fetch_protype){
								?>
							<option value="<?php echo $fetch_protype->serial_number;?>"><?php echo $fetch_protype->keyvalue; ?></option>
							<?php } ?>

						</select>
						</div>  -->
						</div>


						<!--============================================================-->
						<div class="form-group">
							 <label class="col-sm-2 control-label" style="display:none;">Commodity:</label><!-- Supplier  Contract -->
						     <div class="col-sm-4">
						      <input style="display:none;" name="comodity"  type="text" value="" class="form-control" id="comodity" > 
						    </div>
							<label class="col-sm-2 control-label" style="display:none;">*Supplier:</label>
							<div class="col-sm-4" style="display:none;"> 
								<!-- <input name="supplier"  type="text" value="" class="form-control" id="supplier" required> -->
								<select name="supplier" class="form-control" id="supplier">
							    <option value="">----Select----</option>
								<?php 
								$sqlgroup11=$this->db->query("select * from tbl_contact_m where group_name='4'");
								foreach ($sqlgroup11->result() as $fetchgroup11){						
								?>					
							    <option value="<?php echo $fetchgroup11->contact_id; ?>"><?php echo $fetchgroup11->first_name ; ?></option>

							    <?php } ?>
						    </select>
							</div>
					
						</div>


						<!--===========================================================-->

						<div class="form-group">
						<label class="col-sm-2 control-label" >*Contract:</label>
							<div class="col-sm-4"> 
								<input name="contract"  type="text" value="" class="form-control" id="contract" >
							</div>

						<label class="col-sm-2 control-label">*UOM:</label> 
						<div class="col-sm-4"> 
						    <select name="unit"  class="form-control" id="unit">
									<option value="" >----Select Unit----</option>
										<?php 
										$sqlunit=$this->db->query("select * from tbl_master_data where param_id=16");
										foreach ($sqlunit->result() as $fetchunit){
										?>
									<option value="<?php echo $fetchunit->serial_number;?>"><?php echo $fetchunit->keyvalue; ?></option>
										<?php } ?>
							</select>
						</div> 
						</div>
						<div class="form-group" >
						    <label class="col-sm-2 control-label" >*Part Number:</label>
							<div class="col-sm-4"> 
								<input name="part_name"  type="text" value="" class="form-control" id="part_name" >
							</div>
							<label class="col-sm-2 control-label" style="display:none;">Storage Location:</label> 
							<div class="col-sm-4" style="display:none;"> 
							<div id="subcategory1">
							<select name="location[]" class="form-control" id="location" multiple>
							<option value="">----Select----</option>
								<?php 
								$sqlgroup11=$this->db->query("select * from tbl_master_data where param_id = 22");
								foreach ($sqlgroup11->result() as $fetchgroup11){						
								?>					
							    <option value="<?php echo $fetchgroup11->serial_number; ?>"><?php echo $fetchgroup11->keyvalue ; ?></option>
                            <?php } ?>
						    </select>
							</div> 
							</div>
						</div>
						<div class="modal-footer" id="button">
							<input type="submit" class="btn btn-sm btn-black btn-outline" value="Save">
							<button type="button" class="btn btn-sm btn-black btn-outline" data-dismiss="modal">Cancel</button>
						</div>
						</form>
						</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
                    </div>
                     <!-- /.modal -->
    </div>
               
             
    
<script>

function changing(v){
 //alert(v);
  var pro=v;
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "changesubcatg?ID="+pro, false);
  xhttp.send();
   //alert(xhttp.responseText);
   document.getElementById("subcategory1").innerHTML = xhttp.responseText;
   // document.getElementById("subcategory11").innerHTML = xhttp.responseText;
}

</script>	


<script>

function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType    = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML   = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'ProductList_<?php echo date('d-m-Y');?>.xls';
    
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

<?php
$this->load->view("footer.php");
?>

<script>
 function viewItem(viewId){

 	$.ajax({   
	    type: "POST",  
		url: "ajax_viewItemData",  
		cache:false,  
		data: {'id':viewId},  
		success: function(data)  
		{  
		//alert(data); 
		//console.log(data);
		// $("#loading").hide();  
		 $("#viewData").empty().append(data).fadeIn();
		//referesh table
		}   
	});

 }
</script>