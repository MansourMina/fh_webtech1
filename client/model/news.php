<?php
include_once 'config/dbaccess.php';

function getNews()
{
    $sql = "SELECT * FROM news";
    $stmt = db->prepare($sql);
    $stmt->execute();
    $res = $stmt->get_result();
    $news = array();
    while (($row = $res->fetch_assoc()) !== null) {
        $news[] = $row;
    }
    return $news;
}
