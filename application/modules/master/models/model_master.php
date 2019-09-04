<?php
class model_master extends CI_Model {
	
function productCatg_data()
{
	  $this->db->select("*");
	  // $this->db->order_by("prodcatg_id","desc");
      $this->db->from('tbl_prodcatg_mst');  
      $query = $this->db->get();
	  return $result=$query->result();  
}	

function productSubCatg_data()
{
	  $this->db->select("*");
	  // $this->db->order_by("prodcatg_id","desc");
      $this->db->from('tbl_prodcatg_m');  
      $query = $this->db->get();
	  return $result=$query->result();  
}

//===========================================Product Master============================

function product_get($last,$strat)
{
	$query=$this->db->query("select *from tbl_product_stock where status='A'  order by Product_id desc limit $strat,$last");
    return $result=$query->result();  
}
function filterProductList($perpage,$pages,$get){
 	
	     $qry = "select * from tbl_product_stock where status = 'A'";
    
	     if(sizeof($get) > 0)
		 {
        
			   if($get['sku_no'] != "")
				 $qry .= " AND sku_no LIKE '%".$get['sku_no']."%'";
			   
			  if($get['contract'] != "")
				$qry .= " AND contract LIKE '%".$get['contract']."%'";
				
			   if($get['productname'] != "")
				 $qry .= " AND productname LIKE '%".$get['productname']."%'";
				  
			   
			   if($get['usages_unit'] != "")
			   {
				   $unitQuery=$this->db->query("select * from tbl_master_data where keyvalue LIKE '%".$get['usages_unit']."%'");
				   $getUnit=$unitQuery->row();
				   $sr_no=$getUnit->serial_number;
			       $qry .= " AND usageunit ='$sr_no'";
			   }
			if($get['comodity'] != "")
			     $qry .= " AND comodity LIKE '%".$get['comodity']."%'";

			if($get['supplier'] != "")
			     $qry .= " AND supplier LIKE '%".$get['supplier']."%'";
		     }

		    $qry .= " order by Product_id desc limit $pages,$perpage";   
 
  $data =  $this->db->query($qry)->result();
 return $data;
}


function count_product($tableName,$status = 0,$get){
   $qry ="select count(*) as countval from $tableName where status='A'";
    
		if(sizeof($get) > 0)
		 {
			   if($get['sku_no'] != "")
				
				  $qry .= " AND sku_no LIKE '%".$get['sku_no']."%'";
			   
			   if($get['type'] != "")
			   {
				   $unitQuery=$this->db->query("select * from tbl_master_data where keyvalue LIKE '%".$get['type']."%'");
				   $getUnit=$unitQuery->row();
				   $sr_no=$getUnit->serial_number;
			 
				  $qry .= " AND type ='$sr_no'";
				  
			   }
				 
			   if($get['category'] != "")
			   {
				   $unitQuery2=$this->db->query("select * from tbl_prodcatg_mst where prodcatg_name LIKE '%".$get['category']."%'");
				   $getUnit2=$unitQuery2->row();
				   $sr_no2=$getUnit2->prodcatg_id;
			 
				  $qry .= " AND category ='$sr_no2'";
				  
			   }
			   
			   if($get['productname'] != "")
				
				  $qry .= " AND productname LIKE '%".$get['productname']."%'";
				  
			   
			   if($get['usages_unit'] != "")
			   {
				   $unitQuery=$this->db->query("select * from tbl_master_data where keyvalue LIKE '%".$get['usages_unit']."%'");
				   $getUnit=$unitQuery->row();
				   $sr_no=$getUnit->serial_number;
			 
				  $qry .= " AND usageunit ='$sr_no'";
			   }
				
			  if($get['purchase_price'] != "")
			
				  $qry .= " AND unitprice_purchase LIKE '%".$get['purchase_price']."%'";
				  
			  if($get['sale_price'] != "")
			
				  $qry .= " AND unitprice_sale LIKE '%".$get['sale_price']."%'";
				  
	     }
		 
   $query=$this->db->query($qry,array($status))->result_array();
   return $query[0]['countval'];
}


//=============================Contact Master==================================================

function contact_get($last,$strat)
{
	$query=$this->db->query("select *from tbl_contact_m where status='A' ORDER BY contact_id DESC limit $strat,$last");
    return $result=$query->result();  
}

function filterContactList($perpage,$pages,$get)
{

        $qry = "select * from tbl_contact_m where status = 'A'";
		  
        if(sizeof($get) > 0)
		{
        
		   if($get['first_name'] != "")
		      $qry .= " AND first_name LIKE '%".$get['first_name']."%'";
           
		   if($get['group_name'] != "")
		   {
		   $unitQuery=$this->db->query("select * from tbl_account_mst where account_name LIKE '%".$get['group_name']."%'");
	       $getUnit=$unitQuery->row();
	       $sr_no=$getUnit->account_id;
		       
		       $qry .= " AND group_name ='$sr_no'";
		   }
		   
		   if($get['email'] != "")
		      $qry .= " AND email LIKE '%".$get['email']."%'";
			  
   		   if($get['mobile'] != "")
			  $qry .= " AND mobile LIKE '%".$get['mobile']."%'";
			  
		   if($get['phone'] != "")
			  $qry .= " AND phone LIKE '%".$get['phone']."%'";
			  
		 }

		// echo $qry;
		 $qry .= " limit $pages,$perpage";
		 $data =  $this->db->query($qry)->result();
		 return $data;

}

function count_contact($tableName,$status = 0,$get)
{
   $qry ="select count(*) as countval from $tableName where status='A'";
    
		if(sizeof($get) > 0)
		 {
          if($get['first_name'] != "")
		   	  $qry .= " AND first_name LIKE '%".$get['first_name']."%'";
           
		   if($get['group_name'] != "")
		   {
			   $unitQuery=$this->db->query("select * from tbl_account_mst where account_name LIKE '%".$get['group_name']."%'");
		       $getUnit=$unitQuery->row();
		       $sr_no=$getUnit->account_id;
		 
			  $qry .= " AND group_name ='$sr_no'";
			  
		   }
		   
		   if($get['email'] != "")
		      $qry .= " AND email LIKE '%".$get['email']."%'";
			  
		  
		   if($get['mobile'] != "")
			  $qry .= " AND mobile LIKE '%".$get['mobile']."%'";
			  
		   if($get['phone'] != "")
 		     $qry .= " AND phone LIKE '%".$get['phone']."%'";
			
		}
		 
   $query=$this->db->query($qry,array($status))->result_array();
   return $query[0]['countval'];
}

