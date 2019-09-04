

<?php
    $this->load->view("header.php");

	$tableName='tbl_contact_m';
	$location='manage_contact';
			
	$userQuery = $this -> db
	    -> select('*')
	    -> where('contact_id',$_GET['id'])
	    -> or_where('contact_id',$_GET['view'])
	    -> get('tbl_contact_m');
	$branchFetch = $userQuery->row();
	$quryinv     = $this->db->query("select *from tbl_sales_order_hdr");
	$getInv      = $quryinv->row();

?>
 <!-- Main content -->
  <div class="main-content">
	<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
	        <li><a href="#">Master</a></li> 
	        <li class="active"><strong>Add  Order</strong></li>
			<div class="pull-right">
	           <a href="<?=base_url('order/manage_order');?>" class="btn btn-sm btn-black btn-outline"><i class="fa fa-list" aria-hidden="true"></i>Manage  Order</a>
	          <!--  <button type="button" class="btn btn-sm btn-black btn-outline delete_all" ><i class="fa fa-trash-o"></i>Delete</button> -->
	        </div>
		</ol>
        <div class="row">
				<div class="col-lg-12" id="listingData">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h4 class="panel-title">Add Purchase Order</h4>
							<div id="massageData" class="text-center " style="font-size: 15px;color: red;position: absolute;left: 37%;"></div> 
							<ul class="panel-tool-options"> 
								<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
								<li><a data-rel="reload"><i class="icon-arrows-ccw"></i></a></li>
								<!-- <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li> -->
							</ul> 
						</div>

		<form action="insertPurchaseOrder" method="post">
		 <div class="panel-body">
          <div class="row">
			<div class="col-lg-12">

				<div class="panel panel-default">
				   <div class="panel-body">
				   <div class="row">
					 <div class="form-group">
					  <div class="col-sm-3">
					 	<label for="company">STORAGE LOCATION:</label>
					    <select name="company"  class="form-control" id="company"  required>
						   <option value="">----Select ----</option>
							<?php 
								$sqlprotype=$this->db->query("select * from tbl_master_data where param_id=22");
								foreach ($sqlprotype->result() as $fetch_protype){
							?>
					 	   <option value="<?php echo $fetch_protype->serial_number;?>"><?php echo $fetch_protype->keyvalue; ?></option>
							<?php } ?>
	                    </select>
