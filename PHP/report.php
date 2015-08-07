<html>
<head>
<title>Book Reporting</title>
 <link href="bin/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
 <link href="bin/bootstrap-3.3.5-dist/css/bootstrap-theme.min.css" rel="stylesheet">
<style type="text/css">

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

$sqlSeries = "select distinct Series from JD_Books where Series <> '' order by Series";
$sqlAuthor = "select distinct Author_Last, Author_First from JD_Books order by Author_Last";
//echo $sql;
$Series = $conn->query($sqlSeries);
$Authors = $conn->query($sqlAuthor);
    ?>
<div class="container">
<nav class="navbar navbar-default">
	
		<ul class="nav navbar-nav navbar-left">
        <li><a href="default.php">Home</a></li>
		<li><a href="insert.php">Add Book</a></li>
		<li><a href="report.php">Book Report</a></li>
        
      </ul>
	
</nav>
<br/>
<form name="reportForm" action="viewReport.php" method="post">
    
    <div class="panel panel-primary">
        <div class="panel-heading">The Book Report</div>
        <div class="row">
            <div class="col-md-12">
                <b>Author: </b>
                <select name="Authors" size="1">
                    <option value="">All Authors</option>
                    <?php if ($Authors->num_rows > 0) {
                        //output data of each row
                        while ($row = $Authors->fetch_assoc()) { 
                            echo "<option value=\"" .$row["Author_First"]." ".$row["Author_Last"]. "\">".$row["Author_Last"] .", ". $row["Author_First"] ."</option>";
                        } 
                    }?>
                </select>
                <br/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <b>Series: </b>
                <select name="Series" size="1">
                    <option value="">All Series</option>
                    <?php if ($Series->num_rows > 0) {
                        //output data of each row
                        while ($row = $Series->fetch_assoc()) { 
                            echo "<option value=\"" .$row["Series"]. "\">".$row["Series"]."</option>";
                        } 
                    }?>
                </select>
                <br/>
            </div>
        </div>
    
        <div class="row">
            <div class="col-md-8">
                <input type="submit" value="Submit"/>
            </div>
        </div>
    </div>
    <?php
        
    $conn -> close();?>
</form>
</div>
    <script src="bin/jquery-2.1.4.min.js"></script>
    <script src="bin/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
    <script src="JavaScripts/reportSetup.js"></script>
</body>
</html>