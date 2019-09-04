<?php
$this->load->view("header.php");
require_once(APPPATH.'core/my_controller.php');
$obj=new my_controller();
$CI =& get_instance();
$table_name_1='tbl_product_stock';
$pri_id='Product_id';
$field_name='productname';

$entries = "";
if($this->input->get('entries')!="")
{
  $entries = $this->input->get('entries');
}

?>
<!-- Main content -->
<div class="main-content">
	
<?php
$this->load->view("reportheader");
?>
<?php
$p_name = "";$p_id="";$f_date="";$t_date="";
 if($this->input->post() != "") { 
 $p_name = $this->input->get('p_name');
 $p_id   = $this->input->get('p_id');
 $f_date = $this->input->get('f_date');
 $t_date = $this->input->get('t_date');
 $type = $this->input->get('type');
 } ?>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
<h4 class="panel-title">STOCK INBOUND REPORT</h4>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><!--<i class="icon-arrows-ccw"></i>--><i class="fa fa-refresh fa-2x" aria-hidden="true" style="color:black;"></i></a></li>
</ul>
</div>
<!--<div class="panel-body panel-center">-->
<div class="panel-body" style="background:#f9f9f9; border-bottom:1px solid #ddd; padding-bottom:0px !important; margin-bottom:15px;">
<form class="form-inline">
<div class="form-group">
<label class="form-label">Product Id</label>
<input type="text" name="p_id" class="form-control" value="" />
</div>
<div class="form-group">
<label class="form-label">Product Name</label>
<input type="text" name="p_name" class="form-control" value="" />
</div>
<div class="form-group filter-btn">
<button class="btn btn-sm btn-black btn-outline" style="margin-top:20px;">Search</button> 
</div>
</form>
</div>


<div class="row">
<div class="col-sm-12">
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
<div class="html5buttons">
<div class="dt-buttons">
<button class="dt-button buttons-excel buttons-html5" onclick="exportTableToExcel('tblData')">Excel</button>
<a class="dt-button buttons-excel buttons-html5" style="display:none" tabindex="0" aria-controls="DataTables_Table_0" onclick="exportTableToExcel('tblData')"><span>Excel</span></a>
</div>
</div>

<div class="dataTables_length" id="DataTables_Table_0_length">
<label>&nbsp;&nbsp; Show
<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries"  url="<?=base_url('/report/Report/inboundStock?');?>" class="form-control input-sm">
    <option value="10">10</option>
    <option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
    <option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
    <option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
</select>
Entries</label>

<div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite" style="    margin-top: -6px;margin-left: 12px;float: right;">
    Showing <?=$dataConfig['page']+1;?> to 
    <?php
    $m=$dataConfig['page']==0?$dataConfig['perPage']:$dataConfig['page']+$dataConfig['perPage'];
    echo $m >= $dataConfig['total']?$dataConfig['total']:$m;
    ?> of <?php echo $dataConfig['total'];?> Entries
</div>
</div>
<div id="DataTables_Table_0_filter" class="dataTables_filter">
<label>Search:
<input type="text" class="form-control input-sm" id="searchTerm"  onkeyup="doSearch()" placeholder="What you looking for?">
</label>
</div>
</div>
</div>
</div>
<br />

<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example1" >
<thead>
<tr>
        <th width="9%">Serial ID</th>
	    <th>Storage Location:</th>		
        <th>PURCHASE ORDER NO</th>
        <th>Inbound Stock Qty</th>
        <th>status</th>
        <th>Action</th>
		<!-- <th>Action</th> -->
</tr>
</thead>
<tbody>
<?php
$yy=1;
if(!empty($result)) {
    // echo "<pre>";
    //    print_r($result);
    // echo "</pre>";
    $i=1;
foreach($result as $rows) {
?>
<tr class="gradeC record">
    <th><?=$i++;?></th>
    <th>
       <?php 
        $sqlgroup11=$this->db->query("select * from tbl_master_data where serial_number =".$rows->company."");
       foreach ($sqlgroup11->result() as $fetchgroup11){ 
        echo  $fetchgroup11->keyvalue;                   
        ?>
        
        <?php  } ?> 
    </th>
    <th><?=$rows->purchase_no;?></th>
   <!--  <th><?=$rows->qty-$rows->outboundqty;?></th> -->
   <!--  <th><?=$rows->clear_status==1?'Clear Qty':'Pending Qty';?></th> -->
    <th>
    <button class="btn btn-xs btn-black" type="button" data-toggle="modal" data-target="#modal-0" onclick="inbound('<?=$rows->poid;?>');"> Inbound</button>
    <button class="btn btn-xs btn-black" type="button" data-toggle="modal" data-target="#modal-1" onclick="outbound('<?=$rows->poid;?>');"> Outbound</button>
   </th>
    
</tr>
<?php } } ?>
</tbody>
</table>
</div>
 <div class="row">
    <div class="col-md-12 text-right">
    	<div class="col-md-6 text-left"> 
    		<!-- <h6>Showing 1 to 10 of <?php echo $totalrow; ?> entries</h6> -->
    	</div>
    	<div class="col-md-6"> 
        <?php echo $pagination; ?>
        </div>
    </div>
