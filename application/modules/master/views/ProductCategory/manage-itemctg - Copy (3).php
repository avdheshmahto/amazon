<?php
$this->load->view("header.php");
/*require_once(APPPATH.'modules/master/controllers/ProductCategory.php');
$objj=new ProductCategory();
$CI =& get_instance();

$list='';

$list=$objj->pcategory_list();	
require_once(APPPATH.'core/my_controller.php');
$obj=new my_controller();
$CI =& get_instance();
$tableName='tbl_prodcatg_mst';*/
  $name = ""; $id = "";
  if($getEdit != ""){
   echo  $name =  $getEdit['name'];
   echo  $id =  $getEdit['id'];
  }
?>
<style type="text/css">
.ztree * {font-size: 10pt;font-family:"Microsoft Yahei",Verdana,Simsun,"Segoe UI Web Light","Segoe UI Light","Segoe UI Web Regular","Segoe UI","Segoe UI Symbol","Helvetica Neue",Arial}
.ztree li ul{ margin:0; padding:0;margin-left: 31px;}
.ztree li {line-height:30px;}
.ztree li a {width:200px;height:30px;padding-top: 0px;}
.ztree li a:hover {text-decoration:none; background-color: #E7E7E7;}
.ztree li a span.button.switch {visibility:visible}        /*hidden*/
.ztree.showIcon li a span.button.switch {visibility:visible}
.ztree li a.curSelectedNode {background-color:#D4D4D4;border:0;height:30px;}
.ztree li span {line-height:30px;}
.ztree li span.button {margin-top: -7px;}
.ztree li span.button.switch {width: 16px;height: 16px;}

.ztree li a.level0 span {font-size: 110%;font-weight: bold;}
.ztree li span.button {background-image:url("../../img/left_menuForOutLook.png"); *background-image:url("../../img/left_menuForOutLook.gif")}
.ztree li span.button.switch.level0 {width: 20px; height:20px}
.ztree li span.button.switch.level1 {width: 20px; height:20px}
.ztree li span.button.noline_open {background-position: 0 0;}
.ztree li span.button.noline_close {background-position: -18px 0;}
.ztree li span.button.noline_open.level0 {background-position: 0 -18px;}
.ztree li span.button.noline_close.level0 {background-position: -18px -18px;}
.listClass{position: relative;right: 12px font-size: 15px;    font-weight: 600;
    height: 90px !important;border-left: 2px solid red; padding: 14px 20px 14px 20px; }
.displayclass{display: none;}
</style>
<!-- Main content -->
<!-- Page container -->
  <div class="page-container">
    <div class="main-container">
     <!-- Main content -->
      <div class="main-content">
        <div class="row">
			<div class="col-md-12">
				       <ol class="breadcrumb breadcrumb-2"> 
                         <li><a href="<?=base_url();?>"><i class="fa fa-home"></i>Dashboard</a></li> 
                         <li><a href="">Master</a></li> 
                         <li class="active"><strong>Add Product</strong></li>
                       </ol>
					<div class="panel-body" style="background: #f7f7f7;">
						<div class="panel panel-default">
					      <div class="panel-heading clearfix" style="color: #2F224D;">
						    <h4 class="panel-title" style="background: none !important;"> Manage Category Data </h4>
						    <button type="button" class="btn btn-sm pull-right" data-toggle="modal" data-target="#modal-1" ><i class="fa fa-arrow-circle-left"></i> Add Category</button>
                            <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#modal-2" style="margin-right: 10px;">
						    <i class="icon-flow-tree"></i> Category Tree	</a>
				          </div>
				        </div>
						<div class="table-responsive">

							<table class="table table-striped table-bordered table-hover dataTables-example" >
							<thead>
								<tr>
								<th><br>Category Name</th>		
								<th>Date</th>
								<th>Action</th>
								<!-- <th>Action</th> -->
								</tr>
							</thead>
							<tbody>
							<?php
							$yy=1;
							if(!empty($result_list)) {
							  foreach($result_list as $rows) {
							?>
								<tr class="gradeC record">
								<th id="row<?=$rows['id'];?>" onmouseover="showRowtree(<?=$rows['id'];?>)"><?php echo $rows['name'];?>
								 

								</th>
								<th><?php echo $rows['create_on'];?></th>
								<th>
								 <form action="" method="post" style="margin-bottom: 0px;" onSubmit="return confirm('Are you sure delete this Category?');">
                                    <input type="hidden" name="id" id="edit_id" value="<?=$rows['id'];?>">
                                    <button class="btn btn-sm" type="submit" name="submit" value="delete">Delete</button>
									<a  id="<?=$rows['id'];?>" arrt = "<?=$rows['name'];?>" cat_id ="<?=$rows['parent_id'];?>" onclick ="editRow(this.id);" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-1" >&nbsp;Edit&nbsp;</a> 
								 </form>
								 </th>
								</tr>
							<?php } } ?>
                              <div class="popover fade right in displayclass" role="tooltip" id="popover" style="position: fixed;top: 50%;left: 55%; background-color: #ffffff;border-color: #212B4F;"><!-- <div class="arrow" style="top: 50%;"></div>  -->
									<div class="popover-content" id="showParent"></div>
								</div>

							</tbody>
							</table>
						</div>

				<!--Large Modal-->
						<div id="modal-1" class="modal fade" tabindex="-1" role="dialog">
							<div class="modal-dialog modal-lg">
							  <div class="modal-content" style="top: 38px;left: 45px;">
							    <div class="modal-header">
							      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							      <h4 class="modal-title">Add Category</h4>
							      <div id="resultarea" class="text-center" style="font-size: 15px;color: red;"></div>
							      </div>
							    <div class="modal-body">
							    <form class="form-horizontal" id="formId">
						    	  <div class="form-group">
						    		<label class="col-sm-3 control-label"></label>
									 <div class="col-sm-6" > 
										<p class="text-danger" id="error"></p>
							         </div>
				                  </div>
								<div class="form-group">
								<label class="col-sm-3 control-label">Enter Tree Value </label>
								<div class="col-sm-6"> 
								<input type="text"  name="category" class="form-control" id="category" placeholder="Enter input" value="<?=$name;?>" required>
							    </div>
							  </div>
							  <div class="form-group"> 
								<label class="col-sm-3 control-label">Select Category</label> 
								  <div class="col-sm-6"> 
									 <select class=" form-control" required name="selectCategory" id="selectCategory"> <!-- //select2 -->
										<option value="0" class="listClass">Category</option>
										<?php
										  foreach ($categorySelectbox as $key => $dt) { ?>
       	                                          <option id="<?=$dt['id'];?>" value = "<?=$dt['id'];?>" class="<?=$dt['praent']==0 ? 'listClass':'';?>" > <?=$dt['name'];?></option>
                                          <?php } ?>
									 </select>
									</div> 
								</div>
								
								 </form>
							     <div class="modal-footer">
							     	<a class="btn btn-sm" style="padding: 4px;" editvalue="" submit_value = "save" id="target"> Save </a>
							        <button type="button" class="btn btn-sm btn-info" data-dismiss="modal" style="padding: 4px;">Close</button>
							     </div>
							     
							    </div><!-- /.modal-content -->
							  </div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
						<!--End Large Modal-->
                 </div>

                 <!--Large Modal-->
							<div id="modal-2" class="modal fade" tabindex="-1" role="dialog">
							  <div class="modal-dialog modal-lg">
							    <div class="modal-content" style="top: 38px;left: 45px;" >
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title"> Show Category Tree </h4>
							      </div>
							      <div class="modal-body">
							       <!--  <p>One fine body&hellip;</p> -->
							         <!-- Card list view -->
										<div class="cards-container">
						                   <!-- Card -->
											<div class="card">
												<div class="card-header panel-heading clearfix">
												     <div class="content_wrap">
														<div class="zTreeDemoBackground left">
															<ul id="treeDemo" class="ztree">
															</ul>
														</div>
														<div class="right">
														</div>
													 </div> 
													<a  arr='<?=$result;?>' id="content_wrap"></a>
												</div>
											</div>
											<!-- /card -->
										</div>
										<!-- /card container -->
							      </div>
							      <!-- <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							       </div> -->
							    </div><!-- /.modal-content -->
							  </div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
						<!--End Large Modal-->
	                <!-- /main content -->
      </div>
     <!-- /main container -->
  <br>
</div>

<?php

$this->load->view("footer.php");
?>