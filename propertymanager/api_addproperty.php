<?php
header("Content-Type:application/json");

$conn= mysqli_connect('localhost', 'root', '', 'propertymanager') or die("Connection Failed:" .mysqli_connect_error());

        if(isset($_POST['RealtorID']) && isset($_POST['Address']) && isset($_POST['Price']) && isset($_POST['Style']) && isset($_POST['Status']) && isset($_POST['NumOfFloors']) && isset($_POST['NumOfBedrooms']) && isset($_POST['NumOfBathrooms']))
        {
            // Get all the inputs:
            $RealtorID= $_POST['RealtorID'];
            $Address= $_POST['Address'];
            $Price= $_POST['Price'];
            $Style= $_POST['Style'];
            $Status= $_POST['Status'];
            $NumOfFloors= $_POST['NumOfFloors'];
            $NumOfBedrooms= $_POST['NumOfBedrooms'];
            $NumOfBathrooms= $_POST['NumOfBathrooms'];

            $sql= "CALL property_add('$RealtorID', '$Address', '$Price', '$Style', '$Status', '$NumOfFloors', '$NumOfBedrooms', '$NumOfBathrooms')";
            $query = mysqli_query($conn,$sql);

            $row = array('RealtorID'=>$RealtorID,'Address'=>$Address,'Price'=>$Price,'Style'=>$Style,'Status'=>$Status,'NumOfFloors'=>$NumOfFloors,'NumOfBedrooms'=>$NumOfBedrooms,'NumOfBathrooms'=>$NumOfBathrooms);

            response(200,"Created a new property.",$row);

        }
        else
        {
            response(400,"Missing input! Failed to create property.", null);
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