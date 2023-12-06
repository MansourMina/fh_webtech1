<?php
$email = "";
$password = "";
$name = "";
$confirmPassword = "";
$confirmAGB = "";
$phone_number = "";
$errors = [];

if (isset($_POST["register"])) {
  $fields = [
    'email' => 'Email',
    'password' => 'Password',
    'confirmPassword' => 'Confirm Password',
    'name' => 'Name',
    'confirmAGB' => 'Agreement to Terms and Conditions',
    'phone_number' => 'Phone Number'
  ];

  foreach ($fields as $field => $error) {
    $$field = isset($_POST[$field]) ? $_POST[$field] : "";
    if (empty($$field)) {
      $errors[$field] = "$error is required";
    } elseif ($field === 'confirmPassword' && $password !== $confirmPassword) {
      $errors[$field] = "$error does not match";
    }
  }
  if (empty($errors)) {
    $file = 'src/files/data.json';
    $userdata = json_decode(file_get_contents($file), true);
    foreach ($userdata['data'] as $user) {
      if ($email == $user['email']) {
        $errors["email"] = "Email already existing";
        break;
      }
    }
    if (empty($errors)) {
      $new_user = [
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'phone_number' => $phone_number,
        'account_created' => date("Y.m.d")
      ];
      array_push($userdata['data'], $new_user);
      file_put_contents($file, json_encode($userdata, JSON_PRETTY_PRINT));
      $_SESSION = $new_user;
      header('Location: ?index');
    }
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
  <div class="container register">
    <div class="row no-gutters shadow-box " style="min-height: 85vh;">
      <div class="col-lg-5 bg-white p-5 align-self-center">
        <form action="" method="post">

          <div class="formInputs">
            <div>
              <h2 class="title ">MF Palmside Resort</h2>
              <h6 class="card-subtitle mb-2 text-body-secondary fw-bold ">Create your account</h6>
            </div>
            <div class="mt-2">
              <input placeholder="Name" type="text" id="name" name="name" value="<?= $name ?>" />
              <?php if (isset($errors["name"])) {
                echo "<span class='fw-bold text-danger  fst-italic'>" . $errors["name"] . "</span>";
              } ?>
            </div>
            <div>
              <input placeholder="Phone number" type="number" id="phone_number" name="phone_number" value="<?= $phone_number ?>" />
              <?php if (isset($errors["phone_number"])) {
                echo "<span class='fw-bold text-danger  fst-italic'>" . $errors["phone_number"] . "</span>";
              } ?>
            </div>
            <div>
              <input placeholder="E-Mail" type="email" id="email" name="email" value="<?= $email ?>" />
              <?php if (isset($errors["email"])) {
                echo "<span class='fw-bold text-danger  fst-italic'>" . $errors["email"] . "</span>";
              } ?>
            </div>

            <div>
              <input placeholder="Password" type="password" id="password" name="password" value="<?= $password ?>" />
              <?php if (isset($errors["password"])) {
                echo "<span class='fw-bold text-danger  fst-italic'>" . $errors["password"] . "</span>";
              } ?>
            </div>
            <div>
              <input placeholder="Confirm password" type="password" id="confirmPassword" name="confirmPassword" value="<?= $confirmPassword ?>" />
              <?php if (isset($errors["confirmPassword"])) {
                echo "<span class='fw-bold text-danger  fst-italic'>" . $errors["confirmPassword"] . "</span>";
              } ?>
            </div>
            <div>
              <div class="form-check" style="font-size: 15px">
                <input class="form-check-input" type="checkbox" id="confirmAGB" name="confirmAGB">
                <label class="form-check-label" for="confirmAGB">
                  Ich stimme den AGB der MF Palmside Resort zu.
                </label>

              </div>
              <?php if (isset($errors["confirmAGB"])) {
                echo "<span class='fw-bold text-danger  fst-italic'>" . $errors["confirmAGB"] . "</span>";
              } ?>
            </div>

            <button type="submit" name="register" value="1" class="btn btn-dark btn-full d-block w-100 mt-4 mx-auto " style="outline: none;box-shadow:none !important;
              border:0px solid #ccc !important;">Sign Up</button>

            <div>
              <p>Have an account? <a href="?login">Login</a></p>
            </div>
          </div>
        </form>
        <hr />

        <div style="float:right"><a href="?index" style="letter-spacing: -1px;">Go back to website</a></div>

      </div>
      <div class="col-lg-7 d-none d-lg-block p-0">

        <img src="res/img/register.png" class="img-fluid l-img" alt=" MF Palmside Resort">

      </div>
    </div>

  </div>

</body>

</html>