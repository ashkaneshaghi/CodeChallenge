<?PHP
// Version Check CLass
include("version_comparison.php");


// Connection to database
include("conf.php");


// check the file format
if($_FILES["file"]["type"] != "application/json") {
	
	header('location: index.php?status=1');
	exit();
	
} else {
	
	// check if the JSON file exist or not
	if (file_exists($_FILES["file"]["name"])) {
		
		header('location: index.php?status=2');
		exit();
		
	} else {
		// move the JSON file to the folder
		move_uploaded_file($_FILES["file"]["tmp_name"], $_FILES["file"]["name"]);
		
		// readin JSON file
		$json_data_file = file_get_contents($_FILES["file"]["name"]);
		
		// Convert the JSON file from string to PHP array
		$json_data_array = json_decode($json_data_file, true);


		// Storing the data in Database
		foreach ($json_data_array as $item) {
			
			
			// Variables
			$version_comparison = new VersionComparison();
			$event_date = new DateTime($item["event_date"]);
			$timezone = new DateTimeZone('UTC');

			// Changing the time after checking the version
			if (!$version_comparison->compareVersion($item["version"], $item["event_date"])) {
				$event_date->setTimezone($timezone);
			}

			
			// Check if the employee already exists in database. if no then store it
			$find_employee_sql ='select employee_id from employee where employee_name="'.$item["employee_name"].'" and employee_mail="'.$item["employee_mail"].'"';
			$find_employee_result = $conn->query($find_employee_sql);
			if ($find_employee_result->num_rows == 0) {
				$add_employee_sql = 'insert into employee values(NULL, "'.$item["employee_name"].'", "'.$item["employee_mail"].'")';
				$add_employee_result = $conn->query($add_employee_sql);
			}
			
			// Check if the event already exists in database. if no then store it
			
			$find_event_sql ='select event_id from events where event_id="'.$item["event_id"].'"';
			$find_event_result = $conn->query($find_event_sql);
			if ($find_event_result->num_rows == 0) {
				$add_event_sql = 'insert into events values("'.$item["event_id"].'", "'.$item["event_name"].'", "'.$event_date->format('Y-m-d H:i:s').'")';
				$add_event_result = $conn->query($add_event_sql);
			}
			
			
			// Storing the participation data in the database
			// also check if the participation data has already stored.
			
			$find_employee_sql ='select employee_id from employee where employee_name="'.$item["employee_name"].'" and employee_mail="'.$item["employee_mail"].'"';
			$find_employee_result = $conn->query($find_employee_sql);
			$employee_row = $find_employee_result->fetch_assoc();
			$employee_id = $employee_row['employee_id'];

			$find_participation_sql ='select participation_id from participation where participation_id="'.$item["participation_id"].'"';
			$find_participation_result = $conn->query($find_participation_sql);
			if ($find_participation_result->num_rows == 0) {
				$add_participation_sql = 'insert into participation values("'.$item["participation_id"].'", "'.$employee_id.'", "'.$item["event_id"].'", "'.$item["participation_fee"].'", "'.$item["version"].'")';
				$add_participation_result = $conn->query($add_participation_sql);
			}


			
		}
		header('location: index.php?status=3');
		exit();

	}
}
?>