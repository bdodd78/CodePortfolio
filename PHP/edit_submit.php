<?php
$servername = "localhost";
$username=username;
$password=password;
$dbname=database;

//Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);
//check connection
if ($conn->connect_error) {
	die("Connection Failed: " . $conn->connect_error);
}
$title= str_replace("'","''",$_POST["title"]) ;
$author_first= str_replace("'","''",$_POST["author_first"]) ;
$author_last= str_replace("'","''",$_POST["author_last"]) ;
$subtitle= str_replace("'","''",$_POST["subtitle"]) ;
$series= str_replace("'","''",$_POST["series"]) ;
$volume = $_POST["volume"] ;
$coauthor= str_replace("'","''",$_POST["coauthor"]) ;
$compilation= str_replace("'","''",$_POST["compilation"]) ;
$rating= $_POST["rating"] ;
$format= $_POST["format"] ;
$unread= $_POST["unread"] ;
$status= $_POST["status"] ;
$idVal = $_REQUEST["id_val"];

$sql = "UPDATE JD_Books SET Book_Title ='$title', Author_First='$author_first', Author_Last='$author_last',subtitle='$subtitle',
	Series='$series', Co_Author ='$coauthor', Compilation='$compilation', Rating='$rating', Series_Volume='$volume', Format='$format',
	Unread='$unread', Status='$status' WHERE ID= '$idVal'";
echo $sql;

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
	 header("Location: http://memphis/www/PHP/default.php");
 
	 /* Make sure that code below does not get executed when we redirect. */
	 exit;
} else {
    echo "Error updating record: " . $conn->error;
}

$conn -> close();
?>