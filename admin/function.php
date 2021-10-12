<?php
//Start subject_list
function user_level_list()
{
	include('connection.php');
	$sql = "select * from admin_user_level";
	$result = $conn->query($sql);

	$user_level_array = array();

	while ($row = mysqli_fetch_array($result)) {
		$user_level_id 	= $row['user_level_id'];
		$admin_user_level 	= $row['admin_user_level'];
		$user_level_array[$user_level_id] 	= $admin_user_level;
	}
	$conn->close();
	return $user_level_array;
}

//Start subject_list
function subject_list()
{
	include('connection.php');
	$sql = "select * from subject_information order by subject_name";
	$result = $conn->query($sql);

	$subject_array = array();

	while ($row = mysqli_fetch_array($result)) {
		$subject_id 	= $row['subject_id'];
		$subject_name 	= $row['subject_name'];
		$subject_array[$subject_id] 	= $subject_name;
	}
	$conn->close();
	return $subject_array;
}

//Start student_list
function student_list()
{
	include('connection.php');
	$sql = "SELECT * FROM userregistration 			
			ORDER BY firstName,middleName,lastName";
	$result = $conn->query($sql);

	$student_array = array();

	while ($row = mysqli_fetch_array($result)) {
		$student_id 	= $row['id'];
		$student_name 	= $row['firstName'] . " " . $row['middleName'] . " " . $row['lastName'];
		$student_array[$student_id] 	= $student_name;
	}
	$conn->close();
	return $student_array;
}

//Start student_list_for_seat_allotment
function student_list_for_seat_allotment()
{
	include('connection.php');
	$sql = "SELECT * FROM userregistration 
			WHERE id NOT IN (SELECT student_id FROM `seat_information` WHERE student_id IS NOT NULL) 
			ORDER BY firstName,middleName,lastName";
	$result = $conn->query($sql);

	$student_array = array();

	while ($row = mysqli_fetch_array($result)) {
		$student_id 	= $row['id'];
		$student_name 	= $row['firstName'] . " " . $row['middleName'] . " " . $row['lastName'];
		$student_array[$student_id] 	= $student_name;
	}
	$conn->close();
	return $student_array;
}

//Start university_list
function university_list()
{
	include('connection.php');
	$sql = "select * from university_information order by university_name";
	$result = $conn->query($sql);

	$university_array = array();

	while ($row = mysqli_fetch_array($result)) {
		$university_id 	= $row['id'];
		$university_name 	= $row['university_name'];
		$university_array[$university_id] 	= $university_name;
	}
	$conn->close();
	return $university_array;
}

//Start hall_list
function hall_list()
{
	include('connection.php');
	$sql = "select * from hall_information order by hall_name";
	$result = $conn->query($sql);

	$hall_array = array();

	while ($row = mysqli_fetch_array($result)) {
		$hall_id 	= $row['hall_id'];
		$hall_name 	= $row['hall_name'];
		$hall_array[$hall_id] 	= $hall_name;
	}
	$conn->close();
	return $hall_array;
}

//Start floor_list
function floor_list()
{
	include('connection.php');
	$sql = "SELECT * FROM floor_information 
			ORDER BY floor_name";
	$result = $conn->query($sql);

	$floor_array = array();

	while ($row = mysqli_fetch_array($result)) {
		$floor_id 					= $row['floor_id'];
		$floor_name 				= $row['floor_name'];
		$floor_array[$floor_id] 	= $floor_name;
	}
	$conn->close();
	return $floor_array;
}

//Start room_list
function room_list()
{
	include('connection.php');
	$sql = "SELECT * FROM room_information 
			ORDER BY room_no";
	$result = $conn->query($sql);

	$room_array = array();

	while ($row = mysqli_fetch_array($result)) {
		$room_id 				= $row['room_id'];
		$room_no 				= $row['room_no'];
		$room_array[$room_id] 	= $room_no;
	}
	$conn->close();
	return $room_array;
}

//Start seat_list
function seat_list()
{
	include('connection.php');
	$sql = "SELECT * FROM seat_information 
			ORDER BY seat_no";
	$result = $conn->query($sql);
	$seat_info = array();

	$total_seat_array = array();

	while ($row = mysqli_fetch_array($result)) {

		$seat_id 			  = $row['seat_id'];
		$room_id 			  = $row['room_id'];
		$hall_id 			  = $row['hall_id'];
		$seat_no 			  = $row['seat_no'];
		$seat_status 		  = $row['seat_status'];
		$total_seat_array[$seat_id] = $hall_id . " " . $room_id . " " . $seat_no . " status- " . $seat_status;
	}
	$seat_info['total_seat'] = $total_seat_array;

	$sql2 = "SELECT * FROM seat_information
			WHERE seat_status=1 
			ORDER BY seat_no";
	$result2 = $conn->query($sql2);
	$available_seat_array = array();

	while ($row2 = mysqli_fetch_array($result2)) {
		$seat_id 			  = $row2['seat_id'];
		$seat_status 		  = $row2['seat_status'];
		$available_seat_array[$seat_id] = $seat_status;
	}
	$seat_info['available_seat'] = $available_seat_array;

	$sql3 = "SELECT * FROM seat_information
			WHERE seat_status=3
			ORDER BY seat_no";
	// echo $sql3;
	// die;
	$result3 = $conn->query($sql3);
	$not_available_seat_array = array();

	while ($row3 = mysqli_fetch_array($result3)) {
		$seat_id 			  = $row3['seat_id'];
		$seat_status 		  = $row3['seat_status'];
		$not_available_seat_array[$seat_id] = $seat_status;
	}
	$seat_info['alloted_seat'] = $not_available_seat_array;

	$conn->close();
	return $seat_info;
}

//Start room_seat_list
function room_seat_list($student_id)
{
	include('connection.php');
	$sql = "SELECT 
				si.seat_id AS seat_id,
				si.hall_id AS hall_id,
				si.floor_id AS floor_id,
				si.room_id AS room_id,
				si.seat_no as seat_no,
				ssi.status as seat_status
			FROM seat_information si
			LEFT JOIN seat_status_information ssi 
			ON si.seat_status = ssi.status_id
			WHERE room_id IN (SELECT room_id FROM seat_information WHERE student_id = {$student_id})
			ORDER BY seat_no
			";

	// echo "<pre>";
	// print_r($sql);
	// die;
	$result = $conn->query($sql);

	$room_seat_info = array();

	while ($row = mysqli_fetch_array($result)) {
		$room_seat_info['seat'] = $row;
	}
	// echo "<pre>";
	// print_r($room_seat_info);
	// die;
	$conn->close();
	return $room_seat_info;
}
//end room_seat_list

//Start gender_list
function gender_list()
{
	$gender = ["M" => "Male", "F" => "Female", "Others" => "Others"];
	return $gender;
}
//End gender_list

//Start seat_status_list
function seat_status_list()
{
	include('connection.php');
	$sql = "SELECT * FROM seat_status_information ";
	$result = $conn->query($sql);
	$seat_status_info = array();

	while ($row = mysqli_fetch_array($result)) {
		// $seat_array['seat'] = $row;
		$status_id 	= $row['status_id'];
		$status 	= $row['status'];
		$seat_status_info[$status_id] = $status;
	}
	$seat_info['total_seat'] = $seat_status_info;
	return $seat_status_info;
}
//End seat_status_list
