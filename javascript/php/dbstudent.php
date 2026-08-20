<?php
require "connect.php";
$func_name = $_POST['func_name']?? "SaveRecord";

if(function_exists($func_name)){
    $func_name();
}

function GetStudentInput(){

try{
        $pdo = Database::letsconnect();
        $sql = "select * from student order by last_name";
        $record = Database::GetAllData($pdo, $sql);
        echo json_encode($record);
    }
    catch(Exception $e){
    }
}
function SaveRecord()
{
    $pdo = Database::letsconnect();

    $LRN = $_POST['LRN']?? 'User_0000';
    $first_name = $_POST['first_name'] ?? 'asdas';
    $middle_name = $_POST['middle_name'] ??'asdas' ;
    $last_name = $_POST['last_name'] ?? '#ffffff';
    $gender = $_POST['gender'] ?? 'asdas';
    $address = $_POST['address'] ?? 'asdas';
    $grade_level = $_POST['grade_level'] ?? 'asdas';
    $section = $_POST['section'] ?? 'asdas';
    $birthday = $_POST['birthday'] ?? 'asdas';
    $student_contact_no = $_POST['student_contact_no'] ?? 'asdas';
    $parent_contact_no = $_POST['parent_contact_no'] ?? 'asdas';


    $sql = "INSERT INTO student
        (LRN, first_name, middle_name, last_name, gender, address, grade_level, section, birthday, student_contact_no, parent_contact_no)
 VALUES ('$LRN', '$first_name', '$middle_name','$last_name', '$gender', '$address', '$grade_level', '$section', '$birthday', '$student_contact_no', '$parent_contact_no')
        ON DUPLICATE KEY UPDATE
            first_name = VALUES(first_name),
            middle_name =VALUES(middle_name),
            last_name = VALUES(last_name),
            gender = VALUES(gender),
            address = VALUES(address),
            grade_level = VALUES(grade_level),
            section = VALUES(section),
            birthday = VALUES(birthday),
            student_contact_no = VALUES(student_contact_no),
            parent_contact_no = VALUES(parent_contact_no)
        ";
    Database::ManageRecord($pdo, $sql);
    echo $sql;
}//LRN	first_name	middle_name	last_name	gender	address	grade_level	section	birthday	contact_no	parent_contact_no
/* */

function DeleteRecord()
{
    $pdo = Database::letsconnect();
    $LRN = $_POST['LRN'] ?? 'STUD-001';
    $query = "DELETE FROM student WHERE LRN = '$LRN'";
    Database::ManageRecord($pdo, $query);
}

// function  AutoNumbering()
// {
//     $pdo = Database::letsconnect();

//     $sql = "SELECT InputNum
//         FROM silpontable
//         ORDER BY InputNum DESC
//         LIMIT 1";

//     $stmt = $pdo->query($sql);
//     $row = $stmt->fetch(PDO::FETCH_ASSOC);

//     if ($row) {
//         $lastNo = (int)substr($row['InputNum'], 5);
//         $lastNo++;
//     } else {
//         $lastNo = 1;
//     }

//     $UserNum = "User_" . str_pad($lastNo, 4, "0", STR_PAD_LEFT);

//     echo $UserNum;
// }

function CheckStudent(){
    $pdo = Database::letsconnect();
    $LRN = $_POST['LRN']?? 'User_0000';
    $first_name = $_POST['first_name'] ?? 'asdas';
    $last_name = $_POST['last_name'] ?? 'asdas';
    $pin_number = $_POST['pin_number'] ?? '';
    try{
        $sql = "select * from student 
        where LRN = '$LRN' AND first_name = '$first_name' AND last_name = '$last_name' AND pin_number = '$pin_number'";
        $record = Database::GetAllData($pdo, $sql);
        echo json_encode($record);
    }catch(Exception $e){
        echo json_encode([]);
    }
}

function SetPin(){
    $pdo = Database::letsconnect();
    $LRN = $_POST['LRN'] ?? '';
    $pin_number = $_POST['pin_number'] ?? '';
    try{
        $sql = "UPDATE student SET pin_number = '$pin_number' WHERE LRN = '$LRN'";
        Database::ManageRecord($pdo, $sql);
        echo "1";
    }catch(Exception $e){
        echo "0";
    }
}