<!-- onchange= "maplocation(this.value)" -->
					  </div>

					   
                      
					  <div class="col-sm-3">
						<label for="contact_id_copy" > REQUESTOR NAME:</label>
						<select name="contact_id"   id="contact_id_copy" class="form-control"  required><!-- onchange="destinationfunction(this.value);" -->
							<option value="">-- Select --</option>
							<?php
							$contQuery=$this->db->query("select * from tbl_contact_m where status='A' and group_name='5'");
							foreach($contQuery->result() as $contRow)
							{
							?>
								<option value="<?php echo $contRow->contact_id; ?>">
								<?php echo $contRow->first_name.' '.$contRow->middle_name.' '.$contRow->last_name; ?>
								</option>
							<?php } ?>
						</select>
					    </div>
                        <div class="col-sm-3">
					 	<label for="po_order">Requestor LOCATION:</label>
					 	 
						
						   <select name="destination" required  id="destination" onchange="mapconsigneeAddress(this.value,'requester');"  class="form-control ui fluid search dropdown location">
							<option value="" >-- Select --</option>
							<?php
							  $contQuery=$this->db->query("select * from tbl_contact_m where status='A' and group_name='8'");
							   foreach($contQuery->result() as $contRow)
							    {
							?>
							  <option value="<?php echo $contRow->contact_id; ?>">
							   <?=$contRow->code; ?>
							 </option>
						<?php } ?>
					   	 </select>
						<?php
						$this->load->helper('date');

                         $date = date('Y-m-d'); 

						?>
					   
					   <!--<input type="text"  class="form-control" id="destination"  name="order" value="" onblur="CheckPo(this.value,this);"  autocomplete="off" /> -->
                      </div>

                      <div class="col-sm-3">
						<!--<label for="order_date">STN DATE:</label>
						  <input type="date"  class="form-control" id="order_date"  name="order_date" value="<?=$date;?>" />
					     -->
					    <label for="consignee_address"> Requestor ADDRESS:</label>
                        <textarea class="form-control" id="consignee_address"  name="consignee_address" required></textarea>
                        <!-- <input type="text"   value="" /> -->
					     </div>
					    
                        <div class="col-sm-3">
						 <label for="consignee_id" > CONSIGNEE LOCATION:</label>
                       <!-- <input type="text"  class="form-control" id="consignee_id"  name="consignee_id" value="" /> -->
                         <select name="consignee_id"   id="consignee_id" class="form-control" onchange="destinationfunction(this.value);"><!--  -->
							<option value="">----Select ----</option>
							<?php 
							 $sqlprotype=$this->db->query("select * from tbl_master_data where param_id=22");
							 foreach ($sqlprotype->result() as $fetch_protype){
							?>
					 	   <option value="<?php echo $fetch_protype->serial_number;?>"><?php echo $fetch_protype->keyvalue; ?></option>
							<?php } ?>
						</select>
						
					    </div>
                        <div class="col-sm-3">
						<label for="contact_id_copy"> CONSIGNEE LOCATION CODE:</label>
                        <!-- 
                        <input type="text"  class="form-control" id="consignee_details"  name="consignee_details" value="" />
						 -->
						<select name="consignee_details" required  id="consignee_details" onchange="mapconsigneeAddress(this.value,'consignee');" class="form-control ui fluid search dropdown location">
							 <option value="" >-- Select --</option>
						<!-- -->
					   	 </select>
					    </div>
                        
                        <div class="col-sm-3">
						<label for="contact_id_copy"> CONSIGNEE ADDRESS:</label>
                        <textarea class="form-control" id="consignee_address2"  name="consignee_address2"></textarea>
                        <!-- <input type="text"   value="" /> -->
						
					    </div>
						
						<div class="col-sm-3">
						<label for="order_date">STN NUMBER:</label>
						  <input type="text"  class="form-control" id="stn_no"  name="stn_no" value="<?=$stn_no;?>" required/>
					    </div>
                        
                        <div class="col-sm-3">
                        <label for="order_date">STN DATE:</label>
						  <input type="date"  class="form-control" id="order_date"  name="order_date" value="<?=$date;?>" required/>
					    
						<label for="contact_id_copy"  style="display: none;"> DOCKET NO.:</label>
                        
                        <input type="text"  class="form-control" id="docket_no"  name="docket_no" value=""  style="display: none;"/>
						
					    </div>
                        
                        <div class="col-sm-3" style="display: none;">
						<label for="contact_id_copy"> Vehicle NO.:</label>
                        
                        <input type="text"  class="form-control" id="vehicle_no"  name="vehicle_no" value="" />
						
					    </div>
					  </div>
					</div>
				 </div>
				</div>
			</div>
		</div>

        <div class="table-responsive ">
				<table class="table table-striped table-bordered table-hover" >
					<tbody>
					 <tr class="gradeA">
						<th>Product Name</th>
						<th>Unit</th>
						<th>Quantity</th>
						<th style="display: none;">Actual Qty</th>
						
						<th>Inbound Stock Qty</th>
						<th>Stock IN Qty</th> 
					 </tr>

					<tr class="gradeA">
						<td style="width:280px;">
							<div class="input-group"> 
							<div style="width:100%; height:28px;">
							<input type="text" name="prd"  onkeyup="getdata()" class="form-control" onClick="getdata()" id="prd" style=" width:230px;"  placeholder=" Search Items..." autocomplete="off">
							<input type="hidden"  name="pri_id" id='pri_id'  value="" style="width:80px;"  />
							<!-- <img  style="display:none" src="<?php echo base_url();?>/assets/images/search11.png"  onClick="openpopup('<?=base_url();?>SalesOrder/all_product_function',1200,500,'view',<?=$sales[$i]['1'];?>)" /> -->
						    </div>
	                        </div>
							<div id="prdsrch" style="color:black;padding-left:0px; width:83%; height:110px; max-height:110px;overflow-x:auto;overflow-y:auto;padding-bottom:5px;padding-top:0px; position:absolute;">
							 <?php
							   $this->load->view('getproduct');
	                         ?>
							</div>
						</td>
                        <td>
						<input type="text" readonly="" id="usunit" style="width:70px;" class="form-control"> 
						</td>
	                    <td>
						  <b id="lpr"></b>
						  <input type="number" step="any" id="lph" min="1"  onkeyup="checkqtyinstock(this.value)"  value="" class="form-control" style="width:150px;">
					    </td> 
						<td style="display: none;"><input type="text" id="qty_stock" class="form-control"  style="width:70px;" readonly></td>
						<td><input type="text"   id="inboundval" class="form-control"   style="width:70px;" readonly></td>
						<td><input type="text"   id="stockval"   class="form-control"   style="width:70px;" readonly / ></td> 
					</tr>
				  </tbody>
			</table>
        </div>
		
		<div class="" id="style-3-y">
		<div class="force-overflow-y">
		<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover dataTables-example_1" id="invo">
			<thead>
			<tr>
			<th class="tdcenter">Sl No</th>
			<th class="tdcenter">Item Number & Description</th>
			<th class="tdcenter">UOM</th>
			<th class="tdcenter">Ordered Qty</th>
			<!-- <th class="tdcenter">Actual Qty</th> -->
			<th class="tdcenter">Action</th>
			</tr>
			</thead>
			<tbody  id="invoice">
            </tbody>
		</table>
		</div>	  

		</div>
		</div><!--scrollbar-y close-->		

		


		<!-- <div style="width:100%; background:#dddddd; padding-left:0px; color:#000000; border:2px solid "> -->
		


				<!-- <div style="width:100%; background:white;   color:#000000;  max-height:170px; overflow-x:auto;overflow-y:auto;" id="m">
				<table id="invoice"  style="width:100%;background:white;margin-bottom:0px;margin-top:0px;min-height:30px;" title="Invoice" class="table table-bordered blockContainer lineItemTable ui-sortable"  >

				<tr></tr>
				</table> -->
			<!-- </div> -->
		</div>

