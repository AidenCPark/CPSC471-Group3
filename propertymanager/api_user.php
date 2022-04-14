<?php
header("Content-Type:application/json");

$conn= mysqli_connect('localhost', 'root', '', 'propertymanager') or die("Connection Failed:" .mysqli_connect_error());

$sql= "CALL user()";
$query = mysqli_query($conn,$sql);
$counter = 0;

while($row = mysqli_fetch_assoc($query)) {
    $result[] = array(
        'UserID'    => $row['UserID'],
        'Name'   => $row['Name'],
        'Email'     => $row['Email'],
        'Phone'     => $row['Phone'],
        'Username'   => $row['Username'],
        'Type' => $row['Type'],
    );
}


response(200,"Outputting all users.",$result);



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