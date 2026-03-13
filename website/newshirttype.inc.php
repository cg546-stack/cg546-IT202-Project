<h2>Enter New Shirt Type Information</h2>
<form name="newshirttype" action="index.php" method="post">
    <table cellpadding="1" border="0">
        <tr>
            <td>Shirt Type ID:</td>
            <td><input type="text" name="shirtTypeID" size="4"></td>
        </tr>
        <tr>
            <td>Shirt Type Code:</td>
            <td><input type="text" name="shirtTypeCode" size="20"></td>
        </tr>
        <tr>
            <td>Shirt Type Name:</td>
            <td><input type="text" name="shirtTypeName" size="20"></td>
        </tr>
    </table><br>
    
    <input type="submit" value="Submit New Shirt Type">
    
    <input type="hidden" name="content" value="addshirttype">
</form>