<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class model_report extends CI_Model {

//=============================Payment Received Log=====================

function getPaymentReceivedLog($last,$strat)
{
	  $query=$this->db->query("Select * from tbl_invoice_payment where status='PaymentReceived'  limit $strat,$last ");
	  return $result=$query->result();  
}
function filterPaymentReceivedLog($perpage,$pages,$get)
{

		  $qry = "Select * from tbl_invoice_payment where status='PaymentReceived' ";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['contactid'] != "")						
						  $qry .= " AND contact_id = '".$get['contactid']."'";
					  
					   if($get['payment_mode'] != "")						
						  $qry .= " AND payment_mode = '".$get['payment_mode']."'";
						  
					   if($get['f_date']!='' && $get['t_date']!='')
						{
						
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and date >='$fdate1' and date <='$todate1'";
						}
					  
				    }
	    $data =  $this->db->query($qry)->result();
  	return $data;
}

function count_payment_received_log($perpage,$pages,$get)
{
 	
		  $qry = "Select * from tbl_invoice_payment where status='PaymentReceived' ";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['contactid'] != "")						
						  $qry .= " AND contact_id = '".$get['contactid']."'";
					  
					   if($get['payment_mode'] != "")						
						  $qry .= " AND payment_mode = '".$get['payment_mode']."'";
						  
					   if($get['f_date']!='' && $get['t_date']!='')
						{
						
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and date >='$fdate1' and date <='$todate1'";
						}
					  
				    }
 
    $data =  $this->db->query($qry)->num_rows();
 return $data;
}


//=====================================Payment Log==========================================

function getPaymentLog($last,$strat)
{
	  $query=$this->db->query("Select * from tbl_invoice_payment where status='payment'  limit $strat,$last ");
	  return $result=$query->result();  
}
function filterPaymentLog($perpage,$pages,$get)
{

		  $qry = "Select * from tbl_invoice_payment where status='payment' ";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['contactid'] != "")						
						  $qry .= " AND contact_id = '".$get['contactid']."'";
					  
					   if($get['payment_mode'] != "")						
						  $qry .= " AND payment_mode = '".$get['payment_mode']."'";
						  
					   if($get['f_date']!='' && $get['t_date']!='')
						{
						
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and date >='$fdate1' and date <='$todate1'";
						}
					  
				    }
	    $data =  $this->db->query($qry)->result();
  	return $data;
}

function count_payment_log($perpage,$pages,$get)
{
 	
		  $qry = "Select * from tbl_invoice_payment where status='payment' ";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['contactid'] != "")						
						  $qry .= " AND contact_id = '".$get['contactid']."'";
					  
					   if($get['payment_mode'] != "")						
						  $qry .= " AND payment_mode = '".$get['payment_mode']."'";
						  
					   if($get['f_date']!='' && $get['t_date']!='')
						{
						
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and date >='$fdate1' and date <='$todate1'";
						}
					  
				    }
 
    $data =  $this->db->query($qry)->num_rows();
 return $data;
}

//=====================Payment=========================================


function getPayment($last,$strat)
{
	  $query=$this->db->query("Select * from tbl_contact_m where group_name='5'  limit $strat,$last ");
	  return $result=$query->result();  
}
function filterPayment($perpage,$pages,$get)
{

		  $qry = "Select * from tbl_contact_m where group_name='5' ";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['contactid'] != "")						
						  $qry .= " AND contact_id = '".$get['contactid']."'";
					  
				    }
	    $data =  $this->db->query($qry)->result();
  	return $data;
}

function count_payment($perpage,$pages,$get)
{
 	
		  $qry = "Select * from tbl_contact_m where group_name='5' ";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['contactid'] != "")						
						  $qry .= " AND contact_id = '".$get['contactid']."'";
					  
				    }
 
    $data =  $this->db->query($qry)->num_rows();
 return $data;
}

//============================Payment Received================================

function getPaymentReceived($last,$strat)
{
	  $query=$this->db->query("Select * from tbl_contact_m where group_name='4'  limit $strat,$last ");
	  return $result=$query->result();  
}
function filterPaymentReceived($perpage,$pages,$get)
{

		  $qry = "Select * from tbl_contact_m where group_name='4' ";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['contactid'] != "")						
						  $qry .= " AND contact_id = '".$get['contactid']."'";
					  
				    }
	    $data =  $this->db->query($qry)->result();
  	return $data;
}

function count_payment_received($perpage,$pages,$get)
{
 	
		  $qry = "Select * from tbl_contact_m where group_name='4' ";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['contactid'] != "")						
						  $qry .= " AND contact_id = '".$get['contactid']."'";
					  
				    }
 
    $data =  $this->db->query($qry)->num_rows();
 return $data;
}


//====================Product Stock======================================

function getProduct($last,$strat)
{
	//echo "Select * from tbl_product_stock where status='A'  limit $strat,$last ";
	  $query=$this->db->query("Select * from tbl_product_stock where status='A'  limit $strat,$last ");
	  return $result=$query->result();  
}

