<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Shirt Inventory Website</title>
</head>
<body>
    <section>
        <main>
            <?php
                if (isset($_REQUEST['content'])) {
                    include($_REQUEST['content'] . ".inc.php");
                } else {
                    include("main.inc.php");
                }
            ?>
        </main>
    </section>
</body>
</html>