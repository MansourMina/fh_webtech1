<?php
$errors = [];
if (isset($_POST["deleteAccount"])) {
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : "";
    if (empty($confirm_password)) {
        $errors["confirm_password"] = "Please confirm your password!";
    } else if (password_verify($confirm_password, $_SESSION["password"])) {
        $stmt = deleteAccount($_SESSION["member_id"]);
        if ($stmt) {
            header("Location: ?logout");
            exit();
        }
    } else {
        $errors["confirmation"] = "Confirmation failed!";
    }
}
?>
<?php if (count($errors) > 0) : ?>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#deleteAccountModal").modal('show');
        });
    </script>
<?php endif; ?>
<div class="modal " id="deleteAccountModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="passwordModalLabel">Delete Account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="alert alert-danger" role="alert">
                        <p><span class="fw-bold mb-0 pb-0"><i class="fa fa-warning me-2 text-danger"></i>Warning</span></p>
                        By deleting this account, you won't be able to access the system with this account again.

                    </div>


                    <div class="mb-3">
                        <label for="confirm_password" class="col-form-label">Confirm password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                        <?php if (isset($errors["confirm_password"])) {
                            echo "<span class='fw-bold text-danger  fst-italic'>" . $errors["confirm_password"] . "</span>";
                        } ?>
                    </div>
                    <?php if (isset($errors["confirmation"])) {
                        echo "<span class='fw-bold text-danger  fst-italic'>" . $errors["confirmation"] . "</span>";
                    } ?>

                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-secondary w-25" onclick="closePassword()" data-bs-dismiss="modal">Cancel</button>
                    <form action="" method="post">
                        <button type="submit" name="deleteAccount" class="btn btn-danger w-25">Delete</button>
                    </form>

                </div>
            </div>
        </form>
    </div>
</div>