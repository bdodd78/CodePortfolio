<%@ Page Language="C#" AutoEventWireup="true" CodeFile="APIQuery.aspx.cs"  Inherits="_Default"%>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Book Lookup</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="GoogleBookAPI.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"/>
    <style type="text/css">
            li {
                padding-left: 10px;
            }

            .level2 {
                padding-left: 20px;
            }

            .searchField {}
            .saveButton {}
            .nextPage {}
            .prevPage {}
            .searchRadio {}
            .invisible {display:none;}
        </style>
</head>
<body>
    
    <div class="container">
        <div class="jumbotron">
            <h1>Library</h1>
            <p>Look up books from the Google Books location by Title, Author or ISBN.</p>
        </div>
        <div id="bookForm" class="form-inline">
            <label  class="control-label">
                <input type="radio" value="title" id="radioTitle" name="searchCriteria" class="searchRadio"/> Book Title:
                <input type="text" id="searchTitle" class="form-control input-sm searchField" />
            </label>
            <label class="control-label">
                <input type="radio" value="authors" id="radioAuthor" name="searchCriteria" class="searchRadio" checked="checked"/>Book Author:
                <input type="text" id="searchAuthor" class="form-control input-sm searchField" value="Jim Butcher" />
            </label>
            <label class="control-label">
                <input type="radio" value="isbn" id="radioISBN" name="searchCriteria" class="searchRadio"/>ISBN:
                <input type="text" id="searchISBN" value="" class="form-control input-sm searchField" />
            </label>
            <!--<button id='listAll' class="btn btn-sm btn-primary">Search for Book</button>         -->
            <button id='saveList' class="btn btn-sm btn-primary">Search</button>
        </div>
        <p></p>
        <div id='saveDiv'></div> 
        
    </div>
    <form name="saveForm" method="post" action="#" runat="server">
        <input type="hidden" value="" id="book_title" name="book_title" />
        <input type="hidden" value="" id="subtitle" name="subtitle"/>
        <input type="hidden" value="" id="author" name="author"/>
        <input type="hidden" value="" id="publisher" name="publisher"/>
        <input type="hidden" value="" id="published_date" name="published_date"/>
        <input type="hidden" value="" id="page_count" name="page_count"/>
        <input type="hidden" value="" id="categories" name="categories"/>
        <input type="hidden" value="" id="description" name="description"/>
        <input type="hidden" value="" id="industry_type" name="industry_type"/>
        <input type="hidden" value="" id="industry_identifier" name="industry_identifier"/>
     </form>           
    
</body>
</html>



