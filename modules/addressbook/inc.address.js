	//$(document).ready(function(){
   //		$('#records').DataTable();
	//});

	$(document).ready(function(){
		
		//Activate the DataTable
		$('#records').DataTable();

		//To handle deletions
		$(document).on("click", ".deleteButton", function(e){
			var id = $(this).val();
			e.preventDefault();
			if(confirm("Are you sure you want to delete this entry?")){
				$.ajax({
					url: "delete.php",
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
			            $('#output').html(data.updateInfo);
			            $('#records').DataTable();
					}
				});
			}
		});

		//To handle edits
		$(document).on("click", ".editButton", function(e){
			var id = $(this).val();
			e.preventDefault();
			var url = "edit.php?id="+id;
			window.location.href = url;
		});

		//To handle views
		$(document).on("click", ".viewButton", function(e){
			var id = $(this).val();
			e.preventDefault();
			var url = "view.php?id="+id;
			window.location.href = url;
		});
	});