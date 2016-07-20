<span id="ajax_load_control_inputs"></span>
<button class="btn btn-mini" type="button" id="pdg_send">Send</button>


<script>
$(document).ready(function() {
	$.get('/inside/custom_model/inside_access/main_model/group_select_by_id/', function(data) {
		$('#ajax_load_control_inputs').html(data);
	});
  
});
</script>