<input type="hidden" name="rows" id="rows">
<!--//////////ADDING TEST/////////-->
<input type="hidden" name="spid" id="spid" value="d1"/>
<input type="hidden" name="ef" id="ef" value="0" />

<div class="table-responsive">
 <table class="table table-striped table-bordered table-hover" >
	<tbody>
	<!-- 	<tr class="gradeA">
		<th>Sub Total</th>
		<th>&nbsp;</th>
		<th>
		<input type="text" placeholder="Placeholder" id="sub_total" readonly="" name="sub_total" class="form-control">
		</th>
		</tr>

		

        <tr class="gradeA">
		<th>Grand Total</th>
		<th>&nbsp;</th>
		<th><input type="number" readonly="" step="any" id="grand_total" name="grand_total" placeholder="Placeholder" class="form-control"></th>
		</tr>
		<tr class="gradeA">
		<th>&nbsp;</th>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
		</tr>
		<tr class="gradeA">
		<th> -->

		<!-- <th>&nbsp;</th>
		<th >
		
		</th></th> -->
		</tr>
	  </tbody>
    </table>
   </div>
   
   </div>
   <div class ="pull-right">
   <input class="btn btn-sm btn-black btn-outline" type="button" value="SAVE"   id="sv1" onclick="fsv(this)" >
		&nbsp;<a href="<?=base_url();?>order/manage_order" class="btn btn-sm btn-black btn-outline">Cancel</a>
   </div>