  function tree_all(){
	   $data="";
       $result = $this->db->query("SELECT  id, name,name as text, inside_cat as parent_id ,create_on FROM tbl_category where status = 1 Order by id ASC")->result_array();
        foreach ($result as $row) {
           $data[] = $row;
       }
     return $data;
  }

  function categorySelectbox($parent = 0, $spacing = '', $user_tree_array = ''){
      if (!is_array($user_tree_array))
        $user_tree_array = array();
   
        $sql = "select * from tbl_category where status = 1 AND inside_cat = $parent";
        $query = $this->db->query($sql);
        $data  = $query->result_array();
         if (sizeof($data) > 0) {
           foreach($data as $row) {
             // echo "<option>".$spacing . $row['name']."</option>";
             $user_tree_array[] = array("id" => $row['id'], "name" => $spacing . $row['name'],'praent' => $row['inside_cat']);
             $user_tree_array = $this->categorySelectbox($row['id'],$spacing . '&nbsp;&nbsp;&nbsp;&nbsp;',$user_tree_array);
           }
         }
       return $user_tree_array;
     }

     function category_all($last ,$strat){
	$data="";
  /*echo "SELECT  id, name,name as text, inside_cat as parent_id ,create_on FROM tbl_category where status = 1 Order by id ASC limit $strat,$last";*/
  $result = $this->db->query("SELECT  id, name,name as text, inside_cat as parent_id ,create_on,type,grade FROM tbl_category where status = 1 Order by id DESC ")->result_array();
  if(sizeof($result ) > 0){
       return $result;
  }
}

 function insert_value($post){
  	 $data = date("Y-m-d"); 
     $sql  = "insert into tbl_category set name = ?,inside_cat = ?,create_on = ?";
    return $this->db->query($sql,array($post['category'],$post['selectCategory'],$data));
  
  }

function treeGetParentValue($id = 0, $user_tree_array = ''){
    if (!is_array($user_tree_array))
            $user_tree_array = array(); 

            $sql   = "select * from tbl_category where  id =$id";
            $query = $this->db->query($sql);
            $data  = $query->result_array();

          if (sizeof($data) > 0) {
           foreach($data as $row) {
              $user_tree_array[] = array("id" => $row['inside_cat'],'name'=>$row['name']);
              $user_tree_array   = $this->treeGetParentValue($row['inside_cat'],$user_tree_array);
           }
         }
       return $user_tree_array;
    }

 function edit_Category($post){
    $qry = "update tbl_category set name = ?,inside_cat=?  WHERE id = ?";
    $this->db->query($qry,array($post['category'],$post['selectCategory'],$post['edit']));
}

