<?php

  $hdrQuery=$this->db->query("select *from tbl_inbound_log where po_no='$id'");
  $getHdr=$hdrQuery->row();
?>
        <div class="row">
				<div class="col-lg-12" id="listingData">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h4 class="panel-title">View Inbound Logs</h4>
						      <ul class="panel-tool-options"> 
								<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
								<li><button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></li>
								<!-- <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li> -->
							  </ul> 
						 </div>
		
		 <div class="panel-body">
          <div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
				   <div class="panel-body">
					 <div class="form-group">
					  <div class="col-sm-6">
					 	<label for="company">Storage Location:</label>
					   
							<?php 
								$sqlprotype=$this->db->query("select D.keyvalue,P.purchase_no from tbl_master_data D,tbl_purchase_order_hdr P where D.serial_number = P.company AND D.param_id=22 AND P.purchaseid = $id");
								$resutl = $sqlprotype->row();
							?>
					 	  <input type="text"  class="form-control" value="<?=$resutl->keyvalue; ?>" readonly="readonly"  />

					  </div>
					   <div class="col-sm-6">
					 	<label for="po_order">PURCHASE ORDER NO.:</label>
					    <input type="text"  class="form-control" value="<?=$resutl->purchase_no; ?>" readonly="readonly"  />
					  </div>

                     <!-- <div class="col-sm-6" id="invoiceId" >
					 	<label for="po_order">INVOICE NO.:</label>
					    <input type="text" name="invoice_no"  class="form-control" value="<?=$getHdr->invoice_no;?>" readonly="readonly" required />

					  </div>

                     <div class="col-sm-6" id="grnId" >
					 	<label for="po_order">GRN No.:</label>
					    <input type="text" name="grn_no" class="form-control" required readonly="readonly" value="<?=$getHdr->grn_no;?>"  />
                      </div> -->
					</div>
                  </div>
				</div>
			</div>
		</div>
	<!-- <div class="table-responsive-">
   </div> -->
        
		
		<div class="" id="style-3-y">
		<div class="force-overflow-y">
		<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover " >
		<thead>
		<tr>
		<th class="tdcenter"> Sl No</th>
		<th class="tdcenter">Item Number & Description</th>
		<th class="tdcenter">UOM</th>
		<th class="tdcenter">INVOICE NO</th>
       <th class="tdcenter">GRN No.</th>
       <th class="tdcenter">GRN Date</th> 
        <th class="tdcenter">Receive Qty</th>
      
		
		
		</tr>
		</thead>
        
      <?php
     
		$productQuery=$this->db->query("select receive_qty,productid,inboundrhdr,invoice_no,grn_no,maker_date,receive_qty from tbl_inbound_log where po_no='$id'");
			$i=1;
	      	foreach($productQuery->result() as $getProduct){
	       	####### get product #######
	         	$productStockQuery=$this->db->query("select *from tbl_product_stock where Product_id='$getProduct->productid'");
	        	$getProductStock=$productStockQuery->row();
	      	####### ends ########
		
		####### get UOM #######
		$productUOMQuery=$this->db->query("select *from tbl_master_data where serial_number='$getProductStock->usageunit'");
		$getProductUOM=$productUOMQuery->row();
		####### ends ########
		
		?>
                                    <tr class="gradeX odd" role="row">
                                            <td class="size-60 text-center sorting_1"><?=$i;?></td>
											<td><?=$getProductStock->productname;?>
                                            <input type="hidden"  value="<?=$getProduct->productid;?>" class="form-control">
                                            </td>
											<td><?=$getProductUOM->keyvalue;?></td>
                                            <?php
											 $poLogQuery=$this->db->query("select SUM(qty) as po_qty from tbl_purchase_order_dtl where purchaseorderhdr='$getHdr->po_no' and productid='$getProduct->productid'");
											 $getPoQty=$poLogQuery->row();
											?>

											<td><?=$getProduct->invoice_no;?></td>
                                            
                                            <?php
										 
										      $inbountLogQuery=$this->db->query("select SUM(receive_qty) as rec_qty from tbl_inbound_log where productid='$getProduct->productid' and po_no='$getHdr->po_no'");
											  $getInbound=$inbountLogQuery->row();
											?>
                                            <td><?=$getProduct->grn_no;?></td>
                                            <td><?=$getProduct->maker_date;?></td>
                                            <td><?=$getProduct->receive_qty;?></td> 
											

                                    </tr>
		                        <?php 
							     	$i++;
								} ?>
		</table>
		</div>	  

		</div>
		</div><!--scrollbar-y close-->		

		


		<!-- <div style="width:100%; background:#dddddd; padding-left:0px; color:#000000; border:2px solid "> -->
		


				<!-- <div style="width:100%; background:white;   color:#000000;  max-height:170px; overflow-x:auto;overflow-y:auto;" id="m">
				<table id="invoice"  style="width:100%;background:white;margin-bottom:0px;margin-top:0px;min-height:30px;" title="Invoice" class="table table-bordered blockContainer lineItemTable ui-sortable"  >

				<tr></tr>
				</table> -->
			<!-- </div> -->
		</div>

<input type="hidden" name="rows" id="rows">
<!--//////////ADDING TEST/////////-->
<input type="hidden" name="spid" id="spid" value="d1"/>
<input type="hidden" name="ef" id="ef" value="0" />

<div class="table-responsive">
 <table class="table table-striped table-bordered table-hover" >
	<tbody>
	<!-- 	<tr class="gradeA">
		<th>Sub Total</th>
		<th>&nbsp;</th>
		<th>
		<input type="text" placeholder="Placeholder" id="sub_total" readonly="" name="sub_total" class="form-control">
		</th>
		</tr>

		

        <tr class="gradeA">
		<th>Grand Total</th>
		<th>&nbsp;</th>
		<th><input type="number" readonly="" step="any" id="grand_total" name="grand_total" placeholder="Placeholder" class="form-control"></th>
		</tr>
		<tr class="gradeA">
		<th>&nbsp;</th>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
		</tr>
		<tr class="gradeA">
		<th> -->

		<!-- <th>&nbsp;</th>
		<th >
		
		</th></th> -->
		</tr>
	  </tbody>
    </table>
   </div>
   
   </div>
   <div class ="pull-right" id="saveDiv" >
   
		&nbsp;<a  class="btn btn-sm btn-black btn-outline"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Cancel</a>
   </div>

  </div>
  </div>


