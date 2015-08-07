<html>
<head>
<title>Book Listing</title>
 <link href="bin/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
 <link href="bin/bootstrap-3.3.5-dist/css/bootstrap-theme.min.css" rel="stylesheet">

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
parse_str($_SERVER['QUERY_STRING']);
$sql = "select * from JD_Books where ID = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {?>
<div class="container">
<nav class="navbar navbar-default">
	
		<ul class="nav navbar-nav navbar-left">
        <li><a href="default.php">Home</a></li>
		<li><a href="insert.php">Add Book</a></li>
		<li><a href="report.php">Book Report</a></li>
        
      </ul>
	
</nav>
<br/>
<form name="book_form" action="edit_submit.php" method="post" >
		<input type="hidden" name="id_val" value="<?php echo $id;?>"/>
		
		<br/>
		<table class="table table-striped">
			<tr>
				<th colspan="2">Edit Book</th>
			</tr>
	<?php //output data of each row
	while ($row = $result->fetch_assoc()) { ?>
		<tr>
			<td class="heading">Title</td>
			<td><input type="text" value="<?php echo $row["Book_Title"] ?>" name="title" size="50"/> </td>
		</tr>
		<tr>
			<td class="heading">Author</td>
			<td>
				<input type="text" value="<?php echo $row["Author_First"] ?>" name="author_first" size="20" />
				<input type="text" value="<?php echo $row["Author_Last"] ?>" name="author_last" size="20" />
			</td>
		</tr>
		<tr>
			<td class="heading">Sub-title</td>
			<td>
				<input type="text" value="<?php echo $row["Subtitle"] ?>" name="subtitle" size="50"/> 
			</td>
		</tr>
		<tr>
			<td class="heading">Series</td>
			<td>
				<input type="text" value="<?php echo $row["Series"] ?>" name="series" size="50"/> 
			</td>
		</tr>
		<tr>
			<td class="heading">Volume</td>
			<td>
				<input type="text" value="<?php echo $row["Series_Volume"]?>" name="volume" size="5"/> 
			</td>
		</tr>
		<tr>
			<td class="heading">Co-Author</td>
			<td>
				<input type="text" value="<?php echo $row["Co_Author"] ?>" name="coauthor" size="50"/> 
			</td>
		</tr>
		<tr>
			<td class="heading">Compilation</td>
			<td>
				<input type="text" value="<?php echo $row["Compilation"]?>" name="compilation" size="50"/> 
			</td>
		</tr>
		<tr>
			<td class="heading">Rating</td>
			<td>
				<select name="rating" size="1">
					<option value="0">0</option>
					<option value="1" <?php if ($row["Rating"]==1) {echo " selected";} ?>>1</option>
					<option value="2" <?php if ($row["Rating"]==2) {echo " selected";} ?>>2</option>
					<option value="3" <?php if ($row["Rating"]==3) {echo " selected";} ?>>3</option>
					<option value="4" <?php if ($row["Rating"]==4) {echo " selected";} ?>>4</option>
					<option value="5" <?php if ($row["Rating"]==5) {echo " selected";} ?>>5</option>
				</select>
				
			</td>
		</tr>
		<tr>
			<td class="heading">Format</td>
			<td>
				<select name="format" size="1">
					<option value="UK">Unknown</option>
					<option value="Paperback" <?php if ($row["Format"]=="Paperback") {echo " selected";} ?>>Paperback</option>
					<option value="Hardback" <?php if ($row["Format"]=="Hardback") {echo " selected";} ?>>Hardback</option>
					<option value="E-book" <?php if ($row["Format"]=="E-book") {echo " selected";} ?>>E-book</option>
					
				</select>
				
			</td>
		</tr>
		<tr>
			<td class="heading">Unread</td>
			<td>
				<select name="unread" size="1">
					<option value="0">No</option>
					<option value="1" <?php if ($row["Unread"]=="1") {echo " selected";} ?>>Yes</option>
						
				</select>
				
			</td>
		</tr>
		<tr>
			<td class="heading">Status</td>
			<td> 
				<select name="status" size="1">
					<option value="UK">Unknown</option>
					<option value="On Shelf" <?php if ($row["Status"]=="On Shelf") {echo " selected";} ?>>On Shelf</option>
					<option value="Removed" <?php if ($row["Status"]=="Removed") {echo " selected";} ?>>Removed</option>
					<option value="Missing" <?php if ($row["Status"]=="Missing") {echo " selected";} ?>>Missing</option>
					<option value="Gave to Beth" <?php if ($row["Status"]=="Gave to Beth") {echo " selected";} ?>>Gave to Beth</option>
				</select>
				
			</td>
		</tr>
	<?php 	
		
	} ?>
	
		<tr>
			<td colspan="2">
				<input type="submit" value="Submit" class="btn"/>
			</td>
		</tr>
	</table>
</form>
</div>
<?php } else {
	echo "0 results";
}
$conn -> close();
?>
</body>
</html>