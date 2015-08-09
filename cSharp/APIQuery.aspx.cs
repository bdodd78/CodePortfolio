using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Data;
using System.Configuration;
using MySql.Data.MySqlClient;



public partial class _Default : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
        if (IsPostBack)
        {
            string bookTitle = Request.Form["book_title"];
            string subtitle = Request.Form["subtitle"];
            string author = Request.Form["author"];
            string coAuthors = "";
            string[] authors;
            if (author.Contains(","))
            {
                authors = author.Split(',');
                for (var i = 0; i < authors.Length; i++)
                {
                    if (i == 0)
                    {
                        author = authors[i];
                    }
                    else
                    {
                        coAuthors += authors[i] + ",";
                    }

                }
            }
            string publisher = Request.Form["publisher"];
            string publishedDate = Request.Form["published_date"];
            string pageCount = Request.Form["page_count"];
            string categories = Request.Form["categories"];
            string description = Request.Form["description"];
            string industryType = Request.Form["industry_type"];
            string[] indType;
            if (industryType.Contains(",")) { indType = industryType.Split(','); }
            string industryIdentifiers = Request.Form["industry_identifier"];
            string[] indIdent;
            if (industryIdentifiers.Contains(",")) { indIdent = industryIdentifiers.Split(','); }
            string UN_ID = Guid.NewGuid().ToString("N");
            string nowDate = System.DateTime.Now.ToString();
            string SQLInsert;
            //SQLInsert = "INSERT INTO Library_Table (UN_ID, Book_Title, Book_Author1, Book_Author2, Subtitle, Publisher, Published_Date, Description, Page_Count, Categories, Date_Added) VALUES ('" + UN_ID + "', '" + bookTitle + "', '" + author + "', '" + coAuthors + "', '" + subtitle + "', '" + publisher + "', '" + publishedDate + "', '" + description + "', '" + pageCount + "', '" + categories + "', '" + nowDate + "')";
            SQLInsert = "INSERT INTO Library_Table (UN_ID, Book_Title, Book_Author1, Book_Author2, Subtitle, Publisher, Published_Date, Description, Page_Count, Categories, Date_Added) VALUES (@UN_ID, @BookTitle, @Author1, @Author2, @Subtitle, @Publisher, @pubDate, @Description, @pageCount, @Categories, @Now)";
            string connString = ConfigurationManager.ConnectionStrings["Library"].ConnectionString;
            using (var conn = new MySqlConnection(connString))
            {
                conn.Open();
                var comm = conn.CreateCommand();
                comm.CommandText = SQLInsert;
                comm.Parameters.AddWithValue("?UN_ID", UN_ID);
                comm.Parameters.AddWithValue("?BookTitle", bookTitle);
                comm.Parameters.AddWithValue("?Author1", author);
                comm.Parameters.AddWithValue("?Author2", coAuthors);
                comm.Parameters.AddWithValue("?Subtitle", subtitle);
                comm.Parameters.AddWithValue("?Publisher", publisher);
                comm.Parameters.AddWithValue("?pubDate", publishedDate);
                comm.Parameters.AddWithValue("?Description", description);
                comm.Parameters.AddWithValue("?pageCount", pageCount);
                comm.Parameters.AddWithValue("?Categories", categories);
                comm.Parameters.AddWithValue("?Now", nowDate);
                comm.ExecuteNonQuery();
            }
        }
    }
}