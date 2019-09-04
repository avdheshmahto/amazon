<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class master extends my_controller {

	
//---------------------------start itemctg function------------------------------

	public function insert_itemctg(){	
			extract($_POST);
			$table_name ='tbl_prodcatg_mst';
		 	$pri_col ='prodcatg_id';
	 		$id= $this->input->post('prodcatg_id');
			$mid1= $this->input->post('mid1');
			//echo $mid1;die;
			$midd1= $this->input->post('midd1');
			$midd2= $midd1-1;
			if($midd2==1){
			$mid= $midd2;
			}else if($mid1==''){
			$mid= $this->input->post('mid');
			}else{
			$mid= $this->input->post('mid1');
			}
			$data=array(
					
					'prodcatg_name' => $this->input->post('prodcatg_name'),
					'printname' => $this->input->post('printname'),
					'alias' => $this->input->post('alias'),
					'Description' => $this->input->post('description'),
					'main_prodcatg_id' => $mid
					
					);
					
			$sesio = array(
					
					'comp_id' => $this->session->userdata('comp_id'),
					'divn_id' => $this->session->userdata('divn_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'maker_id' => $this->session->userdata('user_id'),
					'author_id' => $this->session->userdata('user_id'),
					'maker_date'=> date('y-m-d'),
					'author_date'=> date('y-m-d')
					);
			$dataall=array_merge($data,$sesio);
					$this->load->model('Model_admin_login');
			if($id!=''){
					$this->Model_admin_login->update_user($pri_col,$table_name,$id,$dataall);
					echo "<script type='text/javascript'>";
					echo "window.close();";
					echo "window.opener.location.reload();";
					echo "</script>";
					}
		else
				{
					if($midd1==2){
					
					$this->Model_admin_login->insert_user($table_name,$dataall);
					echo "<script type='text/javascript'>";
					echo "window.close();";
					echo "window.opener.location.reload();";
					echo "</script>";
					}
					else if($mid==1){
					$this->Model_admin_login->insert_user($table_name,$dataall);
					redirect('/index.php/master/manage_itemctg');
					}
					else{
					$this->Model_admin_login->insert_user($table_name,$dataall);
					echo "<script type='text/javascript'>";
					echo "window.close();";
					echo "window.opener.location.reload();";
					echo "</script>";
			
				}
				}
				
			}	
			
	

public function add_itemctg(){
	
	if($this->session->userdata('is_logged_in')){
		$this->load->view('add-itemctg');
	}
	else
	{
	redirect('/master/index');
	}
	
	
}
	
	public function manage_itemctg(){
	
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	$this->load->view('manage-itemctg',$data);
	}
	else
	{
	redirect('/master/index');
	}
	
	
}

	function delete_itemctg(){
	$table_name ='tbl_prodcatg_mst';
	$pri_col ='prodcatg_id';
	$this->load->model('Model_admin_login');
		$id= $_GET['id'];
		$this->Model_admin_login->delete_user($pri_col,$table_name,$id);
		redirect('/index.php/master/manage_itemctg');
}
	
public function aliesfunction(){
	
		$data['alias_idd']=$_GET['alias_idd'];
		$this->load->view('get-alies-itemctg',$data);
	
	}

	public function prodcatefunction(){
	
		$data['prodcatg_id']=$_GET['prodcatg_id'];
		$this->load->view('get-alies-itemctg',$data);
	
	}
	
	
//--------------------------close itemctg function -----------------------------------	

//---------------------------start godown function------------------------------


	public function insert_godown(){	
			extract($_POST);
			$table_name ='tbl_godown_mst';
		 	$pri_col ='godown_id';
	 		$id= $this->input->post('godown_id');
			$mid1= $this->input->post('mid1');
			
			$midd1= $this->input->post('midd1');
			$midd2= $midd1-1;
			if($midd2==1){
			$mid= $midd2;
			}
			else if($mid1==''){
			$mid= $this->input->post('mid');
			}else{
			$mid= $this->input->post('mid1');
			}
			$data=array(
					
					'godown_name' => $this->input->post('godown_name'),
					'printname' => $this->input->post('printname'),
					'alias' => $this->input->post('alias'),
					'main_godown_id' => $mid
					
					);
					
					
			$sesio = array(
					
					'comp_id' => $this->session->userdata('comp_id'),
					'divn_id' => $this->session->userdata('divn_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'maker_id' => $this->session->userdata('user_id'),
					'author_id' => $this->session->userdata('user_id'),
					'maker_date'=> date('y-m-d'),
					'author_date'=> date('y-m-d')
					);
			$dataall=array_merge($data,$sesio);
			
					$this->load->model('Model_admin_login');
							
								
		if($id!=''){
					$this->Model_admin_login->update_user($pri_col,$table_name,$id,$dataall);
					echo "<script type='text/javascript'>";
					echo "window.close();";
					echo "window.opener.location.reload();";
					echo "</script>";
					}
		else
				{
					if($midd1==2){
					$this->Model_admin_login->insert_user($table_name,$dataall);
					echo "<script type='text/javascript'>";
					echo "window.close();";
					echo "window.opener.location.reload();";
					echo "</script>";
		
					}
					else if($mid==1){
					$this->Model_admin_login->insert_user($table_name,$dataall);
					redirect('/index.php/master/manage_godown');
					}else{
					$this->Model_admin_login->insert_user($table_name,$dataall);
					echo "<script type='text/javascript'>";
					echo "window.close();";
					echo "window.opener.location.reload();";
					echo "</script>";
				
				}
				}
				
			}	
			

public function add_godown(){
	
	if($this->session->userdata('is_logged_in')){
		$this->load->view('add-godown');
	}
	else
	{
	redirect('/master/index');
	}
	
	
}
	
	public function manage_godown(){
	
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	$this->load->view('manage-godown',$data);
	}
	else
	{
	redirect('/master/index');
	}
	
	
}

	function delete_godown(){
	$table_name ='tbl_godown_mst';
	$pri_col ='godown_id';
	$this->load->model('Model_admin_login');
		$id= $_GET['id'];
		$this->Model_admin_login->delete_user($pri_col,$table_name,$id);
		redirect('/index.php/master/manage_godown');
}
	
public function alies_godown(){
	
		$data['alias_godowid']=$_GET['alias_godowid'];
		$this->load->view('get-alies-itemctg',$data);
	
	}

	
public function godownfunction(){
	
		$data['godown_id']=$_GET['godown_id'];
		$this->load->view('get-alies-itemctg',$data);
	
	}
	
//--------------------------close godown function -----------------------------------	
//---------------------------start accountfunction------------------------------


	public function insert_account(){	
			extract($_POST);
			$table_name ='tbl_account_mst';
		 	$pri_col ='account_id';
	 		$id= $this->input->post('account_id');
			$mid1= $this->input->post('mid1');
			if($mid1==''){
			$mid= $this->input->post('mid');
			}else{
			$mid= $this->input->post('mid1');
			}
			$data=array(
					
					'account_name' => $this->input->post('account_name'),
					'printname' => $this->input->post('printname'),
					'alias' => $this->input->post('alias'),
					'main_account_id' => $mid
					
					);
			
					
			$sesio = array(
					
					'comp_id' => $this->session->userdata('comp_id'),
					'divn_id' => $this->session->userdata('divn_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'maker_id' => $this->session->userdata('user_id'),
					'author_id' => $this->session->userdata('user_id'),
					'maker_date'=> date('y-m-d'),
					'author_date'=> date('y-m-d')
					);
			$dataall=array_merge($data,$sesio);
					$this->load->model('Model_admin_login');
							
								
		if($id!=''){
					$this->Model_admin_login->update_user($pri_col,$table_name,$id,$dataall);
					echo "<script type='text/javascript'>";
					echo "window.close();";
					echo "window.opener.location.reload();";
					echo "</script>";
					}
		else
				{
					if($mid==1){
					$this->Model_admin_login->insert_user($table_name,$dataall);
					redirect('/index.php/master/manage_account');
					}else{
					$this->Model_admin_login->insert_user($table_name,$dataall);
					echo "<script type='text/javascript'>";
					echo "window.close();";
					echo "window.opener.location.reload();";
					echo "</script>";
				
				}
				}
				
			}	
			

public function add_account(){
	
	if($this->session->userdata('is_logged_in')){
		$this->load->view('add-account-grp');
	}
	else
	{
	redirect('/master/index');
	}
	
	
}
	
	public function manage_account(){
	
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	$this->load->view('manage-account-grp',$data);
	}
	else
	{
	redirect('/master/index');
	}
	
	
}

	function delete_account(){
	$table_name ='tbl_account_mst';
	$pri_col ='account_id';
	$this->load->model('Model_admin_login');
		$id= $_GET['id'];
		$this->Model_admin_login->delete_user($pri_col,$table_name,$id);
		redirect('/index.php/master/manage_account');
}
	
public function accountfunction(){
	
		$data['accountid']=$_GET['accountid'];
		$this->load->view('get-alies-itemctg',$data);
	
	}
public function acc_alies_function(){
	
		$data['ac_alies_id']=$_GET['ac_alies_id'];
		$this->load->view('get-alies-itemctg',$data);
	
	}
	
//--------------------------close accountfunction -----------------------------------	



//-----------------role function---------------	
public function add_role(){
	
	if($this->session->userdata('is_logged_in')){
		$this->load->view('add-role');
	}
	else
	{
	redirect('/master/index');
	}
	
	
}	

public function manage_role(){
	
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
		$this->load->view('manage-role',$data);
	}
	else
	{
	redirect('/master/index');
	}

}

