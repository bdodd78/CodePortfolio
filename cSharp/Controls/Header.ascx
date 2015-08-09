<%@ Control Language="C#" AutoEventWireup="true" CodeFile="Header.ascx.cs" Inherits="Controls_Header" %>
<script runat="server">
    public string heading = "Page Heading";  
</script>

<h1><%= heading %></h1>
<asp:Panel id="imgPanel" runat="server" >
          
</asp:Panel>
<asp:Panel id="menuPanel" runat="server" CssClass="menuPanel">
    <a href="Default.aspx">Home</a> |
    <a href="Insert.aspx">Add Books</a> |
    <a href="APIQuery.aspx">Query Google Books</a>|
</asp:Panel>
<br />



