<?php

$toUpdate = array();
if ((!empty($_FILES['picture']['name']))) {
    // Delete the member's existing image before uploading a new one
    if ($_SESSION["image"] != NULL) {
        $files = glob($_SESSION["image"] . "*");
        foreach ($files as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }

    // Get image infos of the image the member wants to upload
    $info = pathinfo($_FILES["picture"]["name"]);
    $filename = "src/upload/" . uniqid() . "_img." . $info["extension"];


    // Resize the image by half
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

    // Upload the wanted image
    move_uploaded_file($_FILES['picture']['tmp_name'], $filename);
    $toUpdate["image"] = $filename;
}

$fields = [
    'email' => $_SESSION["email"],
    'firstname' => $_SESSION["firstname"],
    'lastname' => $_SESSION["lastname"],
    'phone_number' => $_SESSION["phone_number"],
];

// Check if input is different from the session values and not empty, then update the toUpdate array
foreach ($fields as $field => $value) {
    $$field = isset($_POST[$field]) ? $_POST[$field] : "";
    if (!empty($$field) && $$field != $value) {
        $toUpdate[$field] = $$field;
    }
}

// If there are updates to be made, call updateProfile function 
if (count($toUpdate) > 0) {
    $stmt = updateProfile($toUpdate, $_SESSION["member_id"]);
    if ($stmt) {
        // Change session values with the updated member data
        $updatedUser = getMemberByAttribute("member_id", $_SESSION["member_id"], "i");
        $_SESSION = $updatedUser;
    }
}

// Redirect to the profile page
header("Location: ?profile");
exit();
