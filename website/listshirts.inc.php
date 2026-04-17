<?php
/*
Name: Christian Guadalupe
Date: 02/24/2026
Course: IT-202-XXX Internet Applications
Assignment: Phase 5 - JavaScript
Email: cg546@njit.edu
*/
require_once('shirt.php');

// Handle Update submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_shirt"])) {
    $id          = intval($_POST["shirtID"]);
    $code        = trim(htmlspecialchars($_POST["shirtCode"]));
    $name        = trim(htmlspecialchars($_POST["shirtName"]));
    $description = trim(htmlspecialchars($_POST["shirtDescription"]));
    $fabric      = trim(htmlspecialchars($_POST["fabricType"]));
    $fit         = trim(htmlspecialchars($_POST["fit"]));
    $shirtTypeID = $_POST["shirtTypeID"];
    $buyPrice    = floatval($_POST["buyPrice"]);
    $sellPrice   = floatval($_POST["sellPrice"]);

    $errors = [];
    if (empty($code))        $errors[] = "Shirt Code is required.";
    if (empty($name))        $errors[] = "Shirt Name is required.";
    if (empty($description)) $errors[] = "Description is required.";
    if (empty($fabric))      $errors[] = "Fabric Type is required.";
    if (empty($fit))         $errors[] = "Fit is required.";
    if ($buyPrice <= 0)      $errors[] = "Buy Price must be greater than 0.";
    if ($sellPrice <= 0)     $errors[] = "Sell Price must be greater than 0.";

    if (empty($errors)) {
        Shirt::updateShirtByID($id, $code, $name, $description, $fabric, $fit, $shirtTypeID, $buyPrice, $sellPrice);
        echo "<p style='color:green;'>Shirt updated successfully.</p>";
    } else {
        foreach ($errors as $e) echo "<p style='color:red;'>$e</p>";
    }
}

// Handle Delete submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_shirt"])) {
    $id = intval($_POST["shirtID"]);
    Shirt::deleteShirt($id);
    echo "<p style='color:green;'>Shirt deleted successfully.</p>";
}

// Fetch AFTER any updates/deletes
$shirts = Shirt::getShirts();

if ($shirts) {
?>
    <h2>List Shirts</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>Shirt ID</th>
            <th>Code</th>
            <th>Name</th>
            <th>Description</th>
            <th>Fabric</th>
            <th>Fit</th>
            <th>Type ID</th>
            <th>Buy Price</th>
            <th>Sell Price</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($shirts as $shirt) { ?>
        <tr>
            <td><?= $shirt->shirtID ?></td>
            <td><?= $shirt->shirtCode ?></td>
            <td><?= $shirt->shirtName ?></td>
            <td><?= $shirt->shirtDescription ?></td>
            <td><?= $shirt->fabricType ?></td>
            <td><?= $shirt->fit ?></td>
            <td><?= $shirt->shirtTypeID ?></td>
            <td><?= $shirt->buyPrice ?></td>
            <td><?= $shirt->sellPrice ?></td>
            <td>
                <button onclick="viewShirt(
                    '<?= $shirt->shirtID ?>',
                    '<?= $shirt->shirtCode ?>',
                    '<?= $shirt->shirtName ?>',
                    '<?= addslashes($shirt->shirtDescription) ?>',
                    '<?= $shirt->fabricType ?>',
                    '<?= $shirt->fit ?>',
                    '<?= $shirt->shirtTypeID ?>',
                    '<?= $shirt->buyPrice ?>',
                    '<?= $shirt->sellPrice ?>'
                )">View</button>

                <button onclick="loadShirtUpdateForm(
                    '<?= $shirt->shirtID ?>',
                    '<?= $shirt->shirtCode ?>',
                    '<?= $shirt->shirtName ?>',
                    '<?= addslashes($shirt->shirtDescription) ?>',
                    '<?= $shirt->fabricType ?>',
                    '<?= $shirt->fit ?>',
                    '<?= $shirt->shirtTypeID ?>',
                    '<?= $shirt->buyPrice ?>',
                    '<?= $shirt->sellPrice ?>'
                )">Update</button>

                <button onclick="confirmShirtDelete(
                    '<?= $shirt->shirtID ?>'
                )">Delete</button>
            </td>
        </tr>
        <?php } ?>
    </table>

    <!-- VIEW display area -->
    <div id="viewShirtDiv" style="display:none; border:1px solid #e0e0e0; padding:20px; margin-top:20px; border-radius:8px; background:#ffffff; box-shadow:0 2px 8px rgba(0,0,0,0.06);">
        <h3>View Shirt</h3>
        <p><strong>ID:</strong> <span id="viewShirtID"></span></p>
        <p><strong>Code:</strong> <span id="viewShirtCode"></span></p>
        <p><strong>Name:</strong> <span id="viewShirtName"></span></p>
        <p><strong>Description:</strong> <span id="viewShirtDesc"></span></p>
        <p><strong>Fabric:</strong> <span id="viewShirtFabric"></span></p>
        <p><strong>Fit:</strong> <span id="viewShirtFit"></span></p>
        <p><strong>Type ID:</strong> <span id="viewShirtTypeID"></span></p>
        <p><strong>Buy Price:</strong> <span id="viewShirtBuy"></span></p>
        <p><strong>Sell Price:</strong> <span id="viewShirtSell"></span></p>
        <button onclick="document.getElementById('viewShirtDiv').style.display='none'">Close</button>
    </div>

    <!-- UPDATE form area -->
    <div id="updateShirtDiv" style="display:none; border:1px solid #e0e0e0; padding:20px; margin-top:20px; border-radius:8px; background:#ffffff; box-shadow:0 2px 8px rgba(0,0,0,0.06);">
        <h3>Update Shirt</h3>
        <form method="POST">
            <input type="hidden" name="shirtID" id="updateShirtID">

            <label>Shirt Code:</label>
            <input type="text" name="shirtCode" id="updateShirtCode">
            <span id="codeError" style="color:red; font-size:12px;"></span>

            <label>Shirt Name:</label>
            <input type="text" name="shirtName" id="updateShirtName">
            <span id="nameError" style="color:red; font-size:12px;"></span>

            <label>Description:</label>
            <input type="text" name="shirtDescription" id="updateShirtDesc">
            <span id="descError" style="color:red; font-size:12px;"></span>

            <label>Fabric Type:</label>
            <input type="text" name="fabricType" id="updateShirtFabric">
            <span id="fabricError" style="color:red; font-size:12px;"></span>

            <label>Fit:</label>
            <input type="text" name="fit" id="updateShirtFit">
            <span id="fitError" style="color:red; font-size:12px;"></span>

            <label>Shirt Type ID:</label>
            <input type="text" name="shirtTypeID" id="updateShirtTypeID">

            <label>Buy Price:</label>
            <input type="number" step="0.01" name="buyPrice" id="updateShirtBuy">
            <span id="buyError" style="color:red; font-size:12px;"></span>

            <label>Sell Price:</label>
            <input type="number" step="0.01" name="sellPrice" id="updateShirtSell">
            <span id="sellError" style="color:red; font-size:12px;"></span>

            <button type="button" onclick="validateAndSubmitShirtUpdate()">Submit Update</button>
            <button type="button" onclick="document.getElementById('updateShirtDiv').style.display='none'">Cancel</button>
            <input type="hidden" name="update_shirt" value="1">
        </form>
    </div>

    <!-- DELETE hidden form -->
    <form id="deleteShirtForm" method="POST" style="display:none;">
        <input type="hidden" name="shirtID" id="deleteShirtID">
        <input type="hidden" name="delete_shirt" value="1">
    </form>

