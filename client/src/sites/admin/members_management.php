<?php
$name = "";
$errors = array();
$searchResults = array();
$found = false;
if (isset($_GET['members'])) {
    $name = isset($_GET['members']) ? $_GET['members'] : "";
    if (empty($name)) {
        $found = false;
    } else {
        $members = getMembersCred();
        foreach ($members as $member) {
            if (strpos(strtolower(($member['firstname'] . " " . $member['lastname'])), strtolower($name)) !== false) {
                $searchResults[] = $member;
            }
        }
        $found = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin News Management - Keep your audience engaged with the latest updates and stories.">
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
        #member-img{
            height: 60px;
            width: 60px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="container notFound">
        <form action="" method="GET">
            <div class="input-group mb-3 rounded-pill">
                <input type="text" class="form-control " placeholder="Members name" aria-label="Recipient's username" aria-describedby="button-addon2" id="name" name="members" value="">
                <button type="submit" id="button-addon2" class="btn btn-outline-secondary">
                    Search
                </button>
            </div>

        </form>

        <?php if (!empty($searchResults)) : ?>
            <?php foreach ($searchResults as $index => $person) : ?>
                <a style="text-decoration: none;" href="<?= $person["member_id"] == $_SESSION["member_id"] ? "?profile" : "?members-profile=" . $person['member_id'] ?>">
                    <div class="card border-profile my-5" style="border-left: 5px solid <?= $person["is_active"] == 1 ? "#15736b" : "red" ?>; cursor: pointer;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div class="me-5"><img src="<?php echo $person["image"] ? $person["image"] : 'res/img/default.jpg' ?>" alt="Profile Image" class="rounded-circle img-circle" id="member-img"></div>
                                <div>
                                    <p class="mb-0 h5 fw-bold"><?= $person["firstname"] . " " . $person["lastname"] ?></p>
                                    <p class="mb-0"><?= $person["is_admin"] == 1 ? "Admin" : "User" ?>
                                        <span class="fw-bold"><?= $person["member_id"] == $_SESSION["member_id"] ? "(You)" : '' ?></span>
                                    </p>
                                </div>
                                <div class="ms-auto d-flex align-items-center">
                                    <i class="me-2 fa fa-circle fa-lg <?= $person["is_active"] == 0 ? "text-danger" : "text-success" ?>"></i>
                                    <span class="d-sm-block d-none"><?= $person["is_active"] == 1 ? "Active" : "Deactivated" ?> </span>
                                </div>

                            </div>
                        </div>
                    </div>
                </a>

            <?php endforeach; ?>
        <?php else : ?>
            <p>No results found.</p>
            <?= $_GET["members"]; ?>
        <?php endif; ?>
    </div>


</body>

</html>