function delete_role() {
	$table_name ='tbl_role_mst';
	$pri_col ='role_id';
	$this->load->model('Model_admin_login');
		$id= $_GET['id'];
		$this->Model_admin_login->delete_user($pri_col,$table_name,$id);
		redirect('/index.php/master/manage_role');
}

public function insert_role(){
	
	extract($_POST);
		$tablename ='tbl_role_mst';
		$pri_col ='role_id';
	 	$id= $this->input->post('role_id');
		
		$action1= $this->input->post('action1');
		$action2= $this->input->post('action2');
		$action3= $this->input->post('action3');
		$action4= $this->input->post('action4');
		$ction =$action1."-".$action2."-".$action3."-".$action4;
				
		$data = array(
					'code' => $this->input->post('code'),
				'role_name' => $this->input->post('role_name'),
					'action'=>$ction
					);
					
//create session					
					
			$sesio = array(
					'comp_id' => $this->session->userdata('comp_id'),
					'divn_id' => $this->session->userdata('divn_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'maker_id' => $this->session->userdata('user_id'),
					'author_id' => $this->session->userdata('user_id'),
					'maker_date'=> date('y-m-d'),
					'author_date'=> date('y-m-d')
					);
			$dataall=array_merge($data,$sesio);
		
		$dataall = array_merge($data,$sesio);
		
				$this->load->model('Model_admin_login');
		if($id!=''){
					$this->Model_admin_login->update_user($pri_col,$tablename,$id,$dataall);
					echo "<script type='text/javascript'>;";
					echo "window.close();";
					echo "window.opener.location.reload();";
					echo "</script>;";
					}
		else
				{
				
				$this->Model_admin_login->insert_user($tablename,$dataall);
				redirect('/index.php/master/manage_role');
				}
}



//--------------------------close role data -----------------------------------	

//--------------------Item Starts---------------------------
public function manage_item(){
	
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	$this->load->view('manage-item',$data);
	}
	else
	{
	redirect('/master/index');
	}
	
	
}


