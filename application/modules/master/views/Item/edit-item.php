
          <div class="panel panel-default">
            <div class="panel-heading clearfix">
              <h4 class="panel-title">Add Product</h4>
              <ul class="panel-tool-options"> 
                <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
                <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                <!-- <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li> -->
              </ul> 
            </div>
            
            <div class="panel-body" style="padding-bottom:0px;">
            <div class="row">
                        <div class="col-sm-5">
            <label>Show 
                          <select name="DataTables_Table_0_length" url="<?=base_url();?>master/Item/manage_item?<?='sku_no='.$_GET['sku_no'].'&productname='.$_GET['productname'].'&contract='.$_GET['contract'].'&usages_unit='.$_GET['usages_unit'].'&comodity='.$_GET['comodity'].'&supplier='.$_GET['supplier'].'&filter='.$_GET['filter'];?>" id="entries" class="">
              <option value="10" <?=$entries=='10'?'selected':'';?>>10</option>
              <option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
              <option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
              <option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
              <option value="<?=$dataConfig['total'];?>" <?=$entries==$dataConfig['total']?'selected':'';?>>ALL</option>
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
                  <table class="table table-striped table-bordered table-hover dataTables-example1" id="tblData" >
              <thead>
               <tr>
                    <th id="ab"></th>
                    <th style="display:none;">Item Code </th>
                      <th>Item Name </th>
                  <!-- <th>Category</th> -->
                      <th style="display:none;">Contract</th>
                  <th >UOM</th>
                      <th style="display:none;">Commodity</th>
                  <th style="display:none;">Supplier</th>
                  
                  <th><div style="width:100px;">Action</div></th>
               </tr>
              </thead>

                <tbody id="dataTable" >
                <form method="get">
                <tr>
                  <td style="display:none;"></td>
                  <td><input name="check_all" type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></td>
                  <!-- <td><input name="category"  type="text"  class="search_box form-control input-sm" value="" /></td> -->
                  <td><input name="productname"  type="text"  class="search_box form-control input-sm" value="" /></td>
                  <td style="display:none;"><input name="contract"  type="text"  class="search_box form-control input-sm"  value="" /></td>
                  <td><input name="usages_unit"  type="text"  class="search_box form-control input-sm" value="" /></td>
                  <td style="display:none;"><input name="comodity" type="text"  class="search_box form-control input-sm" value="" /></td>
                  <td style="display:none;"><input name="supplier" type="text"  class="search_box form-control input-sm" value="" /></td>
                  <td ><button type="submit" class="btn btn-sm btn-black btn-outline" name="filter" value="filter"><span>Search</span></button>
                  </td>
                </tr>
                </form>

                <?php  
                $yy=1;
                //if(!empty($result)) {
                // echo "<pre>";
                // print_r($result);
                // echo  "</pre>";
                  foreach($result as $fetch_list)
                  {
                ?>

                  <tr  class="gradeC record" data-row-id="<?php echo $fetch_list->Product_id; ?>">
                  <td id="ab1">
                  <?php
                  //$productId= $fetch_list->Product_id;
                  //$checkProduct=$productId;
                  // if($checkProduct=='1')
                  //{
                  ?>
                  <input name="cid[]" type="checkbox" id="cid[]" class="sub_chk" data-id="<?php echo $fetch_list->Product_id; ?>" value="<?php echo $fetch_list->Product_id;?>" />
                  <?php //} else{ ?>
                  <?php //}?>
                  </td>
                  
                  <td style="display:none;"><?=$fetch_list->sku_no;?></td>
                  <td><?=$fetch_list->productname;?></td>
                  
                  <td style="display:none;">
                                        <?php
                            $compQuery11 = $this->db->query("select contract,first_name from tbl_product_mapping M,tbl_contact_m C where C.contact_id = M.suplier_id AND M.product_id = '".$fetch_list->Product_id."'");
                            $suplier_name1 = $compQuery11->result();
                            echo $suplier_name1->contract;      
                    ?>

                    <?=$fetch_list->contract;?>
                  </td>
                  <td ><?php
                  $compQuery1 = $this -> db
                             -> select('*')
                             -> where('serial_number',$fetch_list->usageunit)
                             -> get('tbl_master_data');
                        $keyvalue1 = $compQuery1->row();
                            echo $keyvalue1->keyvalue;      
                  ?></td>
                  <td style="display:none;"><?=$fetch_list->comodity;?></td>
                  <td style="display:none;">
                     <?php
                            $compQuery11 = $this->db->query("select contract,first_name from tbl_product_mapping M,tbl_contact_m C where C.contact_id = M.suplier_id AND M.product_id = '".$fetch_list->Product_id."'");
                            $suplier_name1 = $compQuery11->result();
                            $i = 1;
                             foreach ($suplier_name1 as $dtt) {
                              echo '<span >'.$dtt->first_name ."</span>".'&nbsp;/ &nbsp;&nbsp;&nbsp;<br>';
                             }    
                    ?>
                    
                    <?php 
                    
                              
                    ?>
                    </td>
                  <td>
                  <?php if($view!=''){ ?>
                       <button class="btn btn-xs btn-black" type="button" onclick ="viewItem(<?=$fetch_list->Product_id;?>);" type="button" data-toggle="modal" data-target="#modal-1" data-backdrop='static' data-keyboard='false'> <i class="fa fa-eye"></i> </button>
                      <?php } if($edit!=''){ ?>
                       <button class="btn btn-xs btn-black" type="button" data-toggle="modal" data-target="#modal-0" arrt= '<?=json_encode($fetch_list);?>' onclick="editItem(this)"> <i class="icon-pencil"></i> </button>
                       <?php }
                  $pri_col='Product_id';
                  $table_name='tbl_product_stock';
                  ?>
                       <button class="btn btn-xs btn-black delbutton" type="button" id="<?php echo $fetch_list->Product_id."^".$table_name."^".$pri_col ; ?>"> <i class="icon-trash"></i> </button> 
                        </td>
                  
                  </tr>
                <!-- /.modal -->
                <?php $i++; } //}?>
                </tbody>
              <input type="text" style="display:none;" id="table_name" value="tbl_product_stock">  
              <input type="text" style="display:none;" id="pri_col" value="Product_id">
          </table>
                    </div>
          <nav aria-label="Page navigation" class="pull-right">
                    <?php echo $pagination; ?>
                </nav> 
            </div>
          </div>
       