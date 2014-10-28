        <hr>
          <table width="100%" class="table">
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
