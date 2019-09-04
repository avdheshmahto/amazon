<?php
class model_inbound_order extends CI_Model {
	
//===================inbound==============

public function getInbound($last,$strat)
  {
      $query         = $this->db->query("select * from tbl_inbound_hdr where status='A' Order by inboundid desc limit $strat,$last ");
	  return $result = $query->result();  
  }

function filterInboundOrder($perpage,$pages,$get)
{
 	
			  $qry = "select * from tbl_inbound_hdr where status = 'A'";
					  
				 if(sizeof($get) > 0)
				 {
					
					  if($get['location'] != "")
					   {
					   $contactQuery = $this->db->query("select * from tbl_master_data where keyvalue like '%".$get['location']."%' ");
					   $contactVal   = $contactQuery->row();
					   $contactVal   = $contactVal->serial_number;
					   $qry         .= " AND storage_location ='$contactVal'";
              	   	   }  
					  
					   /*if($get['po_no'] != "")
						   $qry .= " AND po_no LIKE '%".$get['po_no']."%'";*/
					
					 if($get['po_no'] != "")
					   {
					   $contactQuery = $this->db->query("select * from tbl_purchase_order_hdr where purchase_no like '%".$get['po_no']."%' ");
					   $contactVal   = $contactQuery->row();
					   $contactVal   = $contactVal->purchaseid;
					   $qry         .= " AND po_no ='$contactVal'";
              	   	   }  
					 
					   if($get['date'] != "")
					     $qry .= " AND date = '".$get['date']."' ";
              	   	  
					   
					   
					   if($get['invoice_no'] != "")
					       $qry .= " AND invoice_no = '".$get['invoice_no']."'";

					   if($get['grn_no'] != "")
					       $qry .= " AND grn_no = '".$get['grn_no']."'";
						   
					   if($get['invoice_date'] != "")
					       $qry .= " AND invoice_date = '".$get['invoice_date']."'";
					
				 }
 
    $data =  $this->db->query($qry)->result();
  return $data;
}

function count_inbound($tableName,$status = 0,$get)
{
   $qry ="select count(*) as countval from $tableName where status='A'";
    
			 if(sizeof($get) > 0)
				 {
					
					  if($get['location'] != "")
					   {
					   $contactQuery = $this->db->query("select * from tbl_master_data where keyvalue like '%".$get['location']."%' ");
					   $contactVal   = $contactQuery->row();
					   $contactVal   = $contactVal->serial_number;
					   $qry         .= " AND storage_location ='$contactVal'";
              	   	   }  
					  
					 /*  if($get['po_no'] != "")
						   $qry .= " AND po_no LIKE '%".$get['po_no']."%'";*/
					
					 if($get['po_no'] != "")
					   {
					   $contactQuery = $this->db->query("select * from tbl_purchase_order_hdr where purchase_no like '%".$get['po_no']."%' ");
					   $contactVal   = $contactQuery->row();
					   $contactVal   = $contactVal->purchaseid;
					   $qry         .= " AND po_no ='$contactVal'";
              	   	   }  
					 
					   if($get['date'] != "")
					     $qry .= " AND date = '".$get['date']."' ";
              	   	  
					   
					   
					   if($get['invoice_no'] != "")
					       $qry .= " AND invoice_no = '".$get['invoice_no']."'";

					   if($get['grn_no'] != "")
					       $qry .= " AND grn_no = '".$get['grn_no']."'";
						   
					   if($get['invoice_date'] != "")
					       $qry .= " AND invoice_date = '".$get['invoice_date']."'";
					
				 }
 
		 
   $query=$this->db->query($qry,array($status))->result_array();
   return $query[0]['countval'];
}

function get_tblHdrData($id){
	$query     = $this->db->query("select * from tbl_purchase_order_hdr where purchaseid = $id ");
	$resultHdr = $query->row_array();
	$arr = "";
    if(sizeof($resultHdr) > 0){
    	// echo "<pre>";
    	// print_r($resultHdr);
    	// echo "</pre>";

        $arr['purchaseid']       = $resultHdr['purchaseid'];
        $arr['purchase_contact'] = $resultHdr['purchase_contact'];
        $arr['supplier_contact'] = $resultHdr['supplier_contact'];
        $arr['fob_incoterms']    = $resultHdr['fob_incoterms'];
        $arr['order_date']       = $resultHdr['order_date'];
        $arr['revised_date']     = $resultHdr['revised_date'];
        $arr['revised_by']       = $resultHdr['revised_by'];
        $arr['terms']            = $resultHdr['terms'];
        $arr['purchase_no'] 	 = $resultHdr['purchase_no'];
        $arr['ship_method']      = $resultHdr['ship_method'];
        $arr['ship_vip'] 		 = $resultHdr['ship_vip'];
        $arr['supplier']         = $resultHdr['supplier'];
        $arr['freight']          = $resultHdr['freight'];
        $arr['company']          = $resultHdr['company'];
        $arr['po_status']        = $resultHdr['po_status'];
        $arr['dtlData']          = array();

        $queryDtl  = $this->db->query("select D.*,S.productname,S.usageunit from tbl_purchase_order_dtl D,tbl_product_stock S where D.productid = S.Product_id AND D.purchaseorderhdr = $id ");
	    $resultDtl = $queryDtl->result_array();
        $i=0;
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

  function insertDataInboundOutbound($hid,$poid,$productId,$qtyy){

  	   $date1 = date('Y-m-d H:i:s');
  	   $lastHdrId1 = $this->db->query("select sum(D.receive_qty) as sum_qty from tbl_inbound_dtl D,tbl_inbound_hdr H where H.inboundid = D.inboundrhdr AND D.productid = $productId AND H.po_no = $poid");
       $resultHdr = $lastHdrId1->result_array();

       $lastHdrId12 = $this->db->query("select * from tbl_outbound_details where poid = ? AND product_id = ?",array($poid,$productId));
       $resultHdr2 = $lastHdrId12->result_array();

       if(sizeof($resultHdr2) > 0){

       	   $sumall = $resultHdr[0]['sum_qty'];
       	   $qry    = "update tbl_outbound_details set qty = ?,create_on = ? where poid = ?  AND product_id = ?";
           $insert = $this->db->query($qry,array($sumall,$date,$poid,$productId));

       }else{
        	
           $qry    = "insert into tbl_outbound_details set inbound_id = ?,poid = ?,qty = ?,product_id = ?,create_on = ?";
           $insert = $this->db->query($qry,array($hid,$poid,$qtyy,$productId,$date));
          
       }

      $qry    = "insert into tbl_inbound_outbound_details set inbound_id = ?,poid = ?,qty = ?,product_id = ?,create_on = ?,type = ?";
      $insert = $this->db->query($qry,array($hid,$poid,$qtyy,$productId,$date1,'inbound'));

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
      $qry    = "update tbl_dailywisedetails set inbound = inbound+$qty where id=?";
      $update = $this->db->query($qry,array($id));
   }else{
      $qry    = "insert into tbl_dailywisedetails set inbound = ?,opening = ?,product_id = ?,create_on = ?,location=?";
      $insert = $this->db->query($qry,array($qty,$stockqtyy,$proId,$date,$location));
   }
}

}
?>