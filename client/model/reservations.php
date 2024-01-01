<?php

// Function to get all Reservations from all members from table reservations
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
