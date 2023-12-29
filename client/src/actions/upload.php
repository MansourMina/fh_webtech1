<?php
// $userdata = json_decode(file_get_contents('src/files/data.json'), true);

// foreach ($userdata['data'] as &$user) {
//     if ($user["email"] == $_SESSION["email"]) {
//         $current_user = &$user;
//         break;
//     }
// }

$toUpdate = array();

if ((!empty($_FILES['picture']['name']))) {
    // Löscht das Bild vom User bevor ein neues in den Ordner geuploaded wird
    if ($_SESSION["image"] != NULL) {
        $files = glob($_SESSION["image"] . "*");
        foreach ($files as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }

    // Image Infos
    $info = pathinfo($_FILES["picture"]["name"]);
    $filename = "src/upload/" . uniqid() . "_img." . $info["extension"];


    // Resize Image
    $percent = 0.5;
    list($width, $height) = getimagesize($_FILES['picture']['tmp_name']);
    $new_width = $width * $percent;
    $new_height = $height * $percent;
    $image_p = imagecreatetruecolor($new_width, $new_height);
    $contentType = mime_content_type($_FILES["picture"]["tmp_name"]);
    if ($contentType === "image/jpeg") {
        $image = imagecreatefromjpeg($_FILES['picture']['tmp_name']);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    }
    imagejpeg($image_p, $filename, 100);

    // Upload Image
    move_uploaded_file($_FILES['picture']['tmp_name'], $filename);
    $toUpdate["image"] = $filename;
}

$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : "";
if (!empty($firstname) && $firstname != $_SESSION["firstname"]) {
    $toUpdate["firstname"] = $firstname;
}
$lastname = isset($_POST['lastname']) ? $_POST['lastname'] : "";
if (!empty($lastname) && $lastname != $_SESSION["lastname"]) {
    $toUpdate["lastname"] = $lastname;
}
$phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : "";
if (!empty($phone_number) && $phone_number != $_SESSION["phone_number"]) {
    $toUpdate["phone_number"] = $phone_number;
}

$email = isset($_POST['email']) ? $_POST['email'] : "";
if (!empty($email) && $email != $_SESSION["email"]) {
    $toUpdate["email"] = $email;
}

if (count($toUpdate) > 0) {
    $stmt = updateProfile($toUpdate, $_SESSION["member_id"]);
    if ($stmt) {
        $updatedUser = getUserByAttribute("member_id", $_SESSION["member_id"], "i");
        $_SESSION = $updatedUser;
    }
}
header("Location: ?profile");
exit();
