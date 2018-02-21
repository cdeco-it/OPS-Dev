//Activate date pickers
	$(function() {
		$( "#hiredate" ).datepicker({
			format: "mm-dd-yyyy",
		 	clearBtn: true
		});
		$( "#dob" ).datepicker({
			format: "mm-dd-yyyy",
			clearBtn: true
		});	
	});

	$(document).ready(function(){

		//Activate the DataTable
		$('#records').DataTable();

		$(document).on("click", ".toggleButton", function(e){
			var id = $(this).val();
			e.preventDefault();
			if(confirm("Are you sure you want to toggle this employees status?")){
				$.ajax({
					url: "toggle.php",
					method: "POST",
					data: {
						"id":id
					},
					dataType: "json"
				})
				.done(function(data){
					if(!data.success){
						$('#error').html(data.message);
						$("#error").show();
					}else{
						$('#success').html(data.message);
						$("#success").show().fadeTo(5000,500).slideUp(500, function(){
			            	$('#success').hide();
			            });
			            $('#outputData').html(data.updateInfo);
			            $('#records').DataTable();
					}
				});
			}
		});

		$(document).on("click", ".editButton", function(e){
			var id = $(this).val();
			e.preventDefault();
			var url = "edit.php?id="+id;
			window.location.href = url;
		});

		$(document).on("click", ".viewButton", function(e){
			var id = $(this).val();
			e.preventDefault();
			var url = "view.php?id="+id;
			window.location.href = url;
		});

		//Deal with the submission of a new employee
		$('#quickadd').on("submit", function(e){
			e.preventDefault();
			$.ajax({
				url: "insert.php",
				method: "POST",
				data: $('#quickadd').serialize(),
				dataType: "json"
			})
			.done(function(data){
				if(!data.success){
					$('#addModal').modal('hide');
					$('#error').html(data.message);
					$("#error").show();
				}else{
					$('#quickadd')[0].reset();  
	                $('#addModal').modal('hide');
					$('#success').html(data.message);
					$("#success").show().fadeTo(5000,500).slideUp(500, function(){
	                	$('#success').hide();
	                });
	                $('#outputData').html(data.updateInfo);
				}
			})
		});
	});