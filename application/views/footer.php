<!-- Footer -->
<footer class="footer-main"> 
<strong>Copyright &copy; <?php echo date(Y);?> <a target="_blank" href="http://www.techvyas.com/"> Tech Vyas Pvt Ltd </a> All Rights Reserved.</strong>
</footer>	 
<!-- /footer -->
</div>
<!-- /main content -->
</div>
  <!-- /main container -->
</div>
<!-- /page container -->
    
<!--Load JQuery-->


<script src="<?=base_url();?>assets/js/jquery.min.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/plugins/metismenu/js/jquery.metisMenu.js"></script>


<!-- <script src="<?php echo base_url();?>assets/plugins/select2/js/select2.full.min.js"></script> -->
<!-- <script src="<?=base_url();?>assets/plugins/select2/js/select2-script.js"></script> -->
 

<script src="<?=base_url();?>assets/plugins/blockui-master/js/jquery-ui.js"></script>
<script src="<?=base_url();?>assets/plugins/blockui-master/js/jquery.blockUI.js"></script>
<!--Knob Charts-->
<script src="<?=base_url();?>assets/plugins/knob/js/jquery.knob.min.js"></script>
<!--Jvector Map-->
<script src="<?=base_url();?>assets/plugins/jvectormap/js/jquery-jvectormap-2.0.3.min.js"></script>
<script src="<?=base_url();?>assets/plugins/jvectormap/js/jquery-jvectormap-world-mill-en.js"></script>
<!--ChartJs-->
<script src="<?=base_url();?>assets/plugins/chartjs/js/Chart.min.js"></script>
<!--Morris Charts-->
<script src="<?=base_url();?>assets/plugins/morris/js/raphael-min.js"></script>
<script src="<?=base_url();?>assets/plugins/morris/js/morris.min.js"></script>
<!-- Select2-->

<!-- <script src="<?=base_url();?>assets/plugins/select2/js/select2.full.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?=base_url();?>assets/js/form-advanced-script.js"></script> -->

<!--Float Charts-->
<script src="<?=base_url();?>assets/plugins/flot/js/jquery.flot.min.js"></script>
<script src="<?=base_url();?>assets/plugins/flot/js/jquery.flot.tooltip.min.js"></script>
<script src="<?=base_url();?>assets/plugins/flot/js/jquery.flot.resize.min.js"></script>
<script src="<?=base_url();?>assets/plugins/flot/js/jquery.flot.pie.min.js"></script>
<script src="<?=base_url();?>assets/plugins/flot/js/jquery.flot.time.min.js"></script>
<!--Functions Js-->
<script src="<?=base_url();?>assets/js/functions.js"></script>
<!--Dashboard Js-->
<script src="<?=base_url();?>assets/js/dashboard.js"></script>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>


