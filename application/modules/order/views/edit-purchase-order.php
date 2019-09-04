					 <?php
					    $poid        = "";$destination_contact =""; $contact_id = ""; $fob_incoterms	='';
						$order_date  = "";$company          ="";    $dtlData	    ='';$consignee_id='';$consignee_details='';$consignee_address='';

                      if($result != ""){
                         $poid               = $result['purchaseid'];
                         $contact_id         = $result['contact_id'];
						 $consignee_id         = $result['consignee_id'];
						 $consignee_details         = $result['consignee_details'];
						 
						 $consignee_address =$result['consignee_address'];
						$docket_no =$result['docket_no'];
						$vehicle_no =$result['vehicle_no'];
						 
                         $destination_contact= $result['destination_contact'];
                        
                         $order_date         = $result['order_date'];
                         $company            = $result['company'];
                         $dtlData            = $result['dtlData'];

					    }

                     ?>

       
                    
						 <div class="panel-body">
				          <div class="row">
							<div class="col-lg-12">
								<div class="panel panel-default">
								   <div class="panel-body">
										<div class="row">
										 <div class="form-group">
										  <div class="col-sm-3">
										 	<label for="company">STORAGE LOCATION:</label>
										    <select name="company"  class="form-control" id="company" onchange= "maplocation(this.value)" required>
											   <option value="">----Select ----</option>
												<?php 
													$sqlprotype=$this->db->query("select * from tbl_master_data where param_id=22");
													foreach ($sqlprotype->result() as $fetch_protype){
												?>
										 	   <option value="<?php echo $fetch_protype->serial_number;?>" <?=$company==$fetch_protype->serial_number?'selected':'';?> ><?php echo $fetch_protype->keyvalue; ?></option>
												<?php } ?>
						                    </select>
						                    <input type="hidden" name="poid" value="<?=$poid;?>">
										  </div>