</div>
</div>
</div>
</div>


  <div id="modal-0" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
            <button  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Inbound Details</h4>
              
            </div>
            <div class="modal-body overflow"  id="viewData">

                <div class="row">
            <div class="col-lg-12">
        <div class="row">
         <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                     <!-- <h4>PRODUCT NAME :- <br/> <span style="color: #1b87d2;;"></span></h4> -->
                                            <div class="panel-body">
                                             <div class="row">
                                                <div class="col-lg-12">
                                                 <h5>
                                                  Product Name : <br/>
                                                  1110601001-NGB1-GiftBox-20.3X13.9X3.7cm,3PlyDuplexBoard,260/120/120GSM,flute-E,As per approved artwork
                                                  <br><br>
                                                  PO Name : 0002
                                                  </h5>
                                                 <!--  <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>
                                                        -->      
                                                <table class="table">
                                                    <thead>
                                                      <tr>
                                                        <th>S.No.</th>
                                                        <th>Date</th>
                                                        <th>Qty</th>
                                                       
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                 
                                                      <tr>
                                                        <td>1</td>
                                                        <td>2018-07-24 12:50:13</td>
                                                        <td>1000</td>
                                                       <!--  <td></td> -->
                                                      </tr>
                                                       <tr>
                                                        <td>2</td>
                                                        <td>2018-07-24 12:50:13</td>
                                                        <td>4000</td>
                                                        
                                                      </tr>
                                                       <tr>
                                                        <td>3</td>
                                                        <td>2018-07-24 12:50:13</td>
                                                        <td>2000</td>
                                                        
                                                      </tr>
                                                       <tr>
                                                        <td>4</td>
                                                        <td>2018-07-24 12:50:13</td>
                                                        <td>3000</td>
                                                       </tr>
                                                       <tr>
                                                        <td colspan="2" align="right"><b>Total</b></td>
                                                        <td><b>10000</b></td>
                                                       </tr>
                                                    </tbody>
                                                  </table>

                                                </div>

                                            </div>

                                                <div class="row">
                                                <div class="col-lg-12">
                                                                                    
                                                  <h5>
                                                Product Name : <br/>
                                                  1110601001-NGB1-GiftBox-20.3X13.9X3.7cm,3PlyDuplexBoard,260/120/120GSM,flute-E,As per approved artwork
                                                  <br> <br>
                                                  PO Name : 0002
                                              </h5>
                                                 <!--  <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>       -->  
                                                 
                                                  <table class="table">
                                                    <thead>
                                                      <tr>
                                                        <th>S.No.</th>
                                                        <th>Date</th>
                                                        <th>Qty</th>
                                                       
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                 
                                                      <tr>
                                                        <td>1</td>
                                                        <td>2018-07-24 12:50:13</td>
                                                        <td>1000</td>
                                                       <!--  <td></td> -->
                                                      </tr>
                                                       <tr>
                                                        <td>2</td>
                                                        <td>2018-07-24 12:50:13</td>
                                                        <td></td>
                                                        
                                                      </tr>
                                                       <tr>
                                                        <td>3</td>
                                                        <td>2018-07-24 12:50:13</td>
                                                        <td>2000</td>
                                                        
                                                      </tr>
                                                       <tr>
                                                        <td>4</td>
                                                        <td>2018-07-24 12:50:13</td>
                                                        <td>3000</td>
                                                       </tr>
                                                       <tr>
                                                        <td colspan="2" align="right"><b>Total</b></td>
                                                        <td><b>6000</b></td>
                                                       </tr>
                                                    </tbody>
                                                  </table>

                                                </div>

                                            </div>
                                        </div>
            </div>
        </div>
    <!-- <div class="table-responsive-">
   </div> -->
  </div>

    

   </div>
   <div class ="pull-right">
    
        <a  class="btn btn-sm btn-black btn-outline"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Cancel</a>
    </div>
</div>
</div>
            </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
 </div>

  <div id="modal-1" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
            <button  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Outbound Details</h4>
           
            </div>
            <div class="modal-body overflow"  id="viewData">
                
            </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
 </div>

</div>
<?php
$this->load->view("footer.php");
?>
<script>
 function inbound(pId){
//alert(pId);
    $.ajax({   
        type: "POST",  
        url: "ajax_viewinbound",  
        cache:false,  
        data: {'id':pId},  
        success: function(data)  
        {  
        //alert(data); 
        //console.log(data);
        // $("#loading").hide();  
       //  $("#viewData").empty().append(data).fadeIn();
        //referesh table
        }   
    });
}

 function outbound(pId){
    $.ajax({   
        type: "POST",  
        url: "ajax_viewoutbound",  
        cache:false,  
        data: {'id':pId},  
        success: function(data)  
        {  
        //alert(data); 
        //console.log(data);
        // $("#loading").hide();  
        // $("#viewData").empty().append(data).fadeIn();
        //referesh table
        }   
    });
}
</script>
