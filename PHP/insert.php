<html>
<head>
<title>Book Listing</title>
 <link href="bin/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
 <link href="bin/bootstrap-3.3.5-dist/css/bootstrap-theme.min.css" rel="stylesheet">

</head>
<body>
<div class="container">
<nav class="navbar navbar-default">
	
		<ul class="nav navbar-nav navbar-left">
        <li><a href="default.php">Home</a></li>
		<li><a href="insert.php">Add Book</a></li>
		<li><a href="report.php">Book Report</a></li>
        
      </ul>
	
</nav>
<br/>
<form name="book_form" action="insert_submit.php" method="post">
		
		<table class="table table-striped">
			<tr>
				<th colspan="2">A Book</th>
			</tr>
	
		<tr>
			<td class="heading">Title</td>
			<td><input type="text" value="" name="title" size="50"/> </td>
		</tr>
		<tr>
			<td class="heading">Author</td>
			<td>
				<input type="text" value="" name="author_first" size="20" />
				<input type="text" value="" name="author_last" size="20" />
			</td>
		</tr>
		<tr>
			<td class="heading">Sub-title</td>
			<td>
				<input type="text" value="" name="subtitle" size="50"/> 
			</td>
		</tr>
		<tr>
			<td class="heading">Series</td>
			<td>
				<input type="text" value="" name="series" size="50"/> 
			</td>
		</tr>
		<tr>
			<td class="heading">Volume</td>
			<td>
				<input type="text" value="" name="volume" size="5"/> 
			</td>
		</tr>
		<tr>
			<td class="heading">Co-Author</td>
			<td>
				<input type="text" value="" name="coauthor" size="50"/> 
			</td>
		</tr>
		<tr>
			<td class="heading">Compilation</td>
			<td>
				<input type="text" value="" name="compilation" size="50"/> 
			</td>
		</tr>
		<tr>
			<td class="heading">Rating</td>
			<td>
				<select name="rating" size="1">
					<option value="0">0</option>
					<option value="1" >1</option>
					<option value="2" >2</option>
					<option value="3" >3</option>
					<option value="4" >4</option>
					<option value="5" >5</option>
				</select>
				
			</td>
		</tr>
		<tr>
			<td class="heading">Format</td>
			<td>
				<select name="format" size="1">
					<option value="UK">Unknown</option>
					<option value="Paperback" >Paperback</option>
					<option value="Hardback" >Hardback</option>
					<option value="E-book" >E-book</option>
					
				</select>
				
			</td>
		</tr>
		<tr>
			<td class="heading">Unread</td>
			<td>
				<select name="unread" size="1">
					<option value="0">No</option>
					<option value="1" >Yes</option>
						
				</select>
				
			</td>
		</tr>
		<tr>
			<td class="heading">Status</td>
			<td> 
				<select name="status" size="1">
					<option value="UK">Unknown</option>
					<option value="On Shelf" >On Shelf</option>
					<option value="Removed" >Removed</option>
					<option value="Missing" >Missing</option>
					<option value="Gave to Beth" >Gave to Beth</option>
				</select>
				
			</td>
		</tr>
	
		<tr>
			<td colspan="2">
				<input type="submit" value="Submit" class="btn btn-sm btn-primary"/>
			</td>
		</tr>
	</table>
</form>
</div>
</body>
</html>