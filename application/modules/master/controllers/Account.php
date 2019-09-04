<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class Account extends my_controller {

function __construct(){
   parent::__construct(); 
    $this->load->model('model_master');	
}

public function manage_contact()
{

	if($this->session->userdata('is_logged_in')){
	//$data=$this->user_function();// call permission fnctn
	//$data['result'] = $this->model_master->contact_get();	
	$data = $this->ContactListJoin();
	$this->load->view('/Account/manage-contact',$data);
}
	else
	{
	redirect('index');
	}
}

public function ContactListJoin()
{

  	  $data['result'] = "";
	  ////Pagination start ///
      $table_name  = 'tbl_contact_m';
	  $url         = site_url('/master/Account/manage_contact?');
	  $sgmnt       = "4";
      if($_GET['entries']!="")
	  	$showEntries = $_GET['entries'];
	  else
	  	$showEntries = 10;

      $totalData   = $this->model_master->count_contact($table_name,'A',$this->input->get());
      //$showEntries= $_GET['entries']?$_GET['entries']:'12';

      if($_GET['entries']!=""){
         $showEntries = $_GET['entries'];
         $url     = site_url('/master/Account/manage_contact?entries='.$_GET['entries']);
      }

       if($_GET['entries']!="" && $_GET['filter'] == ""){
		$url   = site_url('/master/Account/manage_contact?entries='.$_GET['entries']);
	   }elseif($_GET['filter'] != ""){
		$url   = site_url('/master/Account/manage_contact?entries='.$_GET['entries'].'&first_name='.$_GET['first_name'].'&group_name='.$_GET['group_name'].'&email='.$_GET['email'].'&mobile='.$_GET['mobile'].'&phone='.$_GET['phone'].'&filter='.$_GET['filter']);
	   }

      $pagination = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
  
      //////Pagination end ///
   
	 $data=$this->user_function();      // call permission fnctn
	 $data['dataConfig']        = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
	 //$data['result']            = $this->model_master->contact_get($pagination['per_page'],$pagination['page']);	
	 $data['pagination']        = $this->pagination->create_links();
	 
	 if($this->input->get('filter') == 'filter')   ////filter start ////
			$data['result']       = $this->model_master->filterContactList($pagination['per_page'],$pagination['page'],$this->input->get());
			else	
			$data['result'] = $this->model_master->contact_get($pagination['per_page'],$pagination['page']);

	 return $data;
  
}

public function updateContact(){
	if($this->session->userdata('is_logged_in')){
	 $data['ID'] = $_GET['ID'];
		$this->load->view('/Account/edit-contact',$data);
	}
	else
	{
	redirect('index');
	}
}

public function getdata_fun(){
	if($this->session->userdata('is_logged_in')){
	 $data['id'] = $_GET['con'];
		$this->load->view('/Account/getdata',$data);
	}
	else
	{
	redirect('index');
	}
}

public function contact_log(){

	if($this->session->userdata('is_logged_in')){
	
$data=$this->user_function();// call permission fnctn

		$this->load->view('Account/contact-log',$data);
}
	else
	{
	redirect('index');
	}
}


public function contact_log_pay(){

	if($this->session->userdata('is_logged_in')){
	
$data=$this->user_function();// call permission fnctn

		$this->load->view('Account/contact-log-pay',$data);
}
	else
	{
	redirect('index');
	}
}



public function contact_list_pay()
	{
		$info=array();
		
		$res = $this -> db
           -> select('*')
           -> where('group_name','5')
           -> get('tbl_contact_m');
		   
		$i='0';
		
		foreach($res->result() as $row)
		{
	
		  $compQuery = $this -> db
           -> select('*')
           -> where('account_id',$row->group_name)
           -> get('tbl_account_mst');
		  $compRow = $compQuery->row();
		
			$info[$i]['1']=$row->first_name;
			$info[$i]['2']=$compRow->account_name;
			$info[$i]['3']=$row->email;
			$info[$i]['4']=$row->mobile;
			$info[$i]['5']=$row->contact_id;	
			$info[$i]['6']=$row->phone;		
				$i++;
			
		}
		return $info;
	
	}
	
public function contact_list()
	{
		$info=array();
		
		$res = $this -> db
           -> select('*')
           -> where('group_name','4')
           -> get('tbl_contact_m');
		   
		$i='0';
		
		foreach($res->result() as $row)
		{
	
		  $compQuery = $this -> db
           -> select('*')
           -> where('account_id',$row->group_name)
           -> get('tbl_account_mst');
		  $compRow = $compQuery->row();
		
			$info[$i]['1']=$row->first_name;
			$info[$i]['2']=$compRow->account_name;
			$info[$i]['3']=$row->email;
			$info[$i]['4']=$row->mobile;
			$info[$i]['5']=$row->contact_id;	
			$info[$i]['6']=$row->phone;		
				$i++;
			
		}
		return $info;
	
	}	

public function contact_list_m()
	{
		$info=array();
		
		$res = $this -> db
           -> select('*')
           -> where('status','A')
           -> get('tbl_contact_m');
		   
		$i='0';
		
		foreach($res->result() as $row)
		{
	
		  $compQuery = $this -> db
           -> select('*')
           -> where('account_id',$row->group_name)
           -> get('tbl_account_mst');
		  $compRow = $compQuery->row();
		
			$info[$i]['1']=$row->first_name;
			$info[$i]['2']=$compRow->account_name;
			$info[$i]['3']=$row->email;
			$info[$i]['4']=$row->mobile;
			$info[$i]['5']=$row->contact_id;	
			$info[$i]['6']=$row->phone;		
				$i++;
			
		}
		return $info;
	
	}	

public function add_contact(){


	if($this->session->userdata('is_logged_in')){

 		$this->load->view('Account/add-contact');
}
	else
	{
	redirect('index');
	}
}

	



public function insert_contact(){
	
		@extract($_POST);
		$table_name ='tbl_contact_m';
		$table_name_dtl='tbl_contact_person';
		$pri_col ='contact_id';
		$pri_col_dtl ='person_id';
	 	$id= $this->input->post('contact_id');
		$total='0';
		
		//count($this->input->post('requestor_location'));
		  // implode function is used here
         $entityarr =$this->input->post('entity');
          @$entityComma=implode(',',$entityarr);

         $entityCodearr =$this->input->post('entity_code');
          @$entitycodeComma=implode('^',$entityCodearr);

       //echo addslashes($address1);


		 $data= array(
					'first_name' 			=> $this->input->post('first_name'),
					'group_name' 			=> $this->input->post('maingroupname'),
					'contact_person' 		=> $this->input->post('contact_person'),
					'email' 				=> $this->input->post('email'),
					//'requestor_location' => $ab,
					'location' 				=> addslashes($this->input->post('location')),
					'mobile' 				=> $this->input->post('mobile'),					
	                'phone' 				=> $this->input->post('phone'),
					'gst' 					=> $this->input->post('gst'),	
					'code' 					=> $this->input->post('code'),	
					'address1' 				=> addslashes($address1),
                 	'address3' 				=> addslashes($address3),
	 				'printname'			 	=> $printname,
					'city' 					=> $this->input->post('city'),
				    'state_id' 				=> $this->input->post('state'),
				    'entity'     			=> $entityComma,
				    'entity_code'   		=> $entitycodeComma,
					'pincode' 				=> $this->input->post('pin_code')                 	
            );

	     $sesio = array(
					'comp_id' 		=> $this->session->userdata('comp_id'),
					'divn_id' 		=> $this->session->userdata('divn_id'),
					'zone_id' 		=> $this->session->userdata('zone_id'),
					'brnh_id' 		=> $this->session->userdata('brnh_id'),
					'maker_id' 		=> $this->session->userdata('user_id'),
					'author_id'		=> $this->session->userdata('user_id'),
					'maker_date'	=> date('y-m-d'),
					'author_date'	=> date('y-m-d')
					);
		
		
		$data_entr = array_merge($data,$sesio);		
    	$this->load->model('Model_admin_login');

		if($id!=''){
		           
		            $this->Model_admin_login->update_user($pri_col,$table_name,$id,$data_entr);
					$table_name ='tbl_contact_m';
		            $pri_col ='contact_id';
	 	            $id= $this->input->post('contact_id');
		            $data= array(
					'first_name' 		=> $this->input->post('first_name'),
					'group_name' 		=> $this->input->post('maingroupname'),
					'contact_person' 	=> $this->input->post('contact_person'),
					'email'          	=> $this->input->post('email'),
					//'requestor_location' => $ab,
					'location'       	=> $this->input->post('location'),
					'mobile'         	=> $this->input->post('mobile'),					
	                'phone'          	=> $this->input->post('phone'),
					'gst'            	=> $this->input->post('gst'),	
					'code'           	=> $this->input->post('code'),	
					'address1'        	=> addslashes($address1),
                 	'address3'       	=> addslashes($address3),
	 				'printname'      	=> $printname,
					'city'          	=> $this->input->post('city'),
				    'state_id'     		=> $this->input->post('state'),
				    'entity'     		=> $entityComma,
				    'entity_code'  	 	=> $entitycodeComma,
					'pincode'    		=> $this->input->post('pin_code') 
					);
		
				
					$table_name1 ='tbl_address_m';
		          	$pri_col1 ='addressid';
	 	            $id1 = $this->input->post('adress_id');			

					$data1= array(					
								'address1' => $this->input->post('address1'),
								'address3' => $this->input->post('address3'),
								'City' => $this->input->post('City'),
								'state' => $this->input->post('state'),
								'country' => $this->input->post('country'),
								'Street' => $this->input->post('Street'),
								'pobox' => $this->input->post('pobox'),
								'zip' => $this->input->post('zip'),
								'description' => $this->input->post('textarea')
								);					
								$this->Model_admin_login->update_user($pri_col1,$table_name1,$id1,$data1);					
									//this data is for inserting in tbl_invoice_payment for opening balance
									$lastHdrId=$this->db->insert_id();
												$this->software_log_insert($lastHdrId,$id,$total,'Contact Updated');
								$namecont=count($val);
						          for ($i = 0; $i < $namecont; $i++) {
                                    $data_dtl['customer_id'] = $this->input->post('maingroupname');
									$data_dtl['contact_id']  = $id;
									$data_dtl['p_name']=$val[$i];
									$data_dtl['p_email']=$valemail[$i];
									$data_dtl['p_phone']=$valmobile[$i];
									$data_dtl['designation']=$desi[$i];
									$data_dtl['maker_id']=$this->session->userdata('user_id');
									$data_dtl['maker_date'] =$this->input->post('date_name');
									$data_dtl['author_date'] = date('y-m-d');
									$data_dtl['comp_id']=$this->session->userdata('comp_id');
									$data_dtl['zone_id']=$this->session->userdata('zone_id');
									$data_dtl['brnh_id']=$this->session->userdata('brnh_id');

								    $this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);
								
							}
							echo 2;			
					//redirect('master/Account/manage_contact');
			}
			else
			{ 
							$this->Model_admin_login->insert_user($table_name,$data_entr);
							$lastid = $this->db->insert_id();
							$this->software_log_insert($lastid,$lastid,$total,'Contact added');		
							$customer=$this->input->post('maingroupname');
						    $namecont=count($lot_no);
            for ($i = 0; $i < $namecont; $i++) {

				
					$data_dtl['customer_id']=$this->input->post('maingroupname');
					$data_dtl['contact_id']=$lastid;
					$data_dtl['p_name']=$this->input->post('lot_no')[$i];
					$data_dtl['p_email']=$this->input->post('pl_no')[$i];
					$data_dtl['p_phone']=$this->input->post('qtyy')[$i];
					$data_dtl['designation']=$this->input->post('start_date')[$i];
					$data_dtl['maker_id']=$this->session->userdata('user_id');
					$data_dtl['maker_date'] =$this->input->post('date_name');
					$data_dtl['author_date'] = date('y-m-d');
					$data_dtl['comp_id']=$this->session->userdata('comp_id');
					$data_dtl['zone_id']=$this->session->userdata('zone_id');
					$data_dtl['brnh_id']=$this->session->userdata('brnh_id');

				    $this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);
            }
					
					if($maingroupname=='8')
					{
		             $ContactLastid=$lastid;
		             $openingBal=$this->input->post('op_bal');
		             $this->insertOpeningBal($ContactLastid,$openingBal);
		            }	

				echo 1;
					//redirect('master/Account/manage_contact');
				
	}
}
	

