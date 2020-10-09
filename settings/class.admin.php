<?php
Class admin extends Student{
	private $db;

	function __construct($db_con){
		$this->db = $db_con;
	}
		public function is_admin_logged_in(){
		if(isset($_SESSION['ocbt_admin_id'])){
			return true;
		}
	}

	//Log user into the account
	public function admin_login($username,$password){
		try{
			$stmt= $this->db->prepare("SELECT * FROM ocbt_admin_tbl WHERE user_name = :uname");
			$stmt->bindParam(':uname',$username);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount()>0){
				if(password_verify($password,$row['password'])){
					$_SESSION['ocbt_admin_id'] = $row['user_id'];
					$_SESSION['ocbt_admin_username'] = $username;
					$_SESSION['ocbt_admin_email'] = $row['email'];
					
					return true;
				}
			}
			else{
				return false;
			}
			
		}
		catch(PDOException $e){
			echo $e->getMessage();
			
		}
	}
	//Update last login
	public function update_last_login($user){
			$stmt= $this->db->prepare("UPDATE ocbt_admin_tbl SET last_login = CURDATE() WHERE user_name = :uname");
			$stmt->bindParam(':uname',$user);
			$stmt->execute();
			if($stmt->rowCount() > 0){
				return true;
			}
	}
		public function admin_logout(){
		unset($_SESSION['ocbt_admin_id']);
		unset($_SESSION['ocbt_admin_username']);
		unset($_SESSION['ocbt_admin_email']);
	}
	//Get all courses from database
		public function get_active_courses(){
		$stmt = $this->db->prepare("SELECT * FROM std_courses");
		$stmt->execute();
		if($stmt->rowCount()> 0){
			echo "<form method='post'>";
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				echo "<div class='form-group'>";
				echo "<input type=\"radio\" 
				name=\"course\" value =" . $row['course_code'] . " required>"
				. "  " . $row['course_code'] . "<br/>";
				echo "</div>";
			}
			echo "<button class='btn btn-success' name='sel_course'>
			Proceed to Manage questions</button></form>";
		}
		
	}
	//get all questions
		public function get_all_questions($course_code){
		try{
			$stmt = $this->db->prepare("SELECT * FROM all_questions WHERE course_code = :c_code");
		$stmt->execute(array(':c_code'=>$course_code));
		if($stmt->rowCount()>0){
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$questions[] = $row;
			}
			return $questions;
		}
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}	
		}
		//get all students
		public function get_all_students(){
		try{
			$stmt = $this->db->prepare("SELECT * FROM std_details");
		$stmt->execute();
		if($stmt->rowCount()>0){
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$students[] = $row;
			}
			return $students;
		}
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}	
		}
		//Get all student result
		public function get_all_student_result(){
		try{
			$stmt = $this->db->prepare("SELECT * FROM std_results");
		$stmt->execute();
		if($stmt->rowCount()>0){
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$results[] = $row;
			}
			return $results;
		}
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}	
		}
		
		//get all courses 
		public function get_all_courses(){
		try{
			$stmt = $this->db->prepare("SELECT * FROM std_courses");
		$stmt->execute();
		if($stmt->rowCount()>0){
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$courses[] = $row;
			}
			return $courses;
		}
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}	
		}
		//Add new Course
		public function add_new_course($c_cde,$c_title,$c_unit){
			try{
				$stmt = $this->db->prepare("INSERT INTO std_courses(course_code,course_title,unit) VALUES(:c_cde,:c_title,:c_unit)");
				$stmt->execute(array(':c_cde'=>$c_cde,':c_title'=>$c_title,':c_unit'=>$c_unit));
				if($stmt->rowCount()> 0){
					return true;
				}
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		//Add new question to database
		public function add_new_question($quest,$opt_a,$opt_b,$opt_c,$opt_d,$ans,$mark,$c_cde){
			try{
				$stmt = $this->db->prepare("INSERT INTO all_questions(question,opt_a,opt_b,opt_c,opt_d,ans,mark,course_code)
				VALUES(:quest,:opt_a,:opt_b,:opt_c,:opt_d,:ans,:mark,:c_cde)");
				$stmt->execute(array(':quest'=>$quest,':opt_a'=>$opt_a,':opt_b'=>$opt_b,':opt_c'=>$opt_c,':opt_d'=>$opt_d,
				':ans'=>$ans,':mark'=>$mark,':c_cde'=>$c_cde));
				if($stmt->rowCount()> 0){
					return true;
				}
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		//Update exam settings
		public function update_exam_settings($c_cde,$time,$no_quest_ans,$status){
			try{
				$stmt = $this->db->prepare("UPDATE std_courses SET time = :time, no_quest_ans =:no_quest_ans, status =:status WHERE course_code = :c_cde");
				$stmt->execute(array(':time'=>$time,':c_cde'=>$c_cde,':no_quest_ans'=>$no_quest_ans,':status'=>$status));
				if($stmt->rowCount()> 0){
					return true;
				}
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		//Update course 
		public function update_course($c_id,$c_cde,$c_title,$unit){
			try{
				$stmt = $this->db->prepare("UPDATE std_courses SET course_code = :c_cde, course_title =:c_title,unit =:unit WHERE course_id = :c_id");
				$stmt->execute(array(':unit'=>$unit,':c_cde'=>$c_cde,':c_id'=>$c_id,':c_title'=>$c_title));
				if($stmt->rowCount()> 0){
					return true;
				}
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		//Update question
		public function update_question($q_id,$quest,$opt_a,$opt_b,$opt_c,$opt_d,$ans,$mark){
			try{
				$stmt = $this->db->prepare("UPDATE all_questions SET question = :quest,opt_a = :opt_a,opt_b = :opt_b,opt_c = :opt_c,
				opt_d = :opt_d,ans = :ans,mark =:mark WHERE q_id = :q_id");
				$stmt->execute(array(':q_id'=>$q_id,':quest'=>$quest,':opt_a'=>$opt_a,':opt_b'=>$opt_b,
				':opt_c'=>$opt_c,':opt_d'=>$opt_d,':ans'=>$ans,':mark'=>$mark));
				if($stmt->rowCount()> 0){
					return true;
				}
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		//Update student details
		public function update_student_details($fname,$lname,$uname,$dept,$level,$std_id){
			try{
				$stmt = $this->db->prepare("UPDATE std_details SET fname = :fname, lname =:lname,username =:uname,department = :dept,level =:level WHERE std_id = :std_id");
				$stmt->execute(array(':fname'=>$fname,':lname'=>$lname,':uname'=>$uname,':dept'=>$dept,':level'=>$level,':std_id'=>$std_id));
				if($stmt->rowCount()> 0){
					return true;
				}
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		//Check total number of questions for course in database
		public function total_no_questions($c_cde){
			try{
				$stmt = $this->db->prepare("SELECT * FROM all_questions WHERE course_code = :c_cde");
				$stmt->execute(array(':c_cde'=>$c_cde));
				if($stmt->rowCount()> 0){
					return $stmt->rowCount();
				}
				else{
					$no_of_quest = "0";
					return $no_of_quest;
				}
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		//total no of courses
		public function total_no_courses(){
			try{
				$stmt = $this->db->prepare("SELECT * FROM std_courses");
				$stmt->execute();
				if($stmt->rowCount()> 0){
					return $stmt->rowCount();
				}
				else{
					$no_of_course = "0";
					return $no_of_course;
				}
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		//delete course
		public function delete_course($c_cde){
			try{
				$stmt = $this->db->prepare("DELETE FROM std_courses WHERE course_code = :c_cde");
				$stmt->execute(array(':c_cde'=>$c_cde));
				if($stmt->rowCount()> 0){
					return true;
				}
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		//delete student record
		public function delete_student($std_id){
			try{
				$stmt = $this->db->prepare("DELETE FROM std_details WHERE std_id = :std_id");
				$stmt->execute(array(':std_id'=>$std_id));
				if($stmt->rowCount()> 0){
					return true;
				}
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		//Delete question
		public function delete_question($q_id){
			try{
				$stmt = $this->db->prepare("DELETE FROM all_questions WHERE q_id = :q_id");
				$stmt->execute(array(':q_id'=>$q_id));
				if($stmt->rowCount()> 0){
					return true;
				}
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		//Search results
		public function search_record($table_name,$column_name,$search){
		try{
			$stmt = $this->db->prepare("SELECT * FROM " . $table_name . " WHERE " . $column_name . "=:search");
		$stmt->execute(array(':search'=>$search));
		if($stmt->rowCount()>0){
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$results[] = $row;
			}
			return $results;
		}
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}	
		}
}

?>