public function add_item(){
//echo "";die;
	if($this->session->userdata('is_logged_in')){
		$this->load->view('add-item');
}
	else
	{
	redirect('master/index');
	}
}





public function add_print(){
//echo "";die;
	if($this->session->userdata('is_logged_in')){
		$this->load->view('print');
}
	else
	{
	redirect('master/index');
	}
}


public function insert_item(){
	
		@extract($_POST);
		$table_name ='tbl_product_stock';
		$pri_col ='Product_id';
	 	$id= $this->input->post('Product_id');
		
		
		// this query is for inserting imgage
		
		 @$branchQuery2 = $this->db->query("SELECT * FROM $table_name where status='A' and Product_id='$id'");
					$branchFetch2 = $branchQuery2->row();
		   
	
			if(!empty($_FILES['image_name']['name'])){
			
			$ff = $branchFetch2->product_image;
			
					
				@unlink('assets/image_data/'.$ff);
				
		
                $config['upload_path'] = 'assets/image_data/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|csv|xlsx|pdf|xls';
              	$config['file_name'] = $_FILES['image_name']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
              
				
                if($this->upload->do_upload('image_name')){
                    $uploadData = $this->upload->data();
                    $picture2 = $uploadData['file_name'];
                }else{
                    $picture2 = '';
                }
		}
		
		
		
		
		
		
		
		
		
		
		
		
		 count($this->input->post('color')); 
		  // implode function is used here
 $bb=$this->input->post('color');
  @$ab=implode(',',$bb);  
 $count=sizeof('color');

		
		
		
		
		$data= array(
					'productname' => $this->input->post('item_name'),
					'category' => $this->input->post('category'),
					'product_image' => $picture2,
					
					
					'color' => $ab,
					'Product_typeid' => $Product_typeid,
					'sku_no' => $this->input->post('sku_no'),
					//'quantity_stock' => $this->input->post('quantity_stock'),
					
					'unitprice_purchase' => $this->input->post('unitprice_purchase'),
					
					'unitprice_sale' => $this->input->post('unitprice_sale'),
					'usageunit' => $this->input->post('unit'),
					'pic_per_box' => $this->input->post('pic_per_box'),
					'mrp' => $this->input->post('mrp'),
					'style_no' => $this->input->post('style'),	
					//'mrp' => $this->input->post('mrp'),
					//'reorderlevelqty' => $this->input->post('reorderlevelqty'),
					//'product_status' => $this->'A',
		      	);


	$sesio = array(
					
					'comp_id' => $this->session->userdata('comp_id'),
					'divn_id' => $this->session->userdata('divn_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'maker_date'=> date('y-m-d'),
					'author_date'=> date('y-m-d')
					);
		
		$dataall = array_merge($data,$sesio);

	$this->load->model('Model_admin_login');
	
		if($id!=''){
		
					$this->Model_admin_login->update_user($pri_col,$table_name,$id,$dataall);
					echo "<script type='text/javascript'>";
					echo "window.close();";
					echo "window.opener.location.reload();";
					echo "</script>";
					}
					
                     
					
		else
				{
				
					
		    	$this->Model_admin_login->insert_user($table_name,$dataall);
			// $lastHdrId=$this->db->insert_id();
			 //echo $lastHdrId;die;
			 $rediectItem="/master/manage_item";
			 
		redirect($rediectItem);
		
	}
	}
	

	
	function delete_item() {
	$table_name ='tbl_product_stock';
	$table_name1 ='tbl_product_serial';
	$table_name2 ='tbl_product_serial_log';
	$pri_col ='Product_id';
	$this->load->model('Model_admin_login');
		$id= $_GET['id'];
		$queryP=$this->db->query("select * from tbl_invoice_dtl where productid='$id'");
		$fetchP=$queryP->row();
		//echo $fetchP->productid;die;
		if($fetchP->productid!=''){
		?>			 
			<script> alert("please delete product in tbl_invoice_dtl table then you can delete this product:"); 
			window.location.href='manage_item';
			</script>				 
				
		<?php			 
		}else{
		$this->Model_admin_login->delete_user($pri_col,$table_name,$id);
		$this->Model_admin_login->delete_user($pri_col,$table_name1,$id);
		$this->Model_admin_login->delete_user($pri_col,$table_name2,$id);
		redirect('/master/manage_item');
		}
}
//-----------------End Item ------------------------------	



		public function getregion(){
	
		$data['zone_id']=$_GET['zone_id'];
		$this->load->view('get-zone',$data);
	
	}
		
		
	public function getBranch(){
	
		$data['zone_id']=$_GET['zone_id'];
		$this->load->view('get_branch',$data);
	
	}
	
	public function getDivision(){
	
		$data['branch_id']=$_GET['branch_id'];
		$this->load->view('get_division',$data);
	
	}
	public function get_cid(){
	$data=$this->user_function();// call permission function
	
		$this->load->view('get_cid',$data);
	
	}
	
	
	

//---------------state--------------------
public function getState(){
	
		$data['country']=$_GET['country'];
		$this->load->view('get_state',$data);
	
	}
	
	public function getCity(){
	
		$data['state']=$_GET['state'];
		$this->load->view('get_city',$data);
	
	}

//---------------Group--------------------
public function getgroup(){
	
		$data['group']=$_GET['group'];
		$this->load->view('get_group',$data);
	
	}
	
//-----------------role_function_action function----------------


public function role_function_action(){
	
	if($this->session->userdata('is_logged_in')){
		$this->load->view('role-function-action');
	}
	else
	{
	redirect('/master/index');
	}
}

public function role_function_permision(){
 	 $drid =$this->input->post('drid');
	 $cid =$this->input->post('cid');
	 $module_id=$this->input->post('module_id');
	 $role_id=$this->input->post('role_id');
	 @$r =@count(@$drid);
	 @$rc=@count(@$cid);
	
	@$z=$rc-1;
	
	for($i=0;$i<$rc;$i++){
	
	
	 @$tbl_qry = $this->db->query("select count(status) as r1 from tbl_role_func_action where function_url='". $cid[$i]."' and role_id='".$role_id."'");
		 @$userFetch = $tbl_qry->row();
		 $rl1= @$userFetch->r1;
		 if($rl1>0)
		{
		 @$tbl_sql=$this->db->query("update tbl_role_func_action set action_id='".$drid[$i]."' where function_url='".$cid[$i]."' and role_id='".$role_id."'");	
		}else{
		@$tbl_sql=$this->db->query("insert into tbl_role_func_action set action_id='".$drid[$i]."',function_url='".$cid[$i]."', role_id='".$role_id."',module_id='".$module_id."'");
		@$tbl_sql="";
		
		}
		if($i==$z){
		redirect('/index.php/master/role_function_action');}
		}
	
}

//-----------------Close role_function_action function----------------


//-------------------------------Start Contact-----------------------------------
public function manage_contact(){

	if($this->session->userdata('is_logged_in')){
	
$data=$this->user_function();// call permission fnctn

		$this->load->view('manage-contact',$data);
}
	else
	{
	redirect('/master/index');
	}
}



public function add_contact(){


	if($this->session->userdata('is_logged_in')){

 



		$this->load->view('add-contact');
}
	else
	{
	redirect('/master/index');
	}
}

	


public function insert_contact(){
	
		@extract($_POST);
		$table_name ='tbl_contact_m';
		$pri_col ='contact_id';
	 	$id= $this->input->post('contact_id');
		
		
		$data= array(
					'first_name' => $this->input->post('first_name'),
					'ledgertype' => $this->input->post('ledgertype'),	
					'address1' => $address1,
                 	'address3' => $address3,
	 				'group_name' => $this->input->post('maingroupname'),		       
					'accunt' => $this->input->post('groupname'),
				     'alias' => $this->input->post('alias_name'),
					'printname' => $this->input->post('print_name'),
                 	'email' => $this->input->post('email'),
	                'phone' => $this->input->post('phone'),
					'station' => $this->input->post('station'),
	                'contact_person' => $this->input->post('contact_person'),
					'IT_Pan' => $this->input->post('it_pan'),
					'ward' => $this->input->post('ward'),
	                'lst' => $this->input->post('lst_no'),
					'cst' => $this->input->post('cst_no'),
	                'tin' => $this->input->post('tin_no'),
					'fax' => $this->input->post('fax'),
	                'opening_balance' => $this->input->post('op_bal'),
					 'previous_balance' => $this->input->post('prev_bal'),
					'transport' => $this->input->post('transport'),
	                'mobile' => $this->input->post('mobile')
					
					
					);
	   $sesio = array(
					
					'comp_id' => $this->session->userdata('comp_id'),
					'divn_id' => $this->session->userdata('divn_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'maker_id' => $this->session->userdata('user_id'),
					'author_id' => $this->session->userdata('user_id'),
					'maker_date'=> date('y-m-d'),
					'author_date'=> date('y-m-d')
					);
		
		
		$data_entr = array_merge($data,$sesio);
		
    	$this->load->model('Model_admin_login');
		//echo "sss";die;
		if($id!=''){
		//echo "kk";die;
		$this->Model_admin_login->update_user($pri_col,$table_name,$id,$data_entr);
					
		            $table_name ='tbl_contact_m';
		            $pri_col ='contact_id';
	 	            $id= $this->input->post('contact_id');
		            $data= array(
					'first_name' => $this->input->post('first_name'),
					'address1' => $address1,
                 	'address3' => $address3,
					
					'ledgertype' => $this->input->post('ledgertype'),	
	 				'group_name' => $this->input->post('maingroupname'),		       
					'accunt' => $this->input->post('groupname'),
				    'alias' => $this->input->post('alias_name'),
					'printname' => $this->input->post('print_name'),
                 	'email' => $this->input->post('email'),
	                'phone' => $this->input->post('phone'),
					'station' => $this->input->post('station'),
	                'contact_person' => $this->input->post('contact_person'),
					'IT_Pan' => $this->input->post('it_pan'),
					'ward' => $this->input->post('ward'),
	                'lst' => $this->input->post('lst_no'),
					'cst' => $this->input->post('cst_no'),
	                'tin' => $this->input->post('tin_no'),
					'fax' => $this->input->post('fax'),
	                'opening_balance' => $this->input->post('op_bal'),
					'previous_balance' => $this->input->post('prev_bal'),
					'transport' => $this->input->post('transport'),
	                'mobile' => $this->input->post('mobile')
					);
		
					//print_r ($data_entr);
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
									
												
								
								echo "<script type='text/javascript'>";
								echo "window.close();";
								echo "window.opener.location.reload();";
								echo "</script>";
								}
							else
				     		{ 
							
							
							$this->Model_admin_login->insert_user($table_name,$data_entr);
							$lastid = $this->db->insert_id();
							/*$lastid;
							
							
							
							
		//
							$table_name_a ='tbl_address_m';
						   // $pri_col ='addressid';
	 	           // $id=74;
		
			$data1= array(
					
					'address1' => $this->input->post('address1'),
                 	'address3' => $this->input->post('address3'),
	                'City' => $this->input->post('City'),
                 	'state' => $this->input->post('state'),
	                'country' => $this->input->post('country'),
                 	'Street' => $this->input->post('Street'),
	                'pobox' => $this->input->post('pobox'),
                 	'zip' => $this->input->post('zip'),
	                'description' => $this->input->post('textarea'),
					'entityid' => $lastid
						
					);
					*/
					if($maingroupname=='8')
					{
		$ContactLastid=$lastid;
		$openingBal=$this->input->post('op_bal');
		$this->insertOpeningBal($ContactLastid,$openingBal);
					}		          
				  //$this->Model_admin_login->insert_user($table_name,$data1,$data);
					redirect('/master/manage_contact');
				
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
	    redirect('/index.php/master/manage_contact');
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
//--------------------------------close Contact--------------------------------------
//--------------------------------add-sundry-----------------------------------------
public function bill_sundary(){
	
	if($this->session->userdata('is_logged_in')){
	$this->load->view('bill-sundary');
	}
	else
	{
	redirect('/master/index');
	}
	
	
}



public function manage_sundry(){
	
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn

	$this->load->view('manage-sundry',$data);
	}
	else
	{
	redirect('/master/index');
	}
	
	
}




public function insert_bill(){
	
	
	extract($_POST);
		$table_name ='tbl_bill_sundry';
		$pri_col ='bill_sundry_id';
	 	$id= $this->input->post('bill_sundry_id');
 
		//echo "asdas";
		//die;
		$data = array(
					//$sesio,
				 'bill_name' => $this->input->post('bill_name'),
				 'alias_name' => $this->input->post('alias_name'),
				 'print_name' => $this->input->post('print_name'),
				'bill_type' => $this->input->post('bill_type'),
					'bill_sundry_nature' => $this->input->post('bill_sundry_nature'),
					'default_value' => $this->input->post('default_value'),
					'sub_total' => $this->input->post('sub_total'),
					'Goods_in_sale' => $this->input->post('Goods_in_sale'),
					'Goods_in_purchase' => $this->input->post('Goods_in_purchase'),
					'material_issue' => $this->input->post('material_issue'),
					'Material_receipt' => $this->input->post('Material_receipt'),
					'stock_transfer' => $this->input->post('stock_transfer'),
					'affects_accounting' => $this->input->post('affects_accounting'),
					'sale_amount' => $this->input->post('sale_amount'),
					'head_to_post' => $this->input->post('head_to_post'),
					'head_to_past' => $this->input->post('head_to_past'),
					'puramt' => $this->input->post('puramt'),
					'adjustpartyamount' => $this->input->post('adjustpartyamount'),
					'over_and_above' => $this->input->post('over_and_above'),
					'affecting_account' => $this->input->post('affecting_account'),
					'head_to_post' => $this->input->post('head_to_post'),
					'puramt' => $this->input->post('puramt'),
					'party_amount' => $this->input->post('party_amount'),
					'post_over_and_above' => $this->input->post('post_over_and_above'),
					'sundry_to_be_fed' => $this->input->post('sundry_to_be_fed'),
					'bill_sundry_amount' => $this->input->post('bill_sundry_amount'),
					'sundry_to_be_add' => $this->input->post('sundry_to_be_add')
					
					);
										
					
					$sesio = array(
					
					'comp_id' => $this->session->userdata('comp_id'),
					'divn_id' => $this->session->userdata('divn_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id')
					);
		//print_r($sesio);
		$data1 = array_merge($data,$sesio);
		//print_r($data_entr);
				//print_r ($data);
				//$data = array_merge($data1,$sesio);
		$this->load->model('Model_admin_login');
		
		if($id!=''){

					$this->Model_admin_login->update_user($pri_col,$table_name,$id,$data1);
					echo "<script type='text/javascript'>;";
					echo "window.close();";
					echo "window.opener.location.reload();";
					echo "</script>;";
					}
		else
				{
				$this->Model_admin_login->insert_user($table_name,$data1);
								redirect('/index.php/master/manage_sundry');
				}
}
function delete_sundry() {
	$table_name ='tbl_bill_sundry';
	$pri_col ='bill_sundry_id';
	$this->load->model('Model_admin_login');
		$id= $_GET['id'];
		$this->Model_admin_login->delete_user($pri_col,$table_name,$id);
		redirect('/index.php/master/manage_sundry');
}
public function billfunction(){
	
		$data['billid']=$_GET['billid'];
		$this->load->view('get-alies-itemctg',$data);
	
	}

public function aliasbillfunction(){
	
		$data['alias_bill_id']=$_GET['alias_bill_id'];
		$this->load->view('get-alies-itemctg',$data);
	
	}

//---------------------close Sundary-------------
//--------------------------start account function ---------------------------	
	
	

	public function in_account(){
		@extract($_POST);
		$table_name ='tbl_account';
		$fetch ='hiddenaccount';
		 $pri_col ='account_id';
	 	$id= $this->input->post('hiddenaccount');
		$data = array(
					
					'bill_by_bill_details' => $this->input->post('bill_by_bill_details'),
					'broker_wise_reporting' => $this->input->post('broker_wise_reporting'),
					'credit_limits' => $this->input->post('credit_limits'),
					'budgets' => $this->input->post('budgets'),				
					'targets' => $this->input->post('targets'),
					'multi_currency' => $this->input->post('multi_currency'),
					'bank_reconciliation' => $this->input->post('bank_reconciliation'),
					'currency_con_decimal_places' => $this->input->post('currency_con_decimal_places'),
					'post_dated_cheques_payment' => $this->input->post('post_dated_cheques_payment'),
					'maintain_sub_ledgers' => $this->input->post('maintain_sub_ledgers'),
					'posting_acc_through' => $this->input->post('posting_acc_through'),
					'double_entry_system_for_payment' => $this->input->post('double_entry_system_for_payment'),
					'show_acc_current_balance' => $this->input->post('show_acc_current_balance'),
					'maintain_images' => $this->input->post('maintain_images'),
					'balance_stock_updat' => $this->input->post('balance_stock_updat'),
					'ledger_reconciliation' => $this->input->post('ledger_reconciliation'),
					'cheque_printing' => $this->input->post('cheque_printing'),					
					'enab_group_reference' => $this->input->post('enab_group_reference'),
					'tag_bill_refe_group_with' => $this->input->post('tag_bill_refe_group_with'),
					'enforce_amount_alloct_references' => $this->input->post('enforce_amount_alloct_references'),
					'show_pen_till_vouch_date_only' => $this->input->post('show_pen_till_vouch_date_only'),
					'enable_bill_ref_narration' => $this->input->post('enable_bill_ref_narration'),
					'enable_by_bill_for_all_acco' => $this->input->post('enable_by_bill_for_all_acco'),
					'auto_party_Ref_sale_voucher' => $this->input->post('auto_party_Ref_sale_voucher'),
					'auto_party_ref_purch_voucher' => $this->input->post('auto_party_ref_purch_voucher'),
					'brok_to_applied_at' => $this->input->post('brok_to_applied_at'),
					'broker' => $this->input->post('broker'),
					'brokerage' => $this->input->post('brokerage'),
					'enable_in' => $this->input->post('enable_in'),
					'specify_default_brok' => $this->input->post('specify_default_brok'),
					'default_brok_to_pick_fro' => $this->input->post('default_brok_to_pick_fro'),
					'brok_mode_rate' => $this->input->post('brok_mode_rate'),
					'brokerage_rate' => $this->input->post('brokerage_rate'),
					'sep_brok_in_each_voucher' => $this->input->post('sep_brok_in_each_voucher'),
					'post_brok_in_account' => $this->input->post('post_brok_in_account')
					 	
					);
			
			 $sesio = array(
					
					'comp_id' => $this->session->userdata('comp_id'),
					'divn_id' => $this->session->userdata('divn_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'maker_id' => $this->session->userdata('user_id'),
					'author_id' => $this->session->userdata('user_id'),
					'maker_date'=> date('y-m-d'),
					'author_date'=> date('y-m-d')
					);
		
		
		$data12 = array_merge($data,$sesio);

								
		$this->load->model('Model_admin_login');
			
		if($id!=''){
		
					$this->Model_admin_login->update_user($pri_col,$table_name,$id,$data12);
					redirect('/index.php/master/maccount');
					}
		else
				{
				$this->Model_admin_login->insert_user($table_name,$data12);
				redirect('/index.php/master/maccount');
				
				}
				
			}	
			
		public function account(){
	
	if($this->session->userdata('is_logged_in')){
		$this->load->view('add-account');
	}
	else
	{
	redirect('/master/index');
	}
	
	
}
	
	public function maccount(){
	
	if($this->session->userdata('is_logged_in')){
	$this->load->view('add-account');
	}
	else
	{
	redirect('/master/index');
	}
	
	
}

	function delet_account(){
	$table_name ='tbl_account';
	$pri_col ='account_id';
	$this->load->model('Model_admin_login');
		$id= $_GET['id'];
		$this->Model_admin_login->delete_user($pri_col,$table_name,$id);
		redirect('/index.php/master/manage_account');
	}
	
public function get_pop(){

if($this->session->userdata('is_logged_in')){
$this->load->view('add-account-popup');
}
else
{
redirect('/master/index');
}
}
public function get_popp(){


if($this->session->userdata('is_logged_in')){
$this->load->view('add-account-popup2');
}
else
{
redirect('/master/index');
}
}
	
//--------------------------close account function ---------------------------


//--------------------------start payment function ---------------------------	
	
/*
public function payment(){

	if($this->session->userdata('is_logged_in')){
	$this->load->view('invoice-payment');
}
	else
	{
	redirect('/master/index');
	}	
}


//--------------------------close account function ---------------------------




//--------------------------start payment shashi ---------------------------	

public function invoicereport(){

	if($this->session->userdata('is_logged_in')){
	
		$this->load->view('invoice-payment-report');
}
else{
redirect('/master/index');

}
}

*/
//--------------------------close account function ---------------------------

//--------------------------start payment invoice payment correction ---------------------------	

public function invoice_correction(){

	
	if($this->session->userdata('is_logged_in')){
	
		$this->load->view('invoice-payment-correction');
}

else{
redirect('/master/index');

}

}





	
public function itemChallan(){
	if($this->session->userdata('is_logged_in')){
	
	$this->load->view('item-challan');
	}
	else
	{
	redirect('/billing/index');
	}
	
	
}
	



// multiple qty insert 

public function add_multiple_qty(){

	
	if($this->session->userdata('is_logged_in')){
	
		$this->load->view('multiple-product-transfer-quantity');
}

else{
redirect('/master/index');

}

}

//ends
}
?>