function moddailyreport($last,$strat)
{
	  $query = $this->db->query("Select *,DATE_FORMAT(create_on, '%a %D %M %Y') create_on from tbl_dailywisedetails where  DATE(create_on) = DATE(NOW()) AND status='1'  limit $strat,$last");
	  return $result =$query->result();  
}

			function filtermoddailyreport($perpage,$pages,$get)
			{
			  $falg = false;
		      $qry = "Select *,DATE_FORMAT(create_on, '%a %D %M %Y') create_on from tbl_dailywisedetails where status='1'";
				if(sizeof($get) > 0)
				{
					
				if($get['date'] != ""){
					  $qry .= " AND DATE(create_on) = '".$get['date']."'";
					  $falg = true;
				}	  
					
				if($get['monthly'] != "")
				{
				  $qry       .= " AND month(create_on) = '".$get['monthly']."'";
				  $falg = true;		
			    } 

			   if($get['yearly'] != ""){
			       $qry       .= " AND year(create_on) = '".$get['yearly']."'";
			      $falg = true;
			    }
			   }

			   if($falg == false){
			   	 $qry  .= " AND DATE(create_on) = DATE(NOW())";
			   }
	              $qry .= " limit $pages,$perpage";

	          // echo $qry;
				  $data =  $this->db->query($qry)->result();
			  	return $data;
           }



function filterProductList($perpage,$pages,$get)
{

		  $qry = "Select * from tbl_product_stock where status='A'";
					  
					 if(sizeof($get) > 0)
					 {
					
					    if($get['contr'] != "")
						  $qry .= " AND location = '".$get['contr']."'";
						  
						
						if($get['contr'] != "")
					{
			$unitQuery2 = $this->db->query("select * from  tbl_contact_m where contract LIKE '%".$get['contr']."%'");
			$getUnit2   = $unitQuery2->row();
			$sr_no2     = $getUnit2->contact_id;
			
			$qry       .= " AND Product_id ='$sr_no2'";
			//echo $qry;		
				    }  
						
					  
					   if($get['p_name'] != "")
					     $qry .= " AND productname LIKE '%".$get['p_name']."%'";
					
				    }
		$qry .= " limit $pages,$perpage";			
	    $data =  $this->db->query($qry)->result();
  	return $data;
}

function count_product($perpage,$pages,$get)
{
 	
		  $qry ="select count(*) as countval from tbl_product_stock where status='A'";
		  
					  
					 if(sizeof($get) > 0)
					 {
					
					    if($get['contr'] != "")
					{
			$unitQuery2 = $this->db->query("select * from  tbl_contact_m where contract LIKE '%".$get['contr']."%'");
			$getUnit2   = $unitQuery2->row();
			$sr_no2     = $getUnit2->contact_id;
			
			$qry       .= " AND Product_id ='$sr_no2'";
			//echo $qry;		
				    }  
						  
					  
					   if($get['p_name'] != "")
					     $qry .= " AND productname LIKE '%".$get['p_name']."%'";
					   
				    }
$data=$this->db->query($qry,array($status))->result_array();
   return $data[0]['countval'];
}

function count_dailyproduct($perpage,$pages,$get)
{
 	
	$falg = false;
		      $qry = "Select *,DATE_FORMAT(create_on, '%a %D %M %Y') create_on from tbl_dailywisedetails where status='1'";
				if(sizeof($get) > 0)
				{
					
				if($get['date'] != ""){
					  $qry .= " AND DATE(create_on) = '".$get['date']."'";
					  $falg = true;
				}	  
					
				if($get['monthly'] != "")
				{
				  $qry       .= " AND month(create_on) = '".$get['monthly']."'";
				  $falg = true;		
			    } 

			   if($get['yearly'] != ""){
			       $qry       .= " AND year(create_on) = '".$get['yearly']."'";
			       $falg = true;
			    }

			   }

			   if($falg == false){
			   	 $qry  .= " AND DATE(create_on) = DATE(NOW())";
			   }
	             // $qry .= " limit $pages,$perpage";
            //echo $qry;
            $data =  $this->db->query($qry)->num_rows();
			return $data;
}

//*****************************************Product Location**************************************************


function getlocation($last,$strat)
{
	  $query=$this->db->query("Select * from tbl_product_serial where status='A'  limit $strat,$last ");
	  return $result=$query->result();  
}
function filterlocationList($perpage,$pages,$get)
{

		  $qry = "Select * from tbl_product_serial where status='A'";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['s_loc'] != "")
						  $qry .= " AND location_id = '".$get['s_loc']."'";
					  
					
					if($get['p_name'] != "")
					{
		          	 $unitQuery2 = $this->db->query("select * from  tbl_product_stock where productname LIKE '%".$get['p_name']."%'");
			         $getUnit2   = $unitQuery2->row();
			         $sr_no2     = $getUnit2->Product_id;
			
			         $qry       .= " AND serial_number ='$sr_no2'";
			//echo $qry;		
		  }
		}

		//echo $qry;
		$qry .= " limit $pages,$perpage";			
	    $data =  $this->db->query($qry)->result();
  	return $data;
}

