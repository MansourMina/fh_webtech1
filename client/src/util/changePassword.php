<?php
$errors = [];
$toUpdate = array();
if (isset($_POST["changePassword"])) {
    $old_password = isset($_POST['old_password']) ? $_POST['old_password'] : "";
    $new_password = isset($_POST['new_password']) ? $_POST['new_password'] : "";
    if (empty($old_password)) {
        $errors["old_password"] = "Please confirm your old password!";
    }
    if (empty($new_password)) {
        $errors["new_password"] = "New password is required!";
    } else if (password_verify($old_password, $_SESSION["password"])) {
        if (!empty($new_password) && $new_password != $_SESSION["password"]) {
            $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
            $toUpdate["password"] = $hashedPassword;
            $stmt = updateProfile($toUpdate, $_SESSION["member_id"]);
            if ($stmt) {
                $updatedUser = getMemberByAttribute("member_id", $_SESSION["member_id"], "i");
                $_SESSION = $updatedUser;
            }
            header("Location: {$_SERVER['REQUEST_URI']}");
            exit();
        }
    } else {
        $errors["wrong_password"] = "Password confirmation failed!";
    }
}
?>
<?php if (count($errors) > 0) : ?>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#passwordModal").modal('show');
        });
    </script>
<?php endif; ?>
<div class="modal " id="passwordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="passwordModalLabel">Change Password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="old_password" class="col-form-label">Old password</label>
                        <input type="password" class="form-control" id="old_password" name="old_password">
                        <?php if (isset($errors["old_password"])) {
                            echo "<span class='fw-bold text-danger  fst-italic'>" . $errors["old_password"] . "</span>";
                        } ?>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="col-form-label">New password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password">
                        <?php if (isset($errors["new_password"])) {
                            echo "<span class='fw-bold text-danger  fst-italic'>" . $errors["new_password"] . "</span>";
                        } ?>
                    </div>
                    <?php if (isset($errors["wrong_password"])) {
                        echo "<span class='fw-bold text-danger  fst-italic'>" . $errors["wrong_password"] . "</span>";
                    } ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closePassword()" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="changePassword" id="test" class="btn btn-danger">Change</button>
                </div>
            </div>
        </form>
    </div>
</div>