function insertOpeningBal($ContactLastid,$openingBal)
	{
		
		$table_name='tbl_invoice_payment';
		$data= array(
					
					'contact_id' => $ContactLastid,
                 	'receive_billing_mount' => $openingBal,
	                'remarks' => 'Opening Balance',
                 	'comp_id' => $this->session->userdata('comp_id'),
					
					'date' =>  date('y-m-d'),
					
					'maker_id' => $this->session->userdata('user_id'),
					
					'maker_date'=> date('y-m-d'),
					'status'=> 'invoice'
					
						
					);
	$this->Model_admin_login->insert_user($table_name,$data);
			 return;
	
	}

	
	function delete_contact() {
	
	$table_name ='tbl_contact_m';
	$pri_col ='contact_id';
	$this->load->model('Model_admin_login');
		$id= $_GET['id'];
		
		// echo "select * from tbl_invoice_payment where contact_id='$id'"
		
		$querypayment= $this->db->query("select * from tbl_invoice_payment where contact_id='$id'");
		$fetchid=$querypayment->row();
		if($fetchid->contact_id!=''){
		?>	
		<script>
        	
			confirm("You can't delete it because this id is in tbl_invoice_payment"); 
			window.location.href='manage_contact';			
		
        </script>
        <?php	
		}
		
		//echo "select * from tbl_invoice_dtl where productid='$id'";
		
		$queryP=$this->db->query("select * from tbl_invoice_hdr where contactid='$id'");
		$fetchP=$queryP->row();
		
		
		if($fetchP->contactid!=''){
		?>			 
			<script> alert("please delete product in tbl_invoice_dtl table then you can delete this product:"); 
			window.location.href='manage_contact';
			</script>				 
				
		<?php			 
		}else{
		
		$this->Model_admin_login->delete_user($pri_col,$table_name,$id);
		
		$table_name1 ='tbl_address_m';
		$pri_col1 ='entityid';
		$this->load->model('Model_admin_login');
		$id= $_GET['id'];
		$this->Model_admin_login->delete_address($pri_col1,$table_name1,$id);
	    redirect('/index.php/Account/manage_contact');
}
}

