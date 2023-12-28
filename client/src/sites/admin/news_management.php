<?php
include_once 'model/news.php';

$news = getNews();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .tab-content>div {
            display: none;
        }

        /* Zeige den aktiven Tab-Inhalt */
        .tab-content>div:target {
            display: block;
        }

        li .active {
            color: white !important;

            background-color: #212529 !important;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <ul class="nav nav-tabs" id="myTabs">
            <li class="nav-item">
                <a class="nav-link active" id="list-manager-list" data-bs-toggle="tab" href="#list-manager" role="tab" aria-controls="list-manager">Manager</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="list-news-list" data-bs-toggle="tab" href="#list-news" role="tab" aria-controls="list-news">Add News</a>
            </li>

        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="list-manager" role="tabpanel" aria-labelledby="list-manager-list">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Added by</th>
                            <th scope="col">content</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($news as $current_news) : ?>
                            <tr class="<?= $i % 2 == 0  ? "table-active" : "" ?>">
                                <th scope="row"><?= $i ?></th>
                                <td><?= $current_news["title"] ?></td>
                                <td><?= $current_news["news_id"] ?></td>
                                <td><?= $current_news["content"] ?></td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="list-news" role="tabpanel" aria-labelledby="list-news-list">...</div>

        </div>
    </div>

</body>

</html>