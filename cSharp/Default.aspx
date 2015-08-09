<%@ Page Language="C#" AutoEventWireup="true" CodeFile="Default.aspx.cs" Inherits="_Default" %>

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
    
        <asp:GridView ID="GridView1" runat="server" DataSourceID="SqlDataSource1" DataKeyNames="id" EmptyDataText="There are no data records to display." 
            AutoGenerateColumns="False" CellPadding="4" ForeColor="#333333" GridLines="None" Width="835px">            
            <Columns>
                <asp:BoundField DataField="Book_Title" HeaderText="Title" />
                <asp:BoundField DataField="Book_Author1" HeaderText="Author" />
                <asp:BoundField DataField="Book_Author2" HeaderText="Co-Author" />
                <asp:BoundField DataField="Subtitle" HeaderText="Subtitle" />
                <asp:BoundField DataField="Categories" HeaderText="Categories" />                
                <asp:HyperLinkField DataNavigateUrlFields="id" DataNavigateUrlFormatString="BookDetail.aspx?id={0}" Text="Edit" />                
                <asp:CommandField ShowDeleteButton="True" />
            </Columns>
            <EditRowStyle CSSclass="editRow"/>
            <FooterStyle CSSclass="footer" />
            <HeaderStyle CssClass="header" />
            <AlternatingRowStyle cssClass="alternate"/>
            <RowStyle cssClass="row" />
            <SelectedRowStyle cssClass="selectRow" />
            
        </asp:GridView>
    
        <br />
        <asp:HyperLink ID="HyperLink1" runat="server" NavigateUrl="~\Insert.aspx">Add New Book</asp:HyperLink>
    
    </div>
        <asp:SqlDataSource ID="SqlDataSource1" runat="server" 
            ProviderName="<%$ ConnectionStrings:Library.ProviderName %>" 
            ConnectionString="<%$ ConnectionStrings:Library %>" 
            DeleteCommand="DELETE FROM Library_Table WHERE id = @id" 
            SelectCommand="SELECT ID, Book_Title, Book_Author1, Book_Author2, subtitle, Categories from Library_Table"> 
            <DeleteParameters>
                <asp:Parameter Name="id" Type="Int32" />
            </DeleteParameters>
        </asp:SqlDataSource>

    </form>
</body>
</html>
