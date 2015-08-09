<%@ Page Language="C#" AutoEventWireup="true" CodeFile="BookDetail.aspx.cs" Inherits="BookDetail" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Home Page - Books DB</title>
    <link rel="stylesheet" href="~/CSS/styles.css" />
</head>
<body>
    <form id="form1" runat="server">
        <customControls:Header heading="Home Page" runat="server" ID="myHeader" />

    <div>
    
            
        <asp:DetailsView ID="DetailsView1" runat="server" DataSourceID="SqlDataSource1" DataKeyNames="id" 
            Height="50px" Width="489px" AutoGenerateRows="False" DefaultMode="Edit" 
            OnItemUpdated="DetailsView1_ItemUpdated" OnItemCommand="DetailsView1_ItemCommand">
           
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
                
                <asp:CommandField ShowEditButton="True" />
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
            UpdateCommand="UPDATE Library_Table SET Book_Title = @Book_Title, Book_Author1 = @Book_Author1, Book_Author2 = @Book_Author2, Subtitle = @Subtitle, Publisher = @Publisher,
                Published_Date = @Published_Date, Categories = @Categories, Description = @Description, Page_Count = @Page_Count  WHERE id = @id"
            SelectCommand="SELECT ID, Book_Title, Book_Author1, Book_Author2, subtitle, Publisher, Published_Date, Description, Page_Count, Categories from Library_Table"> 
            <UpdateParameters>
                <asp:Parameter Type="String" Name="Book_Title" />
                <asp:Parameter Type="String" Name="Book_Author1" />
                <asp:Parameter Type="String" Name="Book_Author2" />
                <asp:Parameter Type="String" Name="Subtitle" />
                <asp:Parameter Type="String" Name="Publisher" />
                <asp:Parameter Type="String" Name="Published_Date" />
                <asp:Parameter Type="String" Name="Categories" />
                <asp:Parameter Type="String" Name="Description" />
                <asp:Parameter Type="Int32" Name="Page_Count" />
                <asp:Parameter Name="id" Type="Int32" />
            </UpdateParameters>
        </asp:SqlDataSource>

    </form>
</body>
</html>

