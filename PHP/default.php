<html>
<head>
<title>Book Listing</title>
 <link href="bin/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
 <link href="bin/bootstrap-3.3.5-dist/css/bootstrap-theme.min.css" rel="stylesheet">
<style type="text/css">
    .Series { display: none; }
    
    .CoAuthor { display: none; }
    .Rating { display: none; }
    .Format { display: none; }
    .Status { display: none; }
    .sortable { cursor:hand; }
    .chosen {background-color: rgba(0, 128, 54, 0.63);}
    .cbChoice{}
    .heading{
        font-weight:bold;
        text-align:center;
    }
</style>
</head>
<body>
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
$sortCol = $_REQUEST["sortColumn"];
$sortColtmp = $sortCol;
$SeriesChoice = $_REQUEST["cbSeries"];
$CAChoice = $_REQUEST["cbCoAuthor"];
$RatingChoice = $_REQUEST["cbRating"];
$FormatChoice = $_REQUEST["cbFormat"];
$StatusChoice = $_REQUEST["cbStatus"];

if ($sortCol == "") {
    $sortCol = "Book_Title";   
    $sortColtmp = "Book_Title";
}

if ($sortCol == "Series") {
    $sortColtmp = "Series, Series_Volume";   
}
$sql = "select * from JD_Books order by $sortColtmp";
//echo $sql;
$result = $conn->query($sql);?>
<div class="container">
<nav class="navbar navbar-default">
	
		<ul class="nav navbar-nav navbar-left">
        <li><a href="default.php">Home</a></li>
		<li><a href="insert.php">Add Book</a></li>
		<li><a href="report.php">Book Report</a></li>
        
      </ul>
	
</nav>
<br/>
<form name="viewForm" action="#" method="post">
    
    <div class="panel panel-primary col-md-4">
        <div class="panel-heading">
            Choose Columns to Display
        </div>

        <ul>
            <li><input type="checkbox" value="Series" class="cbChoice" name="cbSeries" <?php if($SeriesChoice == "Series") echo "checked=\"checked\""; ?> />Series</li>
            <li><input type="checkbox" value="CoAuthor" class="cbChoice" name="cbCoAuthor"<?php if($CAChoice == "CoAuthor") echo "checked=\"checked\""; ?>/>Co-Author</li>
            <li><input type="checkbox" value="Rating" class="cbChoice" name="cbRating"<?php if($RatingChoice == "Rating") echo "checked=\"checked\""; ?>/>Rating</li>
            <li><input type="checkbox" value="Format" class="cbChoice" name="cbFormat"<?php if($FormatChoice == "Format") echo "checked=\"checked\""; ?>/>Format</li>
            <li><input type="checkbox" value="Status" class="cbChoice" name="cbStatus"<?php if($StatusChoice == "Status") echo "checked=\"checked\""; ?>/>Status</li>            
        </ul>
        
    </div>
    <input type="hidden" id="sortColumn" name="sortColumn" value="<?php echo $sortCol; ?>"/>
<table class="table table-striped">
	<tr>
        <td class="heading">Edit</td>
		<td class="heading sortable" data-column="Book_Title">Title</td>
		<td class="heading sortable" data-column="Author_Last">Author</td>
        <td class="Series heading sortable" data-column="Series">Series (Volume)</td>
        <td class="CoAuthor heading sortable" data-column="Co_Author">Co-Author</td>
        <td class="Rating heading sortable" data-column="Rating">Rating</td>
        <td class="Format heading sortable" data-column="Format">Format</td>
        <td class="Status heading sortable" data-column="Status">Status</td>		
	</tr>
        <?php
        if ($result->num_rows > 0) {
            //output data of each row
            while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><a href="edit.php?id=<?php echo $row["ID"]; ?>">Edit</a></td>
                    <td><?php echo $row["Book_Title"]; ?></td>
                    <td><?php echo $row["Author_First"] ." ".$row["Author_Last"] ?></td>
                    <td class="Series"><?php if (!$row["Series"] == "") {echo $row["Series"]. " (". $row["Series_Volume"] .")"; } ?></td>
                    <td class="CoAuthor"><?php echo $row["Co_Author"]; ?></td>
                    <td class="Rating"><?php echo $row["Rating"]; ?></td>
                    <td class="Format"><?php echo $row["Format"]; ?></td>
                    <td class="Status"><?php echo $row["Status"]; ?></td>

                </tr>
        <?php } ?>			
	</table>
<?php }else {
	echo "0 results";
}
$conn -> close();
?>
</form>
</div>
    <script src="bin/jquery-2.1.4.min.js"></script>
    <script src="bin/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
    <script src="JavaScripts/defaultColumns.js"></script>
</body>
</html>