       
                    
						 <div class="panel-body">
				          <div class="row">
							<div class="col-lg-12">
								<div class="panel panel-default">
								   <div class="panel-body">
										<div class="row">
										 <div class="form-group">
										  

										   
					                      <div class="col-sm-3">
											<label for="order_date">ORDER DATE:</label>
											  <input type="date"  class="form-control" id="order_date"  name="order_date" value="<?=$order_date;?>" />
										  </div>
										  <div class="col-sm-3">
											<label for="contact_id_copy"> PICKING No.:</label>
												<input type="text"  class="form-control"   name="pickNo" value="<?=$order_date;?>" />
												<input type="hidden"  class="form-control"   name="pono" value="<?=$_POST['id'];?>" />
											  </div>
											</div>
										 </div>
					                  </div>
								</div>
							</div>
						</div>

				        
						
						<div class="" id="style-3-y" >
						<div class="force-overflow-y">
						<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTables-example_1" id="invo">
						<thead>
						<tr>
						<th class="tdcenter"> Sl No</th>
						<th class="tdcenter">Item Number & Description</th>
						<th class="tdcenter">Ordered Qty</th>
						<th class="tdcenter">stock In Qty</th>
						<!-- <th class="tdcenter">Actual Qty</th> -->
						<!-- <th class="tdcenter">Action</th> -->
						</tr>
						</thead>
						<tbody  id="invoice">
					    <?php 
					     $i = 0;$outboundValue = false;
					     $orderQuery=$this->db->query("select *from tbl_order_dtl where purchaseorderhdr='".$_POST['id']."'");
						 foreach ($orderQuery->result() as  $dttl) {
                            $orderQuery1  = $this->db->query("select sum(receive_qty) as sumQty from tbl_inbound_log where productid='".$dttl->productid."'");
                            $inboundsum1  = $orderQuery1->row();

							$orderQuery2  = $this->db->query("select sum(qty) as sumOutboundQty from tbl_outbound_details where product_id='".$dttl->productid."'");
							$inboundsum2  = $orderQuery2->row();

							
							$outbount     = $inboundsum1->sumQty - $inboundsum2->sumOutboundQty; 

							$proQuery     = $this->db->query("select productname from tbl_product_stock	 where Product_id='".$dttl->productid."'");
                            $proresult    = $proQuery->row();


                            if($outbount < $dttl->qty){
                             $outboundValue = true;
                            }

						 ?>
					    <tr  style="<?=$outbount < $dttl->qty?'background: #f3aaaa;':''?>">    
							<td align="center"><?=$i+1;?></td>
							<td align="center">
                            <?=$proresult->productname;?>
							<input type="hidden" value="<?=$dttl->productid;?>" name="main_id[]" id="main_id<?=$i;?>" readonly="" style="text-align: center; border: hidden;">
							</td>
						
							<td align="center" style="width: 3%;">
							<?=$dttl->qty;?>
							<input type="hidden" name="qty[]" id="qty<?=$i;?>" value="<?=$dttl->qty;?>" readonly="" style="text-align: center; border: hidden;"></td>

							<td align="center"><?=$outbount;?></td>
							
						</tr>

						<?php $i++; } ?>
						
						</tbody>
						</table>
						</div>	  

			     </div>
			    </div><!--scrollbar-y close-->	
			     <input type="hidden" name="rows" id="rows" value="<?=$i;?>">
							<!--//////////ADDING TEST/////////-->
							<input type="hidden" name="spid" id="spid" value="d1"/>
							<input type="hidden" name="ef" id="ef" value="0" />
                           <?php if($outboundValue == false){ ?>
							<div class ="pull-right">
					        <input type="submit" class="btn btn-sm btn-black btn-outline" value="Save" >
							&nbsp;
						    <a data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-black btn-outline">Cancel</a>
   							</div>
                           <?php  }else{ ?>
                              <div style="color:red;">*Red rows are denoting, that Stock In Quantity is less compare to ordered Quantity.</div> 
                           <?php } ?>	
			    	</div>
