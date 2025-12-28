<?php

// Create connection to Oracle
$conn = oci_connect('c##aman', 'root', "//localhost:1521/XE"); 

if (!$conn) {
  
$m = oci_error();
  
echo $m['message'], "\n";
 
exit;

}
else {
  
print "Connection to Oracle successful\n";

}

// Close the Oracle connection

oci_close($conn);
?>