<script type="text/javascript" src="<?php echo base_url();?>assets/dropdown-customer/semantic.js"></script>
<link type="text/css" href="<?php echo base_url();?>assets/dropdown-customer/semantic.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

 <script type="text/javascript" src="<?=base_url();?>js/jquery.ztree.core.js"></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
 <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
 <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.js"></script>
 <script src="<?php echo base_url();?>js/custom_master.js"></script>

 <script type="text/javascript">
          var setting = { };
          var da      = "";
          var title   =  $("#content_wrap").attr('arr');
      if(title !== undefined)
          var da      = JSON.parse(title);
        
          var zNodes  = da;
          var curMenu = null, zTree_Menu = null;
          var setting = {
            view:{
              showLine: false,
              showIcon: false,
              selectedMulti: false,
              dblClickExpand: false,
              addDiyDom: addDiyDom
             },
            data: {
              simpleData: {
                enable: true
              }
            },
            callback: {
              beforeClick: beforeClick
            }
          };
  
  function showtree(){


 }
  /* $(".delbutton11").click(function(){
    alert('sdfsdfcvzxcvzxcv');
  });*/



  function mapcategory(ths,id,name,code){
   // alert(name);
  
     $('#proId').val(id);
     $('#prdname').val(name);
     $('#prdcode').val(code);
     var checkval = $(ths).attr('checked_cat');
      if(checkval !== undefined)
          var checkval      = JSON.parse(checkval); 
    
     $("input.check").each(function ()
       {
        $(this).attr('checked', false);
        if(jQuery.inArray($(this).val(), checkval) != -1) {
           $(this).attr('checked', true);
          // alert($(this).val());
       } 
     });

  }


 $("#TermForm").validate({
    rules: {
      // type: "required",
      // tem:"required"
    },
      submitHandler: function(form) {
        ur = "<?=base_url('master/termandcondition/insert_termandcondition');?>";
        var b = $('#tem').val();
        editorData= CKEDITOR.instances['tem'].getData();
        var formData = new FormData(form);
        formData.append('tem',  editorData);

        // alert('$(this)[0]');
            $.ajax({
                type : "POST",
                url  :  ur,
                //dataType : 'json', // Notice json here
                data : formData, // serializes the form's elements.
                success : function (data) {
                 // alert(data); // show response from the php script.
                    
                    if(data == 1 || data == 2){
                      if(data == 1)
                        var msg = "Data Successfully Add !";
                      else
                        var msg = "Data Successfully Updated !";

                     $("#resultarea").text(msg); 
                      setTimeout(function() {   //calls click event after a certain time
                      $("#modal-0 .close").click();
                      $("#resultarea").text(" "); 
                      $('#contactForm')[0].reset(); 
                      $("#Product_id").val("");
                    }, 1000);
                 }else{
                    $("#resultarea").text(data);
                 }
                 ajex_termListData();
               },
                error: function(data){
                    alert("error");
                },
                cache: false,
                contentType: false,
                processData: false
            });
          return false;
        //e.preventDefault();
      }
  });

function editTermandcondition(ths){
   
  // alert('sdfsdf');
  $('.error').css('display','none');
 var jsonVal = $(ths).attr('arrt');
  var button_property = $(ths).attr('property');
  //console.log(rowValue);
   if(jsonVal !== undefined)
     var editVal = JSON.parse(jsonVal);
  
  if(button_property != 'view')
     $('#id').val(editVal.id);

    
    CKEDITOR.instances['tem'].setData(editVal.des);
    $('#type').val(editVal.type);

     if(button_property == 'view'){
       $('#button').css('display','none');
       $("#TermForm :input").prop("disabled", true);
      }else{
       $('#button').css('display','block');
       $("#TermForm :input").prop("disabled", false);
      }

 


}

//--------
  $("#contactForm").validate({
    rules: {
     // first_name: "required",
      maingroupname:"required"
      },
      submitHandler: function(e) {
        ur = "<?=base_url('master/Account/insert_contact');?>";
            $.ajax({
                type : "POST",
                url  :  ur,
                //dataType : 'json', // Notice json here
                data : $('#contactForm').serialize(), // serializes the form's elements.
                success : function (data) {
                  console.log(data); // show response from the php script.
                    
                    if(data == 1 || data == 2){
                      if(data == 1)
                        var msg = "Data Successfully Add !";
                      else
                        var msg = "Data Successfully Updated !";

                     $("#resultarea").text(msg); 
                      setTimeout(function() {   //calls click event after a certain time
                      $("#modal-0 .close").click();
                      $("#resultarea").text(" "); 
                      $('#contactForm')[0].reset(); 
                      $("#Product_id").val("");
                    }, 1000);
                 }else{
                    $("#resultarea").text(data);
                 }
                 ajex_contactListData();
               }
            });
          return false;
        //e.preventDefault();
      }
  });


  

function loadFile(ths) {
  if (ths.files && ths.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#image').attr('src', e.target.result);
            };
          reader.readAsDataURL(ths.files[0]);
        }
}

