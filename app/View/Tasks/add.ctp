<!--Select2 [ OPTIONAL ]-->
<link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
<script src="/css/plug/select/js/select2.min.js"></script>

<!--SWEET ALERT-->
<link href="/css/sweetalert.css" rel="stylesheet">
<script src="/js/sweetalert.min.js"></script>

<!-- TINYMCE -->
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script> 


<div id="content-container">
	<div id="left">
		<div id="page-title">
			<h1 class="page-header text-overflow">
			    <div class="input-group input-group-lg">
					<span class="input-group-addon">
						<span class="fa fa-plus" id="btn_add_todo"></span>
					</span>
					<input type="text" class="form-control"
						   id="input_add_todo"
						   placeholder="Add a to-do" />
				</div>
			</h1>
		</div>
		
		<div id="page-content">
			<div id="div_subtask" style="margin-bottom:50px;">
				<div id="recent"></div>
				<?php
				foreach($my_tasks as $tasks_obj) {
					$task = $tasks_obj['Task'];
					$task_id = $task['id'];
					$task_name = $task['name'];
					
					echo "
						<div class='panel' style='margin-bottom:-1px;'>
							<div class='checkboxes panel-body' id='all'
							     style='margin-bottom:-10px;'>
									<input type='hidden' class='pass_task_id'
										   value='$task_id'readonly />
									<input type='checkbox'
										   class='done' />
									<label><span> $task_name</span></label>
									<span class='trash fa fa-trash-o fa-lg pull-right'
										  style='padding-top:8px;'
									      id='panel_del'></span>
							</div>
						</div>
					";
				}
				?>
			</div>
		</div>
	</div>
	<div id="right" class="col-lg-6" style="position:fixed;right:-10px;width:43%;" hidden>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">
					<div class="row">
						<div class="col-lg-11 pull-left" style="padding-top: 7.5px;">
							<div class="input-group">
					            <div class="input-group-btn">
					                <input class="done"
										   type="checkbox"/>
					            </div>
					            <input type="text" id="title" class="form-control" />
					        </div>
						</div>
						<div class="col-lg-1">
							<div class="pull-right">
								<span id="collapse_right" class="fa fa-chevron-right"></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-body" style="overflow-y:auto;height:530px;">
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							<div class="row">
								<div class="col-lg-6">
									<div class="input-group">
							            <div class="input-group-btn">
											<input type="radio" name="cb" value="users" checked />
										</div>
										<label style="padding-top:7px;"> <span>Users</span></label>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="input-group">
							            <div class="input-group-btn">
											<input type="radio" name="cb" value="department" />
										</div>
										<label style="padding-top:7px;"> <span>Department</span></label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group" id="div_select_users">
							<div class="input-group">
								<span class="input-group-addon">
									<span class="fa fa-grav"></span>
								</span>
								<select class="form-control" id="select_users" multiple>
									<?php
									foreach($get_all_users as $ret_all_users) {
										$user_obj = $ret_all_users['User'];
										$user_id = $user_obj['id'];
										$user_name = ucwords($user_obj['first_name']." ".$user_obj['last_name']);
	
										echo "<option value='$user_id'>$user_name</option>";
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group" id="div_select_dept" hidden>
							<div class="input-group">
								<span class="input-group-addon">
									<span class="fa fa-building-o"></span>
								</span>
								<select class="form-control" id="select_dept" multiple>
									<?php
										foreach($get_all_dept as $each_dept) {
											$dept_obj = $each_dept['Department'];
											$dept_id = $dept_obj['id'];
											$dept_name = ucwords($dept_obj['name']);
										
											echo "<option value='$dept_id'>$dept_name</option>";
										}
									?>
								</select>
							</div>
						</div>
						<!--INSERT ADDED SUBTASK HERE-->
						<div class="form-group">
							<div id="div_added_subtask">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon">
									 <span class="fa fa-plus"
										   id="added_subtask"></span> 
								</span>
								<input type="text" class="form-control"
									   id="input_subtask" placeholder="Add a subtask" />
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon">
									 <span class="fa fa-calendar"></span> 
								</span>
								<input type="date" class="form-control"
								 	   id="input_deadline" placeholder="Set Deadline" />
							</div>
						</div>
						<div class="form-group">
							Add a note
							<textarea class="form-control"
								   id="input_notes"
								   aria-label="Add a note"></textarea>
						</div>
						<!--DELETE TASK-->
						<div class="form-group">
							<div class="row">
								<div class="col-lg-4 pull-left">
									<button class="btn btn-primary btn-xs"
											id="btn_save_subtask">Save</button>
								</div>
								<div class="col-lg-4" align="center">
									<i>Created on <label id="text_created_on"></label></i>
								</div>
								<div class="col-lg-4 pull-right">
									<span class="trash fa fa-trash-o fa-lg pull-right"
										  style="padding-top:5px;" id="btn_del_task"></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!--JAVASCRIPT METHODS-->
<script>
    tinymce.init({
        selector: 'textarea',
        height: 100,
        menubar: false,
        plugins: [
            'autolink',
            'link',
            'codesample',
            'lists',
            'searchreplace visualblocks',
            'table contextmenu paste code'
        ],
        toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | codesample | link',
    });
</script>
<script type="text/javascript">
$(document).ready(function() {
	$("div#right").hide();
	var isRightVisible = false;
	var selected_task = 0;
	var taskname = '';
	var triggered;

	$("#select_users").select2({
        allowClear: true,
        width: '100%'
    });
    
    $("#select_dept").select2({
        allowClear: true,
        width: '100%'
    });

	$("input[type=radio][name=cb]").change(function() {
		if($(this).val()=="department") {
			$("#div_select_dept").show();
			$("#div_select_users").hide();
			$("#select_users").val(null).trigger("change");
		}
		else {
			$("#div_select_dept").hide();
			$("#div_select_users").show();
			$("#select_dept").val(null).trigger("change");
		}
	});

	$("#btn_add_todo").on('click', function(e) {
	    if (isDoubleClicked($(this))) return;

		show_subtask();
	});

	function isDoubleClicked(element) {
	    if (element.data("isclicked")) return true;
	
	    element.data("isclicked", true);
	    setTimeout(function () {
	        element.removeData("isclicked");
	    }, 900);
	
	    return false;
	}
	
	$("#input_add_todo").bind('keyup', function(e) {
		prevent_redunduncy(e);
	});
	
	function prevent_redunduncy(e) {   
		if (e.which === 13) {
			show_subtask();
			$("#input_add_todo").unbind('keyup');
			
			return setTimeout(function(){
			  $("#input_add_todo").keyup(prevent_redunduncy);
			}, 900);
		}
	}
	
	$('div#recent, div#all').on('click', function(e) {
		$("div#div_added_subtask").empty();
		$("div#right").hide();
		triggered = $(e.target).closest('div#page-content div.panel');
        selected_task = $(e.target).closest("div.checkboxes").find(".pass_task_id").val();
        if(($(e.target).prop('class')!="done") && ($(e.target).prop('id')!="panel_del") && ($(e.target).prop('id')!="panel_del1")) {
			$.get("/tasks/get_task", {id:selected_task}, function(data) {
				var rettasks = $.parseJSON(data);
				var taskobject = rettasks['Task'];
				taskname = taskobject['name'];
				var assignedto = taskobject['assigned_to'];
				var created_on_tmp = taskobject['created'];
				var task_stat = taskobject['status'];
				if(task_stat=="Completed") {
					$(".done").prop('checked', true);
				}
				else {
					$(".done").prop('checked', false);
				}
				
				var dept_ids = [];
				if(taskobject['department_id']!=null || taskobject['department_id']!='') {
					dept_ids = JSON.parse(taskobject['department_id']);
				}
				var user_ids = [];
				if(taskobject['users']!=null || taskobject['users']!='') {
					user_ids = JSON.parse(taskobject['users']);
				}
				
				var formattedDate = new Date(created_on_tmp);
				var d = formattedDate.getDate();
				var m =  formattedDate.getMonth(); m += 1;
				var y = formattedDate.getFullYear();
				
				$("#title").val(taskname);
				$("#text_created_on").text(m+'/'+d+'/'+y);
				
				if(assignedto=="department") {
					// $("#select_dept").val(null).trigger("change");
					$("input[name=cb][value=department]").prop('checked', true);
					$("input[name=cb][value=users]").prop('checked', false);
					$("#div_select_dept").show();
					$("#div_select_users").hide();
					
					// $("#select_dept").select2().select2('val', [dept_ids]);
				}
				else if(assignedto=="users") {
					// $("#select_users").val(null).trigger("change");
					$("input[name=cb][value=department]").prop('checked', false);
					$("input[name=cb][value=users]").prop('checked', true);
					$("#div_select_dept").hide();
					$("#div_select_users").show();
					
					// $("#select_users").select2().select2('val', [user_ids]);
				}
				else {
					// $("#select_users").select2().select2('val', [user_ids]);
				}
			});
			
			$("div#left").addClass('col-lg-6');
			
			if($(window).scrollTop() != 0) {
				$("div#right").css({'position':'fixed','right':'-10px','top':'0','width':'43%'});
			}
			$("div#right").show();
			isRightVisible = true;
        }
        else {
        	if($(e.target).prop('nodeName')=='INPUT') {
        		DoneTask(e);
        	}
        	
        	if(isRightVisible) {
				$("div#left").addClass('col-lg-6');
				
				if($(window).scrollTop() != 0) {
					$("div#right").css({'position':'fixed','right':'-10px','top':'0','width':'43%'});
				}
				$("div#right").show();
				isRightVisible = true;
        	}
        	else {
				$("div#left").removeClass('col-lg-6');
				$("div#right").hide();
				isRightVisible = false;
        	}
        }
	});
	
	$("#btn_del_task, #panel_del, #panel_del1").on('click', function() {
		DeleteTask();
	});
	
	function show_subtask() {
		var task_title = $("#input_add_todo").val();
		$("#input_add_todo").val('');
		if(task_title!="") {
			$.ajax({
				url: "/tasks/add_task",
				type: "POST",
				data: {"task":task_title},
				dataType: "text",
				success: function(taskid) {
					console.log('taskid');
					var div_recent = '<div class="panel" style="margin-bottom:-1px;">'+
							'<div class="checkboxes panel-body" id="added_recent" '+
							    'style="margin-bottom:-10px;">'+
							    	'<input type="hidden" class="pass_task_id" '+
											'value="'+taskid+'" readonly />'+
									'<input type="checkbox" class="done" />'+
									'<label><span>&nbsp;'+task_title+'</span></label>'+
									'<span class="trash fa fa-trash-o fa-lg pull-right" '+
										  'style="padding-top:8px;" '+
									      'id="panel_del1"></span>'+
							'</div>'+
						'</div>';
						
					$("#recent").prepend(div_recent);
				},
				error: function(error) {
					console.log(error);
					swal({
						title: "Oop!",
						text: "There was an error in adding Task.\nPlease try again.",
						type: "warning"
					});
				}
			});
		}
	}

	function DeleteTask() {
		swal({
			title: "Are you sure?",
			text: "This will delete task.",
			type: "warning",
			showCancelButton: true,
            confirmButtonClass: "btn-danger",
            closeOnConfirm: true,
            closeOnCancel: true
		},
		function(isConfirm) {
			if(isConfirm) {
				$.ajax({
					url: "/tasks/delete_task",
					type: "POST",
					data: {"id": selected_task},
					dataType: "text",
					success: function(success) {
						console.log(success);
						isRightVisible = false;
						$("div#right").hide();
						$("div#left").removeClass('col-lg-6');
						triggered.hide();
					},
					error: function(error) {
						console.log(error);
						swal({
							title: "Oops!",
							text: "An error occurred while deleting task.\nPlease try again.",
							type: "warning",
						});
					}
				});
			}
		});
	}
	
	$("span#collapse_right").on('click', function() {
		$("div#right").hide();
		$("div#left").removeClass('col-lg-6');
		isRightVisible = false;
	});
	
	function DoneTask(e) {
		var clicked_task = $(e.target);
		swal({
			title: "Are you sure?",
			text: "This will finish task.",
			type: "warning",
			showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Complete",
            cancelButtonText: "No",
            closeOnConfirm: true,
            closeOnCancel: true
		},
		function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                	url: "/tasks/done_task",
                	type: "POST",
                	data: {"id": selected_task},
                	success: function(success) {
                		console.log(success);
                		clicked_task.closest("div#page-content div.panel").hide();
                		$("div#right").hide();
                		$("div#left").removeClass('col-lg-6');
                		triggered.hide();
                	},
                	error: function(error) {
                		console.log(error);
                		clicked_task.prop('checked', false);
                		swal({
                			title: "Oops!",
                			text: "There was an error in completing task.\nPlease try again.",
                			type: "warning"
                		});
                	}
                });
            }
            else {
        		clicked_task.prop('checked', false);
	        }
		});
	}
	
	$("#added_subtask").on('click', function() {
		if (isDoubleClicked($(this))) return;
		var subtask = $("#input_subtask").val();
		append_subtask(subtask);
	});
	
	$("#input_subtask").on('keyup', function(evt) {
		prevent_redunduncy1(evt)
	});
	
	function prevent_redunduncy1(evt) {
		if (evt.which === 13) {
			var subtask = $("#input_subtask").val();
			append_subtask(subtask);
			$("#input_subtask").unbind('keyup');
			
			return setTimeout(function(){
			  $("#input_subtask").keyup(prevent_redunduncy1);
			}, 900);
		}
	}
	
	function append_subtask(subtask) {
		if($("#input_subtask").val()!="") {
			var append_to_div_subtask = "<div class='well well-sm' style='margin-bottom:1px;'>"+
											"<input type='hidden' class='pass_sid' "+
												   "readonly />"+
											"<font>"+subtask+"</font>"+
											"<i class='fa fa-close fa-lg pull-right' "+
											      "id='subtask_del'></i>"+
										"</div>";
			$("div#div_added_subtask").prepend(append_to_div_subtask);
			$("#input_subtask").val('');
		}
	}
	
	$(document).on('click', function(e) {
		var sbtsk_target = $(e.target);
		var subtask_del = sbtsk_target.prop('id');
		var sbtsk_id = sbtsk_target.closest('input.pass_sid').val();
		if(subtask_del == "subtask_del") {
			$.ajax({
				url: '/tasks/del_subtask',
				data: sbtsk_id,
				dataType: 'text',
				success: function(success_msg) {
					console.log(success_msg);
					$(e.target).closest('div').hide();
				},
				error: function(error_msg) {
					console.log(error_msg);
					swal({
						title: "Oops!",
						text: "An error occurred while removing subtask. \n Please try again.",
						type: "warning"
					});
				}
			});
		}
	});
	
	$("#btn_save_subtask").on('click', function() {
		var id = selected_task;
		var orig_title = taskname;
		var title = $("#title");
		var cb = $("input[name=cb]:checked");
		var select = $("#select_users");
		if(cb.val() == "users") {
			select = $("#select_users");
		}
		else if(cb.val() == "department") {
			select = $("#select_dept");
		}
		var input_deadline = $("#input_deadline");
		var input_notes = tinyMCE.get('input_notes').getContent()
		var subtasks_tmp = [];
		$("div#div_added_subtask ul li").each(function() {
			subtasks_tmp.push($(this).text());
		});
		var subtasks = JSON.stringify(subtasks_tmp);
		
		var data = {
			"id": selected_task,
			"orig_title": orig_title,
			"title": title.val(),
			"cb": cb.val(),
			"select": select.val(),
			"deadline": input_deadline.val(),
			"notes": input_notes,
			"subtasks": subtasks
		};

		if(select.val()=="") {
			if(cb.val()=="department") {
				swal({
					title: "Oops!",
					text: "Department cannot be empty. \n Please select department.",
					type: "warning"
				});
			}
			else {
				swal({
					title: "Oops!",
					text: "Users cannot be empty. \n Please select users.",
					type: "warning"
				});
			}
		}
		else {
			if(input_deadline.val()!="") {
				AddSubtask(data);
			}
			else {
				input_deadline.css({'border-color':'red'});
			}
		}
	});
	
	function AddSubtask(task_details) {
		alert(JSON.stringify(task_details));
		// $.ajax({
		// 	url: "/tasks/add_subtask",
		// 	type: "POST",
		// 	data: {"data": task_details},
		// 	dataType: "text",
		// 	success: function(success) {
		// 		console.log("Success: "+success);
		// 		swal({
		// 			title: "Success!",
		// 			text: "Task details saved.",
		// 			type: "success"
		// 		});
		// 	},
		// 	error: function(error) {
		// 		console.log("Error: "+error);
		// 		swal({
		// 			title: "Oops!",
		// 			text: "An error occurred while saving task details.\nPlease try again.",
		// 			type: "warning"
		// 		});
		// 	}
		// });
	}
	
	var lastScrollTop = 0;
	$(window).scroll(function(event){
		if(isRightVisible) {
			var st = $(this).scrollTop();
			if(st == 0){
				$("div#right").css({'position':'fixed','right':'-10px','top':'35px','width':'43%'});
			}
			else {
				$("div#right").css({'position':'fixed','right':'-10px','top':'0','width':'43%'});
			}
		}
		lastScrollTop = st;
	});
});
</script>
<!--END OF JAVASCRIPT METHODS-->