
<?php
$this->load->view("header.php");
 $entries = "";
 if($this->input->get('entries')!=""){
  $entries = $this->input->get('entries');
 }
 
?>
 <!-- Main content -->
  <div class="main-content">
	<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
	        <li><a href="#">Master</a></li> 
	        <li class="active"><strong>Add Item</strong></li>
			
	        <div class="pull-right">
	           <button type="button" class="btn btn-sm btn-black btn-outline" data-toggle="modal" formid = "#contactForm" data-target="#modal-0" id="formreset"><i class="fa fa-plus" aria-hidden="true"></i>Add Contact</button>
	           <button type="button" class="btn btn-sm btn-black btn-outline delete_all" ><i class="fa fa-trash-o"></i>Delete</button>
	        </div>
		</ol>
        <div class="row">
				<div class="col-lg-12" id="listingData">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h4 class="panel-title">Manage Contact</h4>
						      <ul class="panel-tool-options"> 
								<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
								<li><a data-rel="reload" onclick="ajex_contactListData();"><i class="icon-arrows-ccw"></i></a></li>
								<!-- <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li> -->
							  </ul> 
						 </div>
						
					<div class="panel-body" style="padding-bottom:0px;">
					  <div class="row">
                       <div class="col-sm-5">
						<label>Show 
                        <select name="DataTables_Table_0_length" url="<?=base_url();?>master/Account/manage_contact?<?='first_name='.$_GET['first_name'].'&contact_person='.$_GET['contact_person'].'&group_name='.$_GET['group_name'].'&email='.$_GET['email'].'&mobile='.$_GET['mobile'].'&phone='.$_GET['phone'];?>" aria-controls="" id="entries" class="">
						<option value="10" <?=$entries=='10'?'selected':'';?>>10</option>
						<option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
						<option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
						<option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
						</select> entries
						</label>
						<p>Showing <?=$dataConfig['page']+1;?> to <?php
						$m=$dataConfig['page']==0?$dataConfig['perPage']:$dataConfig['page']+$dataConfig['perPage'];
						echo $m >= $dataConfig['total']?$dataConfig['total']:$m;
						?> of <?=$dataConfig['total'];?> Entries</p>
						</div>
						
                        <div class="col-sm-7">
						<div class="pull-right">
						<label>Search: &nbsp;&nbsp;<input type="text" id="searchTerm" class="form-control input-sm" onkeyup="doSearch()"  placeholder="What you looking for?" aria-controls="" style="float:right; width:auto;"></label>&nbsp;&nbsp;
						<!-- <button type="button" class="btn btn-sm btn-black btn-outline">Copy</button> -->
						<button type="button" class="btn btn-sm btn-black btn-outline" onclick="exportTableToExcel('tblData')">Excel</button>
						<!-- <button type="button" class="btn btn-sm btn-black btn-outline">PDF</button>
						<button type="button" class="btn btn-sm btn-black btn-outline">Column visibility</button> -->
						</div>
						</div>
						</div> 
						
				</div>
						
	  <div class="panel-body">
		
            <div class="table-responsive">
            <form method="get">
             <table class="table table-striped table-bordered table-hover dataTables-example1" id="tblData" >
			  	 <thead>
				 <tr>
					<th><input name="check_all" type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>
				    <th>Contact Name</th>
					<!-- <th>Contact Person</th> -->
					<th>Group Name</th>
			        <th>Email Id</th>
					<th>Mobile No.</th>
					<th>Phone No.</th>
					<th style="width:10%;">Action</th>
				 </tr>
				   <tr>
                	<td>&nbsp;</td>
					<td><input name="first_name"  type="text"  class="search_box form-control input-sm"  value="" /></td>
					<!-- <td><input name="contact_person"  type="text"  class="search_box form-control input-sm"  value="" /></td> -->
					<td><input name="group_name"  type="text"  class="search_box form-control input-sm"  value="" /></td>
					<td><input name="email"  type="text"  class="search_box form-control input-sm"  value="" /></td>
					<td><input name="mobile"  type="text"  class="search_box form-control input-sm"  value="" /></td>
					<td><input name="phone" type="text"  class="search_box form-control input-sm"  value="" /></td>
					<td><button type="submit" class="btn btn-sm btn-black btn-outline" name="filter" value="filter" ><span>Search</span></button></td>
                </tr>
				</thead>
							
              
                           
				<tbody id="dataTable">
					<?php
					 $i=1;	
					 foreach($result as $fetch_list)
					   { ?>


                       <tr class="gradeC record gradeX" data-row-id="<?php echo $fetch_list->contact_id; ?>">
						<td><input name="cid[]" type="checkbox" id="cid[]" class="sub_chk" data-id="<?php echo $fetch_list->contact_id; ?>" value="<?php echo $fetch_list->contact_id;?>" /></td>
                        <td onClick1="openpopup('update_contact',1200,500,'view',<?=$fetch_list->contact_id;?>)">
                        <?=$fetch_list->first_name;?>
					    </td>
                        <?php
						  $contactQuery=$this->db->query("select *from tbl_account_mst where account_id='$fetch_list->group_name'");
						  $getContact=$contactQuery->row();
						?>
						<!-- <td><?=$fetch_list->contact_person;?></td> -->
						<td><?=$getContact->account_name;?></td>
						<td><?=$fetch_list->email;?></td>
						<td><i class="fa fa-phone" aria-hidden="true"></i>
						<a><?=$fetch_list->mobile;?></a></td>
						<td><?=$fetch_list->phone;?></td>
						<td>
							<?php if($view!=''){ ?>
						     <button class="btn btn-xs btn-black" type="button" property = "view" type="button" data-toggle="modal" data-target="#modal-0" arrt= '<?=json_encode($fetch_list);?>' onclick="editContact(this);" data-backdrop='static' data-keyboard='false'> <i class="fa fa-eye"></i> </button>
						     <?php } if($edit!=''){ ?>
						     <button class="btn btn-xs btn-black" type="button" data-toggle="modal" data-target="#modal-0" data-a="<?=$fetch_list->contact_id;?>"  arrt= '<?=json_encode($fetch_list);?>' onclick="editContact(this);" type="button"  data-backdrop='static' data-keyboard='false'> <i class="icon-pencil"></i> </button>
						     <?php }
							    $pri_col='contact_id';
							    $table_name='tbl_contact_m';
							 ?>
						     <button class="btn btn-xs btn-black delbutton" type="button" id="<?php echo $fetch_list->contact_id."^".$table_name."^".$pri_col ; ?>"> <i class="icon-trash"></i> 
						     </button>
						      <button class="btn btn-xs btn-black" data-toggle="modal" data-target="#modal-1" type="button" style="    margin-top: 4px;" data-backdrop='static' data-keyboard='false' onclick="mappingproduct(<?=$fetch_list->contact_id;?>);">Mapping
						      </button>
				        </td>
					 </tr>
				<?php $i++; } ?>
				</tbody>
				    <input type="text" style="display:none;" id="table_name" value="tbl_product_stock">  
				    <input type="text" style="display:none;" id="pri_col" value="Product_id">
			</table>
		  </form>
        </div>

	<nav aria-label="Page navigation" class="pull-right">
       <?php echo $pagination; ?>
    </nav> 
    </div>
   </div>
 </div>

               <div id="modal-1" class="modal fade" tabindex="-1" role="dialog">
					<div class="modal-dialog modal-lg">
					  <div class="modal-content" >
						<div class="modal-header">
						<button  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Purchase Order</h4>
						<div id="msgdata" class="text-center " style="font-size: 15px;color: red;"></div> 
						</div>
						<form  class ="editPurchaseOrder">
                         <div class="panel-body" id ="mappingData">
					     </div>
                        </form>
							
					 </div><!-- /.modal-content -->
			      </div><!-- /.modal-dialog -->
             </div>


   <div id="modal-0" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">Contact</h4>
			<div id="resultarea" class="text-center " style="font-size: 15px;color: red;"></div> 
			</div>

			<form class="form-horizontal" role="form"  id="contactForm">
			<div class="modal-body overflow">

			<div class="form-group"> 
				<label class="col-sm-2 control-label">*Name:</label> 
				<div class="col-sm-4"> 				
				<input type="hidden" name="contact_id" value="" id="contact_id" />
				<input type="text" name="first_name" id="first_name" value="" class="form-control" required>
				</div> 
				<label class="col-sm-2 control-label">*Group Name:</label> 
				<div class="col-sm-4"> 
				<?php
					   	 $hdrQuery=$this->db->query("select * from tbl_contact_m where contact_id='".$_GET['id']."' or contact_id='".$_GET['view']."'");
				         $hrdrow=$hdrQuery->row();
					  
				 ?>
				<input type="hidden" name="grpname" id="group_name" value="" />
				<select name="maingroupname" class="form-control" id="groupName" required id="contact_id_copy5">

				<option value="">-------select---------</option>

				<?php
				if($_GET['popup']=='True' and $_GET['con']!=''  ){
				$ugroup2=$this->db->query("SELECT * FROM tbl_account_mst where account_id= '".$_GET['con']."' " );
				}
				else{
				$ugroup2=$this->db->query("select * from tbl_account_mst where status='A'");
				}
				foreach ($ugroup2->result() as $fetchunit){
				?>
				<option value="<?php  echo $fetchunit->account_id ;?>" ><?php echo $fetchunit->account_name;?></option>
				<?php } ?>
				</select>
				</div> 
				</div>
				<div class="form-group"> 
				<label class="col-sm-2 control-label">Contact Person:</label> 
				<div class="col-sm-4"> 
				<input type="text" name="contact_person" id="contact_person" value=""  class="form-control">
				</div> 
				<label class="col-sm-2 control-label" >Email Id:</label> 
				<div class="col-sm-4"> 
				<input type="email" name="email" value="" id = "email"  class="form-control">
				</div> 
				</div>
				<div class="form-group"> 
				<label class="col-sm-2 control-label">Mobile No.:</label> 
				<div class="col-sm-4"> 
				<input type="tel" minlength="10" maxlength="10" id="mobile" name="mobile" title="Enter 10 digit mobile number"  value=""  class="form-control" >
				</div> 

				<label class="col-sm-2 control-label">Phone No.:</label> 
				<div class="col-sm-4" id="regid"> 
				 <input type="text" id="phone" title="Enter Your Phone Number" name="phone" value=""  class="form-control">
				</div> 
				</div>

				<div class="form-group"> 
				<label class="col-sm-2 control-label">Pan No:</label> 
				<div class="col-sm-4" id="regid"> 
				<input type="text" name="pan_no" pattern1=".{10,10}" id="IT_Pan" maxlength="10" id="pan" placeholder="PAN No 10 digist" title="PAN Number must be 10 character" value=""  class="form-control">
				</div> 
				<label class="col-sm-2 control-label">GSTIN No:</label> 
				<div class="col-sm-4" id="regid"> 
				<input type="text" name="gst" id="gstin"  placeholder="GSTIN" value="" class="form-control">

				</div> 
				</div>

				<div class="form-group"> 
				<label class="col-sm-2 control-label">Address1:</label> 
				<div class="col-sm-4" id="regid"> 
				<textarea class="form-control" name="address1" id="address1"></textarea>
				</div>  
				<label class="col-sm-2 control-label">Address2:</label> 
				<div class="col-sm-4" id="regid"> 
				<textarea class="form-control" name="address3" id="address3"></textarea>
				</div> 
				</div>

				<div class="form-group" > 
				<label class="col-sm-2 control-label">City:</label> 
				<div class="col-sm-4" id="regid"> 
				<input type="text" name="city" id="city" value=""  class="form-control">
				</div> 
				<label class="col-sm-2 control-label">State:</label> 
				<div class="col-sm-4" id="regid"> 
				<select name="state" id="state_id" class="form-control">
				<option value="">--Select--</option>
				<?php 
				$stnm=$this->db->query("select * from tbl_state_m order by stateName asc");
				foreach($stnm->result() as $stdata)
				{
				?>
				<option value="<?=$stdata->code;?>"><?=$stdata->stateName;?></option>
				<?php } ?>
				</select>
				</div> 
				</div>

				<div class="form-group" > 
				<label class="col-sm-2 control-label">Pin Code:</label> 
				<div class="col-sm-4" id="regid"> 
				<input type="number" name="pin_code" id="pincode" value=""  class="form-control">
				</div> 
				<label class="col-sm-2 control-label">Nick Name</label> 
				<div class="col-sm-4" id="regid"> 
				<input type="text" name="printname" id="printname" class="form-control" value="" />
				</div> 
				</div>

				<div class="form-group" > 
				<label class="col-sm-2 control-label">Code:</label> 
				<div class="col-sm-4" id="regid"> 
				<input type="text" name="code" value="" id="code" class="form-control">
				</div> 
				<label class="col-sm-2 control-label">&nbsp;</label> 
				<div class="col-sm-4" id="regid"> 
				&nbsp;
				</div> 
				</div>

			</div>
			<div class="modal-footer" id="button">
			<input type="submit" class="btn btn-sm btn-black btn-outline" value="Save"  id="contactForm1"/>
			<button type="button" class="btn btn-sm btn-black btn-outline" data-dismiss="modal">Cancel</button>
			</div>
			</form>
			</div><!-- /.modal-content -->
        </div>
	  </div>
    </div>
	<!-- /.modal-dialog -->


