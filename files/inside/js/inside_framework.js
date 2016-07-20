
	var pdg_timer = new Array(); // Timers Array
	var pdg_dialog_width = 100; 
	var pdg_dialog_height = 100;
	var dialog_id = 1;

$(function() {
     
	 
	 $(".pop_block > a.btn").on('click', function() {
		 $(this).parent().children(".toggle").toggle();
	 });
	 
	 $(".pop_block > .toggle").on('click', function() {
		 $(".pop_block > .toggle").zIndex('10')
		 $(this).zIndex('11');
	 });

	
});

function dialog_shift() {
	pdg_dialog_width = pdg_dialog_width + 10; pdg_dialog_height = pdg_dialog_height + 10;dialog_id++;
	}