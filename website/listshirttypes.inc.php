<?php
/*
Name: Christian Guadalupe
Date: 03/11/2026
Course: IT-202-XXX
Assignment: Phase 5
*/
require_once("shirt_type.php");

// Handle Update submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_type"])) {
    $id = intval($_POST["shirtTypeID"]);
    $code = trim(htmlspecialchars($_POST["shirtTypeCode"]));
    $name = trim(htmlspecialchars($_POST["shirtTypeName"]));
    $shelf = trim(htmlspecialchars($_POST["shelfNumber"]));

    $errors = [];
    if (empty($code)) $errors[] = "Shirt Type Code is required.";
    if (empty($name)) $errors[] = "Shirt Type Name is required.";
    if (empty($shelf)) $errors[] = "Shelf Number is required.";

    if (empty($errors)) {
        ShirtType::updateShirtTypeByID($id, $code, $name, $shelf);
        echo "<p style='color:green;'>Shirt type updated successfully.</p>";
    } else {
        foreach ($errors as $e) echo "<p style='color:red;'>$e</p>";
    }
}

// Handle Delete submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_type"])) {
    $id = intval($_POST["shirtTypeID"]);
    ShirtType::deleteShirtType($id);
    echo "<p style='color:green;'>Shirt type deleted successfully.</p>";
}

// Fetch AFTER any updates/deletes
$shirtTypes = ShirtType::getShirtTypes();

if ($shirtTypes) {
?>
    <h2>List Shirt Types</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>Shirt Type ID</th>
            <th>Shirt Type Code</th>
            <th>Shirt Type Name</th>
            <th>Shelf Number</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($shirtTypes as $shirtType) { ?>
        <tr>
            <td><?= $shirtType->shirtTypeID ?></td>
            <td><?= $shirtType->shirtTypeCode ?></td>
            <td><?= $shirtType->shirtTypeName ?></td>
            <td><?= $shirtType->shelfNumber ?></td>
            <td>
                <button onclick="viewType(
                    '<?= $shirtType->shirtTypeID ?>',
                    '<?= $shirtType->shirtTypeCode ?>',
                    '<?= $shirtType->shirtTypeName ?>',
                    '<?= $shirtType->shelfNumber ?>'
                )">View</button>

                <button onclick="loadUpdateForm(
                    '<?= $shirtType->shirtTypeID ?>',
                    '<?= $shirtType->shirtTypeCode ?>',
                    '<?= $shirtType->shirtTypeName ?>',
                    '<?= $shirtType->shelfNumber ?>'
                )">Update</button>

                <button onclick="confirmDelete(
                    '<?= $shirtType->shirtTypeID ?>'
                )">Delete</button>
            </td>
        </tr>
        <?php } ?>
    </table>

    <!-- VIEW display area -->
    <div id="viewTypeDiv" style="display:none; border:1px solid #e0e0e0; padding:20px; margin-top:20px; border-radius:8px; background:#ffffff; box-shadow:0 2px 8px rgba(0,0,0,0.06);">
        <h3>View Shirt Type</h3>
        <p><strong>ID:</strong> <span id="viewID"></span></p>
        <p><strong>Code:</strong> <span id="viewCode"></span></p>
        <p><strong>Name:</strong> <span id="viewName"></span></p>
        <p><strong>Shelf:</strong> <span id="viewShelf"></span></p>
        <button onclick="document.getElementById('viewTypeDiv').style.display='none'">Close</button>
    </div>

    <!-- UPDATE form area -->
    <div id="updateTypeDiv" style="display:none; border:1px solid #e0e0e0; padding:20px; margin-top:20px; border-radius:8px; background:#ffffff; box-shadow:0 2px 8px rgba(0,0,0,0.06);">
        <h3>Update Shirt Type</h3>
        <form method="POST">
            <input type="hidden" name="shirtTypeID" id="updateID">

            <label>Shirt Type Code:</label>
            <input type="text" name="shirtTypeCode" id="updateCode">
            <span id="codeError" style="color:red; font-size:12px;"></span>

            <label>Shirt Type Name:</label>
            <input type="text" name="shirtTypeName" id="updateName">
            <span id="nameError" style="color:red; font-size:12px;"></span>

            <label>Shelf Number:</label>
            <input type="text" name="shelfNumber" id="updateShelf">
            <span id="shelfError" style="color:red; font-size:12px;"></span>

            <button type="button" onclick="validateAndSubmitUpdate()">Submit Update</button>
            <button type="button" onclick="document.getElementById('updateTypeDiv').style.display='none'">Cancel</button>
            <input type="hidden" name="update_type" value="1">
        </form>
    </div>

    <!-- DELETE hidden form -->
    <form id="deleteTypeForm" method="POST" style="display:none;">
        <input type="hidden" name="shirtTypeID" id="deleteID">
        <input type="hidden" name="delete_type" value="1">
    </form>

<?php
} else {
    echo "<h2>No Shirt Types found.</h2>";
}
?>

<script>
function viewType(id, code, name, shelf) {
    document.getElementById('viewID').innerText = id;
    document.getElementById('viewCode').innerText = code;
    document.getElementById('viewName').innerText = name;
    document.getElementById('viewShelf').innerText = shelf;
    document.getElementById('viewTypeDiv').style.display = 'block';
    document.getElementById('updateTypeDiv').style.display = 'none';
}

function loadUpdateForm(id, code, name, shelf) {
    document.getElementById('updateID').value = id;
    document.getElementById('updateCode').value = code;
    document.getElementById('updateName').value = name;
    document.getElementById('updateShelf').value = shelf;
    document.getElementById('updateTypeDiv').style.display = 'block';
    document.getElementById('viewTypeDiv').style.display = 'none';
}

function validateAndSubmitUpdate() {
    let valid = true;

    document.getElementById('codeError').innerText = '';
    document.getElementById('nameError').innerText = '';
    document.getElementById('shelfError').innerText = '';

    const code = document.getElementById('updateCode').value.trim();
    const name = document.getElementById('updateName').value.trim();
    const shelf = document.getElementById('updateShelf').value.trim();

    if (code === '') {
        document.getElementById('codeError').innerText = 'Shirt Type Code is required.';
        valid = false;
    }
    if (name === '') {
        document.getElementById('nameError').innerText = 'Shirt Type Name is required.';
        valid = false;
    }
    if (shelf === '') {
        document.getElementById('shelfError').innerText = 'Shelf Number is required.';
        valid = false;
    }

    if (valid) {
        document.querySelector('#updateTypeDiv form').submit();
    }
}

function confirmDelete(id) {
    if (confirm("Are you sure you want to delete this shirt type?")) {
        document.getElementById('deleteID').value = id;
        document.getElementById('deleteTypeForm').submit();
    }
}
</script>