<script>

//add item into showling list
	window.addEventListener("keydown", checkKeyPressed, false);
	      //funtion to select product
	      function checkKeyPressed(e) {
                 // e.preventDefault();
			      var s=e.keyCode;
			      var ppp   = document.getElementById("prd").value;
			      var sspp  = document.getElementById("spid").value;//
			      var ef    = document.getElementById("ef").value;
					ef      = Number(ef);
			
			     var countids = document.getElementById("countid").value;
			     // alert(countids);
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

function deleteselectrow(d,r) //delete dyanamicly created rows or product detail
 {
	var regex = /(\d+)/g;
    nn = d.match(regex);
    id = nn;

	if(document.getElementById("prd").value!=''){
			document.getElementById("qn").focus();
	    alert("Product already in edit Mode");
	    return false;
	}
        var i = $(r).parent().parent();
        var cnf = confirm('Are You Sure..??? you want to Delete line no1.'+(id));
		if (cnf== true)
		 {

		 	var rows    = document.getElementById("rows").value; 
		 	var rid     = Number(rows)-1;

		 	document.getElementById("rows").value = rid;

		   i.remove();
		  // slr();
		  // editDeleteCalculation();
		}
			
   }
////////////////////////////////// ends delete code ////////////////////////////////


////////////////////////////////// starts edit code ////////////////////////////////


	function editselectrow(d,r) //modify dyanamicly created rows or product detail
	{
		 	
        var regex = /(\d+)/g;
		nn        = d.match(regex)
		id        = nn;
		
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
	// var actual   = document.getElementById("actual"+id).value;
		
		document.getElementById("pri_id").value    = main_id;
		document.getElementById("prd").value       = pd;
		document.getElementById("usunit").value    = unit;
		document.getElementById("lph").value       = qn;
	//document.getElementById("qty_stock").value = actual;
			
        $(r).parent().parent().remove();
            var rows    = document.getElementById("rows").value; 
		 	var rid     = Number(rows)-1;
            document.getElementById("rows").value = rid;

        document.getElementById("prd").focus();
	}

////////////////////////////////// ends edit code ////////////////////////////////

  function getdata()
	{
		// alert('sss');
	currentCell          = 0;
    var product1         = document.getElementById("prd").value;	 
    var product          = product1;
	var company          = document.getElementById("company").value;
	var supplier_contact = document.getElementById("supplier_contact").value;
   // var state        = document.getElementById("state").value;
   //alert(company);
	if(company=='')
	{
		alert('Please Select Storage Location !');
		document.getElementById("company").focus();
	}	
	if(supplier_contact=='')
	{
		alert('Plaese Select Sipplier Contact !');
		document.getElementById("supplier_contact").focus();
	}
		
	if(xobj)
    {
		var obj=document.getElementById("prdsrch");
	//	alert("getproduct?con="+product1+"&con_id="+company+"&supplier_contact="+supplier_contact);
		xobj.open("GET","getproduct?con="+product+"&con_id="+company+"&supplier_contact="+supplier_contact,true);
		xobj.onreadystatechange=function()
		{
		if(xobj.readyState==4 && xobj.status==200)
		  {
			//console.log(xobj.responseText);
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
				var rows    = document.getElementById("rows").value;     //row value
				var pri_id  = document.getElementById("pri_id").value;  //item id
				var pd 		= document.getElementById("prd").value;    //item id
		   	    var table   = document.getElementById("invoice");
				var rid     = Number(rows)+1;
              
              	if(lph == 0 || lph == ""){
                   alert('Please Enter Quantity Value !');
                   return false;
                }

				document.getElementById("rows").value=rid;
				//totalSum();	
				
                currentCell = 0;
               if(pd!="" && qn!=0 || qn==0)
			     {

			     	clear();
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
					unitt.name='unit[]';//
					unitt.id='unit'+rid;//
					unitt.readOnly = true;
					unitt.style="text-align:center";  
	//	unitt.style.width="100%";
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
						edt.onclick= function() { editselectrow(edt.id,edt); };
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
			   if(qn==0)
			 	{
				  alert('***Quantity Can not be Zero ***');
				  document.getElementById("prd").focus();
				}
				else
				{
			      alert('***Please Select PRODUCT ***');
			    }
	        }
}


  function clear()
   {
    // this finction is use for clear data after adding invoice
    document.getElementById("qty_stock").value = "";
	document.getElementById("usunit").value    = "";  // unit value
	document.getElementById("lph").value       = "";     // enter quantity
	document.getElementById("prd").value       = "";
    document.getElementById("pri_id").value    = "";
    document.getElementById("prd").focus();	
   }









////////////////////////////////// starts delete code ////////////////////////////////




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
<script>
 function viewPO(viewId){

 	$.ajax({   
	    type: "POST",  
		url: "view_purchase_order",  
		cache:false,  
		data: {'id':viewId},  
		success: function(data)  
		{  
		// /alert(data); 
		// $("#loading").hide();  
		 $("#purchaseDataView").empty().append(data).fadeIn();
		//referesh table
		}   
	});

 }

function inbondviewlog(poid){
    $.ajax({   
	    type: "POST",  
		url: "ajax_inbondview",  
		cache:false,  
		data: {'id':poid},  
		success: function(data)  
		{  
		// /alert(data); 
		// $("#loading").hide();  
		 $("#inbondlogs").empty().append(data).fadeIn();
		//referesh table
		}   
	});
}

 function editPO(editId){
 
 	$.ajax({   
	    type: "POST",  
		url: "edit_purchase_order",  
		cache:false,  
		data: {'id':editId},  
		success: function(data)  
		{  
		// /alert(data); 
		// $("#loading").hide();  
		 $("#purchaseData").empty().append(data).fadeIn();
		//referesh table
		}   
	});
 }

 function mappingproduct(editId){
 
 	$.ajax({   
	    type: "POST",  
		url: "mappingSuplier",  
		cache:false,  
		data: {'id':editId},  
		success: function(data)  
		{  
		//alert(data); 
		// $("#loading").hide();  
		 $("#mappingData").empty().append(data).fadeIn();
		//referesh table
		}   
	});
 }

 function get_suplier(val){
       	$.ajax({  
		    type: "POST",  
			url: "getSuplier",  
			cache:false,  
			data: {'id':val},  
			success: function(data)  
			{
				//supplier_contact
				$("#supplier_contact").empty().append(data).fadeIn();
				//alert(data);
				//console.log(data);
			}   
	    });
    }

function exportTableToExcel(tableID, filename = ''){
 
 	//alert();
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'PurchaseOrder_<?php echo date('d-m-Y'); ?>.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{

        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
</script>