function editContact(ths) {
  //console.log('edit ready !');
  $('.error').css('display','none');
  var rowValue = $(ths).attr('arrt');
  var button_property = $(ths).attr('property');
  //console.log(rowValue);
   if(rowValue !== undefined)
     var editVal = JSON.parse(rowValue);
      //alert(editVal.contact_id);
    if(button_property != 'view')
      $('#contact_id').val(editVal.contact_id);

      $('#addres_id').val(editVal.addres_id);
      $('#first_name').val(editVal.first_name);
      $('#printname').val(editVal.printname);
      $('#mobile').val(editVal.mobile);
      $('#phone').val(editVal.phone);
      $('#city').val(editVal.city);
      $('#email').val(editVal.email);
      $('#contact_person').val(editVal.contact_person);
      $('#address3').val(editVal.address3);
      $('#address1').val(editVal.address1);
      $('#printname').val(editVal.printname);
      $('#state_id').val(editVal.state_id).prop('selected', true);
      $('#groupName').val(editVal.group_name).prop('selected', true);
      $('#pincode').val(editVal.pincode);
      $('#gstin').val(editVal.gst);
      $('#IT_Pan').val(editVal.IT_Pan);
      
      $('#code').val(editVal.code);
      $('#location').val(editVal.location);

       getEntityRow(editVal.contact_id);
       showconsigneemap(editVal.group_name);

      if(button_property == 'view'){
       $('#button').css('display','none');
       $("#contactForm :input").prop("disabled", true);
      }else{
       $('#button').css('display','block');
       $("#contactForm :input").prop("disabled", false);
      }
      
};


$("#ItemMapping").validate({
    rules: {},
      submitHandler: function(form) {
        ur = "<?=base_url('master/Item/mappingPro');?>";
        var formData = new FormData(form);
            $.ajax({
                type : "POST",
                url  :  ur, 
                //dataType : 'json', // Notice json here
                data : formData, // serializes the form's elements.
                success : function (data) {
                //  alert(data); // show response from the php script.
                    if(data == 1){
                      if(data == 1)
                        var msg = "Mapping Process Successful !";
                     

                     $("#msgdata").text(msg); 
                     setTimeout(function() {   //calls click event after a certain time
                       $("#modal-1 .close").click();
                       $("#msgdata").text(" "); 
                       $('#ItemMapping')[0].reset(); 
                       $("#proId").val("");
                    }, 1000);
                  }else{
                    $("#msgdata").text(data);
                 }
                 ajex_ItemListData();
               },
                error: function(data){
                    alert(data);
                },
                cache: false,
                contentType: false,
                processData: false
            });
          return false;
        //form.preventDefault();
      }
  });


function ajex_termListData(){
  ur = "<?=base_url('master/termandcondition/ajex_TermListData');?>";
    $.ajax({
      url: ur,
      type: "POST",
      success: function(data){
        $("#listingData").empty().append(data).fadeIn();
      }
  });

}

//---

function ajex_contactListData(){
  ur = "<?=base_url('master/Account/ajex_ContactListData');?>";
    $.ajax({
      url: ur,
      type: "POST",
      success: function(data){
        // $("#listingDataremove").hide();
        // $("#listingData").append(data);
        // $("#listingData").fadeIn();
        $("#listingData").empty().append(data).fadeIn();

       console.log(data);
     }
  });

}

// function ajex_ItemListData(){
//   ur = "<?=base_url('master/Item/ajex_ItemListData');?>";
//     $.ajax({
//       url: ur,
//       type: "POST",
//       success: function(data){
//         //$("#listingData").hide();
//         $("#listingData").empty().append(data).fadeIn();
              
//      }
//     });
// }

 function addDiyDom(treeId, treeNode) {
      var spaceWidth = 5;
      var switchObj = $("#" + treeNode.tId + "_switch"),
      icoObj = $("#" + treeNode.tId + "_ico");
      switchObj.remove();
      icoObj.before(switchObj);

      if (treeNode.level > 1) {
        var spaceStr = "<span style='display: inline-block;width:" + (spaceWidth * treeNode.level)+ "px'></span>";
        switchObj.before(spaceStr);
      }
  }

    function beforeClick(treeId, treeNode) {
      if (treeNode.level == 0 ) {
        var zTree = $.fn.zTree.getZTreeObj("treeDemo");
        zTree.expandNode(treeNode);
        return false;
      }
      return true;
    }
    

