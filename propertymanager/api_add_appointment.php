<?php
header("Content-Type:application/json");

$conn= mysqli_connect('localhost', 'root', '', 'propertymanager') or die("Connection Failed:" .mysqli_connect_error());

        if(isset($_POST['ClientID']) && isset($_POST['RealtorID']) && isset($_POST['Date']))
        {
            // Get all the inputs:
            $ClientID= $_POST['ClientID'];
            $RealtorID= $_POST['RealtorID'];
            $Date= $_POST['Date'];

            $sql= "CALL appointment_add('$ClientID', '$RealtorID', '$Date')";
            $query = mysqli_query($conn,$sql);

            $row = array('ClientID'=>$ClientID,'RealtorID'=>$RealtorID,'Date'=>$Date);

            response(200,"Created a new appointment.",$row);

        }
        else
        {
            response(400,"Missing input! Failed to create appointment.", null);
        }



function response($status,$status_message,$data)
{
	header("HTTP/1.1 ".$status);
	
	$response['status']=$status;
	$response['status_message']=$status_message;
	$response['data']=$data;
	
	$json_response = json_encode($response);
	echo $json_response;
}

?>