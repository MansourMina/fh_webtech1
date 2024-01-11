<?php
include_once 'model/news.php';
$publishStatus = null;
$news_id = null;
$news = getNews();
$news_title = "";
$news_content = "";
$news_image = "";
$news_category = "";
$errors = [];
if (isset($_POST['add_news'])) {
    $fields = [
        'news_title' => 'Title',
        'news_content' => 'News content',
        'news_image' => 'Image',
        'news_category' => 'Category',
    ];
    foreach ($fields as $field => $error) {
        if ($field == 'news_image') {
            $contentType = mime_content_type($_FILES["news_image"]["tmp_name"]);
            if (!($contentType === "image/jpeg" || $contentType === "image/png" || $contentType === "image/webp")) {
                $errors[$field] = "$error has an invalid file type!";
            }
        } else {
            $$field = isset($_POST[$field]) ? $_POST[$field] : "";
            if (empty($$field)) {
                $errors[$field] = "$error is required";
            }
        }
    }
    if (empty($errors)) {
        // Get image infos of the image the member wants to upload
        $info = pathinfo($_FILES["news_image"]["name"]);
        $news_image = "src/upload/news/" . uniqid() . "_img." . $info["extension"];
        // Resize the image by half
        $percent = 0.5;
        list($width, $height) = getimagesize($_FILES['news_image']['tmp_name']);
        $new_width = $width * $percent;
        $new_height = $height * $percent;
        $image_p = imagecreatetruecolor($new_width, $new_height);
        $contentType = mime_content_type($_FILES["news_image"]["tmp_name"]);
        if ($contentType === "image/jpeg") {
            $image = imagecreatefromjpeg($_FILES['news_image']['tmp_name']);
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        }
        imagejpeg($image_p, $news_image, 100);

        // Upload the wanted image
        move_uploaded_file($_FILES['news_image']['tmp_name'], $news_image);
        $stmt = addNews($news_title, $news_content, $news_image, $news_category);
        header("Location: ?news-management");
        exit;
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <style>
        .tab-content>div {
            display: none;
        }

        /* Zeige den aktiven Tab-Inhalt */
        .tab-content>div:target {
            display: block;
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
            background-color: <?= $GLOBALS["darkMode"] ? 'green' : '#15736b' ?>;
            border-color: <?= $GLOBALS["darkMode"] ? 'green' : '#15736b' ?>;
        }


        .paginate_button .current {
            color: red;
        }

        .dark-overlay {
            position: relative;
        }

        table tbody td {
            vertical-align: middle;
        }

        .editor-toolbar a {
            pointer-events: none;
            opacity: 0.5;
        }


        .CodeMirror .cm-spell-error:not(.cm-url):not(.cm-comment):not(.cm-tag):not(.cm-word) {
            background-color: transparent;
        }

        <?php if ($GLOBALS["darkMode"]) : ?>.cm-spell-error,

        .editor-toolbar a:before,
        .cm-formatting {
            color: white;
        }

        .editor-toolbar a.active {
            color: black;
            background-color: gray;
        }

        .CodeMirror {
            background-color: #212529;
        }


        <?php endif; ?>.editor-toolbar a.fa-bold,
        a.fa-italic,
        a.fa-list-ol {
            pointer-events: auto;
            opacity: 1;
            font-weight: bold;
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

<body onload="generateTitle()">
    <div class="container-fluid p-5 ">

        <ul class="nav nav-tabs" id="myTabs">
            <li class="nav-item tab">
                <a class="nav-link <?= count($errors) > 0 ? '' : 'active' ?>  news-tab" id="list-manager-list" data-bs-toggle="tab" href="#list-manager" role="tab" aria-controls="list-manager"><i class="fa fa-list me-2"></i>Manager</a>
            </li>
            <li class="nav-item tab <?= count($errors) > 0 ? '' : 'active' ?>">
                <a class="nav-link news-tab" id="list-news-list" data-bs-toggle="tab" href="#list-news" role="tab" aria-controls="list-news"><i class="fa fa-plus me-2"></i>Add News</a>
            </li>
            <!-- <li class="ms-auto ">
                <a class="nav-link" href="#list-news"><i class="fa fa-download"></i> Download reservations</a>
            </li> -->


        </ul>

        <div class="tab-content my-5">
            <div class="tab-pane fade <?= count($errors) > 0 ? '' : 'show active' ?> " id="list-manager" role="tabpanel" aria-labelledby="list-manager-list">
                <table class="table pt-4" id="myDataTable">
                    <thead>
                        <tr>
                            <th class="col-1 ">#</th>
                            <th class="col-1">Image</th>
                            <th class="col-1">Category</th>
                            <th class="col-2">Title</th>
                            <th class="col-1">Date</th>
                            <th class="col-5 d-none d-lg-table-cell">Content</th>
                            <th class="col-1 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 1;
                        foreach ($news as $current_news) : ?>

                            <tr class="<?= $current_news["status"] == 0 ? "fw-light" . " " . ($GLOBALS["darkMode"] ? "table-active" : "table-secondary") : '' ?>">
                                <td scope="row">
                                    <div class="d-flex align-items-center <?= $current_news["status"] ? 'fw-bold' : 'fw-light' ?>"><?= $i ?> <i data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="mf-tooltip" data-bs-title="Preview" style="cursor: pointer;" class="fa fa-eye fa-lg ms-5 mt-1" onclick="openNewsModal('newsModal<?= $i ?>')"></i></div>
                                </td>
                                <th>
                                    <div class="<?= $current_news["status"] == 0 ? 'dark-overlay drk' : '' ?>"><img src="<?= $current_news["image"] ?>" class="datatable-image "></div>
                                </th>
                                <td><?= $current_news["category"] ?></td>
                                <td>
                                    <?= $current_news["title"] ?>
                                    <?php if ($current_news["news_of_the_day"]) : ?>
                                        <span class="badge ms-1 text-bg-<?= $current_news["status"] == 0 ? 'secondary' : 'success' ?>">News of the day</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= $current_news["date"] ?></td>
                                <td class="overflow-hidden d-none d-lg-table-cell" style="white-space: nowrap; text-overflow: ellipsis; max-width: 300px;">
                                    <span class="news_content"><?= $current_news["content"] ?></span>
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
                                            <i data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="mf-tooltip" data-bs-title="Published: <?= $current_news["member_id"] ? ($current_news["firstname"] . " " . $current_news["lastname"]) : "N/A" ?>" class="<?= $current_news["status"] ? 'text-success' : 'text-danger' ?> fa fa-globe fa-lg me-5"></i>

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
                                                        <p class="news_content" id="content_newsModal<?= $i ?>">
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
            <div class="tab-pane fade <?= count($errors) > 0 ? 'show active' : '' ?>" id="list-news" role="tabpanel" aria-labelledby="list-news-list">
                <form enctype="multipart/form-data" action="" method="post" id="newsForm">
                    <div class="mb-4">
                        <label for="news_title" class="form-label"><i class="fa fa-paragraph me-3"></i>Title</label>
                        <input type="text" class="form-control" id="news_title" name="news_title" value="<?= $news_title ?>">
                        <?php if (isset($errors["news_title"])) {
                            echo "<span class='fw-bold text-danger  fst-italic'>" . $errors["news_title"] . "</span>";
                        } ?>
                    </div>
                    <div class="mb-4">
                        <label for="news_content" class="form-label"><i class="fa fa-comments me-3"></i>Content</label>
                        <textarea id="news_content" row="5" name="news_content" value="<?= $news_content ?>"></textarea>
                        <?php if (isset($errors["news_content"])) {
                            echo "<span class='fw-bold text-danger  fst-italic'>" . $errors["news_content"] . "</span>";
                        } ?>

                    </div>
                    <div class="mb-4">
                        <label for="news_image" class="form-label"><i class="fa fa-image me-3"></i>Image</label>
                        <input class="form-control" type="file" id="news_image" name="news_image">
                        <?php if (isset($errors["news_image"])) {
                            echo "<span class='fw-bold text-danger  fst-italic'>" . $errors["news_image"] . "</span>";
                        } ?>
                    </div>
                    <div class="mb-4">

                        <label for="news_category" class="form-label"><i class="fa fa-table me-3"></i>Category</label>
                        <input class="form-control" list="exampleDataList" id="news_category" placeholder="Type to search for a category" name="news_category" value="<?= $news_category ?>">
                        <datalist id="exampleDataList">
                            <option value="Hotel">
                            <option value="Country">
                            <option value="Business">
                            <option value="Renovation">
                        </datalist>
                        <?php if (isset($errors["news_category"])) {
                            echo "<span class='fw-bold text-danger  fst-italic'>" . $errors["news_category"] . "</span>";
                        } ?>
                    </div>
                    <div class="text-center"><button class="btn btn-full mb-3 mt-3" name="add_news" type="submit" disabled id="add_news_button">Add news</button></div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script>
        function openNewsModal(id) {
            var modal = new bootstrap.Modal(document.getElementById(id));
            modal.show();
            var textContainer = document.getElementById(`content_${id}`);
            var textContent = textContainer.innerHTML;

            var transformedTextBold = textContent.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
            var transformedTextItalic = transformedTextBold.replace(/\*(.*?)\*/g, '<em>$1</em>');

            textContainer.innerHTML = transformedTextItalic;
        }

        function submitForm(formId) {
            document.getElementById(formId).submit();
        }

        // Generiert einen Random News title in den placeholder rein
        function generateTitle() {
            const prefixes = ["Discover", "Exploring", "The Hidden", "Unveiling", "Inside", "Journey through", "Captivating", "Enchanting", "Secrets of", "Embark on", "A Glimpse into"];
            const keywords = ["Luxurious", "Tranquil", "Exquisite", "Serenity", "Majestic", "Breathtaking", "Elegant", "Picturesque", "Opulent", "Harmonious", "Radiant", "Graceful"];
            const suffixes = ["Retreat", "Paradise", "Getaway", "Haven", "Oasis", "Escape", "Sanctuary", "Wonderland", "Utopia", "Dreamland", "Heavenly", "Eden"];

            const randomPrefix = prefixes[Math.floor(Math.random() * prefixes.length)];
            const randomKeyword = keywords[Math.floor(Math.random() * keywords.length)];
            const randomSuffix = suffixes[Math.floor(Math.random() * suffixes.length)];

            const generatedTitle = `${randomPrefix} the ${randomKeyword} ${randomSuffix}`;
            document.getElementById('news_title').placeholder = generatedTitle;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const addButton = document.getElementById('add_news_button');

            function checkValidityAndEnableButton() {
                const title = document.getElementById('news_title');
                const content = document.getElementById('news_content');
                const image = document.getElementById('news_image');
                const category = document.getElementById('news_category');

                if (title && content && image && category) {
                    const titleValue = title.value.trim();
                    const imageValue = image.files.length;
                    const categoryValue = category.value.trim();
                    const contentValue = isEditorEmpty().trim();

                    addButton.disabled = !(titleValue !== '' && contentValue !== '' && categoryValue !== '' && imageValue !== 0);
                }
            }

            // Füge die Überprüfungsfunktion an das input-Ereignis jedes Elements an
            const formElements = document.querySelectorAll('#newsForm input, #newsForm textarea');
            formElements.forEach(function(element) {
                element.addEventListener('input', checkValidityAndEnableButton);
            });

            // Initialisierung beim Laden der Seite
            checkValidityAndEnableButton();
        });

        const simplemde = new SimpleMDE({
            element: document.getElementById('news_content')
        });

        function isEditorEmpty() {
            const editorContent = simplemde.value();
            return editorContent;
        }

        function toggleBold() {
            simplemde.toggleBold();
        }

        function toggleItalic() {
            simplemde.toggleItalic();
        }
    </script>

</body>

</html>