$(document).ready(function(){
 
  if(zNodes != ""){
      var treeObj = $("#treeDemo");
      $.fn.zTree.init(treeObj, setting, zNodes);
      zTree_Menu = $.fn.zTree.getZTreeObj("treeDemo");
      curMenu = zTree_Menu.getNodes()[0].children[0].children[0];
      zTree_Menu.selectNode(curMenu);

      treeObj.hover(function () {
        if (!treeObj.hasClass("showIcon")) {
          treeObj.addClass("showIcon");
        }
      }, function() {
        treeObj.removeClass("showIcon");
      });
     }

    $(document).delegate("#quotationdel","click",function(){
         var attrSelectValue = $(this).attr('attrVal');
         $('select#entity').find('option').each(function() {
          if($(this).val() == attrSelectValue){
            //alert($(this).val());
            $(this).css("visibility", "visible");
          }
        });

       $(this).parent().parent().remove();
    });

$(document).delegate("#QuotationMap","click",function(){
      var quoId     = [];
      var priceQuot =  [];
      j=0;i=0;
      $('input[name="quotation[]"]').each(function(){
           quoId[i++]  = $(this).val();
      });
      
      $('input[name="quotationPrice[]"]').each(function(){
           priceQuot[j++] = $(this).val();
      });
      
      var myObject  = new Object();
     // myObject.productId = $('#quotationPro').val();
      myObject.quotation = quoId;
      myObject.price = priceQuot;
      var myString = JSON.stringify(myObject);    
     
     // $('#quotationProductmapValue').empty().append("<input type ='text' id ='proQuotation' name='quotationMapedValue[]' value='"+myString+"'>");
      $('#QuotationMap').val(myString);
      $("#QuotationMapForm")[0].reset();
      $('#quotationTable').empty();
      document.getElementById("lph").focus();
      $("#myModal .close").click();
      
  });


});

    
  function openmodelPopup(){
    //alert();
     $("#openPopup").click();
  }

 
  function addQuotation(){

   var qname =  $('#quotation').val();
   var qid   =  $('#qid').val();
   var price =  $('#quotationPrice').val();
   $('#resultarea').text("");
    //alert(price);
    if(qid == "" || price == ""){
      if(qid == "")
        var msg = 'Please Enter Right Quotation Name';
      else
        var msg = 'Please Enter  Quotation Price';

     $('#resultarea').text(msg);


    }else{
       $('#quotationTable').append('<tr><td><input type ="hidden" name="quotation[]" value="'+qid+'">'+qname+'</td><td><input type ="hidden" name="quotationPrice[]" value="'+price+'">'+price+'</td><td><i class="fa fa-trash  fa-2x" id="quotationdel" aria-hidden="true"></i></td></tr>');

       $('#quotation').val("");
       $('#qid').val("");
       $('#quotationPrice').val("");
    }
  }
</script>

<script>
$("#target").click(function(event){
    event.preventDefault();
    $("#error").text(" ");
    $('#button').css('display','block');
   
    $("#category").prop("disabled", false);
  
    $("#selectCategory").prop("disabled", false);

    var ur   = "<?php echo base_url('master/ProductCategory/ajex_formsubmit');?>";
    var name = $("#category").val();
    var id   = $("#selectCategory").val();
  
    var submit_type = $('#target').attr("submit_value");
    var editId = $('#editvalue').val();
    
    if(name != "" && id != ""){
        $.ajax({
        type: "POST",
        url: ur,
        data: {'category':name,'selectCategory':id,'type':submit_type,'edit':editId},
        cache: false,
        success: function(data){
          $("#resultarea").text(data);
          ajex_loadListData(); //// load add table listing // 
          setTimeout(function() {   //calls click event after a certain time
          $("#modal-1 .close").click();
          $("#resultarea").text(" "); 
          }, 1000);
          $('#formId')[0].reset(); 
         
        } 
        });
    }else if(name == ""){
     $("#error").text('Please Enter Category !');
    }else if(id == ""){
     $("#error").text('Please Select Category !');
    }
});



function deleterow(ths){
 var element = $(ths);
 var del_id = element.attr("id");
 var info = 'id=' + del_id;

   if(confirm("Are you sure you want to delete ?"))
    {
      $.ajax({
       type: "GET",
       url: "delete_data",
       data: info,
       success: function(data){}
      });
      $(ths).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast").animate({ opacity: "hide" }, "slow");
   }
return false;
}

// $('.email.dropdown').dropdown();

// $('.emails.form').form({
//     fields: {
//         email: {
//             identifier: 'country',
//             rules: [
//                 {
//                     type   : 'empty',
//                     prompt : 'Please select or add at least one to email address'
//                 }
//             ]
//         }
//     }
// });


function inputdisable(){
   $('#formId')[0].reset(); 
}

