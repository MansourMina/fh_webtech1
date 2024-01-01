<?php
include_once 'config/dbaccess.php';

// Function to get all rows from table news
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

// Function to change the publish status of specific news (online, offline)
function changePublishStatus($news_id, $status)
{
    $sql = "UPDATE news SET `status` = ? where news_id = ? ";
    $stmt = db->prepare($sql);
    $stmt->bind_param("ii", $status, $news_id);
    $stmt->execute();
    return $stmt;
}
