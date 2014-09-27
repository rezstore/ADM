<div class="grid_16">
<!-- TABS START -->
    <div id="tabs">
         <div class="container">
            <ul>
                      <li><a href="#" class="current"><span>Dashboard elements</span></a></li>
           </ul>
        </div>
    </div>
<!-- TABS END -->    
</div>
<div class="grid_16" id="content">
    <!--  TITLE START  --> 
    <div class="grid_9">
    <h1 class="dashboard"><?php echo ucfirst($title); ?> Fanpage Update</h1>
    </div>
    <div class="clear"></div>
    <!--THIS IS A WIDE PORTLET-->
    <div class="portlet">
        <div class="portlet-header fixed">
        	<img src="<?php echo get_images_icon('user.gif');?>" width="16" height="16" alt="Latest Registered Users" /> 
        		Data Posting 
        </div>
	<div class="portlet-content nopadding">
        <form action="" method="post">
          <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
            <thead>
              <tr>
                <th width="34" scope="col"></th>
                <th width="136" scope="col">Tanggal</th>
                <th width="102" scope="col">Nama Page</th>
                <th width="509" scope="col">Text</th>
                <th width="129" scope="col">Url Share</th>
                <th width="171" scope="col">Image</th>
                <th width="90" scope="col">Actions</th>
              </tr>
            </thead>
            <script>
            	function delete_record(ID){
            	 if (ID !== ""){
            	 	del=confirm("hapus???");
            	 	
            	 }
            	}
            </script>
            <tbody>
            <?php
            $prefix=str_replace(' ','_',strtolower($title));
		$no=1;
		if (!isset($posting)){exit();}
		 foreach($posting->result() as $r){
			 $id=$r->ID_post;
			 $tgl=$r->date_post;
			 $pageid=$r->page_id;
			 $pagename="rezstore";
			 $message=substr($r->messages,0,40);
			 $url=substr($r->url,0,40);
			 $image=$r->image;
			 if($image != ""){
			 	$image=img(array("src"=>get_image_post($image),"width"=>"20px","height"=>"20px"));
			 }
			 
			 $status=$r->status;
			 if($no%2 == 0){$bg="#B9B9B9;";}
			 if ($status==1){$bg="";$url_actions="";}else{$bg="#F3B4B4;";
			 	$url_actions=anchor(get_url('edit/'.$prefix.'/'.$id),'__','class="edit_icon"').nbs(2).
			 			anchor($this->uri->uri_string()."#",'__','class="delete_icon" id="delete" onclick="delete_record('.$id.');"');
			 }
              echo "<tr style='background:$bg'>
		        <td width='34'><label>
		            <input type='checkbox' name='checkbox' id='checkbox' />
		        </label></td>
		        <td>".$tgl."</td>
		        <td>".$pagename."</td>
		        <td>".$message."</td>
		        <td>".$url."</td>
		        <td>".$image."</td>
		        <td width='90'>".$url_actions."</td>
              </tr>";
              }
              ?>
              <tr class="footer">
                <td colspan="3">	
                	<a href="#" class="delete_inline">Delete Selected</a>
                </td>
                <td colspan="5" align="right">
				<!--  PAGINATION START  -->             
                    <div class="pagination">
                    <a href="<?php echo get_url('insert_new_'.$prefix); ?>" class="next">Input Data</a>
                    <span class="previous-off">&laquo; Previous</span>
                    <a href="query_41878854" class="next">Next &raquo;</a>
                    </div>  
                <!--  PAGINATION END  -->       
                </td>
              </tr>
            </tbody>
          </table>
        </form>
	</div>
      </div>
      <a href="#" onclick="tooltip.pop(this, '#demo3_tip', {overlay:true, position:4}); return false;">Click me</a>
<div style="display:none;">
    <div id="demo3_tip">
        <form action="javascript-tooltip" method="post">
            Name: <input type="text" name="name" />
            <input type="submit" value="Login" />
            <input type="button" value="Cancel" onclick="tooltip.hide()" />
        </form>
    </div>
</div>
<!--  END #PORTLETS -->  
   </div>
    <div class="clear"> </div>
<!-- END CONTENT-->    
  </div>
</div>
<!-- WRAPPER END -->
<!-- FOOTER START -->
<div class="container_16" id="footer">
Website Administration by <a href="../index.htm">WebGurus</a></div>
<!-- FOOTER END -->
</body>
