<?php

include_once 'config/dbaccess.php';

// Get all rows from members table and return them as an array
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

// Function to insert a new member into the members table 
function registerMember($firstname, $lastname, $email, $phone_number,  $hashedPassword,  $account_created, $date_of_birth)
{
    $sql = "INSERT INTO members(firstname, lastname, email, phone_number, `password`, account_created, date_of_birth) "
        . "VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = db->prepare($sql);
    $stmt->bind_param("sssssss", $firstname, $lastname, $email, $phone_number,  $hashedPassword,  $account_created, $date_of_birth);
    $stmt->execute();
    return $stmt;
}

// Function to return a member from the members table based on the specified attribute (email, member_id)
function getMemberByAttribute($attribute, $value, $param)
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

// Function to update member profile in the members table
function updateProfile($attributes, $member_id)
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
    $values[] = $member_id;

    // Remove the last comma before the WHERE clause
    $sql = rtrim(trim($sql), ', ') . " WHERE member_id = ?";
    $stmt = db->prepare($sql);
    $stmt->bind_param($params, ...$values);
    $stmt->execute();
    return $stmt;
}

// Function to get role from current logged member (0: Not logged in, 1: Regular user, 2: Admin)
function getRole()
{
    if (isset($_SESSION["member_id"])) {
        if ($_SESSION["is_admin"] == 1) return 2;
        else return 1;
    }
    return 0;
}

// Function to change the login status of specific member (activate, deactivate)
function changeMemberLogin($member_id, $status)
{
    $sql = "UPDATE members SET is_active = ? where member_id = ? ";
    $stmt = db->prepare($sql);
    $stmt->bind_param("ii", $status, $member_id);
    $stmt->execute();
    return $stmt;
}
