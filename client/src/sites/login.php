<?php

$email = "";
$password = "";
$errors = [];
$found = false;
if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  if (empty($email)) {
    $errors["email"] = "Email is required";
  }
  if (empty($password)) {
    $errors["password"] = "Password is required";
  } else {
    $user_members_cred = getMembersCred();
    foreach ($user_members_cred as $user) {
      if ($email == $user['email'] && password_verify($password, $user['password'])) {
        if ($user["is_active"] == 0) {
          $errors["message"] = "Your Account has been deactivated. Please contact the custom support.";
          $found = true;
          break;
        } else {
          $_SESSION = $user;
          header('Location: index.php');
        }
      }
    }
    if (!$found) $errors["message"] = "Password or username is incorrect";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="res/css/login-register.css">

</head>

<body>
  <div class="container register ">
    <div class="row no-gutters shadow-box " style="min-height: 85vh;">
      <div class="col-lg-5 bg-white p-5 align-self-center">
        <form action="" method="post">

          <div class="formInputs">
            <div>
              <h2 class="title">MF Palmside Resort</h2>
              <h6 class="card-subtitle mb-2 text-body-secondary fw-bold">Please log into your account</h6>
            </div>
            <div class="mt-2">
              <input type="email" id="email" name="email" value="" placeholder="E-mail" />
              <?php if (isset($errors["email"])) {
                echo "<span class='fw-bold text-danger  fst-italic'>" . $errors["email"] . "</span>";
              } ?>
            </div>

            <div>
              <input type="password" id="password" name="password" value="" placeholder="Password" />
              <?php if (isset($errors["password"])) {
                echo "<span class='fw-bold text-danger  fst-italic'>" . $errors["password"] . "</span>";
              } ?>

            </div>

            <?php if (isset($errors["message"])) {
              echo "<div class='mt-1 fw-bold text-danger  fst-italic'>" . $errors["message"] . "</div>";
            } ?>

            <button type="submit" name="login" value="1" class="btn btn-dark btn-full d-block w-100 mt-4 mx-auto " style="outline: none;box-shadow:none !important;
              border:0px solid #ccc !important;">Login</button>
            <div>
              <p>Don't have an account? <a href="?register">Signup</a></p>
            </div>

          </div>
        </form>

        <hr />

        <div style="float:right"><a href="?" style="letter-spacing: -1px;">Go back to website</a></div>

      </div>
      <div class=" col-lg-7 d-none d-lg-block p-0">
        <img src="res/img/login.png" class="img-fluid l-img" alt=" MF Palmside Resort">

      </div>
    </div>
  </div>
</body>

</html>