function count_location($perpage,$pages,$get)
{
 	
		   $qry ="select count(*) as countval from tbl_product_serial where status='A'";
		  
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['s_loc'] != "")
						  $qry .= " AND location_id = '".$get['s_loc']."'";
					  
					  if($get['p_name'] != "")
					{
			$unitQuery2 = $this->db->query("select * from  tbl_product_stock where productname LIKE '%".$get['p_name']."%'");
			$getUnit2   = $unitQuery2->row();
			$sr_no2     = $getUnit2->Product_id;
			
			$qry       .= " AND serial_number ='$sr_no2'";
					
				    }
					
					   
				    }
 
   $data=$this->db->query($qry,array($status))->result_array();
   return $data[0]['countval'];
}

//****************************************************GRN*******************************************************


function getgrn($last,$strat)
{
	  $query=$this->db->query("Select * from tbl_inbound_hdr where status='A'  limit $strat,$last ");
	  return $result=$query->result();  
}
function filtergrnList($perpage,$pages,$get)
{

		  $qry = "Select * from tbl_inbound_hdr where status='A'";
					  
					 if(sizeof($get) > 0)
					 {
					
					    if($get['s_loc'] != "")
						  $qry .= " AND storage_location = '".$get['s_loc']."'";
						  
						if($get['invoice_date'] != "")
						  $qry .= " AND invoice_date = '".$get['invoice_date']."'";
						  
						
						if($get['po_no'] != "")
					{
			$unitQuery2 = $this->db->query("select * from  tbl_purchase_order_hdr where purchase_no LIKE '%".$get['po_no']."%'");
			$getUnit2   = $unitQuery2->row();
			$sr_no2     = $getUnit2->purchaseid;
			
			$qry       .= " AND po_no ='$sr_no2'";
			//echo $qry;		
				    }  
					
					if($get['in_no'] != "")
						  $qry .= " AND invoice_no = '".$get['in_no']."'";
						  
					if($get['grn_no'] != "")
						$qry .= " AND grn_no = '".$get['grn_no']."'";
						
					  
					  
						 
						 
			if($get['f_date']!='')
		{
		
			$t_date=explode("-",$get['t_date']);
			
			$f_date=explode("-",$get['f_date']);

			$t_date1=$t_date[0]."-".$t_date[1]."-".$t_date[2];
	        $f_date1=$f_date[0]."-".$f_date[1]."-".$f_date[2];
			$qry .=" and grn_date >='$f_date1' and grn_date <='$t_date1'";
		}
				
					
				    }
		$qry .= " limit $pages,$perpage";
	    $data =  $this->db->query($qry)->result();
  	return $data;
}

function count_grn($perpage,$pages,$get)
{
 	
		 $qry ="select count(*) as countval from tbl_inbound_hdr where status='A'";
		  
					  
					 if(sizeof($get) > 0)
					 {
					
					 if($get['po_no'] != "")
					{
			$unitQuery2 = $this->db->query("select * from  tbl_purchase_order_hdr where purchase_no LIKE '%".$get['po_no']."%'");
			$getUnit2   = $unitQuery2->row();
			$sr_no2     = $getUnit2->purchaseid;
			
			$qry       .= " AND po_no ='$sr_no2'";
			//echo $qry;		
				    }  
					
		if($get['invoice_date'] != "")
				$qry .= " AND invoice_date = '".$get['invoice_date']."'";
		
		if($get['in_no'] != "")
			$qry .= " AND invoice_no = '".$get['in_no']."'";	
		
		if($get['grn_no'] != "")
			$qry .= " AND grn_no = '".$get['grn_no']."'";			
			  
					  
					   
					   
	if($get['f_date']!='')
		{
		
			$t_date=explode("-",$get['t_date']);
			
			$f_date=explode("-",$get['f_date']);

			$t_date1=$t_date[0]."-".$t_date[1]."-".$t_date[2];
	        $f_date1=$f_date[0]."-".$f_date[1]."-".$f_date[2];
			$qry .=" and grn_date >='$f_date1' and grn_date <='$t_date1'";
		}
				
	
	
				    }
 $data=$this->db->query($qry,array($status))->result_array();
   return $data[0]['countval'];
}

//***********************************Order  Report***************************************************