<?php
} else {
    echo "<h2>No shirts found.</h2>";
}
?>

<script>
function viewShirt(id, code, name, desc, fabric, fit, typeID, buy, sell) {
    document.getElementById('viewShirtID').innerText = id;
    document.getElementById('viewShirtCode').innerText = code;
    document.getElementById('viewShirtName').innerText = name;
    document.getElementById('viewShirtDesc').innerText = desc;
    document.getElementById('viewShirtFabric').innerText = fabric;
    document.getElementById('viewShirtFit').innerText = fit;
    document.getElementById('viewShirtTypeID').innerText = typeID;
    document.getElementById('viewShirtBuy').innerText = buy;
    document.getElementById('viewShirtSell').innerText = sell;
    document.getElementById('viewShirtDiv').style.display = 'block';
    document.getElementById('updateShirtDiv').style.display = 'none';
}

function loadShirtUpdateForm(id, code, name, desc, fabric, fit, typeID, buy, sell) {
    document.getElementById('updateShirtID').value = id;
    document.getElementById('updateShirtCode').value = code;
    document.getElementById('updateShirtName').value = name;
    document.getElementById('updateShirtDesc').value = desc;
    document.getElementById('updateShirtFabric').value = fabric;
    document.getElementById('updateShirtFit').value = fit;
    document.getElementById('updateShirtTypeID').value = typeID;
    document.getElementById('updateShirtBuy').value = buy;
    document.getElementById('updateShirtSell').value = sell;
    document.getElementById('updateShirtDiv').style.display = 'block';
    document.getElementById('viewShirtDiv').style.display = 'none';
}

function validateAndSubmitShirtUpdate() {
    let valid = true;

    document.getElementById('codeError').innerText = '';
    document.getElementById('nameError').innerText = '';
    document.getElementById('descError').innerText = '';
    document.getElementById('fabricError').innerText = '';
    document.getElementById('fitError').innerText = '';
    document.getElementById('buyError').innerText = '';
    document.getElementById('sellError').innerText = '';

    const code   = document.getElementById('updateShirtCode').value.trim();
    const name   = document.getElementById('updateShirtName').value.trim();
    const desc   = document.getElementById('updateShirtDesc').value.trim();
    const fabric = document.getElementById('updateShirtFabric').value.trim();
    const fit    = document.getElementById('updateShirtFit').value.trim();
    const buy    = parseFloat(document.getElementById('updateShirtBuy').value);
    const sell   = parseFloat(document.getElementById('updateShirtSell').value);

    if (code === '') {
        document.getElementById('codeError').innerText = 'Shirt Code is required.';
        valid = false;
    }
    if (name === '') {
        document.getElementById('nameError').innerText = 'Shirt Name is required.';
        valid = false;
    }
    if (desc === '') {
        document.getElementById('descError').innerText = 'Description is required.';
        valid = false;
    }
    if (fabric === '') {
        document.getElementById('fabricError').innerText = 'Fabric Type is required.';
        valid = false;
    }
    if (fit === '') {
        document.getElementById('fitError').innerText = 'Fit is required.';
        valid = false;
    }
    if (isNaN(buy) || buy <= 0) {
        document.getElementById('buyError').innerText = 'Buy Price must be greater than 0.';
        valid = false;
    }
    if (isNaN(sell) || sell <= 0) {
        document.getElementById('sellError').innerText = 'Sell Price must be greater than 0.';
        valid = false;
    }

    if (valid) {
        document.querySelector('#updateShirtDiv form').submit();
    }
}

function confirmShirtDelete(id) {
    if (confirm("Are you sure you want to delete this shirt?")) {
        document.getElementById('deleteShirtID').value = id;
        document.getElementById('deleteShirtForm').submit();
    }
}
</script>