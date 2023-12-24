<?php

include 'config/dbaccess.php';

function getMembersCred()
{
    $sql = "SELECT * FROM members";
    $stmt = db->prepare($sql);
    $stmt->execute();
    $res = $stmt->get_result();
    $creds = array();
    while (($row = $res->fetch_assoc()) !== null) {
        $creds[] = $row;
    }
    return $creds;
}

function registerUser($firstname, $lastname, $email, $phone_number,  $hashedPassword,  $account_created)
{
    $sql = "INSERT INTO members(firstname, lastname, email, phone_number, `password`, account_created) "
        . "VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = db->prepare($sql);
    $stmt->bind_param("ssssss", $firstname, $lastname, $email, $phone_number,  $hashedPassword,  $account_created);
    $stmt->execute();
    return $stmt;
}

function getUserByAttribute($attribute, $value, $param)
{
    $sql = "SELECT * FROM members where $attribute = ?";
    $stmt = db->prepare($sql);
    $stmt->bind_param($param, $value);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = NULL;
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
    }
    return $row;
}


function updateProfile($attributes)
{
    $sql = "UPDATE members SET ";
    $params = "";
    $values = array();
    foreach ($attributes as $attribute => $value) {
        $sql .= "$attribute = ?, ";
        $params .= "s";
        $values[] = $value;
    }
    $params .= "i";
    $values[] = $_SESSION["member_id"];

    //Löscht den letzten Beistrich vor der Where klausel
    $sql = rtrim(trim($sql), ', ') . " WHERE member_id = ?";
    $stmt = db->prepare($sql);
    $stmt->bind_param($params, ...$values);
    $stmt->execute();
    return $stmt; 
}

function getRole(){
    if(isset($_SESSION["member_id"])){
        if($_SESSION["is_admin"] == 1) return 2;
        else return 1;
    }
    return 0;
}

function getMembersReservations()
{
    $sql = "SELECT * FROM reservations join members using(member_id)";
    $stmt = db->prepare($sql);
    $stmt->execute();
    $res = $stmt->get_result();
    $creds = array();
    while (($row = $res->fetch_assoc()) !== null) {
        $creds[] = $row;
    }
    return $creds;
}

function getMembersprofile()
{
    $sql = "SELECT * FROM members";
    $stmt = db->prepare($sql);
    $stmt->execute();
    $res = $stmt->get_result();
    $creds = array();
    while (($row = $res->fetch_assoc()) !== null) {
        $creds[] = $row;
    }
    return $creds;
}
