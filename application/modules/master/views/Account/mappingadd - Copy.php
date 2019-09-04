					 <?php
					    $poid        = "";$purchase_contact =""; $supplier_contact = ""; $fob_incoterms	='';
						$order_date  = "";$revised_date     =""; $revised_by       = ""; $terms	        ='';
						$purchase_no = "";$ship_method      =""; $ship_vip		   = ""; $supplier	    ='';
						$freight     = "";$company          =""; $po_status		   = ""; $dtlData	    ='';

                      if($result != ""){
                         // $poid               = $result['purchaseid'];
                         // $purchase_contact   = $result['purchase_contact'];
                         // $supplier_contact   = $result['supplier_contact'];
                         // $fob_incoterms		 = $result['fob_incoterms'];
                         // $order_date         = $result['order_date'];
                         // $revised_date       = $result['revised_date'];
                         // $revised_by         = $result['revised_by'];
                         // $terms              = $result['terms'];
                         // $purchase_no        = $result['purchase_no'];
                         // $ship_method        = $result['ship_method'];
                         // $ship_vip           = $result['ship_vip'];
                         // $supplier           = $result['supplier'];
                         // $freight            = $result['freight'];
                         // $company            = $result['company'];
                         // $po_status          = $result['po_status'];
                         $dtlData            = $result['result'];
					    }

					    // echo "<pre>";
					    //  print_r($result);
					    // echo "</pre>";
                      ?>

       
                    
						 <div class="panel-body">
				        

				            <div class="table-responsive ">
								<table class="table table-striped table-bordered table-hover" >
									<tbody>
									 <tr class="gradeA">
									 	<!--   -->
										<th>Product Name</th>
										<th>location</th>
										<th>Quantity</th>
										<!-- <th>Actual Qty</th> -->
										<!-- <th>Ordered Qty</th>
										<th>Effective Qty</th> -->
									 </tr>

									<tr class="gradeA">
										<!-- <td class="tdcenter"> &nbsp;</td> -->
										<td style="width:280px;">
											<div class="input-group"> 
											<div style="width:100%; height:28px;">
											<input type="text" name="prd"  onkeyup="getdata()" class="form-control" onClick="getdata()" id="prd" style=" width:230px;"  placeholder=" Search Items..." tabindex="5" autocomplete="off">
											<input type="hidden"  name="pri_id" id='pri_id'  value="" style="width:80px;"  />
											 </div>
					                        </div>
											<div id="prdsrch" style="color:black;padding-left:0px; width:30%; height:110px; max-height:110px;overflow-x:auto;overflow-y:auto;padding-bottom:5px;padding-top:0px; position:absolute;">
											 <?php
											   $this->load->view('getproduct');
					                         ?>
											</div>
										</td>
				                        <td>
<div class="col-sm-6"> 
<div class="checkbox"> <label> <input type="checkbox">Checkbox 1</label> </div> 
<div class="checkbox"> <label> <input type="checkbox">Checkbox 3</label> </div>
</div>

<div class="col-sm-6"> 
<div class="checkbox"> <label> <input type="checkbox">Checkbox 2</label> </div> 
<div class="checkbox"> <label> <input type="checkbox">Checkbox 4</label> </div>
</div>
										
<!--<select name="company1"  class="form-control" id="company1">
<option value="">----Select ----</option>
<?php 
$sqlprotype=$this->db->query("select * from tbl_master_data where param_id=22");
foreach ($sqlprotype->result() as $fetch_protype){
?>
<option value="<?php echo $fetch_protype->serial_number;?>" <?=$company ==$fetch_protype->serial_number?'selected':'';?> ><?php echo $fetch_protype->keyvalue; ?></option>
<?php } ?>
</select>-->
										</td>
					                    <td>
										  <b id="lpr"></b>
										  <button type="number" step="any" id="lph" class="form-control" style="width:70px;">Add</button> 
									    </td> 
										<!-- <td><input type="text"   id="qty_stock" class="form-control"  style="width:70px;" readonly></td> -->
										<!-- <td><input type="text"   id="ordered_qty" class="form-control"   style="width:70px;" readonly></td>
										<td><input type="text"   id="effective_qty" class="form-control" style="width:70px;"readonly / ></td> -->
									</tr>
								  </tbody>
							</table>
				        </div>
						
						<div class="" id="style-3-y">
						<div class="force-overflow-y">
						<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTables-example_1" id="invo">
						<thead>
						<tr>
						<th class="tdcenter"> Sl No</th>
						<th class="tdcenter">Item Number & Description</th>
						<th class="tdcenter">Location</th>
						<!-- <th class="tdcenter">Ordered Qty</th> -->
						<!-- <th class="tdcenter">Actual Qty</th> -->
						<th class="tdcenter">Action</th>
						</tr>
						</thead>
						<tbody  id="invoice">
					    <?php 
					     $i = 1;
					     if($dtlData == ""){
					     foreach ($result as  $dttl) {
                        ?>
					    <tr>
							<td align="center"><?=$i;?></td>
							<td align="center">
								<input type="text" class="form-control" name="pd[]" id="pd<?=$i;?>" value="<?=$dttl['productname'];?>^<?=$dttl['productid'];?>" readonly="" style="text-align: center; border: hidden;">
								<input type="hidden" value="<?=$dttl['productid'];?>" name="main_id[]" id="main_id<?=$i;?>" readonly="" style="text-align: center; border: hidden;">
								<input type="hidden" value="<?=$dttl['umo'];?>" name="unit1[]" id="unit<?=$i;?>" readonly="" style="text-align: center; border: hidden;">
							</td>
							<td align="center">
								<input type="text" class="form-control" name="unit[]" value="<?=$dttl['keyvalue'];?>" id="unit<?=$i;?>" readonly="" style="text-align: center; border: hidden;">

								<input type="hidden" name="unit[]" value="<?=$dttl['umo'];?>" id="unit<?=$i;?>" readonly="" style="text-align: center; border: hidden;">
							</td>
							<!-- <td align="center" style="width: 3%;">
								<input type="text" name="qty[]" id="qty<?=$i;?>" value="<?=$dttl['qty'];?>" readonly="" style="text-align: center; border: hidden;">
							</td> -->
							<td align="center">
								<button type="button" class="btn btn-xs btn-black" name="ed" onclick = "editselectrow('<?=$i;?>',this);"  id="ed<?=$i;?>"  style="margin-right: 10px;"><i class="icon-pencil"> </i>
								</button>
								<button type="button" class="btn btn-xs btn-black" name="dlt" id="dlt<?=$i;?>" onclick = "deleteselectrow('<?=$i;?>',this);"><i class="icon-trash"> </i></button>
							</td>
						</tr>

						<?php 
						 $i++;}} ?>
						</tbody>
						</table>
						</div>	  

			     </div>
			    </div><!--scrollbar-y close-->		
			</div>
			         <input type="hidden" name="rows" id="rows" value="<?=$i-1;?>">
							<!--//////////ADDING TEST/////////-->
							<input type="hidden" name="spid" id="spid" value="d1"/>
							<input type="hidden" name="ef" id="ef" value="0" />

							<div class ="pull-right">
					        <button class="btn btn-sm btn-black btn-outline" type="button"  id="editpofunction" >Save</button>
							&nbsp;
						 <a data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-black btn-outline">Cancel</a>
   							</div>
