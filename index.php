<?php
// Include the database connection file
include('db_config.php');
?>

<html>
<head>
	<title>Dynamic Dependent Select Box using jQuery, Ajax and PHP - Clue Mediator</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
	<div class="container">
		<h3>Dynamic Dependent Select Box - <a href="https://www.cluemediator.com" target="_blank">Clue Mediator</a></h3>
    <br />
		<form action="" method="post">
			<div class="col-md-4">

				<!-- Country dropdown -->
				<label for="country">Country</label>
				<select class="form-control" id="country">
					<option value="">Select Country</option>
					<?php 
					$query = "SELECT * FROM countries";
					$result = $con->query($query);
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							echo '<option value="'.$row['id'].'">'.$row['country_name'].'</option>';
						}
					}else{
						echo '<option value="">Country not available</option>'; 
					}
					?>
				</select>
        <br />

				<!-- State dropdown -->
				<label for="country">State</label>
				<select class="form-control" id="state">
					<option value="">Select State</option>
				</select>
        <br />

				<!-- City dropdown -->
				<label for="country">City</label>
				<select class="form-control" id="city">
					<option value="">Select City</option>
				</select>

			</div>
		</form>
	</div>

  <script type="text/javascript">
    $(document).ready(function(){
      // Country dependent ajax
      $("#country").on("change",function(){
        var countryId = $(this).val();
        $.ajax({
          url :"action.php",
          type:"POST",
          cache:false,
          data:{countryId:countryId},
          success:function(data){
            $("#state").html(data);
            $('#city').html('<option value="">Select city</option>');
          }
        });			
      });

      // state dependent ajax
      $("#state").on("change", function(){
        var stateId = $(this).val();
        $.ajax({
          url :"action.php",
          type:"POST",
          cache:false,
          data:{stateId:stateId},
          success:function(data){
            $("#city").html(data);
          }
        });
      });
    });
  </script>

</body>
</html>
