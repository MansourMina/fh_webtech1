<?php
include_once 'config/dbaccess.php';

// Function to get all rows from table news
function getNews()
{
    $sql = "SELECT news_id, n.image, category, content, `date`, news_of_the_day, `status`, title, firstname, lastname, member_id FROM news n LEFT join members using(member_id)";
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


// Function to insert a new member into the members table 
function addNews($news_title, $news_content, $news_image, $news_category)
{
    setNewsOfDayBack();
    $sql = "INSERT INTO news(title, content, category, `image`, `date`, news_of_the_day, `status`, member_id) "
        . "VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = db->prepare($sql);
    $news_date = date("Y-m-d");
    $news_of_the_day = 1;
    $status = 1;
    $stmt->bind_param("sssssiii", $news_title, $news_content, $news_category, $news_image,  $news_date,  $news_of_the_day, $status, $_SESSION['member_id']);
    $stmt->execute();
    return $stmt;
}

function setNewsOfDayBack()
{
    $sql = "UPDATE news SET `news_of_the_day` = ? ";
    $stmt = db->prepare($sql);
    $not_news_of_day = 0;
    $stmt->bind_param("i", $not_news_of_day);
    $stmt->execute();
}