function getorder($last,$strat)
{
	  $query=$this->db->query("Select * from tbl_order_hdr where status='A'  limit $strat,$last ");
	  return $result=$query->result();  
}
function filterorderList($perpage,$pages,$get)
{

		  $qry = "Select * from tbl_order_hdr where status='A'";
					  
					 if(sizeof($get) > 0)
					 {
					
					    if($get['s_loc'] != "")
						  $qry .= " AND company = '".$get['s_loc']."'";


						if($get['doc_no'] != "")
							$qry .= " AND docket_no = '".$get['doc_no']."'";	
		
						if($get['veh_no'] != "")
							$qry .= " AND vehicle_no = '".$get['veh_no']."'";			


						if($get['r_name'] != "")
							$qry .= " AND contact_id = '".$get['r_name']."'";

						if($get['dest'] != "")
							$qry .= " AND destination_contact = '".$get['dest']."'";
						
						if($get['transporter_name'] != "")
							$qry .= " AND transporter_name = '".$get['transporter_name']."'";
						
						
						if($get['vehicle_date'] != "")
							$qry .= " AND vechicle_date = '".$get['vehicle_date']."'";

						 
						 
			if($get['f_date']!='')
		{
		
			$t_date=explode("-",$get['t_date']);
			
			$f_date=explode("-",$get['f_date']);

			$t_date1=$t_date[0]."-".$t_date[1]."-".$t_date[2];
	        $f_date1=$f_date[0]."-".$f_date[1]."-".$f_date[2];
			$qry .=" and order_date >='$f_date1' and order_date <='$t_date1'";
		}
				
					
				    }
		$qry .= " limit $pages,$perpage";			
	    $data =  $this->db->query($qry)->result();
  	return $data;
}

function count_order($perpage,$pages,$get)
{
 	
		  $qry ="select count(*) as countval from tbl_order_hdr where status='A'";
		 
					  
					 if(sizeof($get) > 0)
					 {
					
					if($get['s_loc'] != "")
						  $qry .= " AND company = '".$get['s_loc']."'";
							
							
					if($get['r_name'] != "")
						  $qry .= " AND contact_id = '".$get['r_name']."'";
					
					if($get['dest'] != "")
						$qry .= " AND destination_contact = '".$get['dest']."'";	  
					
					
					
		if($get['doc_no'] != "")
			$qry .= " AND docket_no = '".$get['doc_no']."'";	
		
		if($get['veh_no'] != "")
			$qry .= " AND vehicle_no = '".$get['veh_no']."'";			
		
	
		if($get['transporter_name'] != "")
			$qry .= " AND transporter_name = '".$get['transporter_name']."'";
		
		
		if($get['vehicle_date'] != "")
			$qry .= " AND vechicle_date = '".$get['vehicle_date']."'";

			  
					  
					   
	if($get['f_date']!='')
		{
		
			$t_date=explode("-",$get['t_date']);
			
			$f_date=explode("-",$get['f_date']);

			$t_date1=$t_date[0]."-".$t_date[1]."-".$t_date[2];
	        $f_date1=$f_date[0]."-".$f_date[1]."-".$f_date[2];
			$qry .=" and order_date >='$f_date1' and order_date <='$t_date1'";
		}
				
	
	
				    }
 
    
 $data=$this->db->query($qry,array($status))->result_array();
   return $data[0]['countval'];

}



//***************************************Purchase Stock Order************************************************

function getPurchaseStock($last,$strat)
{
	  $query=$this->db->query("Select * from tbl_purchase_order_hdr where status='A'  limit $strat,$last ");
	  return $result=$query->result();  
}
function filterPurchaseStock($perpage,$pages,$get)
{

		  $qry = "Select * from tbl_purchase_order_hdr where status='A'";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['p_no'] != "")
						  $qry .= " AND purchase_no LIKE '%".$get['p_no']."%'";
						  
						 if($get['s_loc'] != "")
						  $qry .= " AND company LIKE '%".$get['s_loc']."%'";
						  
					   if($get['v_name'] != "")
						  $qry .= " AND purchase_contact LIKE '%".$get['v_name']."%'";
					  
					   
					    					   
					     if($get['s_cont'] != "")
					{
			$unitQuery2 = $this->db->query("select * from  tbl_contact_m where first_name LIKE '%".$get['s_cont']."%'");
			$getUnit2   = $unitQuery2->row();
			$sr_no2     = $getUnit2->contact_id;
			
			$qry       .= " AND supplier_contact ='$sr_no2'";
			//echo $qry;		
				    }  
						  
					   
					   
					   
					   if($get['f_date']!='' && $get['t_date']!='')
						{
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and order_date >='$fdate1' and order_date <='$todate1'";
						}
				    }
		$qry .= " limit $pages,$perpage";			
	    $data =  $this->db->query($qry)->result();
  	return $data;
}

