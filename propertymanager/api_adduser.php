<?php
header("Content-Type:application/json");

$conn= mysqli_connect('localhost', 'root', '', 'propertymanager') or die("Connection Failed:" .mysqli_connect_error());

        if(isset($_POST['Name']) && isset($_POST['Email']) && isset($_POST['Phone']) && isset($_POST['Username']) && isset($_POST['Password']) && isset($_POST['Type']))
        {
            // Get all the inputs:
            $Name= $_POST['Name'];
            $Email= $_POST['Email'];
            $Phone= $_POST['Phone'];
            $Username= $_POST['Username'];
            $Password= $_POST['Password'];
            $Type= $_POST['Type'];

            $sql= "CALL user_add('$Name', '$Email', '$Phone', '$Username', '$Password', '$Type')";
            $query = mysqli_query($conn,$sql);

            $row = array('Name'=>$Name,'Email'=>$Email,'Phone'=>$Phone,'Username'=>$Username,'Password'=>$Password,'Type'=>$Type);

            response(200,"Created a new user.",$row);

        }
        else
        {
            response(400,"Missing input! Failed to create user.", null);
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