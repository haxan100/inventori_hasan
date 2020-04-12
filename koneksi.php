<?php 
$host='localhost'; 
$user='root'; 
$pass=''; 
$database='db_inventor'; 
$konek=mysqli_connect($host, $user, $pass); 
mysqli_select_db($konek,$database); 
if ($konek)
{ //echo "success"; 
} 
else 
{ echo "failure"; } 
?> 

