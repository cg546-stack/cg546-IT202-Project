<h2>Enter New Shirt Information</h2>
<form name="newshirt" action="index.php" method="post">
    <table cellpadding="1" border="0">
        <tr>
            <td>Shirt ID:</td>
            <td><input type="text" name="shirtID" size="10"></td>
        </tr>
        <tr>
            <td>Shirt Type ID:</td>
            <td><input type="text" name="shirtTypeID" size="10"></td>
        </tr>
        <tr>
            <td>Shirt Code:</td>
            <td><input type="text" name="shirtCode" size="20"></td>
        </tr>
        <tr>
            <td>Shirt Name:</td>
            <td><input type="text" name="shirtName" size="50"></td>
        </tr>
        <tr>
            <td>Description:</td>
            <td><textarea name="description" rows="3" cols="40"></textarea></td>
        </tr>
        <tr>
            <td>Price:</td>
            <td><input type="text" name="price" size="10"></td>
        </tr>
    </table><br>
    
    <input type="submit" value="Submit New Shirt">
    
    <input type="hidden" name="content" value="addshirt">
</form>