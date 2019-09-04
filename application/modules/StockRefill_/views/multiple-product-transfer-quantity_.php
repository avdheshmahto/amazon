<?php
$this->load->view("header.php");

?>
	 <!-- Main content -->
	 <div class="main-content">
			
			<ol class="breadcrumb breadcrumb-2"> 
				
				
			</ol>
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
				<li><a href="#">Stock Refill</a></li> 
				
				<li class="active"><strong><a href="#">Add Multiple Product Quantity</a></strong></li> 
			</ol>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h4 class="panel-title"><strong>Product List</strong></h4>
							<ul class="panel-tool-options"> 
								<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
							</ul>
						</div>
						<div class="panel-body">
						<form method="post" action="insertstockreff">
							<div class="table-responsive">
							<div class="clearfix"></div>
<p><input type="submit" class="btn btn-primary" name="save" value="Save"  /></p>
<table class="table table-striped table-bordered table-hover dataTables-example" >

<thead>
<tr><th style="display:none">Id</th>
	   <th>Location</th>
		<th>Category Name</th>
        <th>Product Name</th>
		<th>New Quantity</th>
      	<th>Total Quantity</th>
</tr>
</thead>

<tbody>
<?php
	$seQu=$this->db->query("select * from tbl_product_stock where status='A'");
$i=1;
foreach($seQu->result() as $fetch){


	  $rp = "SELECT * FROM tbl_product_serial WHERE Product_id ='".$Product_id."' and  comp_id='".$this->session->userdata('comp_id')."' and location_id='".$location_id1."'"; 
		  $leadSourceQuery=$this->db->query($rp);

  $leadSourceRow=$leadSourceQuery -> row();
 		
			$industry_idQuery=$this->db->query("select * from tbl_location where status='A' and comp_id = '".$this->session->userdata('comp_id')."' limit 0,1");

		$industry_idFetch=$industry_idQuery -> row();	
		

	 $fetchschool="select *from tbl_prodcatg_mst where prodcatg_id='$fetch->category'";
 $fetchschool2=$this->db->query($fetchschool);
 $school3=$fetchschool2->row();
							

?>

<tr class="gradeC record">
 <th style="display:none;"><input type="checkbox" name="product_id[]" value="<?php echo $fetch->Product_id; ?>" checked="checked" style="display:none;" /></th>
<th><?php echo $industry_idFetch->location_name;  ?></th>
<th><?php echo $school3->prodcatg_name;  ?></th>
<th><?php echo $fetch->productname; ?></th>
<th><input type="text" name="new_quantity[]" onChange="qun(this.id)" id="newquantity<?php echo $i;?>"  value="" /></th>
   
    <?php $selid=$this->db->query("select * from tbl_product_stock where  Product_id='$fetch->Product_id'");
     $selfetch=$selid -> row();
	
	// print_r($selfetch);
 ?>
<th><input type="hidden" name="quantity[]" id="quantity<?php echo $i;?>_" value="<?php echo $selfetch->quantity;?>"><?php echo $selfetch->quantity;?>
</th>
</tr>
<?php $i++; }  ?>
</tbody>
</table>
<script>
function qun(q)

  {	

  	//var abq=document.getElementById("abqt").value; 
//alert(q);
	var zz=document.getElementById(q).id;
//alert(zz);
	var myarra = zz.split("newquantity");

	var asx= myarra[1];

	//alert(asx);

	var pri=document.getElementById("newquantity"+asx).value;

	var qnty=document.getElementById("quantity"+asx).value;
	//alert(qnty);
//	alert(pri);

if(Number(pri)>Number(qnty)){
alert("***New Quantity Exceed The Actual Quantity In Stock***");
document.getElementById("newquantity"+asx).focus();
}
}

</script>
</div>
</div>
</form>
</div>
</div>
</div>
<?php

$this->load->view("footer.php");
?>