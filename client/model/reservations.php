<?php

// Function to get all Reservations from all members from table reservations
function getMembersReservations()
{
    $sql = "SELECT * FROM reservations join members using(member_id) join reservations_rooms using(reservation_id) join rooms using(room_id) order by check_in_date";
    $stmt = db->prepare($sql);
    $stmt->execute();
    $res = $stmt->get_result();
    $creds = array();
    while (($row = $res->fetch_assoc()) !== null) {
        $creds[] = $row;
    }
    return $creds;
}

function getMemberReservation($member_id)
{
    $sql = "SELECT * FROM reservations join members using(member_id) join reservations_rooms using(reservation_id) join rooms using(room_id) where member_id = ? order by check_in_date";
    $stmt = db->prepare($sql);
    $stmt->bind_param("i", $member_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $creds = array();
    while (($row = $res->fetch_assoc()) !== null) {
        $creds[] = $row;
    }
    return $creds;
}

function getReservation($verification_code)
{
    $sql = "SELECT * FROM reservations join members using(member_id) join reservations_rooms using(reservation_id) join rooms using(room_id) where verification_code = ? ";
    $stmt = db->prepare($sql);
    $stmt->bind_param("s", $verification_code);
    $stmt->execute();
    $res = $stmt->get_result();
    $creds = array();
    while (($row = $res->fetch_assoc()) !== null) {
        $creds[] = $row;
    }
    return $creds[0];
}

function cancelReservation($reservation_id, $status)
{
    $sql = "UPDATE reservations SET `status` = ? where reservation_id = ? ";
    $stmt = db->prepare($sql);
    $stmt->bind_param("ii", $status, $reservation_id);
    $stmt->execute();
    return $stmt;
}

function getRoomTypes()
{
    $sql = "SELECT * FROM rooms";
    $stmt = db->prepare($sql);
    $stmt->execute();
    $res = $stmt->get_result();
    $creds = array();
    while (($row = $res->fetch_assoc()) !== null) {
        $creds[] = $row;
    }
    return $creds;
}
