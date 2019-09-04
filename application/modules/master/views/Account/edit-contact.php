
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
                        <select name="DataTables_Table_0_length" url="<?=base_url();?>Account/manage_contact?<?='first_name='.$_GET['first_name'].'&contact_person='.$_GET['contact_person'].'&group_name='.$_GET['group_name'].'&email='.$_GET['email'].'&mobile='.$_GET['mobile'].'&phone='.$_GET['phone'];?>" aria-controls="" id="entries" class="">
						<option value="10" <?=$entries=='10'?'selected':'';?>>10</option>
						<option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
						<option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
						<option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
						</select> entries
						</label>
						<p>Showing <?=$dataConfig['page']+1;?> <?php
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
					<th>Contact Person</th>
					<th>Group Name</th>
			        <th>Email Id</th>
					<th>Mobile No.</th>
					<th>Phone No.</th>
					<th style="width:10%;">Action</th>
				 </tr>
				   <tr>
                	<td>&nbsp;</td>
					<td><input name="first_name"  type="text"  class="search_box form-control input-sm"  value="" /></td>
					<td><input name="contact_person"  type="text"  class="search_box form-control input-sm"  value="" /></td>
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
						<td><?=$fetch_list->contact_person;?></td>
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
				        </td>
					 </tr>
				<?php $i++; } ?>
				</tbody>
				    <input type="text" style="display:none;" id="table_name" value="tbl_contact_m">  
				    <input type="text" style="display:none;" id="pri_col" value="contact_id">
			</table>
		  </form>
        </div>

	<nav aria-label="Page navigation" class="pull-right">
       <?php echo $pagination; ?>
    </nav> 
    </div>
   </div>
 