function count_po_stock($perpage,$pages,$get)
{
 	
		  $qry ="select count(*) as countval from tbl_purchase_order_hdr where status='A'";
		 
					  
					if(sizeof($get) > 0)
					 {
					
					   if($get['p_no'] != "")
						  $qry .= " AND purchase_no LIKE '%".$get['p_no']."%'";
						  
						 if($get['s_loc'] != "")
						  $qry .= " AND company LIKE '%".$get['s_loc']."%'";
						  
					   if($get['v_name'] != "")
						  $qry .= " AND purchase_contact LIKE '%".$get['v_name']."%'";
					  
					   
					    					   
					     if($get['s_cont'] != "")
					{
			$unitQuery2 = $this->db->query("select * from  tbl_contact_m where first_name LIKE '%".$get['s_cont']."%'");
			$getUnit2   = $unitQuery2->row();
			$sr_no2     = $getUnit2->contact_id;
			
			$qry       .= " AND supplier_contact ='$sr_no2'";
			//echo $qry;		
				    }  
						  
					   
					   
					   
					   if($get['f_date']!='' && $get['t_date']!='')
						{
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and order_date >='$fdate1' and order_date <='$todate1'";
						}
				    }
$data=$this->db->query($qry,array($status))->result_array();
   return $data[0]['countval'];
   
  }


//========================Invoice=========================================

function getInvoice($last,$strat)
{
	  $query=$this->db->query("Select * from tbl_invoice_hdr where status='A'  limit $strat,$last ");
	  return $result=$query->result();  
}
function filterInvoiceData($perpage,$pages,$get)
{

		  $qry = "Select * from tbl_invoice_hdr where status='A'";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['inv_no'] != "")						
						  $qry .= " AND invoiceid = '".$get['inv_no']."'";
					  
					   if($get['cust_name'] != "")					  				
					        $qry .= " AND vendor_id  = '".$get['cust_name']."' ";
					   
					   if($get['f_date']!='' && $get['t_date']!='')
						{
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and invoice_date >='$fdate1' and invoice_date <='$todate1'";
						}
				    }
	    $data =  $this->db->query($qry)->result();
  	return $data;
}

function count_invoice($perpage,$pages,$get)
{
 	
		  $qry = "Select * from tbl_invoice_hdr where status='A'";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['inv_no'] != "")						
						  $qry .= " AND invoiceid = '".$get['inv_no']."'";
					  
					   if($get['cust_name'] != "")					  				
					        $qry .= " AND vendor_id  = '".$get['cust_name']."' ";
					   
					   if($get['f_date']!='' && $get['t_date']!='')
						{
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and invoice_date >='$fdate1' and invoice_date <='$todate1'";
						}
				    }
 
    $data =  $this->db->query($qry)->num_rows();
 return $data;
}


//=====================================Proforma Invoice===============


function getProInvoice($last,$strat)
{
	  $query=$this->db->query("Select * from tbl_proforma_invoice_hdr where status='A'  limit $strat,$last ");
	  return $result=$query->result();  
}
function filterProInvoiceData($perpage,$pages,$get)
{

		  $qry = "Select * from tbl_proforma_invoice_hdr where status='A'";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['inv_no'] != "")						
						  $qry .= " AND invoiceid = '".$get['inv_no']."'";
					  
					   if($get['cstmr_name'] != "")					  				
					        $qry .= " AND vendor_id  = '".$get['cstmr_name']."' ";
					   
					   if($get['f_date']!='' && $get['t_date']!='')
						{
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and invoice_date >='$fdate1' and invoice_date <='$todate1'";
						}
				    }
	    $data =  $this->db->query($qry)->result();
  	return $data;
}

function count_pro_invoice($perpage,$pages,$get)
{
 	
		  $qry = "Select * from tbl_proforma_invoice_hdr where status='A'";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['inv_no'] != "")						
						  $qry .= " AND invoiceid = '".$get['inv_no']."'";
					  
					   if($get['cstmr_name'] != "")					  				
					        $qry .= " AND vendor_id  = '".$get['cstmr_name']."' ";
					   
					   if($get['f_date']!='' && $get['t_date']!='')
						{
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and invoice_date >='$fdate1' and invoice_date <='$todate1'";
						}
				    }
 
    $data =  $this->db->query($qry)->num_rows();
 return $data;
}

//===========================Template=============================


function getTemplate($last,$strat)
{
	  $query=$this->db->query("Select * from tbl_template_hdr where status='A'  limit $strat,$last ");
	  return $result=$query->result();  
}
function filterTemplate($perpage,$pages,$get)
{

		  $qry = "Select * from tbl_template_hdr where status='A'";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['temp_id'] != "")						
						  $qry .= " AND templateid = '".$get['temp_id']."'";
					  
					   if($get['p_name'] != "")
					    {
						    $sql1 = $this->db->query("select * from tbl_product_stock where productname like '%".$get['p_name']."%' ");
						    $sql2 = $sql1->row();					
					        $qry .= " AND product_id  = '$sql2->Product_id' ";
					    }
					   
					   if($get['f_date']!='' && $get['t_date']!='')
						{
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and date >='$fdate1' and date <='$todate1'";
						}
				    }
	    $data =  $this->db->query($qry)->result();
  	return $data;
}

