
     <?php
     $product    ="";$pid="";$location=""; 
     $suplier_id ="";$locationData="";
     if($result != ""){
        $product   = $result['productname'];
         $pid       = $result['Product_id'];
         $location  = $result['location'];
         $suplier_id= $result['suplier_id'];
         $sqlgroup11=$this->db->query("select D.keyvalue from tbl_master_data D, tbl_product_mapping M where find_in_set(M.location,D.serial_number) AND M.product_id = $pid Group by keyvalue ");
		 $locationData = $sqlgroup11->result();	

		$sqlgroup11=$this->db->query("select D.first_name,contract,M.location as mlocation,M.id as mid from tbl_contact_m D, tbl_product_mapping M where M.suplier_id = D.contact_id AND M.product_id = $pid");
		$suplierData = $sqlgroup11->result();				
				
			//	print_r($locationData);							
							  
                        
      }
     ?>
     <div class="row">
			<div class="col-lg-12">
        <div class="row">
		 <div class="panel-body">
          <div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
											<div class="panel-body">
												<h4>PRODUCT NAME :- <br/> <span style="color: #1b87d2;;"><?=$product;?></span></h4>
												
                                               
												
												<div class="row">
												<div class="col-lg-12">
																					
												  <h5>SUPPLIER DETAILS</h5>
												 <!--  <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>       -->      
												  <table class="table">
												    <thead>
												      <tr>
												        <th>S.No.</th>
												        <th>SUPPLIER</th>
												        <th>contract</th>
												        <th>location</th>
												      </tr>
												    </thead>
												    <tbody>
												  <?php if($suplierData){ 
													$i = 1;
												 foreach($suplierData as $Sdt){ ?>
												      <tr>
												        <td><?=$i;?></td>
												        <td><?=$Sdt->first_name;?></td>
												        <td><?=$Sdt->contract;?></td>
												        <td>
												        	<?php 
 															// echo $Sdt->mid;

												        	 $sqlgroup11=$this->db->query("select D.keyvalue from tbl_master_data D where  D.serial_number IN (".$Sdt->mlocation.")");
		                                                      $locationData = $sqlgroup11->result();
		                                                      if($locationData){ 
																	$m = 1;
																 foreach($locationData as $ldt){ ?>
																  <strong><?=$m;?> &nbsp;)&nbsp;&nbsp;<?=$ldt->keyvalue;?></strong><br>
																 <?php $m++;}} ?>
												         </td>
												      </tr>
												 <?php $i++;}} ?>
												    </tbody>
												  </table>

												</div></div>

											</div>
										</div>
			</div>
		</div>
	<!-- <div class="table-responsive-">
   </div> -->
  </div>

    

   </div>
   <div class ="pull-right">
    
		<a  class="btn btn-sm btn-black btn-outline"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Cancel</a>
    </div>
</div>
</div> 

