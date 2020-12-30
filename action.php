<?php
// Include the database connection file
include('db_config.php');

if (isset($_POST['countryId']) && !empty($_POST['countryId'])) {

	// Fetch state name base on country id
	$query = "SELECT * FROM states WHERE country_id = ".$_POST['countryId'];
	$result = $con->query($query);

	if ($result->num_rows > 0) {
		echo '<option value="">Select State</option>'; 
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row['id'].'">'.$row['state_name'].'</option>'; 
		}
	} else {
		echo '<option value="">State not available</option>'; 
	}
} elseif(isset($_POST['stateId']) && !empty($_POST['stateId'])) {

	// Fetch city name base on state id
	$query = "SELECT * FROM cities WHERE state_id = ".$_POST['stateId'];
	$result = $con->query($query);

	if ($result->num_rows > 0) {
		echo '<option value="">Select city</option>'; 
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row['id'].'">'.$row['city_name'].'</option>'; 
		}
	} else {
		echo '<option value="">City not available</option>'; 
	}
}
?>