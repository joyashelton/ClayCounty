<?php
//connect using servername, account username, account password, and database
$db = new mysqli("localhost", "web", "Rm6D?PKBy&K3QhJ!", "CCLR");
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

//Checks to make sure that the name field is filled, then changes the sql statement
if (!empty($_GET['name'])){
  $sql = "SELECT * FROM `cclr2` WHERE LastNameGrantor_1 = ? OR LastNameGrantor_2 = ?  OR LastNameGrantor_3 = ? OR LastNameGrantee_1 = ? OR LastNameGrantee_2 = ?";
} else {
  echo "The name field is required.";
  $db->close();
  exit();
}

//prepare & execute
$stmt = $db->prepare($sql);
$LastName = $_GET['name'];
$stmt->bind_param("sssss", $LastName,$LastName,$LastName,$LastName,$LastName);
$stmt->execute();
//Display the results in an html table
$result = $stmt->get_result();
if ($result->num_rows > 0) {
  echo "<table><tr><th>Date</th><th>Name</th><th>Section, Township, Range</th></tr>";
  //echo "<table><tr><th>Date</th><th>Type</th><th>BK</th><th>Page</th><th>LastNameGrantor1</th><th>FirstNameGrantor1</th><th>LastNameGrantor2</th><th>FirstNameGrantor2</th><th>LastNameGrantor3</th><th>FirstNameGrantor3</th><th>LastNameGrantee1</th><th>FirstNameGrantee1</th><th>LastNameGrantee2</th><th>FirstNameGrantee2</th><th>QTR</th><th>SEC</th><th>TSP</th><th>RGE</th><th>INFO</th><th>LOT</th><th>BLK</th><th>Addition</th><th>City</th>
  
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["DATE"]."</td><td>".$row["LastNameGrantee_1"]."</td><td>".$row["SEC"]." ".$row["TSP"]." ".$row["RGE"]."</td></tr>";
  }
  echo "</table>";
} else {
  echo "Double check spelling and try again.";
}

/* Do some operation here, like talk to the database, the file-session
 * The world beyond, limbo, the city of shimmers, and Canada.
 *
 * AJAX generally uses strings, but you can output JSON, HTML and XML as well.
 * It all depends on the Content-type header that you send with your AJAX
 * request. */

echo json_encode($result); // In the end, you need to echo the result.
                      // All data should be json_encode()d.

                      // You can json_encode() any value in PHP, arrays, strings,
                      //even objects.
$db->close();
?>