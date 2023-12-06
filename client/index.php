<?php
session_start();
$page = 'home.php';
$title = 'MF Palmside Resort';

$pages = [
  "faq" => ["file" => "faq.php", "title" => "FAQ"],
  "impressum" => ["file" => "impressum.php", "title" => "Impressum"],
  "login" => ["file" => "login.php", "title" => "Login"],
  "register" => ["file" => "register.php", "title" => "Register"],
  "logout" => ["file" => "actions/logout.php", "title" => "Logout"],
  "profile" => ["file" => "profile.php", "title" => "Profile"],
  "service" => ["file" => "service.php", "title" => "Service"],
  "team" => ["file" => "team.php", "title" => "Team"],
  "news" => ["file" => "news.php", "title" => "News"],
  "rooms" => ["file" => "rooms.php", "title" => "Rooms"],
  "reservations" => ["file" => "reservations.php", "title" => "Reservations"],
  "book" => ["file" => "book.php", "title" => "Booking"],
];

$only_logged_in = ["book", "reservations", "profile"];

foreach ($pages as $name => $value) {
  if (isset($_GET[$name])) {
    foreach ($only_logged_in as $for_login) {
      if (!isset($_SESSION['email']) && $name == $for_login) {
        header("Location: ?login");
      }
    }
    $page = $value["file"];

    $title = "MF " . $value["title"];
    break;
  }
}

function showNavBar($page)
{
  $navbar_sites = array("home", "faq", "impressum", "profile", "service", "team", "news", "rooms", "reservations", "book");

  foreach ($navbar_sites as $site) {
    if ($site . ".php" == $page) return true;
    else continue;
  }
}

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
  <?php showNavBar($page) ? include_once 'src/util/navbar.php' : "" ?>

  <?php include_once 'src/' . $page ?>
  <?php
  if (showNavBar($page)) {
    echo "<div class='mt-5'>";
    include_once 'src/util/footer.php';
    echo "</div>";
  }
  ?>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>