						<div class="modal-header">
						<button  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">View  Order</h4>
						<div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div> 
						</div>
                         <div class="panel-body" >		
                              <?php if($result !=""){ 
                                 // echo "<pre>";
                              	  //  print_r($result);
                              	  // echo  "</pre>";
                              	?> 
									<div class="row">
									<div class="col-lg-12">
									
										<div class="panel panel-default">
										   <div class="panel-body">
                                              <div class="col-sm-6">
											 	<label for="company">STORAGE LOCATION: </label>
											        <?php 
													$sqlcompany  = $this->db->query("select * from tbl_master_data where serial_number = '".$result['company']."'");
													$resultmst      =  $sqlcompany->row();
													?>
													<b><?=$resultmst->keyvalue;?></b>
													<br/>
													 <label for="contact_id_copy"> REQUESTOR NAME: </label>
												   <?php
													$contQuery = $this->db->query("select * from tbl_contact_m where contact_id='".$result['contact_id']."'");
													$cont_val  = $contQuery->row();
													echo        $cont_val->first_name;
													?><br>
													
                                                   
												     <label for="supplier_contact"> REQUESTOR LOCATION CODE:- &nbsp; </label>
												      <?php
												     // echo "select * from tbl_contact_m where contact_id='".$result['supplier_contact']."'";
													   $contQuery = $this->db->query("select * from tbl_contact_m where contact_id='".$result['destination_contact']."'");
													   $cont_val  = $contQuery->row();
													   echo        $cont_val->code;
												   	  ?> 
												   	  <br/>
													
													 <label for="contact_id_copy"> REQUESTOR ADDRESS: </label>
												    <?php echo $result['requestor_address'];?><br>

											 	    <label for="order_date">ORDER DATE : </label>
												       <?=$result['order_date'];?>
												    <br>

												   												   
											   </div>
											  
											    <div class="col-sm-6">
												 <label for="supplier_contact">  CONSIGNEE LOCATION: </label>
												  <?php
												    $sqlcompany  = $this->db->query("select * from tbl_master_data where serial_number = '".$result['consignee_id']."'");
													$resultmst   =  $sqlcompany->row();
												  ?> 
												<?=$resultmst->keyvalue;?>
											    </div>
											    <div class="col-sm-6">
												 <label for="contact_id_copy"> CONSIGNEE LOCATION CODE: </label>
												   <?php
													$contQuery = $this->db->query("select * from tbl_contact_m where contact_id='".$result['consignee_details']."'");
													$cont_val  = $contQuery->row();
													echo        $cont_val->code ;
													?><br>
													
                                                   
												     <label for="supplier_contact"> CONSIGNEE ADDRESS: </label>
												      <?=stripslashes($result['consignee_address']);?> 
											    </div>
											    <div class="col-sm-6">
												   <label for="contact_id_copy"> STN NUMBER: </label>
												      <?=$result['stn_no'];?><br>
												   <label for="supplier_contact">STN DATE: </label>
												      <?=$result['order_date'];?>
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