						<div class="modal-header">
						<button  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">View Purchase Order</h4>
						<div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div> 
						</div>
                         <div class="panel-body" >		
                              <?php if($result !=""){ ?> 
									<div class="row">
									<div class="col-lg-12">
									
										<div class="panel panel-default">
										   <div class="panel-body">
                                              <div class="col-sm-6">
											 	<label for="company">Company Name : </label>
											        <?php 
													$sqlcompany  = $this->db->query("select * from tbl_master_data where serial_number = '".$result['company']."'");
													$resultmst      =  $sqlcompany->row();
													?>
													<b><?=$resultmst->keyvalue;?></b>
													<br/>
													<label for="po_order">PURCHASE ORDER : </label>
											 	    <strong><?=$result['purchase_no'];?></strong>
											 	    <br/>
											 	    <label for="order_date">ORDER DATE : </label>
												       <?=$result['order_date'];?>
												       <br>
												    <label for="contact_id_copy">PURCHASER CONTACT : </label>
												   <?php
													$contQuery = $this->db->query("select * from tbl_contact_m where contact_id='".$result['purchase_contact']."'");
													$cont_val  = $contQuery->row();
													echo        $cont_val->first_name ;
													?><br>
													<label for="terms">TERMS : </label>
												    <?=$result['terms'];?>
												    <br>
                                                   
												     <label for="supplier_contact">SUPPLIER CONTACT : </label>
												      <?php
												     // echo "select * from tbl_contact_m where contact_id='".$result['supplier_contact']."'";
													   $contQuery = $this->db->query("select * from tbl_contact_m where contact_id='".$result['supplier_contact']."'");
													   $cont_val  = $contQuery->row();
													   echo        $cont_val->first_name;
												   	  ?> <br>
												    <label for="fob_incoterms">FOB/INCOTERMS : </label>
 													 <?=$result['fob_incoterms'];?>

											   </div>
											  
									       

												<div class="col-sm-6">
												 <label for="revised_date">REVISED DATE : </label>
												   <?=$result['revised_date'];?>
												   <br>
												    <label for="revised_by">REVISED BY : </label>
												    <?=$result['revised_by'];?>
												    <br>
												    <label for="ship_method">SHIP METHOD : </label>
												     <?=$result['ship_method'];?>
												    <br>
												    <label for="ship_vip">SHIP VIA : </label>
												     <?=$result['ship_vip'];?>
												     <br>
												     <label for="supplier">SUPPLIER SITE ID : </label>
												     <?=$result['supplier'];?>
												     
													<br>

													<label for="freight">FREIGHT : </label>
												    <?=$result['freight'];?>
											    </div>

									       </div>
										</div>
									
									</div>
								</div>
								<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example_1" id="invo">
									<thead>
									<tr>
						                <th class="tdcenter"> Sl No</th>
									    <th class="tdcenter">Item Number & Description</th>
										<th class="tdcenter">UOM</th>
										<th class="tdcenter">Ordered Qty</th>
									</tr>
									</thead>
									<?php if(sizeof($result['dtlData']) > 0){ ?>
									<tbody  id="invoice">
									<?php 	
									$i = 1;
									foreach ($result['dtlData'] as $dtt) { ?>
										<tr>
										<td class="tdcenter"><?=$i;?></td>
										<td class="tdcenter"><?=$dtt['productname'];?></td>
										<td class="tdcenter"><?=$dtt['umo'];?></td>
										<td class="tdcenter"><?=$dtt['qty'];?></td>
									</tr>
									<?php 
									$i++;} ?>
								    </tbody>
								   <?php } ?>
						        </table>
					        </div>

					        <?php } ?>
					</div>