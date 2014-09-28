<div class="grid_16">
<!-- TABS START -->
    <div id="tabs">
         <div class="container">
            <ul>
                      <li><a href="#" class=""><span>Home</span></a></li>
					  <li><a href="#" class="current"><span>Facebook App</span></a></li>
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
        		Data Posting <button onclick="document.location='<?php echo get_url('new_fb_application'); ?>'">New</button>
        </div>
	<div class="portlet-content nopadding">
        
          <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
           <tbody>
			<?php
			if ($sub=="fb_setting"){
			 $app=$this->m_fanpage->select_default_fb_app();
			 $apps=$this->m_fanpage->select_all_fb_app();
			 $default_app='';
			 foreach($app->result() as $r){
				$default_app=$r->appId;
			 }
			 $arr_app=array();
			 foreach ($apps->result() as $a){
				$arr_app[$a->appId]=$a->app_name;
			 }
			 echo form_open('fanpage/set_defult_app');
			?>
			<tr>
			 <td width="100px">Default App</td>
			 <td width="10px">:</td>
			 <td><?php echo form_open().dropdown('app',$arr_app,$default_app).submit('submit','Simpan').form_close(); ?></td>
			</tr>
			
			<?php
			echo form_close();
			
			}elseif($sub == "fb_new"){
			echo form_open();
			?>
			<tr>
			 <td>Nama Aplikasi</td> <td>:</td> <td><?php echo input('app_name'); ?></td>
			</tr>
			<tr>
			 <td width="100px">AppID</td> <td width="10px">:</td> <td><?php echo input('appid'); ?></td>
			</tr>
			<tr>
			 <td>App Secret</td> <td>:</td> <td><?php echo input('appSecret'); ?></td>
			</tr>
			<tr>
			 <td>Return Url</td> <td>:</td> <td><?php echo input('return_url'); ?></td>
			</tr>
			<tr>
			 <td>Home Url</td> <td>:</td> <td><?php echo input('homeurl'); ?></td>
			</tr>
			<tr>
			 <td>FB Permissions</td> <td>:</td> <td><?php echo input('fb_permisions'); ?></td>
			</tr>
			<tr>
			 <td>Token</td> <td>:</td> <td><?php echo input('token'); ?></td>
			</tr>
			<tr>
			 <td></td> <td></td> <td style="text-align:right;"><?php echo submit('submit','Simpan').form_close(); ?></td>
			</tr>
			<?php				
			}
			 ?>
            
            </tbody>
          </table>
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
