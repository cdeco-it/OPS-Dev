//Activate date pickers
	$(function() {
		$( "#j_milestone_date" ).datepicker({
			format: "mm-dd-yyyy",
		 	clearBtn: true
		});

		$( ".actionDate" ).datepicker({
			format: "mm-dd-yyyy",
		 	clearBtn: true
		});


		

		$("#j_ext_name").autocomplete({
			source: '/lib/assistants/asst.contactlookup.php',
		 	minLength: 1,
		 	select: function(event, ui){
				event.preventDefault();
				$("#j_ext_member_name_id").val(ui.item.id);
				$("#j_ext_name").val(ui.item.value);
				$("#j_ext_org_name_id").val(ui.item.org_id);
				$("#j_ext_team_org").val(ui.item.org_name);
			},
			change: function(event, ui){
				event.preventDefault();
				if(ui.item == null){
					$("#j_ext_team_org").val("");
					$('#j_external_team_add').prop("disabled", true);
					alert("You must add this person to the master address book before assigning them to a team.");
				}else{
					$("#j_ext_member_name_id").val(ui.item.id);
					$("#j_ext_name").val(ui.item.value);
					$("#j_ext_org_name_id").val(ui.item.org_id);
					$("#j_ext_team_org").val(ui.item.org_name);
				}
			}
		});
	});


	$(document).ready(function(){

/**
 * START BASE INFORMATION EDIT
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
			var fields = $('#int_team_content_1').eq(0).clone();

			//Rename the field with an incremental value
			fields.attr('id', "int_team_content_"+internal_team_count);
			fields.addClass('intTeamAddOn');

			//Update select field names
			fields.find('select').each(function() {
			 	this.name = this.name.replace('[1]', '['+internal_team_count+']');
			});

			//Update row delete button values
			fields.find('button').each(function() {
				this.value = this.value.replace('1', internal_team_count);
			});

			$('.int_team').append(fields);
			internal_team_count++;
		});

		//Delete added row
		$(document).on("click", ".del_int_team_row", function(e){
			e.preventDefault();
			var cursor = this.value;
			$('#int_team_content_'+cursor).remove();
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

	            	//This will reset the form to having just ONE input if additional rows were added.
	            	var x = $('.intTeamAddOn').length;
	            	if(x > 0){
	            		$('.intTeamAddOn').remove();
	            	}
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
	 * BEGIN EXTERNAL TEAM
	 */
		//Add external team members
		$('#j_add_external_team_form').on('submit', function(e){
			e.preventDefault();
			$.ajax({
				url: 'addExternalTeam.php',
				method: 'POST',
				data: $('#j_add_external_team_form').serialize(),
				dataType: 'json'
			})
			.done(function(data){
				if(!data.success){
					$('#error').html(data.message + data.info);
					$("#error").show();
				}else{
					$('#j_add_external_team').modal('hide');
					$('#j_add_external_team_form')[0].reset(); 
					$('#success').html(data.message);
					$("#success").show().fadeTo(5000,500).slideUp(500, function(){
	                	$('#success').hide();
	            	});
	            	$('#external_team').html(data.updateInfo);
				}
			})
		});

		//Delete external team record
		$(document).on("click", ".deleteExternalTeam", function(e){
			e.preventDefault();
			var etid = $(this).attr('value');
			var jid = $(this).attr('jid');
			if(confirm("Are you sure you want to delete this external team member?")){
				$.ajax({
					url: "deleteExternalTeam.php",
					method: "POST",
					data: '&etid=' + etid + '&jid=' + jid,
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
		            	$('#external_team').html(data.updateInfo);
					}
				})
			}
		});

		$("#j_ext_name").keyup(function(){
			if($(this).val().length != 0){
				$("#j_external_team_add").prop('disabled', false);	
			}else{
				$("#j_external_team_add").prop('disabled', true);
				$("#j_ext_member_name_id").val("");
				$("#j_ext_name").val("");
				$("#j_ext_org_name_id").val("");
				$("#j_ext_team_org").val("");
			}
		});

	/**
	 * END EXTERNAL TEAM
	 * BEGIN DISCUSSION
	 */
	
		//Add new discussion
		$('#j_add_discussion_form').on('submit', function(e){
			e.preventDefault();
			$.ajax({
				url: 'addDiscussion.php',
				method: 'POST',
				data: $('#j_add_discussion_form').serialize(),
				dataType: 'json'
			})
			.done(function(data){
				if(!data.success){
					$('#error').html(data.message + data.info);
					$("#error").show();
				}else{
					$('#j_add_discussion').modal('hide');
					$('#j_add_discussion_form')[0].reset(); 
					$('#success').html(data.message);
					$("#success").show().fadeTo(5000,500).slideUp(500, function(){
	                	$('#success').hide();
	            	});
	            	$('#discussion_entries').html(data.updateInfo);
				}
			})
		});

		//Load discussion editor in modal
		$(document).on("click", ".editDiscussion", function(e){
			e.preventDefault();
			var loadId = $(this).attr('value');
			$.ajax({
				url: 'editorDiscussion.php',
				method: 'POST',
				data: '&load_id=' + loadId,
				dataType: 'json'
			})
			.done(function(data){
				if(!data.success){					
					$('#error').html(data.message + data.info);
					$("#error").show();
				}else{
					// $('#edit_disc_info').html(data.did);
					$('#j_edit_discussion_form').append(data.did);
					$('#j_edit_discussion').modal('show');
					var editor = tinymce.get('j_edit_disc');
					editor.setProgressState(1);
					window.setTimeout(function(){
						editor.setProgressState(0);
						editor.setContent(data.updateInfo);
					}, 1500);
					
					
					
				}
			})
		});

		//Update discussion record
		$('#j_edit_discussion_form').on('submit', function(e){
			e.preventDefault();
			$.ajax({
				url: 'editDiscussion.php',
				method: 'POST',
				data: $('#j_edit_discussion_form').serialize(),
				dataType: 'json'
			})
			.done(function(data){
				if(!data.success){
					$('#error').html(data.message + data.info);
					$("#error").show();
				}else{
					$('#j_edit_discussion').modal('hide');
					$('#j_edit_discussion_form')[0].reset(); 
					$('#success').html(data.message);
					$("#success").show().fadeTo(5000,500).slideUp(500, function(){
	                	$('#success').hide();
	            	});
	            	$('#discussion_entries').html(data.updateInfo);
				}
			})
		});

		//Delete discussion record
		$(document).on("click", ".deleteDiscussion", function(e){
			e.preventDefault();
			var did = $(this).attr('value');
			var jid = $(this).attr('jid');
			if(confirm("Are you sure you want to delete this external discussion entry?")){
				$.ajax({
					url: "deleteDiscussion.php",
					method: "POST",
					data: '&d_id=' + did + '&j_id=' + jid,
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
		            	$('#discussion_entries').html(data.updateInfo);
					}
				})
			}
		});


	/**
	 * END DISCUSION
	 * BEGIN ACTIONS
	 */
	
	//Add new actions
		$('#j_add_action_form').on('submit', function(e){
			e.preventDefault();
			$.ajax({
				url: 'addAction.php',
				method: 'POST',
				data: $('#j_add_action_form').serialize(),
				dataType: 'json'
			})
			.done(function(data){
				if(!data.success){
					$('#error').html(data.message + data.info);
					$("#error").show();
				}else{
					$('#j_add_action').modal('hide');
					$('#j_add_action_form')[0].reset(); 
					$('#success').html(data.message);
					$("#success").show().fadeTo(5000,500).slideUp(500, function(){
	                	$('#success').hide();
	            	});
	            	$('#action_items').html(data.updateInfo);
				}
			})
		});

	//Load action editor in modal
		$(document).on("click", ".editAction", function(e){
			e.preventDefault();
			var loadId = $(this).attr('value');
			$.ajax({
				url: 'editorAction.php',
				method: 'POST',
				data: '&load_id=' + loadId,
				dataType: 'json'
			})
			.done(function(data){
				if(!data.success){					
					$('#error').html(data.message + data.info);
					$("#error").show();
				}else{

					//Update date selectors
					$('#j_edit_action_date_assigned').val(data.updateInfo.dateAssigned);
					$('#j_edit_action_date_due').val(data.updateInfo.dueDate);
					$('#j_edit_action_date_complete').val(data.updateInfo.dateComplete);

					//Load emnployee selector
					$.ajax({
						url: '/lib/assistants/asst.selectemployee.php',
						method: 'POST',
						dataType: 'json',
						success: function(response){
							$('#j_edit_action_assignedto').empty();
							var len = response.length;
							for(var i = 0; i < len; i++){
								var id = response[i]['id'];
								var name = response[i]['name'];
								if(id == data.updateInfo.assignedTo){
									var opt = '<option value="'+id+'" selected="SELECTED">'+name+'</option>';
								}else{
									var opt = '<option value="'+id+'">'+name+'</option>';
								}
								
								$('#j_edit_action_assignedto').append(opt);
							}
						},
						error: function(response){
							alert("ERROR");
						}
					});

					//Update hidden aid value
					$('#a_id').val(data.updateInfo.id);
					
					//Load content to task
					var task = tinymce.get('j_edit_action_task');
					task.setProgressState(1);
					window.setTimeout(function(){
						task.setProgressState(0);
						task.setContent(data.updateInfo.task);
					}, 500);

					//Load content to comment
					var comment = tinymce.get('j_edit_action_comments');
					comment.setProgressState(1);
					window.setTimeout(function(){
						comment.setProgressState(0);
						comment.setContent(data.updateInfo.comments);
					}, 500);

					$('#j_edit_action').modal('show');
				}
			})
		});
	//Update action record
		$('#j_edit_action_form').on('submit', function(e){
			e.preventDefault();
			$.ajax({
				url: 'editAction.php',
				method: 'POST',
				data: $('#j_edit_action_form').serialize(),
				dataType: 'json'
			})
			.done(function(data){
				if(!data.success){
					$('#error').html(data.message + data.info);
					$("#error").show();
				}else{
					$('#j_edit_action').modal('hide');
					$('#j_edit_action_form')[0].reset(); 
					$('#success').html(data.message);
					$("#success").show().fadeTo(5000,500).slideUp(500, function(){
	                	$('#success').hide();
	            	});
	            	$('#action_items').html(data.updateInfo);
				}
			})
		});

	//Delete action record
		$(document).on("click", ".deleteAction", function(e){
			e.preventDefault();
			var aid = $(this).attr('value');
			var jid = $(this).attr('jid');
			if(confirm("Are you sure you want to delete this action item?")){
				$.ajax({
					url: "deleteAction.php",
					method: "POST",
					data: '&a_id=' + aid + '&j_id=' + jid,
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
		            	$('#action_items').html(data.updateInfo);
					}
				})
			}
		});


	});


	tinymce.init({ 
		// selector:'#j_sow',
		selector: '.tinymce',
		height: 400,
		branding: false,
		menubar: false,
		toolbar: 'undo redo | formatselect | bold italic underline strikethrough forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
		plugins: 'wordcount textcolor colorpicker' 
	});

	tinymce.init({ 
		// selector:'#j_sow',
		selector: '.tinymce_mini',
		height: 100,
		branding: false,
		menubar: false,
		toolbar: 'bold italic underline strikethrough forecolor backcolor ',
		plugins: 'textcolor colorpicker' 
	});

	function resetIntTeamForm(){
		("div.intTeamAddOn").remove();
	}

	function populateEmployee(){

	}