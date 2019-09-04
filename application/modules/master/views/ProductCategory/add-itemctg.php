              
							<?php
							$yy=1;
							if(!empty($result_list)) {
							  foreach($result_list as $rows) {
							?>
							<tr class="gradeC record" data-row-id="<?=$rows['id'];?>">
								<th>
								<input name="cid[]" type="checkbox" id="cid[]" class="sub_chk" data-id="<?=$rows['id'];?>" value="<?=$rows['id'];?>" />
							    </th>
								<th id="row<?=$rows['id'];?>" onmouseover="showRowtree(<?=$rows['id'];?>)" style="cursor: pointer;"><?php echo $rows['name'];?>
								</th>
								
								<th><?=$rows['create_on'];?></th>
								<th>
								<?php $pri_col='id';
                                      $table_name='tbl_category';
                                ?>
                                
                         <?php if($view!=''){ ?>
                             <button class="btn btn-default modalEditItem" type="button" data-toggle="modal" data-target="#modal-1" data-backdrop='static'  typeid = "<?=$rows['type'];?>" arrt = "<?=$rows['name'];?>" cat_id ="<?=$rows['parent_id'];?>" grade="<?=$rows['grade'];?>" onclick ="editRow(this.id);"  id="<?=$rows['id'];?>" data-keyboard='false'> <i class="fa fa-eye"></i> </button>
                         <?php } if($edit==''){ ?>  
                         <a  id="<?=$rows['id'];?>" typeid = "<?=$rows['type'];?>"  arrt = "<?=$rows['name'];?>" cat_id ="<?=$rows['parent_id'];?>" grade="<?=$rows['grade'];?>" onclick ="editRow(this.id);" class="btn btn-default modalEditItem"  data-toggle="modal" data-target="#modal-1" >&nbsp; <i class="icon-pencil"></i> &nbsp; </a> 
                          <?php } ?>      
                           <button class="btn btn-default delbutton" id="<?php echo $rows['id']."^".$table_name."^".$pri_col ; ?>" ><i class="icon-trash"></i></button>	
                       
						</th>
					</tr>
				<?php } } ?>
             
            

	     
        