</form>
  </div>
  </div>
</div>
<!-- /.modal-dialog -->

<script>
//add item into showling list
	window.addEventListener("keydown", checkKeyPressed, false);
	      //funtion to select product
	      function checkKeyPressed(e){
			      var s=e.keyCode;
			      var ppp   = document.getElementById("prd").value;
			      var sspp  = document.getElementById("spid").value;
			      var ef    = document.getElementById("ef").value;
					ef      = Number(ef);
			
			      var countids = document.getElementById("countid").value;
			      for(n=1;n<=countids;n++)
			       {
			          document.getElementById("tyd"+n).onkeyup  = function (e) {
			          var entr =(e.keyCode);
			          if(entr==13){
			            document.getElementById("lph").focus();
			            document.getElementById("prdsrch").innerHTML=" ";
	                  }
			       }
			     }
    
            document.getElementById("lph").onkeyup = function (e) {
            var entr = (e.keyCode);
            if (e.keyCode == "13")
	        {
	          e.preventDefault();
              e.stopPropagation();
		   if(ppp!=='' || ef==1)
	        {

	       // var productId  = document.getElementById("pri_id").value;	
	       // var returnval  = checkStockIn(productId);

	      //   if(returnval == true){
       //         	adda();	  	
		   		// var ddid = document.getElementById("spid").value;
			    // var ddi  = document.getElementById(ddid);
			    // ddi.id   = "d";
       //      }else if(returnval == false){

	      //       document.getElementById("lph").value = "";
       //          return false;
       //  	}

	       	adda();	  	
	   		var ddid = document.getElementById("spid").value;
		    var ddi  = document.getElementById(ddid);
		    ddi.id   = "d";
           }
	       else
	       {
	        alert("Enter Correct Product");
	       }
	       return false;
       }
    }
}




/////////////////////////////////////////////

function fsv(v)
{
var rc=document.getElementById("rows").value;
if(rc!=0)
{
v.type="submit";
}
else
{
	alert('No Item To Save..');	
}
}


function getdata()
	{
		// alert('sss');
	currentCell          = 0;
    var product1         = document.getElementById("prd").value;

    var product          = product1;
	var conatctId        = document.getElementById("contact_id_copy").value;
	

	var company          = document.getElementById("company").value;
    
    var prdId            =  getvalues();
 

   // var state        = document.getElementById("state").value;
   // alert();

   if(company=='')
	{
		alert('Please Select  Storage Location: !');
		document.getElementById("company").focus();
		return false;
	}

	if(conatctId=='')
	{
		alert('Please Select  Contact !');
		document.getElementById("contact_id_copy").focus();
		return false;
	}	
		
	
		
	if(xobj)
    {
		var obj=document.getElementById("prdsrch");
		//alert(obj);
		xobj.open("GET","getproduct?con="+product+"&con_id="+conatctId+"&company="+company+"&commonproduct="+prdId,true);
		xobj.onreadystatechange=function()
		{
		if(xobj.readyState==4 && xobj.status==200)
		  {
			console.log(xobj.responseText);
			obj.innerHTML=xobj.responseText;
		  }
		}
	}
	xobj.send(null);
}
  
