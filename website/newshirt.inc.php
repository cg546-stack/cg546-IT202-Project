<h2>Enter New Shirt Information</h2>
<form name="newshirt" action="index.php" method="post">
    <table cellpadding="1" border="0">
        <tr>
            <td>Shirt ID:</td>
            <!-- 2.2 - number input, not blank, min/max range -->
            <td><input type="number" name="shirtID" size="10" required min="1" max="9999"></td>
        </tr>
        <tr>
            <td>Shirt Type ID:</td>
            <!-- 2.2 - number input, not blank, min/max range -->
            <td><input type="number" name="shirtTypeID" size="10" required min="1" max="9999"></td>
        </tr>
        <tr>
            <td>Shirt Code:</td>
            <!-- 2.2 - not blank, min 2 chars, max 10 chars -->
            <td><input type="text" name="shirtCode" size="20" required minlength="2" maxlength="10"></td>
        </tr>
        <tr>
            <td>Shirt Name:</td>
            <!-- 2.2 - not blank, min 10 chars, max 100 chars -->
            <td><input type="text" name="shirtName" size="50" required minlength="10" maxlength="100"></td>
        </tr>
        <tr>
            <td>Description:</td>
            <!-- 2.2 - not blank, min 100 chars, max 255 chars -->
            <td><textarea name="description" rows="3" cols="40" required minlength="100" maxlength="255"></textarea></td>
        </tr>
        <tr>
            <td>Price:</td>
            <!-- 2.2 - number input, not blank, allows decimals -->
            <td><input type="number" name="price" size="10" required min="0" max="9999" step="0.01"></td>
        </tr>
    </table><br>
    
    <input type="submit" value="Submit New Shirt">
    
    <input type="hidden" name="content" value="addshirt">
</form>