function count_template($perpage,$pages,$get)
{
 	
		  $qry = "Select * from tbl_template_hdr where status='A'";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['temp_id'] != "")						
						  $qry .= " AND templateid = '".$get['temp_id']."'";
					  
					   if($get['p_name'] != "")
					    {
						    $sql1 = $this->db->query("select * from tbl_product_stock where productname like '%".$get['p_name']."%' ");
						    $sql2 = $sql1->row();					
					        $qry .= " AND product_id  = '$sql2->Product_id' ";
					    }
					   
					   if($get['f_date']!='' && $get['t_date']!='')
						{
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and date >='$fdate1' and date <='$todate1'";
						}
				    }
 
    $data =  $this->db->query($qry)->num_rows();
 return $data;
}


//=================================End===================================

function getSearchPacking($p_id,$f_date,$t_date) {

    $select_query = "Select * from tbl_production_log where production_status='packing'";
    
		if($p_id!='')
		{
			$sql1 = $this->db->query("select * from tbl_packing where packing_id = '$p_id' ");
			$sql2 = $sql1->row();						
			$select_query.=" and  qc_id = '$sql2->qc_id' ";	  
		}

		if($f_date!='' && $t_date!='')
		{
		
			$tdate=explode("-",$t_date);
			
			$fdate=explode("-",$f_date);

			$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
	        $fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
			$select_query .="and date >='$fdate1' and date <='$todate1'";
		}		
	$query = $this->db->query($select_query);
    return $query->result();
}

//===========================Purchase Order=================================


function getPurchaseOrder($last,$strat)
{
	  $query=$this->db->query("Select * from tbl_purchase_order_hdr where status='A' Order by purchaseid DESC  limit $strat,$last ");
	  return $result=$query->result();  
}
function filterPurchaseOrder($perpage,$pages,$get)
{

		  $qry = "Select * from tbl_purchase_order_hdr where status='A'";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['p_no'] != "")
						  $qry .= " AND purchase_no LIKE '%".$get['p_no']."%'";
						  
						 if($get['s_loc'] != "")
						  $qry .= " AND company LIKE '%".$get['s_loc']."%'";
						  
					   if($get['v_name'] != "")
						  $qry .= " AND purchase_contact LIKE '%".$get['v_name']."%'";
					  
					   
					    					   
					     if($get['s_cont'] != "")
					{
			$unitQuery2 = $this->db->query("select * from  tbl_contact_m where first_name LIKE '%".$get['s_cont']."%'");
			$getUnit2   = $unitQuery2->row();
			$sr_no2     = $getUnit2->contact_id;
			
			$qry       .= " AND supplier_contact ='$sr_no2'";
			//echo $qry;		
				    }  
						  
					   
					   
					   
					   if($get['f_date']!='' && $get['t_date']!='')
						{
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and order_date >='$fdate1' and order_date <='$todate1'";
						}
				    }
		$qry .= " limit $pages,$perpage";			
	    $data =  $this->db->query($qry)->result();
  	return $data;
}

function count_po($tableName,$status = 0,$get)
{
 	
		  $qry = "Select count(*) as countval from tbl_purchase_order_hdr where status='A'";
					  
					 if(sizeof($get) > 0)
					 {
					
					    if($get['p_no'] != "")
						  $qry .= " AND purchase_no LIKE '%".$get['p_no']."%'";
						  
					   if($get['v_name'] != "")
						  $qry .= " AND purchase_contact LIKE '%".$get['v_name']."%'";
					  
					   if($get['s_cont'] != "")
					{
			$unitQuery2 = $this->db->query("select * from  tbl_contact_m where first_name LIKE '%".$get['s_cont']."%'");
			$getUnit2   = $unitQuery2->row();
			$sr_no2     = $getUnit2->contact_id;
			
			$qry       .= " AND supplier_contact ='$sr_no2'";
			//echo $qry;		
				    }  
					  
					   
					   if($get['f_date']!='' && $get['t_date']!='')
						{
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and order_date >='$fdate1' and order_date <='$todate1'";
						}
				    }
 
    $query=$this->db->query($qry,array($status))->result_array();
   return $query[0]['countval'];
}


//*********************purchase order log*******************************************************************