function editRow(ths){
   var value  =  $('#'+ths).attr("arrt");
   var cat_id =  $('#'+ths).attr("cat_id");
   var type =  $('#'+ths).attr("typeid");
   var grade =  $('#'+ths).attr("grade");
   //alert(cat_id);
    $('#selectCategory').val(cat_id).prop('selected', true);
    $('#category').val(value);
    $('#type').val(type).prop('selected', true);
    $('#grade').val(grade).prop('selected', true);
    $('#target').attr("submit_value","edit");
    $('#editvalue').val(ths);
}

function showRowtree(val){
  var ur   = "<?php echo base_url('master/ProductCategory/ajaxShowParent');?>";
  //alert(ur);
  $(".displayclass").css("display", "none");
  $("th").css("color", "black");
  $.ajax({
      type: "POST",
      url: ur,
      data: {'id':val },
      success: function(data){
      
      $("#showParent").html(data);
      $("#row"+val).css("color", "red");
      $("#popover").css("display", "block");
     }
    });
}



function ajex_loadListData(){
  ur = "<?=base_url('master/ProductCategory/ajex_loadListData');?>";
  $.ajax({
      url: ur,
      type: "POST",
      success: function(data){
        $("#loadProductData").html(data);
        // console.log(data);
     },
        // error: function(data){
        //     alert("error");
        // },
        cache: false,
        contentType: false,
        processData: false
  });
}

function getdataQuotation(val){
    //alert(val);
    var selectQuotation = $('#pri_id').val();
    if(selectQuotation != ""){
    $('#quotationPro').val(selectQuotation);
    $('#productList').css('display','block');
    ur = "<?=base_url('quotation/ajax_productlist');?>"
    $.ajax({
      type: "POST",
      url: ur,
      data: {'value':val},
      success: function(data){
          console.log(data);
          $('#productList').html(data);
      }
    });
  }else{
     alert('Please Select Product !');
   }
}

function selectList(ths){
 var data =  $(ths).attr('jsvalue');
   if(data !== undefined)
     var data = JSON.parse(data);
  $('#productList').css('display','none');
  $('#quotation').val(data.name);
  $('#qid').val(data.id);
}





/*function ajexShowTree(){
  ur = "<?=base_url('master/ProductCategory/ajexShowTree');?>";
  $.ajax({url: ur,success:function(data){
      $(".treeAncor").attr(arr,data);
        var setting = { };
        var title   =  $("#content_wrap").attr('arr');
        var da      = JSON.parse(title);
        var zNodes  = da;
        var curMenu = null, zTree_Menu = null;
        var setting = {
          view:{
            showLine: false,
            showIcon: false,
            selectedMulti: false,
            dblClickExpand: false,
            addDiyDom: addDiyDom
           },
          data: {
            simpleData: {
              enable: true
            }
          },
          callback: {
            beforeClick: beforeClick
          }
        };

    }
  });
}*/

</script>


</body>

</html>
<!-- starts here this javascript code is for multiple delete -->


<script type="text/javascript">