////////////////////////////////////////////////////

 function slr(){
		var table    = document.getElementById('invoice');
        var rowCount = table.rows.length;
		  for(var i=1;i<rowCount;i++)
		  {    
              table.rows[i].cells[0].innerHTML=i;
		  }
   }  
        //////////////////////////////////////////////////////////////

    var rw=0;
	function adda()
		{ 
		    var qn      =   document.getElementById("qty_stock").value;
		    var unit    =   document.getElementById("usunit").value;  // unit value
			var lph     =   document.getElementById("lph").value;     // enter quantity
		        //default
			var rows    =   document.getElementById("rows").value;     //row value
			var pri_id  =   document.getElementById("pri_id").value;  //item id

			var pd 		=   document.getElementById("prd").value;    //item id
		   	var table   =   document.getElementById("invoice");

		   	var inboundval =   document.getElementById("inboundval").value;    //item id
		   	var stockval   =   document.getElementById("stockval");

			var rid     =   Number(rows)+1;
	        document.getElementById("rows").value=rid;

			if(Number(lph) == 0 || Number(lph) == ""){
               alert('Please Enter Quantity Value !');
               return false;
            }
            // alert(inboundval);
            if(Number(lph) > Number(inboundval)){
                   alert('Please Enter less Value and equal form Inbound Stock Qty !');
                    document.getElementById("lph").value = 1;
                   return false;
            }
            if(Number(lph) > Number(stockval)){
                   alert('Please Enter less Value and equal form Stock Qty !');
                   document.getElementById("lph").value = 1;
                   return false;
            }

				//totalSum();	
				clear();

                currentCell = 0;
              if(pd!="")
			     {
			       //alert(pd);
			       var indexcell=0;
			       var row = table.insertRow(-1);
			       rw = rw+0;
				   //cell 0st

				    var cell=cell+indexcell;		
				 	cell = row.insertCell(0);
					//cell.style.width=".20%";
					cell.align="center"
				  	cell.innerHTML=rid;
				
				
				    //cell 1st item name
	                indexcell=Number(indexcell+1);		
	                var cell=cell+indexcell;	
	 		
	                cell = row.insertCell(indexcell);
				    //cell.style.width = "11%";
				    cell.align = "center";

    //============================item text ============================

				    var prd = document.createElement("input");
					prd.type="text";
					prd.border ="0";
					prd.value=pd;	
					prd.name='pd[]';//
					prd.id='pd'+rid;//
					prd.readOnly = true;
					prd.style="text-align:center";  
					//	prd.style.width="100%";
					prd.style.border="hidden"; 
					cell.appendChild(prd);
				    var priidid = document.createElement("input");
					priidid.type="hidden";
					priidid.border ="0";
					priidid.value=pri_id;	
					priidid.name='main_id[]';//
					priidid.id='main_id'+rid;//
					priidid.readOnly = true;
					priidid.style="text-align:center";  
					//	priidid.style.width="100%";
					priidid.style.border="hidden"; 
					cell.appendChild(priidid);
							
							
					var unitt = document.createElement("input");
					unitt.type="hidden";
					unitt.border ="0";
					unitt.value=unit;	
					unitt.name='unit1[]';//
					unitt.id='unit'+rid;//
					unitt.readOnly = true;
					unitt.style="text-align:center";  
	                //unitt.style.width="100%";
					unitt.style.border="hidden"; 
					cell.appendChild(unitt);
					
						// ends here
	
	
	//#################cell 2nd starts here####################//
	
	
	
	
			indexcell = Number(indexcell+1);		
			var cell  = cell+indexcell;
		        cell  = row.insertCell(indexcell);
			//	cell.style.width="3%";
			//	cell.style.display="none";
				cell.align="center"
				var qty_stockK = document.createElement("input");
							qty_stockK.type         = "text";
							qty_stockK.border       = "0";
							qty_stockK.value        = unit;	    
							qty_stockK.name         ='unit[]';
							qty_stockK.id           ='unit'+rid;
							qty_stockK.readOnly     = true;
							qty_stockK.style        = "text-align:center";
						    qty_stockK.style.border ="hidden"; 
							cell.appendChild(qty_stockK);
	
	
	
	
	
			indexcell = Number(indexcell+1);		
			var cell  = cell+indexcell;
		        cell  = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center"
				var salepr = document.createElement("input");
							salepr.type="text";
							salepr.border ="0";
							salepr.value=lph;	    
							salepr.name ='qty[]';
							salepr.id='qty'+rid;
							salepr.readOnly = true;
							salepr.style="text-align:center";
						//	salepr.style.width="100%";
							salepr.style.border="hidden"; 
							cell.appendChild(salepr);
					
 						
		//======================================defult Edit And Delete========================================
		
		        indexcell=Number(indexcell+1);		
		        var cell=cell+indexcell;
		        var imageloc="/mr_bajaj/";
		        var cell = row.insertCell(indexcell);
				//cell.style.width="3%";
				cell.align="center";
				

					
		            var edt = document.createElement("button");
						edt.type ="button";
						edt.setAttribute("class", "btn btn-xs btn-black");
						edt.name ='ed';
						edt.style="margin-right: 10px;";
						edt.id='ed'+rid;
						edt.innerHTML='<i class="icon-pencil"> </i>';
						edt.onclick= function() { editselectrow(delt.id,edt); };
						cell.appendChild(edt);

   

			        var delt =document.createElement("button");
			        	delt.type ="button";
						delt.setAttribute("class", "btn btn-xs btn-black");
						delt.innerHTML='<i class="icon-trash"> </i>';
						delt.name ='dlt';
						delt.id='dlt'+rid;
						delt.onclick= function() { deleteselectrow(delt.id,delt); };
					    cell.appendChild(delt);
               
                $("#style-3-y").addClass("scrollbar-y");
				
			}
			else
			{
			   if(pd==0)
			 	{
				  alert('***Please Select PRODUCT ***');
				}

				
				
	        }

}

  function clear()
   {
    // this finction is use for clear data after adding invoice
  // document.getElementById("qty_stock").value = "";
	document.getElementById("usunit").value    = "";  // unit value
	document.getElementById("lph").value       = "";     // enter quantity
	document.getElementById("prd").value       = "";
    document.getElementById("pri_id").value    = "";
    document.getElementById("inboundval").value     = "";
    document.getElementById("stockval").value       = "";
    document.getElementById("prd").focus();	
   }