function getPurchaseOrderlog($last,$strat)
{
	  $query=$this->db->query("Select * from tbl_purchase_order_hdr where status='A' Order by purchaseid DESC  limit $strat,$last ");
	  return $result=$query->result();  
}
function filterPurchaseOrderlog($perpage,$pages,$get)
{

		  $qry = "Select * from tbl_purchase_order_hdr where status='A'";
					  
					if(sizeof($get) > 0)
					 {
					
					   if($get['p_no'] != "")
						  $qry .= " AND purchase_no LIKE '%".$get['p_no']."%'";
						  
						 if($get['s_loc'] != "")
						  $qry .= " AND company LIKE '%".$get['s_loc']."%'";
						  
					   if($get['v_name'] != "")
						  $qry .= " AND purchase_contact LIKE '%".$get['v_name']."%'";
					  
					   
					    					   
					     if($get['s_cont'] != "")
					{
			$unitQuery2 = $this->db->query("select * from  tbl_contact_m where first_name LIKE '%".$get['s_cont']."%'");
			$getUnit2   = $unitQuery2->row();
			$sr_no2     = $getUnit2->contact_id;
			
			$qry       .= " AND supplier_contact ='$sr_no2'";
			//echo $qry;		
				    }  
						  
					   
					   
					   
					   if($get['f_date']!='' && $get['t_date']!='')
						{
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and order_date >='$fdate1' and order_date <='$todate1'";
						}
				    }
		$qry .= " limit $pages,$perpage";
	    $data =  $this->db->query($qry)->result();
  	return $data;
}

function count_po_log($tableName,$status = 0,$get)
{
 	
		  $qry = "Select count(*) as countval from tbl_purchase_order_hdr where status='A'";
					  
					if(sizeof($get) > 0)
					 {
					
					   if($get['p_no'] != "")
						  $qry .= " AND purchase_no LIKE '%".$get['p_no']."%'";
						  
						 if($get['s_loc'] != "")
						  $qry .= " AND company LIKE '%".$get['s_loc']."%'";
						  
					   if($get['v_name'] != "")
						  $qry .= " AND purchase_contact LIKE '%".$get['v_name']."%'";
					  
					   
					    					   
					     if($get['s_cont'] != "")
					{
			$unitQuery2 = $this->db->query("select * from  tbl_contact_m where first_name LIKE '%".$get['s_cont']."%'");
			$getUnit2   = $unitQuery2->row();
			$sr_no2     = $getUnit2->contact_id;
			
			$qry       .= " AND supplier_contact ='$sr_no2'";
			//echo $qry;		
				    }  
						  
					   
					   
					   
					   if($get['f_date']!='' && $get['t_date']!='')
						{
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and order_date >='$fdate1' and order_date <='$todate1'";
						}
				    }
    $query=$this->db->query($qry,array($status))->result_array();
   return $query[0]['countval'];
}



//==========================Production========================

function getSearchMasterCutting($post,$limit=0, $start=0) 
{
		$p_name = $post['p_name']; $f_date = $post['f_date']; $t_date = $post['t_date'];$p_id   = $post['p_id'];$type = $post['type'];
    
	    if($p_id!='' || $p_name!='' || $f_date!='' || $t_date!='' || $type!='')
		{
            $select_query    = "Select *,PL.date as log_date,PL.qty as log_qty from tbl_production_log PL,tbl_product_stock PS,tbl_contact_m C where PL.finishProductId = PS.Product_id AND C.contact_id = PL.customer_name AND  PL.status='A'"; 
        	
			if($p_id!=''){	$select_query.=" and PL.finishProductId  = '$p_id'"; }
			
			if($type!=''){	$select_query.=" AND PL.production_status = '".$type."'"; }
        	
			if($p_name!='')
			{				
		    	$sql1         = $this->db->query("select * from tbl_contact_m where first_name like '%$p_name%' ");
				$sql2         = $sql1->row();

				$select_query.=" and C.contact_id  = '$sql2->contact_id'";	  
			}
			if($f_date!='' && $t_date!='')
			{
			    $tdate   = explode("-",$t_date);
				$fdate   = explode("-",$f_date);
                $todate1 = $tdate[0]."-".$tdate[1]."-".$tdate[2];
		        $fdate1  = $fdate[0]."-".$fdate[1]."-".$fdate[2];
				$select_query .="and PL.date >='$fdate1' and PL.date <='$todate1'";
			}
		  }
       else{
       	
	 	  $select_query    = "Select *,PL.date as log_date,PL.qty as log_qty from tbl_production_log PL,tbl_product_stock PS,tbl_contact_m C where PL.finishProductId = PS.Product_id AND C.contact_id = PL.customer_name AND  PL.status='A' ";
	 	  }
	   
	   if($limit == "")
	   {
	 	  	$select_query   .= "  order by PL.production_log_id ASC ";
	 	  	$query = $this->db->query($select_query);
	   }
	   else
	   {
	 	    $select_query   .= "  order by PL.production_log_id ASC limit  $start, $limit";
	   }
		  $query = $this->db->query($select_query);
	      $data  = $query->result_array();
	      return $data;
}