$(document).ready(function(){

   $(document).delegate("#formreset","click",function(){
     //  alert('ssdfsdf');
    var url = "<?=base_url()?>"+'assets/images/no_image.png';
    var formid =  $('#formreset').attr('formid');
   // alert(formid);
    
    $(formid)[0].reset();
    $(".hiddenField").val('');
    $(formid+" :input").prop("disabled", false);
    $("#button").css("display", "block");
   // CKEDITOR.instances['tem'].setData("");
    $('#image').attr('src',url);
    $("#consigneeTable").empty();

  });

 $("#entries").change(function()
    {
      var value=$(this).val();
      var pageurl  = $(this).attr('url');
      
      url = pageurl+"&entries="+value;
      window.location.href = url;
    });

	jQuery('#master').on('click', function(e) {
		if($(this).is(':checked',true))  
		{
			$(".sub_chk").prop('checked', true);  
		}  
		else  
		{  
			$(".sub_chk").prop('checked',false);  
		}  
	});
	   $(document).delegate(".classname","click",function(){
      alert("ok");
    });
	
	//$('.delete_all').on('click', function(e) { 
    $(document).delegate(".delete_all","click",function(e){
      //alert('sdf');
    		var allVals = [];  
    		$(".sub_chk:checked").each(function() {  
    			allVals.push($(this).attr('data-id'));
    		});  
      //alert(allVals.length); return false;  
  		if(allVals.length <=0)  
  		{  
  			alert("Please select row.");  
  		}  
		 else {  
			//$("#loading").show(); 
			WRN_PROFILE_DELETE = "Are you sure you want to delete this row?";  
			var check = confirm(WRN_PROFILE_DELETE);  
			if(check == true){  
				//for server side
			
				var table_name=document.getElementById("table_name").value;
				var pri_col=document.getElementById("pri_col").value;
				var join_selected_values = allVals.join(","); 
			//alert(join_selected_values);
				$.ajax({   
				  type: "POST",  
					url: "multiple_delete_two_table",  
					cache:false,  
					data: "ids="+join_selected_values+"&table_name="+table_name+"&pri_col="+pri_col,  
					success: function(response)  
					{   
						$("#loading").hide();  
						$("#msgdiv").html(response);
           //referesh table
					}   
				});
      //for client side
			  $.each(allVals, function( index, value ) {
				  $('table tr').filter("[data-row-id='" + value + "']").remove();
			  });
				

			}  
		}  
	});
	jQuery('.remove-row').on('click', function(e) {
		WRN_PROFILE_DELETE = "Are you sure you want to delete this row?";  
			var check = confirm(WRN_PROFILE_DELETE);  
			if(check == true){
				$('table tr').filter("[data-row-id='" + $(this).attr('data-id') + "']").remove();
			}
	});
});
</script> 

<!-- ends here this javascript code is for multiple delete -->

<!-- starts here this javascript code is for single delete -->
<script type="text/javascript">
$(function() {


//$( ".delbutton" ).on( "click",function(){
 $(document).delegate(".delbutton","click",function(){  
 //Save the link in a variable called element
 var element = $(this);
 //Find the id of the link that was clicked
 var del_id = element.attr("id");
 //Built a url to send
 var info = 'id=' + del_id;
if(confirm("Are You Sure ? You Want To Delete !"))
		  {
 $.ajax({
   type: "GET",
   url: "delete_data",
   data: info,
   success: function(){
    
   }
 });

 $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast").animate({ opacity: "hide" }, "slow");

 }

return false;

});

});

</script>
<!-- ends here this javascript code is for single delete -->














