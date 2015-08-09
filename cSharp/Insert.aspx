<%@ Page Language="C#" AutoEventWireup="true" %>

<!DOCTYPE html>
<script runat="server">
    protected void Page_Load(object sender, EventArgs e)
    {
       TextBox txt1 = (TextBox)DetailsView1.FindControl("Date_Added");
       txt1.Text = System.DateTime.Now.ToString();
        
        TextBox txt2 = (TextBox)DetailsView1.FindControl("UN_ID");
        txt2.Text = generateID();
    }
    public string generateID()
    {
        return Guid.NewGuid().ToString("N");
    }
    protected void DetailView_ItemInsert(object sender,
        DetailsViewInsertedEventArgs e)
    {
        if (e.AffectedRows == 1)
        {
            Response.Redirect("~/Default.aspx");
        }
    }

    protected void DetailView_ItemCommand(object sender,
        DetailsViewCommandEventArgs e)
    {
        if (e.CommandName == "Cancel")
        {
            Response.Redirect("~/Default.aspx");
        }

    }

</script>
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Add New Book</title>
    <link rel="stylesheet" href="~/CSS/styles.css" />
</head>
<body>
    <form id="form1" runat="server">
        <customControls:Header heading="Insert Book" runat="server" ID="myHeader" />
    <div>
    
        <asp:DetailsView ID="DetailsView1" runat="server" AutoGenerateRows="False" DataSourceID="SqlDataSource1" DefaultMode="Insert" Height="50px" 
            Width="489px" CellPadding="3"
            onItemInserted="DetailView_ItemInsert"
            onItemCommand="DetailView_ItemCommand" BackColor="White" BorderColor="#CCCCCC" BorderStyle="None" BorderWidth="1px">        
            
            
            
            <Fields>
                <asp:BoundField DataField="Book_Title" HeaderText="Title" />
                <asp:BoundField DataField="Book_Author1" HeaderText="Author" />
                <asp:BoundField DataField="Book_Author2" HeaderText="Co-Author" />
                <asp:BoundField DataField="Subtitle" HeaderText="Subtitle" />
                <asp:BoundField DataField="Publisher" HeaderText="Publisher" />
                <asp:BoundField DataField="Published_Date" HeaderText="Pub Date" />
                <asp:TemplateField HeaderText="Description">
                    <EditItemTemplate>
                        <asp:TextBox ID="Description" runat="server" Text="<%# Bind('Description') %>" Height="150px" TextMode="MultiLine"/>
                    </EditItemTemplate>
                </asp:TemplateField>
                <asp:BoundField DataField="Page_Count" HeaderText="Pages" />
                <asp:BoundField DataField="Categories" HeaderText="Categories" />            
                <asp:TemplateField>
                    <EditItemTemplate>
                        <asp:TextBox ID="Date_Added" runat="server" Text="<%# Bind('Date_Added') %>" cssClass="hiddenItem"/>
                    </EditItemTemplate>
                </asp:TemplateField>
                <asp:TemplateField>
                    <EditItemTemplate>
                        <asp:TextBox ID="UN_ID" runat="server" Text="<%# Bind('UN_ID') %>" ReadOnly="true" Width="200px" CssClass="hiddenItem" />
                    </EditItemTemplate>
                </asp:TemplateField>
                <asp:CommandField ShowInsertButton="True" />
            </Fields>
       
            <EditRowStyle cssClass="editRow" />
            <FooterStyle cssClass="footer" />
            <HeaderStyle cssClass="header" />
            <RowStyle cssClass="row" />
       

        </asp:DetailsView>
    
    </div>
        <asp:SqlDataSource ID="SqlDataSource1" runat="server" 
            ProviderName="<%$ ConnectionStrings:Library.ProviderName %>" 
            ConnectionString="<%$ ConnectionStrings:Library %>" 
            InsertCommand="INSERT INTO Library_Table (UN_ID, Book_Title, Book_Author1, Book_Author2, Subtitle, Publisher, Published_Date, Description, Page_Count, Categories, Date_Added) 
                VALUES (@UN_ID, @Book_Title, @Book_Author1, @Book_Author2, @Subtitle, @Publisher, @Published_Date, @Description, @Page_Count, @Categories, @Date_Added)" 
            SelectCommand="SELECT id,UN_ID, Book_Title, Book_Author1, Book_Author2, subtitle, publisher, published_date, description, page_count, Categories from Library_Table" >
            <DeleteParameters>
                <asp:Parameter Name="id" Type="Int32" />
            </DeleteParameters>
            <InsertParameters>
                <asp:Parameter Name="UN_ID" Type="String" />
                <asp:Parameter Name="Book_Title" Type="String" />
                <asp:Parameter Name="Book_Author1" Type="String" />
                <asp:Parameter Name="Book_Author2" Type="String" />
                <asp:Parameter Name="Subtitle" Type="String" />
                <asp:Parameter Name="Publisher" Type="String" />
                <asp:Parameter Name="Published_Date" Type="String" />
                <asp:Parameter Name="Description" Type="String" />
                <asp:Parameter Name="Page_Count" Type="Int32" />
                <asp:Parameter Name="Categories" Type="String" />
                <asp:Parameter DbType ="Date" Name="Date_Added" />
                
            </InsertParameters>
            <UpdateParameters>
                
            </UpdateParameters>
        </asp:SqlDataSource>

    </form>
</body>
</html>