public function firstfunction(){
	
		$data['firstid']=$_GET['firstid'];
		$this->load->view('get-alies-itemctg',$data);
	
	}
public function aliesnamefunction(){
	
		$data['aliesnameid']=$_GET['aliesnameid'];
		$this->load->view('get-alies-itemctg',$data);
	
	}

public function ajex_ContactListData(){
    $data =  $this->ContactListJoin();
    $this->load->view('/Account/edit-contact',$data);  
  }


  public function mappingSuplier(){
	if($this->session->userdata('is_logged_in')){
       $data['result']  =  $this->model_master->get_tblmappingData($this->input->post('id'));
       $data['contact'] = $this->input->post('id');
	   $this->load->view('Account/mappingadd',$data);
	 }
	else
	 {
	 redirect('index');
	 }		
}

  public function getproduct(){
	 if($this->session->userdata('is_logged_in')){
	   $this->load->view('Account/getproduct');
	 }
	 else
	 {
	   redirect('index');
	 }
  }

 public function insertProductMapping(){
        @extract($_POST);
		$table_name ='tbl_product_mapping';
		$pri_col    = 'suplier_id';
		// echo "<pre>";
		//   print_r($_POST);
		// echo  "</pre>";
		$count   = $this->input->post('rows');
		$contact = $this->input->post('contact');
       
		$this->Model_admin_login->delete_user($pri_col,$table_name,$contact);
        
		for ($i = 0; $i < $count; $i++) {

            $data_dtl['product_id']  = $this->input->post('main_id')[$i];
			$data_dtl['location']    = $this->input->post('locationidVal')[$i];
			$data_dtl['suplier_id']  = $contact;
			$data_dtl['status']      = 1;
            $this->Model_admin_login->insert_user($table_name,$data_dtl);
			//echo $i;
        }
  //       echo "<pre>";
		//   print_r($data_dtl);
		// echo  "</pre>";die;
        echo 1;
 }

 function ajax_getEntityCode(){
       $result  =  $this->model_master->get_SelectBoxEntityCode($this->input->post('id'));
 }

 function ajax_getentityRows(){
 
    $result  =  $this->model_master->get_getentityRows($this->input->post('id'));
 }

    public function ajax_viewContactData(){
        // echo $this->input->post('id');die;
        $data['result'] = $this->model_master->mod_viewContact($this->input->post('id'));
       //print_r($data['result']);
	    $this->load->view('Account/viewcontactPages',$data);
    }

}
?>