					 <?php
					    $poid        = "";$purchase_contact =""; $supplier_contact = ""; $fob_incoterms	='';
						$order_date  = "";$revised_date     =""; $revised_by       = ""; $terms	        ='';
						$purchase_no = "";$ship_method      =""; $ship_vip		   = ""; $supplier	    ='';
						$freight     = "";$company          =""; $po_status		   = ""; $dtlData	    ='';

                      if($result != ""){
                         $poid               = $result['purchaseid'];
                         $purchase_contact   = $result['purchase_contact'];
                         $supplier_contact   = $result['supplier_contact'];
                         $fob_incoterms		 = $result['fob_incoterms'];
                         $order_date         = $result['order_date'];
                         $revised_date       = $result['revised_date'];
                         $revised_by         = $result['revised_by'];
                         $terms              = $result['terms'];
                         $purchase_no        = $result['purchase_no'];
                         $ship_method        = $result['ship_method'];
                         $ship_vip           = $result['ship_vip'];
                         $supplier           = $result['supplier'];
                         $freight            = $result['freight'];
                         $company            = $result['company'];
                         $po_status          = $result['po_status'];
                         $dtlData            = $result['dtlData'];
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
										<!-- <th>Unit</th> -->
										<th>Location</th>
										<th>Action</th>
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
												<!-- <img  style="display:none" src="<?php echo base_url();?>/assets/images/search11.png"  onClick="openpopup('<?=base_url();?>SalesOrder/all_product_function',1200,500,'view',<?=$sales[$i]['1'];?>)" /> -->
										    </div>
					                        </div>
											<div id="prdsrch" style="color:black;padding-left:0px; width:95.5%; height:110px; max-height:110px;overflow-x:auto;overflow-y:auto;padding-bottom:5px;padding-top:0px; position:absolute;">
											 <?php
											   $this->load->view('getproduct');
					                         ?>
											</div>
										</td>
				                        <!-- <td>
										<input type="text" readonly="" id="usunit" style="width:120px;" class="form-control"> 
										</td> -->
					                    <td>
										  <b id="lpr"></b>
										  <?php 
										$i=0;  
											$sqlprotype=$this->db->query("select * from tbl_master_data where param_id=22");
											foreach ($sqlprotype->result() as $fetch_protype){
											?>
											<div class="col-sm-4"> 
											  <div class="checkbox"> <label> <input class="loc<?=$i;?>" id="locationid" value="<?=$fetch_protype->keyvalue;?>" type="checkbox" name="locationval[]" idval = "<?=$fetch_protype->serial_number; ?>"> <?=$fetch_protype->keyvalue; ?></label> </div>
										    </div>

                                          <?php $i++;} ?>
                                             <input type="hidden" id="locIdval"  value="" class="form-control" style="width:70px;" > 
									    </td> 
										<td>
											
										<input type="hidden" id="contact"  value="<?=$contact;?>" name = "contact" class="form-control"> 
										<input id="addRow"  value="ADD" class="form-control" style="width:70px;"readonly> 
                                       
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
					     if($result != ""){
					     	// echo "<pre>";
					     	//   print_r($result);
					     	// echo "</pre>";
					     foreach ($result as  $dttl) {
					     	$proVal = $dttl['productname'];
					     	$proId  = $dttl['product_id'];
                        ?>
					    <tr>
							<td align="center"><?=$i;?></td>
							<td align="center">
								<input type="text" class="form-control" name="pd[]" id="pd<?=$i;?>" value='<?=$proVal;?>^<?=$proId;?>' readonly="" style="text-align: center; border: hidden;">
								<input type="hidden" value="<?=$proId;?>" name="main_id[]" id="main_id<?=$i;?>" readonly="" style="text-align: center; border: hidden;">
								<input type="hidden" value="<?=$dttl['umo'];?>" name="unit1[]" id="unit<?=$i;?>" readonly="" style="text-align: center; border: hidden;">
							</td>
							<td align="center">
 							<?php 

 							$mlocation   = $dttl['mloc'];
 							$unitQuery   = $this->db->query("select * from tbl_master_data where serial_number IN($mlocation)");
				            $getUnit     = $unitQuery->result();
				            $keylocation = array();
				            foreach ($getUnit as $dts) {
				            	$keylocation[] = $dts->keyvalue;
				            }
				            //print_r($keylocation);
				            $commalocation = implode(',', $keylocation);

 							?>
                            <input type="text" class="form-control" id="loc<?=$i;?>" value="<?=$commalocation;?>"  readonly="" style="text-align: center; border: hidden;">
							<input type="hidden" name="locationidVal[];" id="locatId<?=$i;?>" value="<?=$dttl['mloc'];?>" readonly="" class="valid" aria-invalid="false" style="text-align: center; border: hidden;">
                            <!-- <input type="hidden" name="unit[]" value="<?=$dttl['umo'];?>" id="unit<?=$i;?>" readonly="" style="text-align: center; border: hidden;"> -->
							</td>
							<!-- <td align="center" style="width: 3%;">
								<input type="text" name="qty[]" id="qty<?=$i;?>" value="<?=$dttl['qty'];?>" readonly="" style="text-align: center; border: hidden;">
							</td> -->
							<td align="center">
								<button type="button" class="btn btn-xs btn-black" name="ed" onclick = "editselectrow(this.id,this);"  id="ed<?=$i;?>"  style="margin-right: 10px;"><i class="icon-pencil"> </i>
								</button>
								<button type="button" class="btn btn-xs btn-black" name="dlt" id="dlt<?=$i;?>" onclick = "deleteselectrow(this.id,this);"><i class="icon-trash"> </i></button>
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
					        <button class="btn btn-sm btn-black btn-outline" type="button" id="mapingbutton" >Save</button>
							&nbsp;
						    <a data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-black btn-outline">Cancel</a>
   							</div>
