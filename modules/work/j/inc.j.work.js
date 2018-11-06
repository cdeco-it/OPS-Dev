//Activate date pickers
	$(function() {
		$( "#j_milestone_date" ).datepicker({
			format: "mm-dd-yyyy",
		 	clearBtn: true
		});
// 		$( "#dob" ).datepicker({
// 			format: "mm-dd-yyyy",
// 			clearBtn: true
// 		});	
	});

	$(document).ready(function(){

		//Deal with the submission of a new employee
		$('#j_edit_form').on("submit", function(e){
			e.preventDefault();
			$.ajax({
				url: "updateBase.php",
				method: "POST",
				data: $('#j_edit_form').serialize(),
				dataType: "json"
			})
			.done(function(data){
				if(!data.success){
					$('#j_edit').modal('hide');
					$('#error').html(data.message + data.info);
					$("#error").show();
				}else{
					var url = window.location.href;
	                window.location.href = url;
	                //$('#j_edit').modal('hide');
					//$('#success').html(data.message);
					//$("#success").show().fadeTo(5000,500).slideUp(500, function(){
	                //	$('#success').hide();
	               // });
				}
			})
		});

		//Deal with the submission of a new employee
		$('#j_add_milestone_form').on("submit", function(e){
			e.preventDefault();
			$.ajax({
				url: "addMilestone.php",
				method: "POST",
				data: $('#j_add_milestone_form').serialize(),
				dataType: "json"
			})
			.done(function(data){
				if(!data.success){
					$('#j_add_milestone').modal('hide');
					$('#error').html(data.message + data.info);
					$("#error").show();
				}else{
					var url = window.location.href;
	                window.location.href = url;
	                //$('#j_edit').modal('hide');
					//$('#success').html(data.message);
					//$("#success").show().fadeTo(5000,500).slideUp(500, function(){
	                //	$('#success').hide();
	               // });
				}
			})
		});


		//@TODO - Pick up here tomorrow!!!!!
		//
		$(document).on("click","button .deleteMilestone", function(e){
			e.preventDefault();
			var mid = $(this).attr('value');
			var jid = $(this).attr('jid');
			$.ajax({
				url: "deleteMilestone.php",
				method: "POST",
				data: '&mid=' + mid + '&jid=' + jid,
				dataType: "json"
			})
			.done(function(data){
				if(!data.success){
					$('#error').html(data.message + data.info);
					$("#error").show();
				}else{
					$('#success').html(data.message);
					$("#success").show().fadeTo(5000,500).slideUp(500, function(){
	                	$('#success').hide();
	            	});
	            	$('#milestones').html(data.updateInfo);
				}
			})
		});

		//THIS SOMEWHAT WORKS VVVVVVV
		// $('.deleteMilestone').click(function(e) {
		// 	//alert($(this).val());
		// 	e.preventDefault();
		// 	var mid = $(this).attr('value');
		// 	var jid = $(this).attr('jid');
		// 	$.ajax({
		// 		url: "deleteMilestone.php",
		// 		method: "POST",
		// 		data: '&mid=' + mid + '&jid=' + jid,
		// 		dataType: "json"
		// 	})
		// 	.done(function(data){
		// 		if(!data.success){
		// 			$('#error').html(data.message + data.info);
		// 			$("#error").show();
		// 		}else{
		// 			$('#success').html(data.message);
		// 			$("#success").show().fadeTo(5000,500).slideUp(500, function(){
	 //                	$('#success').hide();
	 //            	});
	 //            	$('#milestones').html(data.updateInfo);
		// 		}
		// 	})
		// });
	});

	tinymce.init({ 
		selector:'#j_sow',
		height: 400,
		branding: false,
		menubar: false,
		toolbar: 'undo redo | formatselect | bold italic underline strikethrough backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
		plugins: ['wordcount'] 
	});