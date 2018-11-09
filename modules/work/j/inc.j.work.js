//Activate date pickers
	$(function() {
		$( "#j_milestone_date" ).datepicker({
			format: "mm-dd-yyyy",
		 	clearBtn: true
		});
	});

	$(document).ready(function(){

/**
 * START BASE INFOR EDIT
 */
		//Deal with editing of the base J info
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
				}
			})
		});

/**
 * END BASE INFO EDIT
 * START MILESTONE
 */

		//Deal with the addition of a milestone
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
				}
			})
		});

		//Deal with the deletion of milestones
		$(document).on("click",".deleteMilestone", function(e){
			e.preventDefault();
			var mid = $(this).attr('value');
			var jid = $(this).attr('jid');
			if(confirm("Are you sure you want to delete this milestone?")){
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
			}
		});

/**
 * END MILESTONE
 * BEGIN INTERNAL TEAM
 */

		//This function will duplicate the entire DIV #int_team_content, 
		//rename the name value and append to modal
		var internal_team_count = 2;
		$(document).on("click", ".expand_int_team", function(e){
			e.preventDefault();
			var fields = $('#int_team_content').eq(0).clone();
			fields.find('select').each(function() {
			 	this.name = this.name.replace('[1]', '['+internal_team_count+']');
			});

			$('.int_team').append(fields);
			internal_team_count++;
		});

		//Add internal team members
		$('#j_add_internal_team_form').on('submit', function(e){
			e.preventDefault();
			$.ajax({
				url: 'addInternalTeam.php',
				method: 'POST',
				data: $('#j_add_internal_team_form').serialize(),
				dataType: 'json'
			})
			.done(function(data){
				if(!data.success){
					$('#error').html(data.message + data.info);
					$("#error").show();
				}else{
					$('#j_add_internal_team').modal('hide');
					$('#j_add_internal_team_form')[0].reset(); 
					$('#success').html(data.message);
					$("#success").show().fadeTo(5000,500).slideUp(500, function(){
	                	$('#success').hide();
	            	});
	            	$('#internal_team').html(data.updateInfo);
				}
			})
		});

		//Delete internal team record
		$(document).on("click", ".deleteInternalTeam", function(e){
			e.preventDefault();
			var tid = $(this).attr('value');
			var jid = $(this).attr('jid');
			if(confirm("Are you sure you want to delete this internal team member?")){
				$.ajax({
					url: "deleteInternalTeam.php",
					method: "POST",
					data: '&tid=' + tid + '&jid=' + jid,
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
		            	$('#internal_team').html(data.updateInfo);
					}
				})
			}
		});

	/**
	 * END INTERNAL TEAM
	 */


	});

	tinymce.init({ 
		selector:'#j_sow',
		height: 400,
		branding: false,
		menubar: false,
		toolbar: 'undo redo | formatselect | bold italic underline strikethrough backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
		plugins: ['wordcount'] 
	});