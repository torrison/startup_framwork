<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Access Change Model
 *
 * @author Alex Torrison
 */
class Main_Model extends CI_Model
{
	
	public function __construct(){
	
	}
	
	public function index()
	{		
		if (!$this->inside_access->check_access('root_system_zone')) exit('Access Denied');
		
		// Works like SingleTone !!!		
		$group_id = intval($this->input->post('groups_id'));
		if ($group_id > 0)
		{
		// Get group data
		$query = $this->db->query('SELECT * FROM groups WHERE id ='.$group_id);	
		$group_id_arr = $query->result_array();
		// Get one first row
		$group_info = $group_id_arr[0];
		
		$query = $this->db->query('SELECT * FROM inside_top_menu ORDER BY top_menu_name');	
		$all_inside_blocks = $query->result_array();
		
		$query = $this->db->query('SELECT * FROM inside_system_zones ORDER BY system_zones_name');	
		$all_zones = $query->result_array();
		
		$query = $this->db->query('SELECT access_system_zones_zone_id FROM inside_access_system_zones WHERE access_system_zones_group_id = '.$group_id);			
		$selected_zones_res = $query->result_array();
		$selected_zones_arr = Array();
		foreach ($selected_zones_res as $row) {$selected_zones_arr[] = $row['access_system_zones_zone_id'];}
		
		$query = $this->db->query('SELECT access_top_menu_block_id FROM inside_access_top_menu WHERE access_top_menu_group_id = '.$group_id);	
		$selected_blocks_res = $query->result_array();
		$selected_blocks_arr = Array();
		foreach ($selected_blocks_res as $row) {$selected_blocks_arr[] = $row['access_top_menu_block_id'];}
		
		
ob_start();
?>
<b>Inside Top Menu View Access: Group = <?php echo $group_info['description'];?> (<?php echo $group_info['name'];?>)</b>
<br /><br />
<form method="post" action="/inside/custom_model/inside_access/main_model/save_top_menu_access/">
<input type="hidden" name="group_id" value="<?php echo $group_info['id'];?>">

<span class="input-line">Inside Top Menu Access</span>
<button class="btn btn-mini btn-success form_submit" type="button" id="pdg_send" style="margin-bottom: 3px;">Save Changes</button>

<select name="inside_top_menu_access_rules[]" multiple="multiple"  class="multiselect pdg_mselect">
	<?php foreach ($all_inside_blocks as $block_row) {?>
	<option value="<?php echo $block_row['top_menu_id']; ?>"<?php if (in_array($block_row['top_menu_id'], $selected_blocks_arr)) echo " selected"?>><?php echo $block_row['top_menu_name']; ?></option>
	<?php } ?>
</select>



</form>
<br /><br />
<form method="post" action="/inside/custom_model/inside_access/main_model/save_zones_access/">

<input type="hidden" name="group_id" value="<?php echo $group_info['id'];?>">
<span class="input-text">Inside Zones Access</span>
<button class="btn btn-mini btn-success form_submit" type="button" id="pdg_send" style="margin-bottom: 3px;">Save Changes</button>

<select name="inside_zones_access_rules[]" multiple="multiple"  class="multiselect pdg_mselect">
	<?php foreach ($all_zones as $zone_row) {?>
	<option value="<?php echo $zone_row['system_zones_id']; ?>"<?php if (in_array($zone_row['system_zones_id'], $selected_zones_arr)) echo " selected"?>><?php echo $zone_row['system_zones_name']; ?></option>
	<?php } ?>
</select>

</form>
<br /><br />
<form method="post" action="/inside/custom_model/inside_access/main_model/save_tables_access/">

<input type="hidden" name="group_id" value="<?php echo $group_info['id'];?>">
<span class="input-text">Tables Access</span>
<button class="btn btn-mini btn-success form_submit" type="button" id="pdg_send" style="margin-bottom: 3px;">Save Changes</button>

<table class="table table-bordered" style="width: 600px;">
	<tr>
		<th>id</th>
		<th>Table SysName</th>
		<th>Table Decription</th>
		<th style="width: 35px;">View</th>
		<th style="width: 35px;">Edit</th>
		<th style="width: 35px;">Tabs</th>		
	</tr>
<?php 
$query = $this->db->query('SELECT 
							inside_tables.tables_id as tables_id, 
							inside_tables.tables_name as tables_name, 
							inside_tables.tables_description as tables_description, 
							inside_access_tables.access_tables_view as access_tables_view,
							inside_access_tables.access_tables_edit as access_tables_edit 
							FROM inside_tables 
							LEFT JOIN inside_access_tables
							ON inside_tables.tables_id = inside_access_tables.access_tables_table_id AND inside_access_tables.access_tables_group_id = '.intval($group_info['id']).'
							ORDER BY tables_name ASC');
foreach ($query->result_array() as $row) {

if ($row['access_tables_view'] == 1) $bcolor_view = "green";
else $bcolor_view = "darkred";

if ($row['access_tables_edit'] == 1) $bcolor_edit = "green";
else $bcolor_edit = "darkred";

?>	
	<tr>
		<td><?php echo $row['tables_id']; ?><input type="hidden" name="table_id[]" value="<?php echo $row['tables_id']; ?>" /></td>
		<th><?php echo $row['tables_name']; ?></th>
		<td><?php echo $row['tables_description']; ?></td>
		<td style="background: <?php echo $bcolor_view;?>;"><select style="width:auto;" name="view_table_access[]"><option value="allow"<?php if ($row['access_tables_view'] == 1) echo " selected"?>>Allow</option><option value="deny"<?php if ($row['access_tables_view'] == 0) echo " selected"?>>Deny</option></select></td>
		<td style="background: <?php echo $bcolor_edit;?>;"><select style="width:auto;" name="edit_table_access[]"><option value="allow"<?php if ($row['access_tables_edit'] == 1) echo " selected"?>>Allow</option><option value="deny"<?php if ($row['access_tables_edit'] == 0) echo " selected"?>>Deny</option></select></td>
		<td><a class="btn tabs_rules" group_id="<?php echo $group_info['id'];?>" table="<?php echo $row['tables_name']; ?>" table_id=<?php echo $row['tables_id']; ?>>Tabs Rules</a></td>
	</tr>
<?php } ?>
</table>

</form>
<br /><br />
<form method="post" action="/inside/custom_model/inside_access/main_model/save_customs_access/">

<input type="hidden" name="group_id" value="<?php echo $group_info['id'];?>">
<span class="input-text">Custom Access</span>
<button class="btn btn-mini btn-success form_submit" type="button" id="pdg_send" style="margin-bottom: 3px;">Save Changes</button>

<table class="table table-bordered" style="width: 600px;">
	<tr>
		<th>id</th>
		<th>Custom SysName</th>
		<th>Custom Decription</th>
		<th style="width: 35px;">View</th>
		<th style="width: 35px;">Edit</th>		
	</tr>
<?php 
$query = $this->db->query('SELECT 
							inside_customs.customs_id as customs_id, 
							inside_customs.customs_name as customs_name, 
							inside_customs.customs_description as customs_description, 
							inside_access_customs.access_customs_view as access_customs_view,
							inside_access_customs.access_customs_edit as access_customs_edit 
							FROM inside_customs 
							LEFT JOIN inside_access_customs
							ON inside_customs.customs_id = inside_access_customs.access_customs_custom_id AND inside_access_customs.access_customs_group_id = '.intval($group_info['id']).'
							ORDER BY customs_name ASC');
foreach ($query->result_array() as $row) {

if ($row['access_customs_view'] == 1) $bcolor_view = "green";
else $bcolor_view = "darkred";

if ($row['access_customs_edit'] == 1) $bcolor_edit = "green";
else $bcolor_edit = "darkred";
?>	
	<tr>
		<td><?php echo $row['customs_id']; ?><input type="hidden" name="custom_id[]" value="<?php echo $row['customs_id']; ?>" /></td>
		<th><?php echo $row['customs_name']; ?></th>
		<td><?php echo $row['customs_description']; ?></td>
		<td style="background: <?php echo $bcolor_view;?>;"><select style="width:auto;" name="view_custom_access[]"><option value="allow"<?php if ($row['access_customs_view'] == 1) echo " selected"?>>Allow</option><option value="deny"<?php if ($row['access_customs_view'] == 0) echo " selected"?>>Deny</option></select></td>
		<td style="background: <?php echo $bcolor_edit;?>;"><select style="width:auto;" name="edit_custom_access[]"><option value="allow"<?php if ($row['access_customs_edit'] == 1) echo " selected"?>>Allow</option><option value="deny"<?php if ($row['access_customs_edit'] == 0) echo " selected"?>>Deny</option></select></td>
	</tr>
<?php } ?>
</table>

</form>

<?php
$date = ob_get_clean();
		}
		else
		{
		$date = "Select group in control form.";
		}
		return $date;
		
	}

// ----------------------------------------------------------------------------------------------------	 TOP MENU UPDATE ---
	
	public function save_top_menu_access()
	{
	if (!$this->inside_access->check_access('root_system_zone')) exit('Access Denied');
	
	$input_arr = $this->input->post("inside_top_menu_access_rules");
	$group_id = intval ($this->input->post("group_id"));

	$this->db->delete('inside_access_top_menu', array('access_top_menu_group_id' => $group_id)); 
	
	foreach ($input_arr as $inside_menu_id)
	{
	$input = array(
   'access_top_menu_block_id' => $inside_menu_id ,
   'access_top_menu_group_id' => $group_id ,
	);
	$this->db->insert('inside_access_top_menu', $input); 
	ob_start();
	}

?>

Saved!

<?php
$date = ob_get_clean();
		return $date;	
	
	}	

// ----------------------------------------------------------------------------------------------------	 ZONES UPDATE ---

public function save_zones_access()
	{
	if (!$this->inside_access->check_access('root_system_zone')) exit('Access Denied');
	
	$input_arr = $this->input->post("inside_zones_access_rules");
	$group_id = intval ($this->input->post("group_id"));

	$this->db->delete('inside_access_system_zones', array('access_system_zones_group_id' => $group_id)); 
	
	foreach ($input_arr as $zone_id)
	{
	$input = array(
   'access_system_zones_zone_id' => $zone_id ,
   'access_system_zones_group_id' => $group_id ,
	);
	$this->db->insert('inside_access_system_zones', $input); 
	ob_start();
	}

?>

Saved!

<?php
		$date = ob_get_clean();
		return $date;	
	
	}	
	
// ----------------------------------------------------------------------------   TABLES UPDATE   -------------
public function save_tables_access()
	{
	
	if (!$this->inside_access->check_access('root_system_zone')) exit('Access Denied');
	
	$tables_arr = $this->input->post("table_id");
	$view_input_arr = $this->input->post("view_table_access");
	$edit_input_arr = $this->input->post("edit_table_access");
	$group_id = intval ($this->input->post("group_id"));
	

	$this->db->delete('inside_access_tables', array('access_tables_group_id' => $group_id)); 
	
	foreach ($tables_arr as $key => $table_id)
	{
	$input = array(
	   'access_tables_table_id' => $table_id ,
	   'access_tables_group_id' => $group_id ,
	);
	if ($view_input_arr[$key] == 'allow') $input['access_tables_view'] = 1;
	if ($edit_input_arr[$key] == 'allow') $input['access_tables_edit'] = 1;
	
	$this->db->insert('inside_access_tables', $input); 
	ob_start();
	}

?>

Saved!

<?php
		$date = ob_get_clean();
		return $date;	
	
	}	
	
// ----------------------------------------------------------------------------   CUSTOMS UPDATE   -------------
public function save_customs_access()
	{
	
	if (!$this->inside_access->check_access('root_system_zone')) exit('Access Denied');
	
	$customs_arr = $this->input->post("custom_id");
	$view_input_arr = $this->input->post("view_custom_access");
	$edit_input_arr = $this->input->post("edit_custom_access");
	$group_id = intval ($this->input->post("group_id"));
	

	$this->db->delete('inside_access_customs', array('access_customs_group_id' => $group_id)); 
	
	foreach ($customs_arr as $key => $custom_id)
	{
	$input = array(
	   'access_customs_custom_id' => $custom_id ,
	   'access_customs_group_id' => $group_id ,
	);
	if ($view_input_arr[$key] == 'allow') $input['access_customs_view'] = 1;
	if ($edit_input_arr[$key] == 'allow') $input['access_customs_edit'] = 1;
	
	$this->db->insert('inside_access_customs', $input); 
	ob_start();
	}

?>

Saved!

<?php
		$date = ob_get_clean();
		return $date;	
	
	}		

// ---------------------------------------------------------------------------  ACCESS for TABS

public function tabs_access()
	{				
		$this->load->library('inside_lib');
		$table_name = $this->inside_lib->defend_filter(4, $this->input->post('table_name'));
		
		include ('application/config/pdg_tables/'.$table_name.'.php');
		// ------------------------------------------------     Prepare TABS Access Select
		$tabs_select = '<select id="inside_api_groups_select_by_id" name="tab_sysname[]"><option value="0">All</option>';
		foreach ($table_config['cell_tabs_arr'] as $key => $value) {
		$tabs_select .=  '<option value="'.$key.'">'.$value.'</option>';		
		}
		$tabs_select .= '</select>';
		
				ob_start();
?>
<form method="post" action="/inside/custom_model/inside_access/main_model/edit_tabs_access/">
<input type="hidden" name="group_id" value="" />
<input type="hidden" name="table_id" value="" />
<input type="hidden" name="table" value="" />
<table class="table table-bordered">
	<tr>
		<th>Tabs</td>
		<th>View</td>
		<th>Edit</td>
		<th></td>
	</tr>
	<tr>
		<td><?php echo $tabs_select; ?></td>
		<td><select style="width:auto;" name="view_access[]"><option value="allow" selected="">Allow</option><option value="deny">Deny</option></select></td>
		<td><select style="width:auto;" name="edit_access[]"><option value="allow" selected="">Allow</option><option value="deny">Deny</option></select></td>
		<td><a class="btn btn-danger white del_edit_rule">x</a></td>
	</tr>
</table>
<a class="btn btn-success white add_edit_rule">+</a> <a class="btn btn-success white edit_access">Send</a>
</form>
<?php				
				$form = ob_get_clean();	
				echo $form;
	}
	
// Make Groups Select return without All	
	function group_select_by_id_return() {		
		$arr = $this->get_all_user_groups_arr();
		ob_start();
?>

<select id="inside_api_groups_select_by_id" name="groups_id[]">
	<option value="0">All</option>
	<?php foreach ($arr as $row) {?>
	<option value="<?php echo $row['id'];?>"><?php echo $row['description'];?> (<?php echo $row['name'];?>)</option>
	<?php }?>
</select>


<?php	
	return ob_get_clean();
	}	
	
// Make Groups Select	
	function group_select_by_id() {		
		$arr = $this->get_all_user_groups_arr();
		ob_start();
?>

Group: 
<select id="inside_api_groups_select_by_id" name="groups_id">
	<option value="0">All</option>
	<?php foreach ($arr as $row) {?>
	<option value="<?php echo $row['id'];?>"><?php echo $row['description'];?> (<?php echo $row['name'];?>)</option>
	<?php }?>
</select>


<?php	
	}

// Return all user groups array
	function get_all_user_groups_arr() {
			$query_sql = 'SELECT * FROM groups ORDER BY name';
			$query = $this->db->query($query_sql);	
			return $query->result_array();
	}	

	
// End Class

}



/* End of file inside_model.php */
/* Location: ./application/models/inside_model.php */