<?php
/*
Name: Christian Guadalupe
Date: 02/24/2026
Course: IT-202-XXX Internet Applications
Assignment: Phase 5 - JavaScript
Email: cg546@njit.edu
*/
require_once('database.php');

class ShirtType
{
    public $shirtTypeID;
    public $shirtTypeCode;
    public $shirtTypeName;
    public $shelfNumber;

    function __construct($shirtTypeID, $shirtTypeCode, $shirtTypeName, $shelfNumber)
    {
        $this->shirtTypeID = $shirtTypeID;
        $this->shirtTypeCode = $shirtTypeCode;
        $this->shirtTypeName = $shirtTypeName;
        $this->shelfNumber = $shelfNumber;
    }

    function __toString()
    {
        return "<h2>$this->shirtTypeID - $this->shirtTypeCode, $this->shirtTypeName (Shelf: $this->shelfNumber)</h2>\n";
    }

    static function findShirtType($shirtTypeID)
    {
        $db = getDB();
        $query = "SELECT * FROM shirt_types WHERE shirt_type_id = $shirtTypeID";
        $result = $db->query($query);
        $row = $result->fetch_array(MYSQLI_ASSOC);

        if ($row) {
            $shirttype = new ShirtType(
                $row['shirt_type_id'],
                $row['shirt_type_code'],
                $row['shirt_type_name'],
                $row['shelf_number']
            );
            $db->close();
            return $shirttype;
        } else {
            $db->close();
            return NULL;
        }
    }

    function saveShirtType()
    {
        $db = getDB();

        $query = "INSERT INTO shirt_types
                  (shirt_type_id, shirt_type_code, shirt_type_name, shelf_number)
                  VALUES (?, ?, ?, ?)";

        $stmt = $db->prepare($query);
        if ($stmt == false) {
            echo "ERROR: " . $db->errno . " " . $db->error;
            $db->close();
            return false;
        }

        $stmt->bind_param(
            "issi",
            $this->shirtTypeID,
            $this->shirtTypeCode,
            $this->shirtTypeName,
            $this->shelfNumber
        );

        $result = $stmt->execute();
        $db->close();
        return $result;
    }

    static function getShirtTypes()
    {
        $db = getDB();
        $query = "SELECT * FROM shirt_types";
        $result = $db->query($query);

        if ($result && mysqli_num_rows($result) > 0) {
            $shirttypes = array();

            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $shirttype = new ShirtType(
                    $row['shirt_type_id'],
                    $row['shirt_type_code'],
                    $row['shirt_type_name'],
                    $row['shelf_number']
                );
                array_push($shirttypes, $shirttype);
                unset($shirttype);
            }

            $db->close();
            return $shirttypes;
        } else {
            $db->close();
            return NULL;
        }
    }

    function updateShirtType()
    {
        $db = getDB();

        $query = "UPDATE shirt_types
                  SET shirt_type_code = ?, shirt_type_name = ?, shelf_number = ?
                  WHERE shirt_type_id = $this->shirtTypeID";

        $stmt = $db->prepare($query);
        if ($stmt == false) {
            echo "ERROR: " . $db->errno . " " . $db->error;
            $db->close();
            return false;
        }

        $stmt->bind_param(
            "ssi",
            $this->shirtTypeCode,
            $this->shirtTypeName,
            $this->shelfNumber
        );

        $result = $stmt->execute();
        $db->close();
        return $result;
    }

    // ✏️ UPDATE STATIC - called by listshirttypes.inc.php
    static function updateShirtTypeByID($id, $code, $name, $shelf)
    {
        $db = getDB();

        $query = "UPDATE shirt_types
                  SET shirt_type_code = ?, shirt_type_name = ?, shelf_number = ?
                  WHERE shirt_type_id = ?";

        $stmt = $db->prepare($query);
        if ($stmt == false) {
            echo "ERROR: " . $db->errno . " " . $db->error;
            $db->close();
            return false;
        }

        $stmt->bind_param("sssi", $code, $name, $shelf, $id);
        $result = $stmt->execute();
        $db->close();
        return $result;
    }

    function removeShirtType()
    {
        $db = getDB();
        $query = "DELETE FROM shirt_types WHERE shirt_type_id = $this->shirtTypeID";
        $result = $db->query($query);
        $db->close();
        return $result;
    }

    // 🗑️ DELETE STATIC - called by listshirttypes.inc.php
    static function deleteShirtType($id)
    {
        $db = getDB();

        $query = "DELETE FROM shirt_types WHERE shirt_type_id = ?";

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
    static function getTotalShirtTypes()
    {
        $db = getDB();
        $query = "SELECT COUNT(shirt_type_id) FROM shirt_types";
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