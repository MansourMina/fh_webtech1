<?php
$userdata = json_decode(file_get_contents('src/files/data.json'), true);

foreach ($userdata['data'] as &$user) {
    if ($user["email"] == $_SESSION["email"]) {
        $current_user = &$user;
        break;
    }
}

if (!empty($_FILES['picture']['name'])) {

    $previousFilename = "src/upload/" . $_SESSION["email"] . "_img.";

    $files = glob($previousFilename . "*");

    foreach ($files as $file) {
        if (file_exists($file)) {
            unlink($file);
        }
    }
    $info = pathinfo($_FILES["picture"]["name"]);
    $filename = "src/upload/" . $_SESSION["email"] . "_img." . $info["extension"];

    move_uploaded_file($_FILES['picture']["tmp_name"], $filename);
    $current_user["image"] = $filename;
}

$name = isset($_POST['name']) ? $_POST['name'] : "";
if (!empty($name)) {
    $current_user["name"] = $name;
}
$phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : "";
if (!empty($phone_number)) {
    $current_user["phone_number"] = $phone_number;
}
$password = isset($_POST['password']) ? $_POST['password'] : "";
if (!empty($password)) {
    $current_user["password"] = $password;
}
$_SESSION = $current_user;
file_put_contents('src/files/data.json', json_encode($userdata, JSON_PRETTY_PRINT));



// $contentType = mime_content_type($_FILES["picture"]["tmp_name"]);
// if ($contentType !== "image/png" && $contentType !== "image/jpeg") {
//     echo "Fehler beim Upload!";
//     return;
// }
// if (move_uploaded_file($_FILES["picture"]["tmp_name"], $filename)) {
//     print("Datei wurde erfolgreich hochgeladen!");
// } else {
//     echo "Fehler beim Upload!";
// }
header("Location: ?profile");
exit();
?>