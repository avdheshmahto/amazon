<?php
$hdrQuery=$this->db->query("select *from tbl_inbound_hdr where po_no='$id'");
$getHdr=$hdrQuery->row();
?>

 <!-- Main content -->
  <div class="main-content">
	<!-- Breadcrumb -->
		
        <div class="row">
				<div class="col-lg-12" id="listingData">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h4 class="panel-title">View Inbound and Outbond Order Stock</h4>
						      <ul class="panel-tool-options"> 
								
								
								<li><a href="" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></a></li> 
							  </ul> 
						 </div>
		 <div class="panel-body">
          
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
        <th class="tdcenter">Po Qty</th>
		<th class="tdcenter">GRN Qty</th>
       <th class="tdcenter">STN Qty</th>
       <th class="tdcenter">GRN Remaining Qty</th>
        <th class="tdcenter">STN Remaining Qty</th>
		
		
		</tr>
		</thead>
        
      <?php
		$productQuery=$this->db->query("select SUM(receive_qty) as poQty,productid,inboundrhdr,receive_qty from tbl_inbound_dtl where inboundrhdr='$getHdr->inboundid' group by productid ");
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
																								
											<td><?=$getProductStock->productname;?><a  style="display:none;" href="<?=base_url();?>report/view_po_stock_log_grn_stn?poid=<?=$id;?> && pid=<?=$getProduct->productid;?>" target="_blank"><?=$getProductStock->productname;?></a>
                                            
                                            
                                            <input type="hidden"  name="productid[]" value="<?=$getProduct->productid;?>" class="form-control">
                                            </td>
											<td><?=$getProductUOM->keyvalue;?></td>
                                            
                                            <?php
											// po qty
											
											$poQuery=$this->db->query("select *from tbl_purchase_order_dtl where purchaseorderhdr='$id' and productid='$getProduct->productid'");
											
											$getPoQty=$poQuery->row();
											
											?>
                                            
                                            <td><?php echo $poQtyTo=$getPoQty->qty;?>                    
                                            <?php
										 
										$inbountLogQuery=$this->db->query("select SUM(receive_qty) as rec_qty from tbl_inbound_log where productid='$getProduct->productid' and po_no='$getHdr->po_no'");
											$getInbound=$inbountLogQuery->row();
						
						$inbountLogGRNQuery=$this->db->query("select SUM(receive_qty) as rec_qty from tbl_inbound_log where productid='$getProduct->productid' and po_no='$getHdr->po_no'");
											$getInboundGRN=$inbountLogGRNQuery->row();
						
											?>
                                            <td><?=$getInboundGRN->rec_qty;?>
                     
                                            <?php
											
											$poLogQuery=$this->db->query("select SUM(qty) as po_qty from tbl_inbound_outbound_details where poid='$getHdr->po_no' and product_id='$getProduct->productid' and type='outbound'");
											$getPoQty=$poLogQuery->row();
											?>
											<td><?=$getPoQty->po_qty;?></td>
                                               <td><?=$poQtyTo-$getInboundGRN->rec_qty;?>
                                               <td><?=$getInboundGRN->rec_qty-$getPoQty->po_qty;?>
                                            
                                            <input type="hidden" name="inboundrhdr" value="<?=$getProduct->purchaseorderhdr?>" />
                                            </td>
                                           
						</tr>
                        <?php 
						$i++;
						}?>
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
</div>

