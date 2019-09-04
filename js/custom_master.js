//////////// start item ///////////////

$("#ItemForm").validate({
    rules:{
      // sku_no: "required",
      // industry:"required"
    },
    submitHandler: function(form){
      ur = 'insert_item';
      var formData = new FormData(form);
      //console.log(formData);
          $.ajax({
            type : "POST",
            url  :  ur, 
            //dataType : 'json', // Notice json here
            data : formData, // serializes the form's elements.
              success : function (data) {
              //alert(data); // show response from the php script.
                if(data == 1 || data == 2){
                  if(data == 1)
                      var msg = "Data Successfully Add !";
                     else
                      var msg = "Data Successfully Updated !";

                     $("#resultarea").text(msg); 
                     setTimeout(function() {   //calls click event after a certain time
                       $("#modal-0 .close").click();
                       $("#resultarea").text(" "); 
                       $('#ItemForm')[0].reset(); 
                       $("#contact_id").val("");
                    }, 1000);
                   }else{
                       $("#resultarea").text(data);
                   }
                  ajex_ItemListData();
                },
                error: function(data){
                 alert("error");
              },
              cache: false,
              contentType: false,
              processData: false
            });
          return false;

        //form.preventDefault();
      }
  });



function editItem(ths) {
 // var image_url = "<?=base_url('assets/scope_document');?>"+'/';
  // console.log('edit ready !');
  $('.error').css('display','none');
  var rowValue = $(ths).attr('arrt');
  var button_property = $(ths).attr('property');
   //alert(rowValue);
  console.log(rowValue);
   if(rowValue !== undefined)
    var editVal = JSON.parse(rowValue);
    if(button_property != 'view')
      $('#Product_id').val(editVal.Product_id);

      $('#sku_no').val(editVal.sku_no);
      $('#type').val(editVal.type);
      $('#unit').val(editVal.usageunit).prop('selected', true);

      $('#industry').val(editVal.industry).prop('selected', true);
      $('#category').val(editVal.category).prop('selected', true);
     // $('#scope').val(editVal.scope_doc).prop('selected', true);

      $('#supplier').val(editVal.supplier);
      $('#part_name').val(editVal.part_name);
      $('#contract').val(editVal.contract);
      $('#comodity').val(editVal.comodity);
      $('#part_name').val(editVal.part_name);
      
      $('#productname').val(editVal.productname);

      // if(editVal.category != "")
      //    changing(editVal.category);

      var valArr    = editVal.location; 
      var dataarray = valArr.split(",");
      $('#location').val(dataarray);


      $('#supplier').val(editVal.supplier_id).prop('selected', true);

     if(button_property == 'view'){
       $('#button').css('display','none');
       $("#ItemForm :input").prop("disabled", true);
      }else{
       $('#button').css('display','block');
       $("#ItemForm :input").prop("disabled", false);
      }
  }


  function ajex_ItemListData(){
    ur = "ajex_ItemListData";
      $.ajax({
         url: ur,
         type: "POST",
         success: function(data){
           $("#listingData").empty().append(data).fadeIn();
         }
      });
  }



//////////// End item ///////////////

$(document).delegate("#editpofunction","click",function(){

   // alert('sflsdfjlf');
    $(".editPurchaseOrder").submit();
});


$(".editPurchaseOrder").validate({
    rules:{
      company: "required",
      po_order:"required"
    },
    submitHandler: function(form){
      ur = 'insertPurchaseOrder';
      //alert(ur);
      var formData = new FormData(form);
      //console.log(formData);
          $.ajax({
            type : "POST",
            url  :  ur, 
            //dataType : 'json', // Notice json here
            data : formData, // serializes the form's elements.
              success : function (data) {
             // console.log(data); // show response from the php script.
           //  alert(data);
                if(data == 1 || data == 2){
                  if(data == 1)
                      var msg = "Data Successfully Add !";
                     else
                      var msg = "Data Successfully Updated !";

                     $("#msgdata").text(msg); 
                     setTimeout(function() {   //calls click event after a certain time
                       $("#modal-0 .close").click();
                       $("#msgdata").text(" "); 
                       $('.editPurchaseOrder')[0].reset(); 
                      
                    }, 1000);
                   }else{
                    $("#msgdata").text(data);
                   }
                 // ajex_ItemListData();
                },
                error: function(data){
                 alert("error");
              },
               cache: false,
               contentType: false,
               processData: false
            });
          return false;

       form.preventDefault();
      }
    });