function getOverLocking($post,$type)
{
   
    	$p_name = $post['p_name']; $f_date = $post['f_date']; $t_date = $post['t_date'];$p_id   = $post['p_id'];
        
		if($p_id!='' || $p_name!='' || $f_date!='' || $t_date!='')
		{
         
         if($type != 'Cutting')
		 {
              $select_query = "Select *,PL.date as log_date,PL.qty as log_qty from tbl_production_log PL,tbl_product_stock PS,tbl_contact_m C where PL.finishProductId = PS.Product_id AND C.contact_id = PL.customer_name AND  PL.status='A' AND PL.production_status = '".$type."'"; 
        }
		else
		{
        	 $select_query = "Select *,PL.date as log_date,PL.qty as log_qty from tbl_production_log PL,tbl_product_stock PS,tbl_contact_m C where PL.finishProductId = PS.Product_id AND C.contact_id = PL.customer_name AND  PL.status='A' AND (PL.production_status = '".$type."' OR PL.production_status = 'Raphu') ";	
        }

        if($p_id!='')
		{				
			$select_query.=" and PL.finishProductId  = '$p_id'";	  
		}

		if($p_name!='')
		{				
		    $sql1 = $this->db->query("select * from tbl_contact_m where first_name like '%$p_name%' ");
			$sql2 = $sql1->row();
			$select_query.=" and C.contact_id  = '$sql2->contact_id'";	  
		}
			
		if($f_date!='' && $t_date!='')
		{
			
			$tdate=explode("-",$t_date);
			$fdate=explode("-",$f_date);

			$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
		    $fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
			$select_query .="and PL.date >='$fdate1' and PL.date <='$todate1'";
		}
}
       else
	   {
	 	    if($type != 'Cutting')
			{
              $select_query = "Select *,PL.date as log_date,PL.qty as log_qty from tbl_production_log PL,tbl_product_stock PS,tbl_contact_m C where PL.finishProductId = PS.Product_id AND C.contact_id = PL.customer_name AND  PL.status='A' AND PL.production_status = '".$type."'"; 
            }
			else
			{
        	  $select_query = "Select *,PL.date as log_date,PL.qty as log_qty from tbl_production_log PL,tbl_product_stock PS,tbl_contact_m C where PL.finishProductId = PS.Product_id AND C.contact_id = PL.customer_name AND  PL.status='A' AND (PL.production_status = 'Cutting' OR PL.production_status = 'Raphu') ";	
        	}
	   }
		
		  $query = $this->db->query($select_query);
	      $data  = $query->result_array();
	      return $data;
}

function mod_finishgood()
{
      // $select_query = "Select * from tbl_product_stock where type = '14'";
      $query = $this->db->query("Select * from tbl_product_stock where type = '14'");
	  return $data  = $query->result_array();
}

  function count_inbound($last,$strat,$get){
    $query=$this->db->query("Select count(*) as countVal from tbl_outbound_details D,tbl_purchase_order_hdr P where D.poid = P.purchaseid AND P.status='A' group by D.poid ");
    $result=$query->row_array();
   return  $result['countVal'];
  }//Select * from tbl_inbound_outbound_details D,tbl_purchase_order_hdr P where D.poid = P.purchaseid AND P.status='A' group by D.poid

  function filterInbound(){
  
  }

  function getInbound($last,$strat){
  	//echo "Select * from tbl_inbound_outbound_details D,tbl_purchase_order_hdr P where D.poid = P.purchaseid AND P.status='A' group by D.poid ORDER BY D.poid ASC  limit $strat,$last ";
  	  $query=$this->db->query("Select * from tbl_outbound_details D,tbl_purchase_order_hdr P where D.poid = P.purchaseid AND P.status='A' group by D.poid ORDER BY D.poid ASC  limit $strat,$last ");
	  return $result=$query->result();
  }





//===========================inbound outbound Order=================================


function getInboundOutboundOrder($last,$strat)
{
	  $query=$this->db->query("Select * from tbl_purchase_order_hdr where status='A'  limit $strat,$last ");
	  return $result=$query->result();  
}
function filterInboundOutboundOrder($perpage,$pages,$get)
{

		  $qry = "Select * from tbl_purchase_order_hdr where status='A'";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['p_no'] != "")						
						  $qry .= " AND purchaseid = '".$get['p_no']."'";
					  
					   if($get['v_name'] != "")					  				
					        $qry .= " AND vendor_id  = '".$get['v_name']."' ";
					   
					   if($get['f_date']!='' && $get['t_date']!='')
						{
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and invoice_date >='$fdate1' and invoice_date <='$todate1'";
						}
				    }
	    $data =  $this->db->query($qry)->result();
  	return $data;
}

function count_InboundOutboundOrder($perpage,$pages,$get)
{
 	
		  $qry = "Select * from tbl_purchase_order_hdr where status='A'";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['p_no'] != "")						
						  $qry .= " AND purchaseid = '".$get['p_no']."'";
					  
					   if($get['v_name'] != "")					  				
					        $qry .= " AND vendor_id  = '".$get['v_name']."' ";
					   
					   if($get['f_date']!='' && $get['t_date']!='')
						{
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and invoice_date >='$fdate1' and invoice_date <='$todate1'";
						}
				    }
 
    $data =  $this->db->query($qry)->num_rows();
 return $data;
}


















}
?>