<?php
require "connect.php";
$func_name = $_POST['func_name'] ?? "xxx";
if (function_exists($func_name)) {
    $func_name();
}
/*
|--------------------------------------------------------------------------
| GetSection
|--------------------------------------------------------------------------
*/
function GetSection()
{
    try {
        $pdo = Database::letsconnect();
        $sql = "SELECT *
                FROM tbsection
                ORDER BY SectionCode ASC";
        $record = Database::GetAllData($pdo, $sql);
        echo json_encode($record);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
/*
|--------------------------------------------------------------------------
| SaveRecord
|--------------------------------------------------------------------------
*/

// SaveRecord();
function SaveRecord()
{
    try {
        $pdo = Database::letsconnect();
        $sectionCode =  $_POST['sectionCode'] ?? 'PPP';
        $sectionName = $_POST['sectionName'] ?? 'PPP';
        $sectionCode = trim($sectionCode);
        $sectionName = trim($sectionName);

        $sql = "INSERT INTO tbsection (SectionCode, SectionName)
                VALUES  ('$sectionCode', '$sectionName')
                ON DUPLICATE KEY UPDATE
                SectionName = VALUES(SectionName)";
        Database::ManageRecord($pdo, $sql);
        echo json_encode([
            "status" => "success",
            "message" => "Section saved successfully."
        ]);
    } catch (Exception $e) {
        echo json_encode([
            "status" => "error",
            "message" => $e->getMessage()
        ]);
    }
}
/*
|--------------------------------------------------------------------------
| DeleteRecord
|--------------------------------------------------------------------------
*/

// DeleteRecord();
function DeleteRecord()
{
    try {
        $pdo = Database::letsconnect();
        $sectionCode = $_POST['sectionCode'] ?? 'SEC-01';
        $sectionCode = trim($sectionCode);
        if ($sectionCode == '') {
            echo json_encode([
                "status" => "error",
                "message" => "Section Code is required."
            ]);
            return;
        }
        $sql = "DELETE FROM tbsection
                WHERE SectionCode = '$sectionCode'";
        Database::ManageRecord($pdo, $sql);
        echo json_encode([
            "status" => "success",
            "message" => "Section deleted successfully."
        ]);
    } catch (Exception $e) {
        echo json_encode([
            "status" => "error",
            "message" => $e->getMessage()
        ]);
    }
}


function SectionAutoNumbering()
{
    $pdo = Database::letsconnect();

    $sql = "SELECT SectionCode
            FROM tbsection
            ORDER BY SectionCode DESC
            LIMIT 1";

    $stmt = $pdo->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $lastNo = (int)substr($row['SectionCode'], 4);
        $lastNo++;
    } else {
        $lastNo = 1;
    }

    $sectionCode = "SEC-" . str_pad($lastNo, 2, "0", STR_PAD_LEFT);
    echo $sectionCode;
}
