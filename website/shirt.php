<?php
/*
Name: Christian Guadalupe
Date: 02/24/2026
Course: IT-202-XXX Internet Applications
Assignment: Phase 5 - JavaScript
Email: cg546@njit.edu
*/
require_once('database.php');

class Shirt
{
    public $shirtID;
    public $shirtCode;
    public $shirtName;
    public $shirtDescription;
    public $fabricType;
    public $fit;
    public $shirtTypeID;
    public $buyPrice;
    public $sellPrice;

    function __construct(
        $shirtID,
        $shirtCode,
        $shirtName,
        $shirtDescription,
        $fabricType,
        $fit,
        $shirtTypeID,
        $buyPrice,
        $sellPrice
    ) {
        $this->shirtID = $shirtID;
        $this->shirtCode = $shirtCode;
        $this->shirtName = $shirtName;
        $this->shirtDescription = $shirtDescription;
        $this->fabricType = $fabricType;
        $this->fit = $fit;
        $this->shirtTypeID = $shirtTypeID;
        $this->buyPrice = $buyPrice;
        $this->sellPrice = $sellPrice;
    }

    static function findShirt($shirtID)
    {
        $db = getDB();
        $query = "SELECT * FROM shirts WHERE shirt_id = $shirtID";
        $result = $db->query($query);
        $row = $result->fetch_array(MYSQLI_ASSOC);

        if ($row) {
            $shirt = new Shirt(
                $row['shirt_id'],
                $row['shirt_code'],
                $row['shirt_name'],
                $row['shirt_description'],
                $row['fabric_type'],
                $row['fit'],
                $row['shirt_type_id'],
                $row['buy_price'],
                $row['sell_price']
            );
            $db->close();
            return $shirt;
        } else {
            $db->close();
            return NULL;
        }
    }

    static function getShirts()
    {
        $db = getDB();
        $query = "SELECT * FROM shirts";
        $result = $db->query($query);

        if ($result->num_rows > 0) {
            $shirts = array();
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $shirt = new Shirt(
                    $row['shirt_id'],
                    $row['shirt_code'],
                    $row['shirt_name'],
                    $row['shirt_description'],
                    $row['fabric_type'],
                    $row['fit'],
                    $row['shirt_type_id'],
                    $row['buy_price'],
                    $row['sell_price']
                );
                array_push($shirts, $shirt);
            }
            $db->close();
            return $shirts;
        } else {
            $db->close();
            return NULL;
        }
    }

    function saveShirt()
    {
        $db = getDB();

        $query = "INSERT INTO shirts
        (shirt_id, shirt_code, shirt_name, shirt_description, fabric_type, fit, shirt_type_id, buy_price, sell_price)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $db->prepare($query);
        if ($stmt == false) {
            echo "ERROR: " . $db->errno . " " . $db->error;
            $db->close();
            return false;
        }

        $shirtTypeID = empty($this->shirtTypeID) ? NULL : $this->shirtTypeID;

        $stmt->bind_param(
            "isssssidd",
            $this->shirtID,
            $this->shirtCode,
            $this->shirtName,
            $this->shirtDescription,
            $this->fabricType,
            $this->fit,
            $shirtTypeID,
            $this->buyPrice,
            $this->sellPrice
        );

        $result = $stmt->execute();
        $db->close();
        return $result;
    }

    function updateShirt()
    {
        $db = getDB();

        $query = "UPDATE shirts
            SET shirt_code = ?,
                shirt_name = ?,
                shirt_description = ?,
                fabric_type = ?,
                fit = ?,
                shirt_type_id = ?,
                buy_price = ?,
                sell_price = ?
            WHERE shirt_id = $this->shirtID";

        $stmt = $db->prepare($query);
        if ($stmt == false) {
            echo "ERROR: " . $db->errno . " " . $db->error;
            $db->close();
            return false;
        }

        $shirtTypeID = empty($this->shirtTypeID) ? NULL : $this->shirtTypeID;

        $stmt->bind_param(
            "sssssidd",
            $this->shirtCode,
            $this->shirtName,
            $this->shirtDescription,
            $this->fabricType,
            $this->fit,
            $shirtTypeID,
            $this->buyPrice,
            $this->sellPrice
        );

        $result = $stmt->execute();
        $db->close();
        return $result;
    }

    function removeShirt()
    {
        $db = getDB();
        $query = "DELETE FROM shirts WHERE shirt_id = $this->shirtID";
        $result = $db->query($query);
        $db->close();
        return $result;
    }

    // ✏️ UPDATE STATIC - called by listshirts.inc.php
    static function updateShirtByID($id, $code, $name, $description, $fabric, $fit, $shirtTypeID, $buyPrice, $sellPrice)
    {
        $db = getDB();

        $query = "UPDATE shirts
                  SET shirt_code = ?,
                      shirt_name = ?,
                      shirt_description = ?,
                      fabric_type = ?,
                      fit = ?,
                      shirt_type_id = ?,
                      buy_price = ?,
                      sell_price = ?
                  WHERE shirt_id = ?";

        $stmt = $db->prepare($query);
        if ($stmt == false) {
            echo "ERROR: " . $db->errno . " " . $db->error;
            $db->close();
            return false;
        }

        $shirtTypeID = empty($shirtTypeID) ? NULL : intval($shirtTypeID);

        $stmt->bind_param("sssssiddi",
            $code,
            $name,
            $description,
            $fabric,
            $fit,
            $shirtTypeID,
            $buyPrice,
            $sellPrice,
            $id
        );

        $result = $stmt->execute();
        $db->close();
        return $result;
    }

    // 🗑️ DELETE STATIC - called by listshirts.inc.php
    static function deleteShirt($id)
    {
        $db = getDB();

        $query = "DELETE FROM shirts WHERE shirt_id = ?";

        $stmt = $db->prepare($query);
        if ($stmt == false) {
            echo "ERROR: " . $db->errno . " " . $db->error;
            $db->close();
            return false;
        }

        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $db->close();
        return $result;
    }

    // 📊 TOTAL COUNT - called by realtime.php
    static function getTotalShirts()
    {
        $db = getDB();
        $query = "SELECT COUNT(shirt_id) FROM shirts";
        $result = $db->query($query);
        $row = $result->fetch_array();
        $db->close();
        if ($row) {
            return $row[0];
        } else {
            return NULL;
        }
    }

    // 📊 TOTAL BUY PRICE - called by realtime.php
    static function getTotalBuyPrice()
    {
        $db = getDB();
        $query = "SELECT SUM(buy_price) FROM shirts";
        $result = $db->query($query);
        $row = $result->fetch_array();
        $db->close();
        if ($row) {
            return $row[0];
        } else {
            return NULL;
        }
    }

    // 📊 TOTAL SELL PRICE - called by realtime.php
    static function getTotalSellPrice()
    {
        $db = getDB();
        $query = "SELECT SUM(sell_price) FROM shirts";
        $result = $db->query($query);
        $row = $result->fetch_array();
        $db->close();
        if ($row) {
            return $row[0];
        } else {
            return NULL;
        }
    }
}
?>