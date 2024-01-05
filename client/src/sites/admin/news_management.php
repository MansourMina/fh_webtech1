<?php
include_once 'model/news.php';
$publishStatus = null;
$news_id = null;
$news = getNews();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $news_id = isset($_POST['news_id']) ? $_POST['news_id'] : null;
    if (isset($_POST['publishStatus'])) {
        $publishStatus = $_POST['publishStatus'] == 1 ? 0 : 1;
    }
    $stmt = changePublishStatus($news_id, $publishStatus);
    if ($stmt) {
        header("Location: ?news-management");
        exit;
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin News Management - Effectively manage the news of the hotel">
    <style>
        .tab-content>div {
            display: none;
        }

        /* Zeige den aktiven Tab-Inhalt */
        .tab-content>div:target {
            display: block;
        }

        .tab .active {
            color: white !important;
            background-color: #212529 !important;
        }

        .news-tab {
            color: <?= $GLOBALS["darkMode"] ? "white" : "black" ?>;
        }

        .news-tab:hover {
            color: <?= $GLOBALS["darkMode"] ? 'white' : '#15736b' ?>;
        }

        .datatable-image {
            max-width: 100%;
            max-height: 100%;
        }

        /* Styling von Bootstrap genommen - für das Standard Input von Jquery */
        .dataTables_filter input {
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: var(--bs-body-color);
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-color: var(--bs-body-bg);
            background-clip: padding-box;
            border: var(--bs-border-width) solid var(--bs-border-color);
            border-radius: var(--bs-border-radius);
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }


        .form-switch .form-check-input:focus {
            border-color: rgba(0, 0, 0, 0.25);
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
        }

        .form-switch .form-check-input:checked {
            background-color: <?= $GLOBALS["darkMode"] ? 'white' : '#15736b' ?>;
            border-color: <?= $GLOBALS["darkMode"] ? 'white' : '#15736b' ?>;
        }



        .dark-overlay {
            position: relative;
        }

        table tbody td {
            vertical-align: middle;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- DataTables CSS und JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                "language": {
                    "search": ""
                },
                "initComplete": function() {

                    $('#myDataTable_filter input').attr('placeholder', 'Search news');
                    $('#myDataTable_filter input').attr('id', 'searchNews');
                    $('#myDataTable_info').css('color', '<?= $GLOBALS["darkMode"] ? "white" : "black" ?>');
                    $('#myDataTable_length').css('color', '<?= $GLOBALS["darkMode"] ? "white" : "black" ?>');
                }
            });
        });
    </script>
</head>

<body>
    <div class="container-fluid p-5 ">

        <ul class="nav nav-tabs" id="myTabs">
            <li class="nav-item tab">
                <a class="nav-link active news-tab" id="list-manager-list" data-bs-toggle="tab" href="#list-manager" role="tab" aria-controls="list-manager">Manager</a>
            </li>
            <li class="nav-item tab">
                <a class="nav-link news-tab" id="list-news-list" data-bs-toggle="tab" href="#list-news" role="tab" aria-controls="list-news">Add News</a>
            </li>
            <!-- <li class="ms-auto ">
                <a class="nav-link" href="#list-news"><i class="fa fa-download"></i> Download reservations</a>
            </li> -->


        </ul>

        <div class="tab-content my-4">
            <div class="tab-pane fade show active " id="list-manager" role="tabpanel" aria-labelledby="list-manager-list">
                <table class="table " id="myDataTable">
                    <thead>
                        <tr>
                            <th class="col-1 ">#</th>
                            <th class="col-1">Image</th>
                            <th class="col-1">Category</th>
                            <th class="col-2">Title</th>
                            <th class="col-1">Date</th>
                            <th class="col-5">Content</th>
                            <th class="col-1 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 1;
                        foreach ($news as $current_news) : ?>

                            <tr class="<?= $current_news["status"] == 0 ? 'table-' . ($GLOBALS["darkMode"] ? "active" : "secondary") . ' fw-light' : '' ?>">
                                <td scope="row">
                                    <div class="d-flex align-items-center <?= $current_news["status"] ? 'fw-bold' : 'fw-light' ?>"><?= $i ?> <i data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="mf-tooltip" data-bs-title="Preview" style="cursor: pointer;" class="fa fa-eye fa-lg ms-5 mt-1" onclick="openModal('newsModal<?= $i ?>')"></i></div>
                                </td>
                                <th>
                                    <div class="<?= $current_news["status"] == 0 ? 'dark-overlay drk' : '' ?>"><img src="<?= $current_news["image"] ?>" class="datatable-image "></div>
                                </th>
                                <td><?= $current_news["category"] ?></td>
                                <td>
                                    <?= $current_news["title"] ?>
                                    <?php if ($current_news["news_of_the_day"]) : ?>
                                        <span class="badge text-bg-<?= $current_news["status"] == 0 ? 'secondary' : 'success' ?>">News of the day</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= $current_news["date"] ?></td>
                                <td class="overflow-hidden " style="white-space: nowrap; text-overflow: ellipsis; max-width: 300px;">
                                    <?= $current_news["content"] ?>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <form action="<?= $_SERVER['REQUEST_URI'] ?>" name=" test" method="post" id="publishStatusForm_<?= $current_news['news_id'] ?>">
                                            <input type="hidden" name="news_id" value="<?= $current_news['news_id'] ?>">
                                            <div class="form-check form-switch ">
                                                <input class="form-check-input" name="publishStatus" type="checkbox" role="switch" onchange="submitForm('publishStatusForm_<?= $current_news['news_id'] ?>')" id="switch<?= $i ?>" <?= $current_news["status"] ? 'checked' : '' ?>>
                                            </div>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                            <div class="modal" id="newsModal<?= $i ?>" tabindex="-1" aria-labelledby="newsModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header ">
                                            <i data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="mf-tooltip" data-bs-title="Published by <?= $current_news["firstname"] . " " . $current_news["lastname"] ?>" class="<?= $current_news["status"] ? 'text-success' : 'text-danger' ?> fa fa-globe fa-lg me-5"></i>

                                            <?php if ($current_news["news_of_the_day"]) : ?>
                                                <span class="badge text-bg-<?= $current_news["status"] == 0 ? 'secondary' : 'success' ?>">News of the day</span>
                                            <?php endif; ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                <div class="bg-image mb-4">
                                                    <img src="<?= $current_news['image'] ?>" class="img-fluid" />

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
                                                        <p>
                                                            <!-- nl2br übernimmt die newLines von den Daten der Datenbank -->
                                                            <?= nl2br($current_news["content"]) ?>
                                                        </p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <?php $i++; ?>

                        <?php endforeach; ?>

                    </tbody>

                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="list-news" role="tabpanel" aria-labelledby="list-news-list">...</div>

    </div>


    </div>

    <script>
        function openModal(id) {
            var modal = new bootstrap.Modal(document.getElementById(id));
            modal.show();
        }

        function submitForm(formId) {
            document.getElementById(formId).submit();
        }
    </script>
    </script>
</body>

</html>