    function get_child_data($id = 0,$spacing = '',$user_tree_array = ''){
      if (!is_array($user_tree_array))
          $user_tree_array = array(); 

          $sql   = "select * from tbl_category where  inside_cat = $id";
          $query = $this->db->query($sql);
          $data  = $query->result_array();

        if (sizeof($data) > 0) {
         foreach($data as $row) {
            // echo "<option>".$spacing . $row['name']."</option>";
            $user_tree_array[] = array("id" => $row['id'],"name" => $spacing.$row['name']);
            $user_tree_array   = $this->get_child_data($row['id'],$spacing . '&nbsp;&nbsp;&nbsp;&nbsp;',$user_tree_array);
         }
       }

      return $user_tree_array;
    }

	function get_tblmappingData($id){
	//
	  //echo "select * from tbl_product_mapping M,tbl_product_stock S where S.Product_id = M.product_id AND M.suplier_id = $id";
      $query     = $this->db->query("select *,M.location as mloc from tbl_product_mapping M,tbl_product_stock S where S.Product_id = M.product_id AND M.suplier_id = $id");
	  $resultHdr = $query->result_array();
	  // $arr = "";
     if(sizeof($resultHdr) > 0){
    	//  echo "<pre>";
    	// print_r($resultHdr);
    	// echo "</pre>";
    	return $resultHdr;
      }

     return ""; 

    	
	}

	function mod_viewItem($id){ ///tbl_master_data L  find_in_set(M.location,L.serial_number)
	   //echo "select * from tbl_product_mapping M,tbl_product_stock S where S.Product_id = M.product_id AND S.Product_id = $id";
       $query     = $this->db->query("select S.Product_id, S.productname,M.location,M.suplier_id from tbl_product_mapping M,tbl_product_stock S where S.Product_id = M.product_id AND S.Product_id = $id");
       $resultHdr = $query->row_array();
       if(sizeof($resultHdr) > 0){
        // echo "<pre>";
        //   print_r($resultHdr);
        // echo  "</pre>";
     	return $resultHdr;
      }

      return "";

	}

	function mod_viewContact($id){
	   $query     = $this->db->query("select * from tbl_contact_m C,tbl_account_mst A where A.account_id = C.group_name AND C.contact_id = $id");
       $resultHdr = $query->row_array();
       if(sizeof($resultHdr) > 0){
        // echo "<pre>";
        //   print_r($resultHdr);
        // echo  "</pre>";
     	return $resultHdr;
      }

      return "";	
	}

	function get_SelectBoxEntityCode($id){ 

	   $sqlprotype=$this->db->query("select * from tbl_contact_m where group_name=8 AND location = $id");
	   // echo ' <option value="">----Select ----</option>';
	    foreach ($sqlprotype->result() as $fetch_protype){
       ?>
		 <option value="<?php echo $fetch_protype->contact_id;?>"><?php echo $fetch_protype->code; ?></option>
		
	  <?php } 
   }

   function get_getentityRows($id){
   	if($id!=0){
      $qry       = $this->db->query("select * from tbl_contact_m where contact_id = $id");
	  $entityVal = $qry->row();
      $entityCodeValue = $entityVal->entity_code;
      if($entityCodeValue !=""){
      $explodeentity   = explode('^', $entityCodeValue);
      $i=0;

      $qryEntity = $this->db->query("select * from tbl_master_data  where serial_number IN (".$entityVal->entity.")");
	  foreach ($qryEntity->result() as $fetch_protype){
       $entityarrValue = $explodeentity[$i];
     
       $qry1        =  $this->db->query("select * from tbl_contact_m where contact_id In ($entityarrValue)");
	   $entityVal1  =  $qry1->result();

       $dtEntityarr = array();
       $entityIdimplode = array();
      // print_r($entityVal1);
	   foreach ($entityVal1 as  $dtEntity) {
	     $dtEntityarr[]   = $dtEntity->code;
	     $dtEntityidarr[] = $dtEntity->contact_id;
	   }
       
	   $entityimplode   =  implode(',', $dtEntityarr);
	   $entityIdimplode =  implode(',', $dtEntityidarr);

      ?>
        <tr>
			<td>
				<input  type ="hidden" class="form-control" name="entity[]" value="<?=$fetch_protype->serial_number;?>">
				<input  type ="text" class="form-control"  value="<?=$fetch_protype->keyvalue;?>">
			</td>
			<td>
				<input  type ="hidden" class="form-control" value = "<?=$entityIdimplode;?>" name="entity_code[]">
				<input  type ="text" class="form-control" value="<?=$entityimplode;?>">
			</td>
			<td>
				<i class="fa fa-trash  fa-2x" id="quotationdel" style="font-size:20px;" attrVal="<?=$fetch_protype->serial_number;?>" aria-hidden="true"></i>
			</td>
		</tr>
    <?php $i++;} 
    } }
    }
  }

?>