<div class="col-sm-3">
											<label for="contact_id_copy">REQUETOR CONTACT:</label>
												<select name="contact_id"   id="contact_id_copy" onchange="destinationfunction(this.value);" class="form-control">
													<option value="" selected disabled>Select</option>
													<?php
													$contQuery = $this->db->query("select * from tbl_contact_m where status='A' and group_name='5'");
													 foreach($contQuery->result() as $contRow)
													 { ?>
													<option value = "<?php echo $contRow->contact_id; ?>"  <?=$contRow->contact_id==$contact_id?'selected':'';?>>
													<?php echo $contRow->first_name.' '.$contRow->middle_name.' '.$contRow->last_name; ?>
													</option>
													<?php } ?>
												</select>
											  </div>
										   <div class="col-sm-3">
										 	<label for="po_order">Requestor Destination:</label>
										 	 
											
											   <select name="destination" required  id="destination" onchange="mapconsigneeAddress(this.value);" class="form-control">
												<option value="" selected disabled>Select</option>
													<?php
													$contQuery=$this->db->query("select * from tbl_contact_m where status='A' and group_name='7'");
													foreach($contQuery->result() as $contRow)
													{
													?>
														<option value="<?php echo $contRow->contact_id; ?>"  <?=$destination_contact==$contRow->contact_id?'selected':'';?>>
														<?php echo $contRow->first_name.' '.$contRow->middle_name.' '.$contRow->last_name; ?>
														</option>
													<?php } ?>
										   	    </select>
											
										   
										   <!--  <input type="text"  class="form-control" id="destination"  name="order" value="" onblur="CheckPo(this.value,this);"  autocomplete="off" /> -->
					                      </div>
					                      <div class="col-sm-3">
											<label for="order_date">STN DATE:</label>
											  <input type="date"  class="form-control" id="order_date"  name="order_date" value="<?=$order_date;?>" />
										  </div>
										  
                                              
                                              
                        
                        <div class="col-sm-3">
						<label for="contact_id_copy"> CONSIGNEE NAME:</label>
                        
                        <input type="text"  class="form-control" id="consignee_id"  name="consignee_id" value="<?=$consignee_id?>" />
						
					    </div>
                        <div class="col-sm-3">
						<label for="contact_id_copy"> CONSIGNEE DETAILS:</label>
                        
                        <input type="text"  class="form-control" id="consignee_details"  name="consignee_details" value="<?=$consignee_details;?>" />
						
					    </div>
                        
                        <div class="col-sm-3">
						<label for="contact_id_copy"> CONSIGNEE ADDRESS:</label>
                        
                        <input type="text"  class="form-control" id="consignee_address"  name="consignee_address" value="<?=$consignee_address;?>" />
						
					    </div>
                        
                        <div class="col-sm-3">
						<label for="contact_id_copy"> DOCKET NO.:</label>
                        
                        <input type="text"  class="form-control" id="docket_no"  name="docket_no" value="<?=$docket_no;?>" />
						
					    </div>
                        
                        <div class="col-sm-3">
						<label for="contact_id_copy"> Vehicle NO.:</label>
                        
                        <input type="text"  class="form-control" id="vehicle_no"  name="vehicle_no" value="<?=$vehicle_no;?>" />
						
					    </div>
											</div>
										 </div>
					                  </div>
								</div>
							</div>
						</div>

				        <div class="table-responsive ">
								<table class="table table-striped table-bordered table-hover" >
									<tbody>
									 <tr class="gradeA">
									 	<!--   -->
										<th>Product Name</th>
										<th>Unit</th>
										<th>Quantity</th>
										<th style="display: none;">Actual Qty</th>
										<!-- <th>Ordered Qty</th>
										<th>Effective Qty</th> -->
									 </tr>

									<tr class="gradeA">
										<!-- <td class="tdcenter"> &nbsp;</td> -->
										<td style="width:280px;">
											<div class="input-group"> 
											<div style="width:100%; height:28px;">
											<input type="text" name="prd"  onkeyup="getdata()" class="form-control" onClick="getdata()" id="prd" style=" width:230px;"  placeholder=" Search Items..." autocomplete="off">
											<input type="hidden"  name="pri_id" id='pri_id'  value="" style="width:80px;"  />
												<!-- <img  style="display:none" src="<?php echo base_url();?>/assets/images/search11.png"  onClick="openpopup('<?=base_url();?>SalesOrder/all_product_function',1200,500,'view',<?=$sales[$i]['1'];?>)" /> -->
										    </div>
					                        </div>
											<div id="prdsrch" style="color:black;padding-left:0px; width:30%; height:110px; max-height:110px;overflow-x:auto;overflow-y:auto;padding-bottom:5px;padding-top:0px; position:absolute;">
											 <?php
											   $this->load->view('getproduct');
					                         ?>
											</div>
										</td>
				                        <td>
										<input type="text" readonly="" id="usunit" style="width:70px;" class="form-control"> 
										</td>
					                    <td>
										  <b id="lpr"></b>
										  <input type="number" step="any" id="lph" min="1"  value="" class="form-control" style="width:70px;">
									    </td> 
										<td style="display: none;"><input type="text"   id="qty_stock" class="form-control"  style="width:70px;" readonly></td>
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
						<th class="tdcenter">UOM</th>
						<th class="tdcenter">Ordered Qty</th>
						<!-- <th class="tdcenter">Actual Qty</th> -->
						<th class="tdcenter">Action</th>
						</tr>
						</thead>
						<tbody  id="invoice">
					    <?php 
					     $i = 1;
					     foreach ($dtlData as  $dttl) {
                        ?>
					    <tr>
							<td align="center"><?=$i;?></td>
							<td align="center">
								<input type="text" name="pd[]" id="pd<?=$i;?>" value="<?=$dttl['productname'];?>^<?=$dttl['productid'];?>" readonly="" style="text-align: center; border: hidden;">
								<input type="hidden" value="<?=$dttl['productid'];?>" name="main_id[]" id="main_id<?=$i;?>" readonly="" style="text-align: center; border: hidden;">
								<input type="hidden" value="<?=$dttl['umo'];?>" name="unit1[]" id="unit<?=$i;?>" readonly="" style="text-align: center; border: hidden;">
							</td>
							<td align="center">
								<input type="text" name="unit[]" value="<?=$dttl['umo'];?>" id="unit<?=$i;?>" readonly="" style="text-align: center; border: hidden;">
							</td>
							<td align="center" style="width: 3%;">
								<input type="text" name="qty[]" id="qty<?=$i;?>" value="<?=$dttl['qty'];?>" readonly="" style="text-align: center; border: hidden;">
							</td>
							<td align="center">
								<button type="button" class="btn btn-xs btn-black" name="ed" onclick = "editselectrow('<?=$i;?>',this);"  id="ed<?=$i;?>"  style="margin-right: 10px;"><i class="icon-pencil"> </i>
								</button>
								<button type="button" class="btn btn-xs btn-black" name="dlt" id="dlt<?=$i;?>" onclick = "deleteselectrow('<?=$dttl['productid'];?>',this);"><i class="icon-trash"> </i></button>
							</td>
						</tr>

						<?php 
						 $i++;} ?>
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
