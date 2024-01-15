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

function generateRandomString($length)
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}

function bookReservation($room, $checkin, $checkout, $nadults, $nchildren, $breakfast_checked, $parking_checked, $pet_checked, $special_requests, $payment_summary, $date)
{
    $sql = "INSERT INTO reservations(check_in_date, check_out_date, total_price, special_request, member_id, status, verification_code, breakfast, parking, pet, adults, children, reservation_date) "
        . "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = db->prepare($sql);
    $status = 0;
    $verification_code = generateRandomString(6);
    $stmt->bind_param("ssisiisiiisss", $checkin, $checkout, $payment_summary, $special_requests, $_SESSION['member_id'], $status, $verification_code,  $breakfast_checked, $parking_checked, $pet_checked, $nadults, $nchildren, $date);
    $stmt->execute();

    $sql = "SELECT reservation_id FROM reservations where verification_code = ? ";
    $stmt = db->prepare($sql);
    $stmt->bind_param("s", $verification_code);
    $stmt->execute();
    $res = $stmt->get_result();
    $reservation = array();
    while (($row = $res->fetch_assoc()) !== null) {
        $reservation[] = $row;
    }
    $sql = "SELECT room_id FROM rooms where room_type = ? ";
    $stmt = db->prepare($sql);
    $stmt->bind_param("s", $room);
    $stmt->execute();
    $res = $stmt->get_result();
    $rooms = array();
    while (($row = $res->fetch_assoc()) !== null) {
        $rooms[] = $row;
    }

    $sql = "INSERT INTO reservations_rooms(reservation_id, room_id) "
        . "VALUES (?, ?)";
    $stmt = db->prepare($sql);
    $status = 0;
    $stmt->bind_param("ii", $reservation[0]['reservation_id'], $rooms[0]['room_id']);
    $stmt->execute();
    return $stmt;
}
