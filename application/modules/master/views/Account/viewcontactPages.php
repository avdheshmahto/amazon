
     <?php
     
     $group_name    = "";  $contact_id   = "";   $account_name = ""; 
     $suplier_id    = "";  $locationData = "";   $account_name = ""; 
     $proresult=array();   $contract     = "";   $entity       = "";
     $entity_code 	= "";  $email        = "";   $address1     = "";
     $location      = "";

     if($result != ""){
         $first_name    = $result['first_name'];
         $contact_id    = $result['contact_id'];
         $email         = $result['email'];
         $code          = $result['code'];
        
         $group_name    = $result['group_name'];
         $account_name  = $result['account_name'];
         $contract      = $result['contract'];
         $entity        = $result['entity'];
         $entity_code   = $result['entity_code'];
         $address1      = $result['address1'];
         $location      = $result['location'];
         
       if($group_name == 4){  
         $sqlproduct = $this->db->query("select * from tbl_product_stock P, tbl_product_mapping M where P.Product_id = M.product_id AND M.suplier_id = $contact_id");
		 $proresult  = $sqlproduct->result();	
		//print_r($proresult);
       }
        if($group_name == 5){ 
       //echo "select * from tbl_contact_m  where contact_id IN ($entity)";
         $sqlgroup11    = $this->db->query("select keyvalue from tbl_master_data  where  serial_number IN ($entity)");
         $RequesterData = $sqlgroup11->result();				
		//print_r($RequesterData);	
		$exp_entity_code = explode('^', $entity_code);	
		}		
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
						<h4>Contact NAME :- <span style="color: #1b87d2;;"><?=$first_name;?></span></h4>
						<div class="row">
						<div class="col-lg-12">
							 <?php if($group_name != 4){ ?> 
							<p> Email ID :- <b><?=$email;?></b> <br/>
							   Code :- <b><?=$code;?></b><br/>
							 <?php } ?>
							   <?php if($group_name == 8){ 
							   	$sqlgroup2    = $this->db->query("select keyvalue from tbl_master_data  where  serial_number IN ($location)");
                               $RequesterData2 = $sqlgroup2->row();
                               $keyval = $RequesterData2->keyvalue;
							   	?>
							   Address :- <b><?=$address1;?></b> <br/>
							   Location :- <b><?=$keyval;?></b>
							   
							   <?php } ?>
                             
							</p>
							<!--  <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>       -->  
						<?php if($group_name != 8){ ?>
 						  <h5><?=strtoupper($account_name);?> DETAILS</h5>
 					    <?php } ?>

		                <?php if($group_name == 4){   ?> 
							<table class="table">
							<thead>
						      <tr>
						        <th>S.No.</th>
						        <th>Product</th>
						        <th>contract</th>
						       <!--  <th>location</th> -->
						      </tr>
						    </thead>
						    <tbody>
						  <?php if($proresult){ 
							$i = 1;
						 foreach($proresult as $Sdt){ ?>
						      <tr>
						        <td><?=$i;?></td>
						        <td><?=$Sdt->productname;?></td>
						        <td><?=$contract;?></td>
						     </tr>
						 <?php $i++;}} ?>
						    </tbody>
						  </table>
		    <?php } ?>

		    		<?php if($group_name == 5){   ?> 
							<table class="table" style="display: none !important;">
							<thead>
						      <tr>
						        <th>S.No.</th>
						        <th>Amazon Entity</th>
						        <th>Location code</th>
						       <!--<th>location</th> -->
						      </tr>
						    </thead>
						    <tbody>
						  <?php if($RequesterData){ 
							$i = 1; $entitycodearr="";
						 foreach($RequesterData as $Sd){ ?>
						      <tr>
						        <td><?=$i;?></td>
						        <td><?=$Sd->keyvalue;?></td>
						        <td>
						        	<?php

						        	if($exp_entity_code[$i-1] != ""){
                                      $entitycodearr = $exp_entity_code[$i-1];
						        	}
						        	 $first_namearr = array();
						        	 $sqlcode      = $this->db->query("select code from tbl_contact_m  where  contact_id IN ($entitycodearr)");
                                     $sqlcoderesult = $sqlcode->result();
                                     foreach($sqlcoderesult as $Stdd){ 
                                     	$first_namearr[] = $Stdd->code;
                                     }
                                     echo $first_namecomma = implode(',', $first_namearr)
						        	?>
						        </td>
						      </tr>
						 <?php $i++;}} ?>
						    </tbody>
						  </table>
		            <?php } ?>

                        </div>
					  </div>
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

