<?php 
$servername="localhost";
$username="root";
$password="";
$database="myforum";
$conn=mysqli_connect($servername,$username,$password,$database);


if(!$conn){
die("connect is not established".mysqli_connect_error());
}

$sql = "SELECT cid, cname,c_description FROM categories";
$result = $conn->query($sql);

$categories = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
} else {
echo "0 results";
}




?>