<!-- starts here this javascript code is for  sales delete -->
<script type="text/javascript">
$(function() {


$(".delbuttonSales").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;

 if(confirm("Are you sure you want to delete ?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_sales_order_data",
   data: info,
   success: function(){
  
   }
 });

         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
<!-- ends here this javascript code is for purchase delete -->
<!-- starts here this javascript code is for  invoice delete -->
<script type="text/javascript">
$(function() {


$(".delbuttonInvoice").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;

 if(confirm("Are you sure you want to delete ?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_invoice_data",
   data: info,
   success: function(){
  
   }
 });
$(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast").animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
<!-- ends here this javascript code is for invoice delete -->

<!-- starts here this javascript code is for  sales delete -->
<script type="text/javascript">
$(function() {


$(".delbuttonPurchase").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;

 if(confirm("Are you sure you want to delete ?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_purchase_order_data",
   data: info,
   success: function(){
  
   }
 });

         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
<!-- ends here this javascript code is for purchase delete -->






<script>
function getXMLHTTP() { //fuction to return the xml http object

var xmlhttp=false;

try{

xmlhttp=new XMLHttpRequest();

}

catch(e) {

try{

xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");

}

catch(e){

try{

xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");

}

catch(e1){

xmlhttp=false;

}

}

}

return xmlhttp;

}
</script>



<!-----------------drop down select start here------------->

<script type="text/javascript" src="<?=base_url();?>assets/dropdown-customer/mock.js"></script>

<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/dropdown-customer/jquery.dropdown.css">
<script src="<?=base_url();?>assets/dropdown-customer/jquery.dropdown.js"></script>
<script>

    var Random = Mock.Random;
    var json1 = Mock.mock({
      "data|10-50": [{
        name: function () {
          return Random.name(true)
        },
        "id|+1": 1,
        "disabled|1-2": true,
        groupName: 'Group Name',
        "groupId|1-4": 1,
        "selected": false
      }]
    });

    $('.dropdown-mul-1').dropdown({
      data: json1.data,
      limitCount: 40,
      multipleMode: 'label',
      choice: function () {
        // console.log(arguments,this);
      }
    });

    var json2 = Mock.mock({
      "data|10000-10000": [{
        name: function () {
          return Random.name(true)
        },
        "id|+1": 1,
        "disabled": false,
        groupName: 'Group Name',
        "groupId|1-4": 1,
        "selected": false
      }]
    });

    $('.dropdown-mul-2').dropdown({
      limitCount: 5,
      searchable: false
    });

    $('.dropdown-sin-1').dropdown({
      readOnly: true,
      input: '<input type="text" maxLength="20" placeholder="Search">'
    });

    $('.dropdown-sin-2').dropdown({
      data: json2.data,
      input: '<input type="text" maxLength="20" placeholder="Search">'
    });
</script>
<!--Loader Js-->
<script src="<?=base_url();?>assets/js/loader.js"></script>

<script src="<?=base_url();?>assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/js/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/js/jszip.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/js/pdfmake.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/js/vfs_fonts.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.html5.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.colVis.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/js/dataTables-script.js"></script>



<link href="<?=base_url();?>assets/plugins/datatables/css/jquery.dataTables.css" rel="stylesheet">
<link href="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css" rel="stylesheet">





<!-----------------drop down select ends here------------->


<!-----------------flash timmer code starts here------------->
<script>
$(document).ready(function(){

    setTimeout(function(){

        $('#success-alert').fadeOut();}, 4000);

});

</script>


<!-----------------ends timmer code starts here------------->


<!-- starts here this javascript code is for  template delete -->
<script type="text/javascript">
$(function() {


$(".delbuttonTemplate").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;

 if(confirm("Are you sure you want to delete ?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_template",
   data: info,
   success: function(){
  
   }
 });
$(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast").animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
<!-- ends here this javascript code is for template delete -->

<script type="text/javascript">
$(function() {


$(".delbuttonProduction").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;

 if(confirm("Are you sure you want to delete ?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_production_data",
   data: info,
   success: function(){
  
   }
 });

         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>

<script type="text/javascript">
$(function() {


$(".delbuttonCutting").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
//alert(info);
 if(confirm("Are you sure you want to delete ?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_cutting_data",
   data: info,
   success: function(){
  
   }
 });

         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
<script type="text/javascript">
$(function() {
   $(".delbuttonpacking").click(function(){

    //Save the link in a variable called element
    var element = $(this);
   //Find the id of the link that was clicked
    var del_id = element.attr("id");
   //Built a url to send
    var info = 'id=' + del_id;
 if(confirm("Are you sure you want to delete ?"))
	 {
  $.ajax({
   type: "GET",
   url: "delete_packing_data",
   data: info,
   success: function(){
   }
 });
    $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");
 }
  return false;
  });
});
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/dropdown-customer/semantic.js"></script>
<link type="text/css" href="<?php echo base_url();?>assets/dropdown-customer/semantic.css" rel="stylesheet" />
 <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
 <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.js"></script>
<script>

$('.location.dropdown').dropdown();

$('.location.form').form({
    fields: {
        email: {
            identifier: 'country',
            rules: [
                {
                    type   : 'empty',
                    prompt : 'Please select or add at least one to email address'
                }
            ]
        }
    }
});


</script>
<!-- <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('tem');
   /// CKEDITOR.instances['tem'].setData();

</script>  -->

<script>
function getXMLHTTP() { //fuction to return the xml http object
   var xmlhttp=false;
   try{
     xmlhttp=new XMLHttpRequest();
   }
catch(e) {
  try{
    xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
  }
  catch(e){
  try{
     xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
  }
  catch(e1){
   xmlhttp=false;
  }}}
  return xmlhttp;
}

//manage page search script//
function doSearch() {
  var $rows = $('#dataTable tr');
  var val = $.trim($('#searchTerm').val()).replace(/ +/g, ' ').toLowerCase();
    $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
         if(text == "" || val == ''){
           $(this).css('color','black');
          } else {
         
            $(this).css('color','green');
        }
        return !~text.indexOf(val);
    }).hide();
}
// ends
</script>