////////////////////////////////// starts edit code ////////////////////////////////


		function editselectrow(d,r) //modify dyanamicly created rows or product detail
		 {
		 	//alert(d);
	 	    var regex = /(\d+)/g;
			nn = d.match(regex)
			id = nn;
		    if(document.getElementById("prd").value!=''){
				document.getElementById("lph").focus();
				alert("Product already in edit Mode");
			 	return false;
		    }
           // ####### starts ##############//
            var pd       = document.getElementById("pd"+id).value;
		    var main_id  = document.getElementById("main_id"+id).value;
	        var unit     = document.getElementById("unit"+id).value;
            var qn       = document.getElementById("qty"+id).value;
		 //	var actual   = document.getElementById("actual"+id).value;
		
			document.getElementById("pri_id").value    = main_id;
		    document.getElementById("prd").value       = pd;
			document.getElementById("usunit").value    = unit;
			document.getElementById("lph").value       = lph;
			//document.getElementById("qty_stock").value = actual;
			
            // ####### ends ##############//
			//editDeleteCalculation();
            $("#"+d).parent().parent().remove();
            document.getElementById("prd").focus();
		}

////////////////////////////////// ends edit code ////////////////////////////////




////////////////////////////////// starts delete code ////////////////////////////////

function deleteselectrow(d,r) //delete dyanamicly created rows or product detail
 {
 //alert('sasd');
var regex = /(\d+)/g;

nn = d.match(regex)
id = nn;
if(document.getElementById("prd").value!=''){
		document.getElementById("qn").focus();
    alert("Product already in edit Mode");
    return false;
}
        var i = $("#"+d).parent().parent();
        var cnf = confirm('Are You Sure..??? you want to Delete line no1.'+(id));
		if (cnf== true)
		 {
		   i.remove();
		  // slr();
		  // editDeleteCalculation();
		}
			
}
		////////////////////////////////// ends delete code ////////////////////////////////



