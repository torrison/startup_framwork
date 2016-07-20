<input type="hidden" id="pdg_table" name="pdg_table" value="<?php echo $table_name;?>" />
<input type="hidden" id="pdg_order" name="pdg_order" value="" />
<input type="hidden" id="pdg_asc" name="pdg_asc" value="desc" />


<div id="search_div">


<a href="/inside/pdg_add/table_name" OnClick="return false;" style="cursor:pointer; color: #ddf;margin-left:2px;" class="btn btn-success pdg_badd"><i class="icon-plus icon-white"></i></a>
<a style="cursor:pointer; color: #cfc;" class="btn btn-info pdg_bcopy"><i class="icon-tags icon-white"></i></a>
<a style="cursor:pointer;color:#f88;" class="btn btn-danger pdg_bdel"><i class="icon-trash icon-white"></i></a>

<?php if (strlen($filters) > 0) {?>
<div class="pop_block">
	<a class="btn"><i class="icon-filter"></i></a>
	<div class="toggle" style="min-width: 250px;">
		
		<?php echo $filters;?>
		
	</div>
</div>
<?php } ?>

<div class="pop_block">
	<a class="btn"><i class="icon-wrench"></i></a>
	<div class="toggle" style="width: 200px;">
		
		On page: 
		<input type="text" value="100" id="pdg_limit" name="pdg_limit" style="width:50px;" /> cells
		
	</div>
</div>

<div class="pop_block">
	<a class="btn"><i class="icon-user"></i></a>
	<div class="toggle" style="width: 150px;">
		
		<?php 
		if (isset ($user_info_arr))
		{
			echo '<b>User:</b> ';
			echo '<span style="color:#55a; font-weight:bold;"><b>';
			echo $user_info_arr['users']['first_name']." ".$user_info_arr['users']['last_name']." ".$user_info_arr['users']['email']."</b></span> [".$user_info_arr['id']."]";
			echo ' <br /><b>in Groups:</b><br /> ';
			foreach ($user_info_arr['groups'] as $groups) {echo $groups['description']."<br />";}
		}
		?>
	</div>
</div>

<input type="text" style="width:250px; margin-left: 10px;" value="<?php if (isset($_GET['inside_search'])) echo mysql_real_escape_string($this->input->get('inside_search', true)) ?>" id="pdg_fsearch" name="pdg_fsearch" placeholder="Search..." />
<input type="text" style="width:50px; margin-left: 10px;" value="<?php if (isset($_GET['inside_key'])) echo mysql_real_escape_string($this->input->get('inside_key', true)) ?>" id="pdg_fkey" name="pdg_fkey" placeholder="ID..." />
<button class="btn btn-mini" type="button" id="pdg_send">Send</button>

<a id="pdg_page_prev" style="margin-left: 20px;">&lt;&lt;</a>  Page: <b id="pdg_page_text">1</b>  <a id="pdg_page_next">&gt;&gt;</a>
 <input type="hidden" id="pdg_page" name="pdg_page" value="1" />

</div>
