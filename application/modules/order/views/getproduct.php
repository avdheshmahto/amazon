<?php
 //$con1=$_REQUEST['con'];
 $con1    = $_GET['con'];
 $company = $_GET['company'];
 $suppliercontact=$_GET['supplier_contact'];
 $prdIdd  = $_GET['commonproduct'];
 

 //echo "fff".$con1;
 $con2=explode("^",$con1);
 $con3=$con2[0];
 $Productctg_id=$con2[1];
 $contactStateQuery=$this->db->query("select *from tbl_contact_m where contact_id='".$_GET['con_id']."'");
 $getContactState=$contactStateQuery->row();
 $getContactState->state_id;

 // echo "<pre>";
 //    print_r($getContactState);
 // echo "</pre>";
?>

<script>
 var x = document.getElementsByClassName("prds");
    function ChangeCurrentCell() {
 }

    ChangeCurrentCell();

    $(document).keydown(function(e){

        if (e.keyCode == 37) { 
            currentCell--;
            alert(currentCell);
            return false;
        }
       if (e.keyCode == 39)
        { 
            currentCell++;
			return false;
        }
	  if (e.keyCode == 38)
        {  
         if(currentCell>0)
          {
            currentCell--;
            //alert(currentCell);
            x[currentCell].focus();
            x[currentCell].select();
          }
         else
         {
           var mx = document.getElementById("ttsp").value;
           currentCell = mx;
           x[currentCell].focus();
           x[currentCell].select();
           currentCell--;
         }
           return false;
    }
     if (e.keyCode == 40) 
       { 
          var mx = document.getElementById("ttsp").value;
        if(currentCell<mx)
         {
	         x[currentCell].focus();
	         x[currentCell].select();
	         currentCell++;
	         e.preventDefault();
	         e.stopPropagation();
	         e.returnValue = false;
    }
   else
   {
    currentCell=0;
	    x[currentCell].focus();
	    x[currentCell].select();
	  	document.getElementById('prdsrch').scrollTop =0;
	   }
	}
});


 var xobj;
 //modern browers
 if(window.XMLHttpRequest)
 {
  xobj=new XMLHttpRequest();
 }
 else if(window.ActiveXObject)
 {
  xobj=new ActiveXObject("Microsoft.XMLHTTP");
 }
 else
 {
   alert("Your broweser doesnot support ajax");
 }
        // pt,pr,tid,q,u,igst,quantity,reorder
    function abc(pro_name,pro_id,pro_qty,unit,inbond,serialTotal){  
//alert(pro_id);
	    var qnTT = Number(pro_qty);
	   
        var pid  =pro_name.split("^");
		var pids = pid[1];
		
		document.getElementById("qty_stock").value = qnTT.toFixed(2);
    document.getElementById("pri_id").value = pids;
		document.getElementById("usunit").value = unit;
		document.getElementById("prd").value    = pro_name;

		document.getElementById("lph").value     = "";
		document.getElementById("prd").value    = pro_name;

    document.getElementById("inboundval").value     = inbond;
    document.getElementById("stockval").value       = serialTotal;

	//	document.getElementById("lpr").innerHTML= pro_id;
		//document.getElementById("lph").value    = pro_id;

   // document.getElementById("inboundval").innerHTML = document.getElementById("inboundval").value;
   // document.getElementById("stockval").innerHTML   = document.getElementById("stockval").value;

  

	 }
</script>

<?php
if($con1!="")
 {
  $location = $company;

  if($prdIdd != ""){
    $qryy = "select * from tbl_product_stock S,tbl_product_mapping M where S.Product_id = M.product_id AND S.productname like '%$con3%' AND find_in_set($company,M.location) AND S.Product_id NOT IN ($prdIdd) GROUP BY  S.Product_id";
   }else{
    $qryy =  "select * from tbl_product_stock S,tbl_product_mapping M where S.Product_id = M.product_id AND S.productname like '%$con3%' AND find_in_set($company,M.location) GROUP BY  S.Product_id";
  }

    $sel=$this->db->query($qryy);
    $i=0;
    foreach($sel->result() as $arr)
    {
    $usageunit = $arr->usageunit;
    $qty = $arr->quantity;
   
    $product_det1  = $this->db->query("Select * from tbl_master_data where serial_number= '$arr->usageunit'");
    $prod_Details1 = $product_det1->row();
    $usunit        = $prod_Details1->keyvalue;		
    $i++;
    $id='d'; 
    $id.=$i; 
    $countid+= count($id);
    //echo $arr->size;
    $sqlunit=$this->db->query("select * from tbl_master_data where serial_number='$arr->size'");
    $fetchsize=$sqlunit->row();	

    $inbondTotal  = 0; $serialTotal = 0;
    $orderQuery1  = $this->db->query("select sum(qty) as sumQty, sum(outboundqty) as outqty from tbl_outbound_details where product_id='".$arr->Product_id."'");
    $inboundsum1  = $orderQuery1->row_array();
    if(sizeof($inboundsum1) > 0){
      $inbondTotal = $inboundsum1['sumQty'] - $inboundsum1['outqty'];
    }
  
    $serialQuery1 = $this->db->query("select sum(quantity) as sumserialQty from tbl_product_serial where product_id = '".$arr->Product_id."' AND location_id = '".$location."'");
    $serial       = $serialQuery1->row_array();

    if(sizeof($serial) > 0){
      $serialTotal = $serial['sumserialQty']; 
    }


?>
<div >
 <input type="text" id="ty<?php echo $id;?>"  class="prds form-control" value='<?php echo $arr->productname.'' ?>^<?php echo $arr->Product_id; ?>' name="<?php echo $id;?>"
 onFocus="abc(this.value,this.id,'<?php echo $qty; ?>','<?php echo $usunit; ?>',<?=$inbondTotal;?>,<?=$serialTotal;?>)"  onClick="abc(this.value,this.id,'<?php echo $qty; ?>','<?php echo $usunit; ?>',<?=$inbondTotal;?>,<?=$serialTotal;?>)" style="width: 100%;" tabindex="-1"  readonly >




</div>


<?php

 }

}


?>
<input type="hidden" value="<?php echo $i;?>" id="ttsp" >
<input type="hidden" id="countid" value="<?php echo $countid;?>">