// ##### ends ###########



  
  
  
  



function getVendor()
{

var state=document.getElementById("state").value;
var xhttp = new XMLHttpRequest();
xhttp.open("GET", "getVendor?state="+state, false);
xhttp.send();
document.getElementById("contact_id_copy").innerHTML = xhttp.responseText;
	
	
}

      
</script>
<?php
$this->load->view("footer.php");
?>

<script type="text/javascript">

  function getvalues(){
     var inps  = document.getElementsByName('main_id[]');
     var myarr = [];
	    for (var i = 0; i <inps.length; i++) {
	      var inp = inps[i];
	      //alert("main_id["+i+"].value="+inp.value);
	      myarr.push(inp.value);
	    }
     var webcamval = myarr;
    return webcamval.join(",");
 }

 function destinationfunction(ths){
    $.ajax({   
	    type: "POST",  
		url: "ajax_getdestination",  
		cache:false,  
		data: {'id':ths},  
		success: function(data)  
		{ 
		  $("#consignee_details").empty().append(data).fadeIn();
		  mapconsigneeAddress($('#consignee_details').val(),'consignee');
	    }   
	});
 	
 }

 function maplocation(ths){
 	       $.ajax({   
			    type: "POST",  
				url: "ajax_maplocation",  
				cache:false,  
				data: {'id':ths},  
				success: function(data)  
				{  
				    // alert(data);
				    $("#contact_id_copy").empty().append(data).fadeIn();
				    destinationfunction(NULL);
				    mapconsigneeAddress($('#destination').val());
		            var consignee_name =  $("#company option:selected").text();
			        //$('#consignee_id').val(consignee_name);
			    }   
		});
 }

  function mapconsigneeAddress(ths,ctype){
 	       $.ajax({   
			    type: "POST",  
				url: "ajax_getconsigneeDetails",  
				cache:false,  
				data: {'id':ths},  
				success: function(data)  
				{  
			    
			    var obj =  JSON.parse(data);
			    //console.log(obj.address);
			   // alert(obj.address)
			   
			    if(obj.address != null){
			    	if(ctype == 'requester')
			         $("#consignee_address").empty().val(obj.address);
			        else
			         $("#consignee_address2").empty().val(obj.address);


                }
			    // if(obj.name != null){
       //            $("#consignee_id").empty().append(obj.name).fadeIn();
			    //  }
			    // if(jsonpars['name'] != null){
       //            $("#consignee_id").empty().append(jsonpars['name']).fadeIn();
			    //  }

				}   
		});
 }

   function CheckPo(val,ths){
   	$("#massageData").empty().append("").fadeIn();
		 	$.ajax({   
			    type: "POST",  
				url: "CheckPurchaseOrderNo",  
				cache:false,  
				data: {'id':val},  
				success: function(data)  
				{  
			      $("#massageData").empty().append(data).fadeIn();
			      if(data != ""){
				    $('#po_order').val("");
				   }
				}   
		});
   }

  //  function checkStockIn(productid){
  //  	 //alert(productid);

  //    var location   = document.getElementById("company").value;
  //    var quantity   = document.getElementById("lph").value;
  //    //$("#massageData").empty().append("").fadeIn();
		//  $.ajax({   
		// 	type: "POST",  
		// 	url: "checkStockInqty",  
		// 	cache:false,  
		// 	data: {'id':productid,'location':location,'quantity':quantity},  
		// 	success: function(data)  
		// 	{ 
		// 	 alert(data); 
		// 	 console.log(data);
		// 	 var obj = JSON.parse(data);
  //            console.log(obj.sucessval);
		// 	 if(obj.sucessval == false){
  //              return false;
		// 	 }else if(obj.sucessval == true){
  //              return true;
		// 	 }

			  
		//     }   
		// });
		// // return false;
		 	
  //  }


</script>