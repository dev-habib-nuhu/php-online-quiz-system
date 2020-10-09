<?php
Class Student{
	public $error;
	public $upload_succes;
	public $no_of_courses;
	private $db;
	function __construct($db_con){
		$this->db = $db_con; 
	}
	//Redirect user 
	public function redirect($url){
		header("Location: $url");
	}
	//user logged in
	public function is_logged_in(){
		if(isset($_SESSION['ocbt_uid'])){
			return true;
		}
	}
	public function logout(){
		unset($_SESSION['ocbt_uid']);
		unset($_SESSION['ocbt_first_name']);
		unset($_SESSION['ocbt_last_name']);
		unset($_SESSION['ocbt_username']);
		unset($_SESSION['ocbt_dept']);
		unset($_SESSION['ocbt_level']);
		if(isset($_SESSION['ocbt_course_code'])){
			unset($_SESSION['ocbt_course_code']);
		}
		if(isset($_SESSION['ocbt_quest_no'])){
			unset($_SESSION['ocbt_quest_no']);
		}
	}
	//registration function
	public function std_register($fname,$lname,$username,$password,$dept,$level){
		try{
		$stmt = $this->db->prepare("INSERT INTO std_details (fname,lname,username,password,profile_pix,department,level)
		VALUES(:fname,:lname,:uname,:pass,:prof_pix,:dept,:level)");
		$hash_pass = password_hash($password,PASSWORD_DEFAULT);
		$prof_pix = "profile.jpg";
		$stmt->bindParam(':fname',$fname);
		$stmt->bindParam(':lname',$lname);
		$stmt->bindParam(':uname',$username);
		$stmt->bindParam(':pass',$hash_pass);
		$stmt->bindParam(':prof_pix',$prof_pix);
		$stmt->bindParam(':dept',$dept);
		$stmt->bindParam(':level',$level);
		$stmt->execute();
		return true;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	//Log user into the account
	public function login($username,$password){
		try{
			$stmt= $this->db->prepare("SELECT * FROM std_details WHERE username = :uname");
			$stmt->bindParam(':uname',$username);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount()>0){
				if(password_verify($password,$row['password'])){
					$_SESSION['ocbt_uid'] = $row['std_id'];
					$_SESSION['ocbt_username'] = $username;
					$_SESSION['ocbt_first_name'] = $row['fname'];
					$_SESSION['ocbt_last_name'] = $row['lname'];
					$_SESSION['ocbt_dept'] = $row['department'];
					$_SESSION['ocbt_level'] = $row['level'];
					
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
	public function image_upload_url($name,$dir){
	$imgfile = $_FILES[$name]['name'];
	$tmp_dir = $_FILES[$name]['tmp_name'];
	$imgsize = $_FILES[$name]['size'];
	$upload_dir = $dir;
	$imgext = strtolower(pathinfo($imgfile,PATHINFO_EXTENSION));
	$valid_extensions = array("jpg","jpeg","gif","png");
	$product_image = rand(1000,1000000) . "." . $imgext;
	if(in_array(($imgext), $valid_extensions)){
		if($imgsize < 5000000){
			move_uploaded_file($tmp_dir,$upload_dir.$product_image);
			//$this->upload_succes = "Image Uploaded Succesfully!";
			return $product_image;
		}
		else{
			$this->error = "<p class='alert alert-danger'> Sorry the image is too large</p>";
		}
	}
	else {
		$this->error = "<p class='alert alert-danger'> Only images are allowed</p>";
	}
	}
	//Upload students picture
	public function upload_std_pix($user_id,$imglink){
		try{
			$stmt = $this->db->prepare("UPDATE std_details SET profile_pix = :img_link WHERE std_id = :uid");
			$stmt->bindParam(':img_link',$imglink);
			$stmt->bindParam(':uid',$user_id);
			$stmt->execute();
			if($stmt->rowCount()>0){
				return true;
			}
			else{
				return false;
			}
			
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	//Get user profile pix
	public function get_profile_pix($user_id){
	$stmt = $this->db->prepare("SELECT * FROM std_details WHERE std_id = :user_id");
	$stmt->bindParam(':user_id',$user_id);
	$stmt->execute();
	if($stmt->rowCount() == 1){
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			return $row['profile_pix'];
		}
	}
	else{
			return false;
	}
	}
	//Get Active courses From Database
	public function get_active_courses(){
		$stmt = $this->db->prepare("SELECT * FROM std_courses WHERE status = 1");
		$stmt->execute();
		if($stmt->rowCount()> 0){
			echo "<form method='post'>";
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				echo "<div class='form-group'>";
				echo "<input type=\"radio\" 
				name=\"course\" value =" . $row['course_code'] . ">"
				. "  " . $row['course_code'] . "<br/>";
				echo "</div>";
			}
			echo "<button class='btn btn-success' name='choose_quiz'>Take Quiz</button>";
			echo "</form>";
		}
		
	}
	public function check_result($username){
		try{
		$stmt = $this->db->prepare("SELECT * FROM std_results WHERE username = :uname");
		$stmt->execute(array(':uname'=>$username));
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
	//load question to array
	public function get_questions($course_code,$q_id){
			try{
		$stmt = $this->db->prepare("SELECT * FROM all_questions WHERE q_id = :q_id AND course_code = :c_code");
		$stmt->execute(array(':c_code'=>$course_code,':q_id'=>$q_id));
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
	//get course title
	public function get_course_title($course_code){
		try{
		$stmt = $this->db->prepare("SELECT course_title FROM std_courses WHERE course_code = :c_code");
		$stmt->execute(array(':c_code'=>$course_code));
		if($stmt->rowCount()>0){
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$c_title = $row['course_title'];
			}
			return $c_title;
		}
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}	
	}
	//get time for test
	public function get_course_time($course_code){
		try{
		$stmt = $this->db->prepare("SELECT time FROM std_courses WHERE course_code = :c_code");
		$stmt->execute(array(':c_code'=>$course_code));
		if($stmt->rowCount()>0){
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$c_time = $row['time'];
			}
			return $c_time;
		}
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}	
	}
	//Number of questions to be answered
	public function get_no_quest_to_ans($course_code){
		try{
		$stmt = $this->db->prepare("SELECT no_quest_ans FROM std_courses WHERE course_code = :c_code");
		$stmt->execute(array(':c_code'=>$course_code));
		if($stmt->rowCount()>0){
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$no_quest_to_b_ans = $row['no_quest_ans'];
			}
			return $no_quest_to_b_ans;
		}
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}	
	}
	//Get question number for student to answer
	public function get_my_question_number($course_code,$no_quest_to_ans){
		try{
			$stmt = $this->db->prepare("SELECT q_id,mark from all_questions WHERE course_code = :c_code  ORDER by rand() LIMIT " . $no_quest_to_ans . " ");
		$stmt->execute(array(':c_code'=>$course_code));
		if($stmt->rowCount()>0){
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$quest_nos[] = $row;
			}
			return $quest_nos;
		}
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}	
		}
	public function record_student_score($course_code,$user_name,$score){
		try{
			$stmt = $this->db->prepare("INSERT INTO std_results(username,course_code,score) VALUES(:u_name,:c_code,:score)");
		$stmt->execute(array(':c_code'=>$course_code,':u_name'=>$user_name,':score'=>$score));
		if($stmt->rowCount()>0){
			return true;
		}
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
	}
}
?>