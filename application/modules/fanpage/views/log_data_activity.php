        <form action="" method="post">
          <table width="100%" cellpadding="0" cellspacing="0" class="table">
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
            $prefix=str_replace(' ','_',strtolower($title));
			$bg="";
		$no=1;
		if (!isset($datas)){exit();}
		 foreach($datas->result() as $r){
			 $ID=$r->ID;
			 $user=$r->user;
			 $tgl=$r->date_time;
			 $type=$r->type;
			 $message=$r->message;
			 if($no%2 == 0){$bg="#B9B9B9;";}else{$bg="";}
			 	$url_actions=anchor($this->uri->uri_string()."#",'__','class="delete_icon" id="delete" 
					onclick="delete_record(\''.$active.'\','.$ID.');"');
			
              echo "<tr style=background:".$bg.">
		        <td width='34'><label>
		            <input type='checkbox' name='checkbox' id='checkbox' />
		        </label></td>
                <td>".$no."</td>
		        <td>".$tgl."</td>
		        <td>".$user."</td>
		        <td>".$type."</td>
		        <td>".$message."</td>
		        <td width='90'>".$url_actions."</td>
              </tr>";
			  $no++;
              }
              ?>
              
            </tbody>
          </table>
        </form>

