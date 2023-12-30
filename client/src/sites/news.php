<?php
include_once 'model/news.php';

$all_news = getNews();
$news_of_the_day = "";
$news = array();
$news_folder = "src/images/news";

foreach ($all_news as $current_news) {
    if ($current_news["news_of_the_day"]) {
        $news_of_the_day = $current_news;
    } else {
        $news[] = $current_news;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        .category {
            color: #15736b
        }
    </style>
</head>

<body>
    <div class="container">
        <section class="border-bottom pb-4 mb-5">
            <div class="row gx-5">
                <div class="col-md-6 mb-4">
                    <div class="bg-image   " >
                        <img src="<?= $news_folder . "/" . $news_of_the_day['image'] ?>" class="img-fluid" alt="Hotel from outside">
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <span class="badge  px-2 py-1 shadow-1-strong mb-3" style="background-color: #15736b">News of the day</span>
                    <h4 class="fw-bold"><?= $news_of_the_day["title"] ?></h4>
                    <p class="text-muted">
                        <?= $news_of_the_day["content"] ?>
                    </p>
                </div>
            </div>
        </section>

        <section>
            <div class="row gx-lg-5">
                <?php foreach ($news as $current_news) : ?>
                    <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                        <div>
                            <div class="bg-image mb-4" >
                                <img src="<?= $news_folder . "/" . $current_news['image'] ?>" class="img-fluid" style="min-height: 32vh" />

                            </div>

                            <div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <p class="category"><?= $current_news["category"] ?></p>
                                    </div>

                                    <div class="col-6 text-end">
                                        <?= $current_news["date"] ?>
                                    </div>
                                </div>

                                <div>
                                    <h5 class="mb-4"> <?= $current_news["title"] ?></h5>
                                    <p>
                                        <?= nl2br($current_news["content"]) ?></p>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>


            </div>
        </section>
    </div>
</body>

</html>