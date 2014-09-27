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
                <th width="34" scope="col">NO</th>
                <th width="136" scope="col">Tanggal</th>
                <th width="102" scope="col">username</th>
                <th width="109" scope="col">type</th>
                <th width="529" scope="col">Message</th>
                <th width="90" scope="col">Actions</th>
              </tr>
            </thead>
            <script>
            	function delete_record(type,ID){
            	 if (ID !== ""){
            	 	if (confirm("hapus???") == 1){
            	 		url="<?php echo get_url('delete/"+ type +"/"+ ID +"'); ?>";
		    	 	document.location=url;
            	 	}
            	 }
            	}
            </script>
            <tbody>
            <?php
			$bg="";
		$no=1;
		if (!isset($gal)){exit();}
		 foreach($gal->result() as $r){
			 echo "<div class='gallery'>
				
					</div>";
			 
         }
              ?>
              <tr class="footer">
                <td colspan="3">	
                	<a href="#" class="delete_inline">Delete Selected</a>
                </td>
                <td colspan="5" align="right">
				<!--  PAGINATION START  -->             
                    <div class="pagination">
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
