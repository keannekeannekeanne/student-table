

<?php
require "connect.php";
$func_name = $_POST['func_name'] ?? "SaveRecord";

if (function_exists($func_name)) {
    $func_name();
}




function GetStudent()
{
    try {
        $pdo = Database::letsconnect();
        $sql = "select * from tbstuden";
        $record = Database::GetAllData($pdo, $sql);
        echo json_encode($record);
    } catch (Exception $e) {
        echo  "Error: "  . $e->getMessage();
    }
}



function SaveRecord()
{
    $pdo = Database::letsconnect();
    $studentNo = $_POST['studentNo'] ?? '1000';
    $firstName = $_POST['firstName'] ?? 'Ana';
    $lastName = $_POST['lastName'] ?? 'Castor';
    $middleName = $_POST['middleName'] ?? 'Go';
    $sectionCode = $_POST['sectionCode'] ?? 'Go';

    $sql = "INSERT INTO tbstudent
        (StudentNumber, FirstName, LastName, MiddleName,SectionCode)
        VALUES ('$studentNo', '$firstName', '$lastName', '$middleName', '$sectionCode')
        ON DUPLICATE KEY UPDATE
            FirstName = VALUES(FirstName),
            LastName = VALUES(LastName),
            SectionCode = VALUES(SectionCode),
            MiddleName = VALUES(MiddleName)";

    Database::ManageRecord($pdo, $sql);
}

// DeleteRecord();
function DeleteRecord()
{
    $pdo = Database::letsconnect();
    $studentNo = $_POST['studentNumber'] ?? 'STUD-001';
    $query = "DELETE FROM tbstudent WHERE StudentNumber = '$studentNo'";
    Database::ManageRecord($pdo, $query);
   
}


function  AutoNumbdering()
{
    $pdo = Database::letsconnect();

    $sql = "SELECT StudentNumber
        FROM tbstudent
        ORDER BY StudentNumber DESC
        LIMIT 1";

    $stmt = $pdo->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $lastNo = (int)substr($row['StudentNumber'], 5);
        $lastNo++;
    } else {
        $lastNo = 1;
    }

    $studentNumber = "STUD-" . str_pad($lastNo, 3, "0", STR_PAD_LEFT);

    echo $studentNumber;
}
