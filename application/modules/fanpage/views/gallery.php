          <table width=100% class="table">
           <tr>
            <td>
		<?php
		$bg="";
		$no=1;
		if (!isset($gal)){exit();}
		foreach($gal->result() as $r){
			if (file_exists(get_image_post($r->image,'basedir'))){
			 echo "<div class='img-thumbnail' style='width:100px; height:100px; padding:2px; margin:5px; float:left'>
				".img(array('src'=>get_image_post($r->image),'width'=>'100px','height'=>'100px','class'=>'img-thumbnail','style'=>''))."
				</div>";
			}
		 
		}
		?>
            </td>
           </tr>
              <tr class="footer">
                <td align="right">
				<!--  PAGINATION START  -->             
                    <div class="pagination">
                    <span class="previous-off">&laquo; Previous</span>
                    <a href="query_41878854" class="next">Next &raquo;</a>
                    </div>  
                <!--  PAGINATION END  -->       
                </td>
              </tr>
          </table>
