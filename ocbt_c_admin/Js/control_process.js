function update_exam_settings(str){
	var id = str;
	var c_code = $('#c_code-'+str).val();
	var time = $('#time-'+str).val();
	var no_of_quest_to_ans = $('#no_quest_to_ans-'+str).val();
	var stat = $('#status-'+str).val();
	var s = $('#total_no_quest-'+str).text();
	var total_no_of_quest = parseInt(s.replace(/\D+/g,''));
	var error = 0;
	if(total_no_of_quest == 0 && time > 0){
		document.getElementById('error-'+str).innerHTML = "<p class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a>Time cant be set,there are no questions for the course.</p>";
		error = 1;
	}
	if((total_no_of_quest > 0) && (no_of_quest_to_ans <= 0)){
		document.getElementById('error-'+str).innerHTML = "<p class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a>Number of question to answer must be greater than 0</p>";
		error = 1;
}
	if(no_of_quest_to_ans > total_no_of_quest){
		document.getElementById('error-'+str).innerHTML = "<p class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a>The number of questions to answer cant be greater than the total number of questions for the course.</p>";
		error = 1;
	}
	if(total_no_of_quest == 0 && stat == "Active"){
		document.getElementById('error-'+str).innerHTML = "<p class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a>Course cant be set as active,there are no questions for the course.</p>";
		error = 1;
	}
	if(stat == "Active"){
		var status = 1;
	}
	else{
		var status = 0;
	}
	if ( error == 0){
	$.post('update_exam_settings.php',
	{
		'c_code': c_code,
		'time': time,
		'no_of_quest_to_ans':no_of_quest_to_ans,
		'status':status
	},
	function(data){
		if(data =="Record has been Updated!!!"){
			alert(data);
			location.reload();
		}
		else{
			alert(data);
		}
	});
	}
}
//update course
function update_course(str){
	var id = str;
	var c_id = $('#c_id-'+str).val();
	var c_code = $('#c_code-'+str).val();
	var c_title = $('#c_title-'+str).val();
	var unit = $('#unit-'+str).val();
	var error = 0;
	if ( error == 0){
	$.post('update_course.php',
	{
		'c_id':c_id,
		'c_code': c_code,
		'c_title': c_title,
		'unit': unit
	},
	function(data){
		alert(data);
		location.reload();
	});
	}
}
//delete course
function delete_course(str){
	var c_code = $('#c_code-'+str).val();
	if(confirm("Are you sure you want to delete the course ?")){
		$.post('del_course.php',
	{
		'c_code': c_code
	},
	function(data){
		alert(data);
		location.reload();
	});
	}
	
}
//delete student
function delete_student(str){
	var std_id = $('#std_id-'+str).val();
	if(confirm("Are you sure you want to delete the student record ?")){
		$.post('delete_student.php',
	{
		'std_id': std_id
	},
	function(data){
		alert(data);
		location.reload();
	});
	}
	
}
//delete question
function delete_question(str){
	var q_id = $('#q_id-'+str).val();
	if(confirm("Are you sure you want to delete this question?")){
		$.post('delete_question.php',
	{
		'q_id': q_id
	},
	function(data){
		alert(data);
		location.reload();
	});
	}
	
}

//Update student details
function update_student_details(str){
	var std_id =$('#std_id-'+str).val();
	var fname = $('#fname-'+str).val();
	var lname = $('#lname-'+str).val();
	var uname = $('#uname-'+str).val();
	var dept = $('#dept-'+str).val();
	var level = $('#level-'+str).val();
	var error = 0;
	if ( error == 0){
	$.post('update_student_details.php',
	{
		'fname':fname,
		'lname': lname,
		'uname': uname,
		'dept': dept,
		'level': level,
		'std_id': std_id
	},
	function(data){
		alert(data);
		location.reload();
	});
	}
}
//Update question
function update_question(str){
	var q_id =$('#q_id-'+str).val();
	var quest = $('#quest-'+str).val();
	var opt_a = $('#opt_a-'+str).val();
	var opt_b = $('#opt_b-'+str).val();
	var opt_c = $('#opt_c-'+str).val();
	var opt_d = $('#opt_d-'+str).val();
	var answer = $('#ans-'+str).val();
	if( answer == "A"){
		ans = opt_a;
	}
	else if(answer == "B"){
		ans = opt_b;
	}
	else if(answer == "C"){
		ans = opt_c;
	}
	else if(answer == "D"){
		ans = opt_d;
	}
	var mark = $('#mark-'+str).val();
	var error = 0;
	if ( error == 0){
	$.post('update_question.php',
	{
		'q_id':q_id,
		'quest': quest,
		'opt_a': opt_a,
		'opt_b': opt_b,
		'opt_c': opt_c,
		'opt_d': opt_d,
		'ans': ans,
		'mark': mark
	},
	function(data){
		alert(data);
		location.reload();
	});
	}
}