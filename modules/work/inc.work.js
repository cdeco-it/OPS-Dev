$(function(){
	$("#work_client_display").autocomplete({
		source: '/lib/assistants/asst.orglookup.php',
	 	minLength: 1,
	 	select: function(event, ui){
			event.preventDefault();
			$("#work_client").val(ui.item.id);
			$("#work_client_display").val(ui.item.value);
			alert($("#work_client").val());
		},
		change: function(event, ui){
			event.preventDefault();
			if(ui.item == null){
				$("#work_client").val(null);
			}else{
				$("#work_client").val(ui.item.id);
			}
		}
	});

	$("#work_poc_display").autocomplete({
		source: '/lib/assistants/asst.contactlookup.php',
	 	minLength: 1,
	 	select: function(event, ui){
			event.preventDefault();
			$("#work_poc").val(ui.item.id);
			$("#work_poc_display").val(ui.item.value);
			alert($("#work_poc").val());
		},
		change: function(event, ui){
			event.preventDefault();
			if(ui.item == null){
				$("#work_poc").val(null);
			}else{
				$("#work_poc").val(ui.item.id);
			}
		}
	});

});

$(document).ready(function(){
	//Activate the DataTable
	////		"pageLength": 25, <-- changes default starting length.
	$('#work').DataTable({
		"lengthChange": true,
		"order": [],
		"columnDefs": [ {
			"targets": 'no-sort',
			"orderable": false,
		}]
	});

	//To handle edits
	$(document).on("click", ".editButton", function(e){
		var id = $(this).val();
		e.preventDefault();
		var url = "edit.php?id="+id;
		window.location.href = url;
	});
});

//Used to change the loaded years available.
function loadYear(){
	var year = document.getElementById('yearselect').value;
	window.location = '/modules/work/?year='+year;
}