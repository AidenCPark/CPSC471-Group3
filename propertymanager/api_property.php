<?php
header("Content-Type:application/json");

$conn= mysqli_connect('localhost', 'root', '', 'propertymanager') or die("Connection Failed:" .mysqli_connect_error());

$sql= "CALL property()";
$query = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($query)) {
    $result[] = array(
        'PropertyID'    => $row['PropertyID'],
        'RealtorID'   => $row['RealtorID'],
        'Address'     => $row['Address'],
        'Price'     => $row['Price'],
        'Style'   => $row['Style'],
        'Status' => $row['Status'],
        'NumOfFloors' => $row['NumOfFloors'],
        'NumOfBedrooms' => $row['NumOfBedrooms'],
        'NumOfBathrooms' => $row['NumOfBathrooms'],
    );
}


response(200,"Outputting all properties.",$result);



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