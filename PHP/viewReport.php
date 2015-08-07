<html>
<head>
<title>Book Reporting</title>
 <link href="bin/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
 <link href="bin/bootstrap-3.3.5-dist/css/bootstrap-theme.min.css" rel="stylesheet">
<style type="text/css">

    .sortable { cursor:hand; }
    .chosen {background-color: rgba(0, 128, 54, 0.63);}

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


$sqlReport = "SELECT * from JD_Books";

$Authors = $_POST["Authors"];
if ($Authors == "") {
    $sqlAuthors = "";   
} else {
    $sqlAuthors = "WHERE concat(Author_First,' ',Author_Last) = '$Authors'";  
}
$Series = $_POST["Series"];
if ($Series == "") {
 $sqlSeries = "";   
} else {
    if ($sqlAuthors == "") {
        $sqlSeries = "WHERE Series = '$Series'";
    } else {
        $sqlSeries = "AND Series = '$Series'";   
    }
}

$sortCol = $_REQUEST["sortColumn"];
//echo $sortCol;
if ($sortCol == "") {
    $sortCol = "Book_Title";
}

if ($sortCol == "Series") {
    $sortColtmp = "Series, Series_Volume";
} else {
    $sortColtmp = $sortCol;
}

$SQLStmt = "$sqlReport $sqlAuthors $sqlSeries ORDER BY $sortColtmp"; 
//echo $SQLStmt;
$Report = $conn->query($SQLStmt); ?>
<div class="container">
<nav class="navbar navbar-default">
	
		<ul class="nav navbar-nav navbar-left">
        <li><a href="default.php">Home</a></li>
		<li><a href="insert.php">Add Book</a></li>
		<li><a href="report.php">Book Report</a></li>
        
      </ul>
	
</nav>

    <div class="panel panel-primary">
        <div class="panel-heading">The Book Report</div>
        <b>Author:</b> <?php if ($Authors == "") {echo "All Authors";} else {echo $Authors;} ?> <br/>
        <b>Series:</b> <?php if ($Series == "") {echo "All Series'";} else {echo $Series;} ?>
    </div>
<div class="container-fluid">
    <table class="table table-striped">
        <tr>
            <td class="heading">Edit</td>
            <td class="heading sortable" data-column="Book_Title">Title</td>
            <td class="heading sortable" data-column="Subtitle">Subtitle</td>
            <td class="heading sortable" data-column="Author_Last">Author</td>
            <td class="heading sortable" data-column="Series">Series (Volume)</td>
            <td class="heading sortable" data-column="Co_Author">Co-Author</td>
            <td class="heading sortable" data-column="Compilation">Compilation</td>
            <td class="heading sortable" data-column="Rating">Rating</td>
            <td class="heading sortable" data-column="Format">Format</td>
            <td class="heading sortable" data-column="Status">Status</td>		
            <td class="heading sortable" data-column="Unread">Unread</td>		
        </tr>
        <?php
        if ($Report->num_rows > 0) {
            //output data of each row
            while ($row = $Report->fetch_assoc()) { ?>
                <tr>
                    <td><a href="edit.php?id=<?php echo $row["ID"]; ?>">Edit</a></td>
                    <td><?php echo $row["Book_Title"]; ?></td>
                    <td><?php echo $row["Subtitle"]; ?></td>
                    <td><?php echo $row["Author_First"] ." ".$row["Author_Last"] ?></td>
                    <td><?php if (!$row["Series"] == "") {echo $row["Series"]. " (". $row["Series_Volume"] .")"; } ?></td>
                    <td><?php echo $row["Co_Author"]; ?></td>
                    <td><?php echo $row["Compilation"]; ?></td>
                    <td><?php echo $row["Rating"]; ?></td>
                    <td><?php echo $row["Format"]; ?></td>
                    <td><?php echo $row["Status"]; ?></td>
                    <td><?php if ($row["Unread"] == 1) {echo "Yes";} else {echo "No";} ?></td>

                </tr>
        <?php } ?>			
    </table>
</div>
<?php }else {
	echo "0 results";
}
$conn -> close();
?>
    <form name="sortForm" action="#" method="post">
        <input type="hidden" value="<?php echo $sortCol; ?>" name="sortColumn" id="sortColumn"/>
        <input type="hidden" value="<?php echo $Authors;?>" name="Authors"/>
        <input type="hidden" value="<?php echo $Series;?>" name="Series"/>
    </form>
</div>
    <script src="bin/jquery-2.1.4.min.js"></script>
    <script src="bin/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
    <script src="JavaScripts/reportSort.js"></script>
</body>
</html>