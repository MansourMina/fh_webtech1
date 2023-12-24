<?php
$name = "";
$errors = array();
$searchResults = array();
$searched = false;
$found = false;
if (isset($_POST['searchName'])) {
    $searched = true;
    $name = $_POST['name'];
    if (empty($name)) {
        $found = false;
    } else {
        $members = getMembersCred();
        foreach ($members as $member) {
            if (strpos(strtolower(($member['firstname'] . " " . $member['lastname'])), strtolower($name)) !== false) {
                $searchResults[] = $member;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .notFound {
            min-height: 69vh;
            width: 100vw;

        }

        .profile-image-container {
            position: relative;
            cursor: pointer;
        }

        .card {
            min-height: 12vh;
        }
    </style>
</head>

<body>
    <div class="container mt-5 notFound">
        <form action="" method="post">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Members name" aria-label="Recipient's username" aria-describedby="button-addon2" id="name" name="name" value="">
                <button type="submit" id="button-addon2" class="btn btn-outline-secondary" name="searchName">
                    Search
                </button>
            </div>

        </form>

        <?php if (!empty($searchResults)) : ?>
            <?php foreach ($searchResults as $index => $person) : ?>
                <div class="card border-profile my-5" style="border-left: 5px solid <?= $person["is_active"] == 1 ? "#15736b" : "red" ?>">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="me-5"><img src="<?php echo $person["image"] ? $person["image"] : 'src/images/default.png' ?>" alt="Profile Image" class="rounded-circle img-circle" width="50" height="50" id="profile"></div>
                            <div>
                                <p class="mb-0 h5 fw-bold"><?= $person["firstname"] . " " . $person["lastname"] ?></p>
                                <p class="mb-0"><?= $person["is_admin"] == 1 ? "Admin" : "User" ?>
                                    <span class="fw-bold"><?= $person["member_id"] == $_SESSION["member_id"] ? "(You)" : '' ?></span>
                                </p>
                            </div>
                            <div class="ms-auto">
                                <i class="fa fa-circle fa-lg <?= $person["is_active"] == 0 ? "text-danger" : "" ?>"></i>
                                <span><?= $person["is_active"] == 1 ? "Active" : "Deactivated" ?> </span>
                            </div>

                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        <?php elseif ($searched) : ?>
            <p>No results found.</p>
        <?php endif; ?>
    </div>


</body>

</html>