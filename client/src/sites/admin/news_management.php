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

        .tab .active {
            color: white !important;
            background-color: #212529 !important;
        }

        .nav-link {
            color: black;
        }

        .nav-link:hover {
            color: #15736b;
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

                    $('#myDataTable_filter input').attr('placeholder', 'Search');
                }
            });
        });
    </script>
</head>

<body>
    <div class="container-fluid p-5">

        <ul class="nav nav-tabs" id="myTabs">
            <li class="nav-item tab">
                <a class="nav-link active" id="list-manager-list" data-bs-toggle="tab" href="#list-manager" role="tab" aria-controls="list-manager">Manager</a>
            </li>
            <li class="nav-item tab">
                <a class="nav-link" id="list-news-list" data-bs-toggle="tab" href="#list-news" role="tab" aria-controls="list-news">Add News</a>
            </li>
            <!-- <li class="ms-auto ">
                <a class="nav-link" href="#list-news"><i class="fa fa-download"></i> Download reservations</a>
            </li> -->


        </ul>

        <div class="tab-content my-4">
            <div class="tab-pane fade show active" id="list-manager" role="tabpanel" aria-labelledby="list-manager-list">
                <table class="table" id="myDataTable">
                    <thead>
                        <tr>
                            <th class="col-1">#</th>
                            <th class="col-1">Image</th>
                            <th class="col-1">Category</th>
                            <th class="col-2">Title</th>
                            <th class="col-1">Date</th>
                            <th class="col-5">Content</th>
                            <th class="col-1">Publish status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($news as $current_news) : ?>

                            <tr onclick="openModal('exampleModal<?= $i ?>')" style="cursor: pointer;">

                                <th scope="row"><?= $i ?></th>
                                <th><img src="<?= $current_news["image"] ?>" width="100" class="datatable-image"></th>
                                <td><?= $current_news["category"] ?></td>
                                <td><?= $current_news["title"] . " " . ($current_news["news_of_the_day"] == 1 ? "(News of the day)" : "") ?></td>
                                <td><?= $current_news["date"] ?></td>
                                <td class="overflow-hidden" style="white-space: nowrap; text-overflow: ellipsis; max-width: 300px;">
                                    <?= $current_news["content"] ?>
                                </td>
                                <td><?= $current_news["status"] ?></td>
                            </tr>
                            <div class="modal" id="exampleModal<?= $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><?= $current_news["title"] ?></h5>
                                            <?php if ($current_news["news_of_the_day"]) : ?>
                                                <span class="badge text-bg-success ms-2">News of the day</span>
                                            <?php endif; ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="<?= $current_news["image"] ?>" width="100" class="datatable-image">

                                            <p>
                                                <?= $current_news["content"] ?>
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $i++; ?>

                        <?php endforeach; ?>

                    </tbody>

                </table>
            </div>
            <div class="tab-pane fade" id="list-news" role="tabpanel" aria-labelledby="list-news-list">...</div>

        </div>


    </div>

    <script>
        function openModal(id) {
            var modal = new bootstrap.Modal(document.getElementById(id));
            modal.show();
        }
    </script>
</body>

</html>