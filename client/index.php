<?php
ob_start();
session_start();
$page = 'home.php';
$title = 'MF Palmside Resort';
$pageFound = false;
$showBar = true;



include_once 'model/members.php';
$role = getRole();

if ($role != 2)  include_once 'src/util/discount.php';

// role 0 -> for anonyms
// role 1 -> for logged users
// role 2 ->  for admin
$pages = [
    "faq" => ["file" => "faq.php", "title" => "FAQ", "role" => [0, 1, 2],  "showBar" => true,],
    "impressum" => ["file" => "impressum.php", "title" => "Impressum", "role" => [0, 1, 2],  "showBar" => true],
    "login" => ["file" => "login.php", "title" => "Login", "role" => [0],  "showBar" => false],
    "register" => ["file" => "register.php", "title" => "Register", "role" => [0],  "showBar" => false],
    "logout" => ["file" => "../actions/logout.php", "title" => "Logout", "role" => [1, 2],  "showBar" => false],
    "profile" => ["file" => "user/profile.php", "title" => "Profile", "role" => [1, 2],  "showBar" => true],
    "service" => ["file" => "service.php", "title" => "Service", "role" => [0, 1, 2],  "showBar" => true],
    "team" => ["file" => "team.php", "title" => "Team", "role" => [0, 1, 2],  "showBar" => true],
    "news" => ["file" => "news.php", "title" => "News", "role" => [0, 1, 2],  "showBar" => true],
    "rooms" => ["file" => "rooms.php", "title" => "Rooms", "role" => [0, 1, 2],  "showBar" => true],
    "reservations" => ["file" => "user/reservations.php", "title" => "Reservations", "role" => [1],  "showBar" => true],
    "book" => ["file" => "user/book.php", "title" => "Booking", "role" => [1],  "showBar" => true, "to_login" => true],
    "404" => ["file" => "404.php", "title" => "Page not Found", "role" => [0, 1, 2],  "showBar" => false],
    "members" => ["file" => "admin/members_management.php", "title" => "Members Management", "role" => [2],  "showBar" => true],
    "news-management" => ["file" => "admin/news_management.php", "title" => "News Management", "role" => [2],  "showBar" => true],
    "reservations-management" => ["file" => "admin/reservations_management.php", "title" => "Reservations Management", "role" => [2],  "showBar" => true],
    "members-profile" => ["file" => "admin/members_profile.php", "title" => "Members Profile", "role" => [2],  "showBar" => true]
];

foreach ($pages as $name => $value) {
    if (isset($_GET[$name])) {
        if (!in_array($role, $value["role"])) {
            if ($value["to_login"]) {
                header("Location: ?login");
                exit();
            } else {
                header("Location: ?404");
                exit();
            }
        }
        $page = $value["file"];
        $title = "MF " . $value["title"];
        $pageFound = true;
        $showBar = $value["showBar"];

        break;
    }
}

//redirect to 404 if path not found
$currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$basePath = dirname($currentPath); // current path
$fullPath = $_SERVER['DOCUMENT_ROOT'] . $currentPath;

// navigating with /
if (!file_exists($fullPath)) {
    header("Location: $basePath?404");
    exit();
}
//navigating with ?
if ((!$pageFound && !empty($_GET))) {
    header("Location: ?404");
    exit();
}

// Update Users Profile
if (isset($_POST["saveChanges"])) {
    include_once 'src/actions/upload.php';
}


// $darkMode = isset($_COOKIE['dark_mode']) ? $_COOKIE['dark_mode'] : false;

// $bodyClass = $darkMode ? 'dark-mode' : '';

// function toggleDarkMode()
// {
//   $darkMode = isset($_COOKIE['dark_mode']) ? !$_COOKIE['dark_mode'] : true;
//   setcookie('dark_mode', $darkMode, time() + (365 * 24 * 60 * 60), '/');
//   header('Location: ' . $_SERVER['HTTP_REFERER']);
//   exit;
// }

// if (isset($_POST['toggle_dark_mode'])) {
//   toggleDarkMode();
// }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <?php require_once 'src/util/head.php' ?>
</head>

<body class="<?php echo $bodyClass; ?>">
    <div class="page">
        <?php $showBar ? include_once 'src/util/navbar.php' : "" ?>
        <?php include_once 'src/sites/' . $page ?>
        <?php $showBar ? include_once 'src/util/footer.php' : "" ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="res/js/index.js"> </script>

</body>

</html>