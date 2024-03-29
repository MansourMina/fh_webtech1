<?php
include_once 'model/news.php';

$all_news = getNews();
$news_of_the_day = "";
$news = array();


foreach ($all_news as $current_news) {
    if ($current_news["status"] == 1) {
        if ($current_news["news_of_the_day"]) {
            $news_of_the_day = $current_news;
        } else {
            $news[] = $current_news;
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Latest News about the MF Palmside Resort">
    <style>
        .image-container {
            max-height: 35vh;
            min-height: 35vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            margin-top: auto;
        }
    </style>
</head>

<body>
    <div class="container">

        <?php if ($news_of_the_day != null) : ?>
            <section class="border-bottom pb-4 mb-5">
                <div class="row gx-5  mx-0">
                    <div class="col-md-6 mb-4">
                        <div class="bg-image">
                            <img src=" <?= $news_of_the_day['image'] ?>" class="img-fluid " alt="Hotel from outside">
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <span class="badge px-2 py-1 mb-3 bg-success">News of the day</span>
                        <div class="row mb-1">
                            <div class="col-6">
                                <p class="category"><i class="fa fa-<?= getIcon($news_of_the_day['category']) ?>"></i> <?= $news_of_the_day["category"] ?></p>
                            </div>

                            <div class="col-6 text-end text-secondary">
                                <?= $news_of_the_day["date"] ?>
                            </div>
                        </div>
                        <h4 class="fw-bold"><?= $news_of_the_day["title"] ?></h4>
                        <p class="text-muted news_content">
                            <?= nl2br($news_of_the_day["content"]) ?>
                        </p>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <section>
            <div class="row gx-lg-5 mx-0">
                <?php foreach ($news as $current_news) : ?>
                    <div class="col-lg-<?= count($news) < 3 ? 6 : 4 ?> col-md-12 mb-<?= count($news) < 3 ? 0 : 5 ?>">
                        <div class=" mb-4 text-center image-container ">
                            <img src="<?= $current_news['image'] ?>" class="img-fluid " />
                        </div>

                        <div>
                            <div class="row mb-3">
                                <div class="col-6">


                                    <p class="category"><i class="fa fa-<?= getIcon($current_news['category']) ?>"></i> <?= $current_news["category"] ?></p>
                                </div>

                                <div class="col-6 text-end text-secondary">
                                    <?= $current_news["date"] ?>
                                </div>
                            </div>

                            <div>
                                <h5 class="mb-4 fw-bold"> <?= $current_news["title"] ?></h5>
                                <p class="text-muted news_content">
                                    <!-- nl2br übernimmt die newLines von den Daten der Datenbank -->
                                    <?= nl2br($current_news["content"]) ?>
                                </p>
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>


            </div>
        </section>


    </div>
    <script>

    </script>
</body>

</html>