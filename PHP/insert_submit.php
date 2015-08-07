<?php
$servername = "localhost";
$username=username;
$password=password;
$dbname=database;

echo "here";
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

$sql = "INSERT INTO JD_Books (Book_Title, Author_First, Author_Last, Subtitle, Series, Co_Author, Compilation, Rating, Series_Volume, Format, Unread,Status)
	values ('$title','$author_first','$author_last','$subtitle','$series','$coauthor','$compilation','$rating','$volume','$format','$unread','$status')";
echo $sql;

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
	 header("Location: http://memphis/www/PHP/default.php");
 
	 /* Make sure that code below does not get executed when we redirect. */
	 exit;
} else {
    echo "Error inserting record: " . $conn->error;
}

$conn -> close();
?>