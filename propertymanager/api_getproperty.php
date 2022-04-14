<?php
header("Content-Type:application/json");

$conn= mysqli_connect('localhost', 'root', '', 'propertymanager') or die("Connection Failed:" .mysqli_connect_error());

if(!empty($_GET['id']))
{
	$id=$_GET['id'];
	$sql= "CALL property_get('$id')";
    $query = mysqli_query($conn,$sql);
	
	$row = mysqli_fetch_assoc($query);

    if($row == null)
    {
        response(200,"No property exists with that ID.", $row);
    }
    else
    {
        response(200,"Outputting property info.", $row);
    }

    
	
}
else
{
	response(400,"Invalid Request",NULL);
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