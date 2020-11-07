<html>
 <head>
  <title>PHP-Test</title>
 </head>
 <body>
<?php

//Make sure that it is a POST request.
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0){
    throw new Exception('Request method must be POST!');
}
 
//Make sure that the content type of the POST request has been set to application/json
$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
if(strcasecmp($contentType, 'application/json') != 0){
    throw new Exception('Content type must be: application/json');
}

// Read the input stream
$json = file_get_contents('php://input');
$obj = json_decode($json);
$hardware_serial = $obj->hardware_serial; 
$wifi = $obj->payload_fields->wifi; 
$ble = $obj->payload_fields->ble;


  $conn = mysqli_connect("mysql-service","root","Philipp1","testdb");
  
  if ($conn->connect_error) {
    die("ERROR: Unable to connect: " . $conn->connect_error);
  } 

  echo 'Connected to the database.<br>';

 $stmt = $conn->prepare("INSERT INTO readings (dev_id, count_wifi, count_ble) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $hardware_serial, $wifi, $ble);
  $stmt->execute();
  
  $stmt->close();
  $conn->close();
?>
 </body>
</html>
