<?php
class mysql{
	function __construct(){
		$db = $this->anne_bentley_db();
		$this->db = $db;
	}
	function anne_bentley_db(){
		$server = "xxxxxxxxx";
		$dbname = "xxxxxxxxx";
		$username = "xxxxxxxxx";
		$password = "xxxxxxxxx";

		$connect = "mysql:host = $server; dbname=$dbname";

		try{
			$db = new PDO($connect, $username, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $pe){
			die("could not connect to the database $dbname :\n" . $pe->getMessage());
		}
		return $db;
	}

	function getTitleInfo($id){
		$db = $this->db;
		try{
			$query=$db->prepare("SELECT images.points, Category.name FROM images JOIN Category ON images.category_id=Category.id WHERE images.id = :id");
			$data = array(":id" => $id);

			$query->execute($data);
			//execute everything and do a fetchall
			$rows = $query->fetchAll(PDO::FETCH_ASSOC);
		}
		catch(PDOException $pe){
			die("could not get title info\n" . $pe->getMessage());
		}
		return $rows;
	}
	function getNanoImage($id){
		$db = $this->db;
		try{
			$image = $db->prepare("SELECT filename FROM images WHERE id = :id");
			$data = array(":id" => $id);

			$image->execute($data);
			$rows = $image->fetchAll(PDO::FETCH_ASSOC);
		}
		catch(PDOException $pe){
			die("could not get image\n" . $pe->getMessage());
		}
		return $rows;
	}
	function getHint($id){
		$db = $this->db;
		try{
			$hint = $db->prepare("SELECT clue FROM images WHERE id = :id");
			$data = array(":id" => $id);

			$hint->execute($data);
			$rows = $hint->fetchAll(PDO::FETCH_ASSOC);
		}
		catch(PDOException $pe){
			die("could not get hint\n" . $pe->getMessage());
		}
		return $rows;
	}
	function getAnswer($id){
		$db = $this->db;
		try{
			$answer = $db->prepare("SELECT answer FROM images WHERE id = :id");
			$data = array(":id" => $id);

			$answer->execute($data);
			$rows = $answer->fetchAll(PDO::FETCH_ASSOC);
		}
		catch(PDOException $pe){
			die("could not get answer\n" . $pe->getMessage());
		}
		return $rows;
	}
	function getCategories(){
		$db = $this->db;
		try{
			$query = $db->prepare("SELECT * FROM Category ORDER By id");
			$query->execute();

			$rows = $query->fetchAll(PDO::FETCH_ASSOC);
		}
		catch(PDOException $pe){
			die("could not get categories\n" . $pe->getMessage());
		}
		return $rows;
	}
	function getButtonInfo($categoryId){
		$db = $this->db;
		try{
			$query = $db->prepare("SELECT images.id as imageId, Category.id FROM images JOIN Category ON images.category_id=Category.id WHERE Category.id=:categoryId");
			$data = array(":categoryId" => $categoryId);

			$query->execute($data);
			$rows = $query->fetchAll(PDO::FETCH_ASSOC);
		}
		catch(PDOException $pe){
			die("could not get button info\n" . $pe->getMessage());
		}
		return $rows;
	}
	function getOverlayImage($id){
		$db = $this->db;
		try{
			$query = $db->prepare("SELECT overlay_img FROM images WHERE id=:id");
			$data = array(":id" => $id);
			$query->execute($data);
			$rows = $query->fetchAll(PDO::FETCH_ASSOC);
		}
		catch(PDOException $pe){
			die("could not get overlay image\n" . $pe->getMessage());
		}
		return $rows;
	}
	function getStudentInfo($id){
		$db = $this->db;
		try{
			$query = $db->prepare("SELECT student_name, student_grad_year FROM images WHERE id=:id");
			$data = array(":id" => $id);
			$query->execute($data);
			$rows = $query->fetchAll(PDO::FETCH_ASSOC);
		}
		catch(PDOException $pe){
			die("could not get student info\n" . $pe->getMessage());
		}
		return $rows;
	}

	function getSummary($id){
		$db = $this->db;
		try{
			$query = $db->prepare("SELECT summary FROM images WHERE id=:id");
			$data = array(":id" => $id);
			$query->execute($data);
			$rows = $query->fetchAll(PDO::FETCH_ASSOC);
		}
		catch(PDOException $pe){
			die("could not get summary\n" . $pe->getMessage());
		}
		return $rows;
	}
}
?>