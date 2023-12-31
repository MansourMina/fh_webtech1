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

function changePublishStatus($news_id, $status)
{
    $sql = "UPDATE news SET `status` = ? where news_id = ? ";
    $stmt = db->prepare($sql);
    $stmt->bind_param("ii", $status, $news_id);
    $stmt->execute();
    return $stmt;
}