$(document).delegate("#mapingbutton","click",function(){
     $("#insertProductMapping").submit();
});


$("#insertProductMapping").validate({
    submitHandler: function(form){
      ur = 'insertProductMapping';
    
      var formData = new FormData(form);
       $.ajax({
            type : "POST",
            url  :  ur, 
            cache: false,
            //dataType : 'json', // Notice json here
            data : formData, // serializes the form's elements.
            success : function (data) {
            //alert(data);   // show response from the php script.
            console.log(data);
                if(data == 1){
                    var msg = "Data Successfully Add !";
                    $("#msgdata").text(msg); 
                     setTimeout(function() {   //calls click event after a certain time
                       $("#modal-1 .close").click();
                       $("#msgdata").text(" "); 
                       $('#ItemForm')[0].reset(); 
                       $("#contact_id").val("");
                    }, 1000);
                   }else{
                       $("#msgdata").text(data);
                   }
                //  ajex_ItemListData();
                },
                error: function(data){
                     alert("error");
                },
                contentType: false,
                processData: false
            });
          return false;

        form.preventDefault();
      }
  });

function addconsignee(){
   var value = 0;
   var entity       =  $('#entity').val();
   var entity_code  =  $('#entity_code').val();


   if(entity == ""){
    alert('Please Select Amazon Entity');
    $('#entity').focus();
    return false;
   }
   
   if(entity_code == ""){
    alert('Please Select Location code');
    $('#entity_code').focus();
    return false;
   }


   var x = document.getElementById("entity").selectedIndex;
   var y = document.getElementById("entity").options;
   var indexVal =  y[x].text;
  // alert(indexVal);
  // alert(entity);
   var entityCodeValuearr = [];
   var entityCodeTextarr  = [];
   $('select#entity_code').find('option:selected').each(function() {
    entityCodeValue =  $(this).val();
    entityCodeText  =  $(this).text();
    entityCodeValuearr.push(entityCodeValue);
    entityCodeTextarr.push(entityCodeText);
   });

   var entityCodeCommaValue = entityCodeValuearr.join(",");
   var entityCodeComma      = entityCodeTextarr.join(",");

   //alert($("#entity_code option:selected").index());
   //alert($("select[name='entity_code'] option:selected").index());

   $('#consigneeTable').append('<tr class="'+'row_'+value+'"><td><input  type ="hidden" class="form-control" name="entity[]" value="'+entity+'"><input  type ="text" class="form-control"  value="'+indexVal+'"></td><td><input  type ="hidden" class="form-control" value = "'+entityCodeCommaValue+'" name="entity_code[]"><input  type ="text" class="form-control" value="'+entityCodeComma+'"></td><td><i class="fa fa-trash  fa-3x" style="font-size:20px;" id="quotationdel" attrVal="'+entity+'" aria-hidden="true"></i></td></tr>');

  amazonEntity();
  
 }

 function amazonEntity(){
   $("select#entity").prop('selectedIndex', 0);
  var selectedentity = document.getElementsByName('entity[]'); 
 // alert(selectedentity);
  var selectboxes = [];
  for(var i=0; i < selectedentity.length; i++){
  
    if(selectedentity[i] != ""){
     selectboxes.push(selectedentity[i].value);
    }
   }
 
  $('select#entity').find('option').each(function() {
     // alert($(this).val());
    if(selectboxes.includes($(this).val()) == true){
        // // alert(arrayloc.includes(checkboxes[i].value));
        // checkboxes[i].checked = true;
       //  alert($(this).val());
      $(this).css("visibility", "hidden");
    }
  });

   $("#entity_code").empty().append('<option value="">--Select--</option>').fadeIn();
 }



