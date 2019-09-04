<?php
class model_purchase_order extends CI_Model {
	
function invoice_data()
{

	  $query=$this->db->query("select * from tbl_order_hdr order by purchase_no asc");
	  return $result=$query->result();  
}

//===================Po==============

public function getPO($last,$strat)
  {

	  $query=$this->db->query("select * from tbl_order_hdr where status='A' Order by purchaseid desc limit $strat,$last ");
	  return $result=$query->result();  
  }

function filterPurchaseOrder($perpage,$pages,$get)
{
 	$qry = "select * from tbl_order_hdr where status = 'A'";
		if(sizeof($get) > 0)
			{
					
		   if($get['location'] != ""){
		   
             $sqlpoComp  = $this->db->query("select * from tbl_master_data  where param_id = 22 AND keyvalue = '".$get['location']."'");
			 $getComp    = $sqlpoComp->row();
			 // foreach ($getComp as $value) {
			 //   echo $value['serial_number'];
			 // }
             $qry .= " AND company =".$getComp->serial_number."";
		   }
					 
		   if($get['destination'] != ""){
		   	  $contactQuery = $this->db->query("select * from tbl_contact_m where group_name = 7 AND first_name like '%".$get['destination']."%' ");
		      $contactVal   = $contactQuery->row();
		     $qry .= " AND destination_contact = '".$contactVal->contact_id."'";
		   }
              	   	  
		   if($get['puchase_contact'] != "")
		   {

		   $contactQuery = $this->db->query("select * from tbl_contact_m where group_name = 5 AND first_name like '%".$get['puchase_contact']."%' ");
		   $contactVal   = $contactQuery->row();
		   $contactVal   = $contactVal->contact_id;
		   $qry         .= " AND contact_id ='$contactVal'";
  	   	  
  	   	   }  
					   
		   if($get['order_date'] != "")
		       $qry .= " AND order_date = '".$get['order_date']."'";

					   
					
				 }
 
    $data =  $this->db->query($qry)->result();
  return $data;
}

function count_po($tableName,$status = 0,$get)
{
   $qry ="select count(*) as countval from $tableName where status='A'";
    
		if(sizeof($get) > 0)
		 {
					
					   
					   if($get['location'] != ""){
					   
                         $sqlpoComp  = $this->db->query("select * from tbl_master_data  where param_id = 22 AND keyvalue = '".$get['location']."'");
						 $getComp    = $sqlpoComp->row();
						 // foreach ($getComp as $value) {
						 //   echo $value['serial_number'];
						 // }

					     $qry .= " AND company =".$getComp->serial_number."";
					   }
					 
					   if($get['destination'] != ""){
					   	  $contactQuery = $this->db->query("select * from tbl_contact_m where group_name = 7 AND first_name like '%".$get['destination']."%' ");
					      $contactVal   = $contactQuery->row();
					     $qry .= " AND destination_contact = '".$contactVal->contact_id."'";
					   }
              	   	  
					   if($get['puchase_contact'] != "")
					   {
					   $contactQuery = $this->db->query("select * from tbl_contact_m where group_name = 5 AND first_name like '%".$get['puchase_contact']."%' ");
					   $contactVal   = $contactQuery->row();
					   $contactVal   = $contactVal->contact_id;
					   $qry         .= " AND contact_id ='$contactVal'";
              	   	   }  
					   
					   if($get['order_date'] != "")
					       $qry .= " AND order_date = '".$get['order_date']."'";

					   
					
		}
		 
   $query=$this->db->query($qry,array($status))->result_array();
   return $query[0]['countval'];
}

function get_tblHdrData($id){
	$query     = $this->db->query("select * from tbl_order_hdr where purchaseid = $id ");
	$resultHdr = $query->row_array();
	$arr = "";
    if(sizeof($resultHdr) > 0){
    	// echo "<pre>";
    	// print_r($resultHdr);
    	// echo "</pre>";

        $arr['purchaseid']          = $resultHdr['purchaseid'];
        $arr['contact_id'] 		    = $resultHdr['contact_id'];
        $arr['destination_contact'] = $resultHdr['destination_contact'];
        $arr['order_date']          = $resultHdr['order_date'];
		$arr['consignee_id']        = $resultHdr['consignee_id'];
		$arr['consignee_details']   = $resultHdr['consignee_details'];
		$arr['consignee_address']   = $resultHdr['consignee_address'];
		$arr['docket_no']           = $resultHdr['docket_no'];
		$arr['vehicle_no']          = $resultHdr['vehicle_no'];
        $arr['company']             = $resultHdr['company'];
        $arr['requestor_address']   = $resultHdr['requestor_address'];
        $arr['stn_no']              = $resultHdr['stn_no'];
        $arr['dtlData']             = array();

        $queryDtl  = $this->db->query("select D.*,S.productname,S.usageunit from tbl_order_dtl D,tbl_product_stock S where D.productid = S.Product_id AND D.purchaseorderhdr = $id ");
	    $resultDtl = $queryDtl->result_array();
        $i = 0;
	    foreach ($resultDtl as $k => $dt) {
         $contQuery = $this->db->query("select keyvalue from tbl_master_data where serial_number='".$dt['usageunit']."'");
		 $cont_val  = $contQuery->row();

	     $arr['dtlData'][$i]['productid']    = $dt['productid'];
	     $arr['dtlData'][$i]['productname']  = $dt['productname'];
	     $arr['dtlData'][$i]['umo']          = $cont_val->keyvalue;
	     $arr['dtlData'][$i]['qty']          = $dt['qty'];
	     $i++;
	    }

      }
    return $arr;
  }

  function  getPoNumber($val){
  	$val  = trim($val);
  	//echo "select count(*) as countRow from tbl_purchase_order_hdr where purchase_no = $val";die;
  	$query     = $this->db->query("select count(*) as countRow from tbl_order_hdr where purchase_no = '$val'");
	$resultHdr = $query->row_array();
	if($resultHdr['countRow'] > 0){
      echo "Purchase Order Number Already Exist !";
	}
  
  }

 function dailyDataInboundOutbound($proId,$date,$qty,$location){
   $lastHdrId1 = $this->db->query("select * from tbl_dailywisedetails where product_id = $proId AND location = $location AND DATE(create_on) = '".$date."'");
   $resultHdr  = $lastHdrId1->row();
   $count      = $lastHdrId1->num_rows();
   //var_dump($count);
   $lastpro    = $this->db->query("select quantity from tbl_product_stock where Product_id = $proId");
   $resultpro  = $lastpro->row();

   $stockqtyy  = $resultpro->quantity;

    if($count > 0){
      $id     = $resultHdr->id;
      $qry    = "update tbl_dailywisedetails set outbound = outbound+$qty where id=?";
      $update = $this->db->query($qry,array($id));
   }else{
      $qry    = "insert into tbl_dailywisedetails set outbound = ?,opening = ?,product_id = ?,create_on = ?,location=?";
      $insert = $this->db->query($qry,array($qty,$stockqtyy,$proId,$date,$location));
   }
 }

}
?>