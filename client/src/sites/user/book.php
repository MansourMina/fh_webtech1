<?php
if (isset($_GET['book'])) {
    $room = $_GET['book'];
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .booking {
            padding: 7px 0px 7px 0px;
            font-weight: bold;
        }

        .col {
            margin-bottom: 8px;
            margin-top: 8px;
        }

        label {
            margin-bottom: 2px;
        }
    </style>
</head>

<body>
    
    <div class="container-fluid mx-0 px-0">
        <div class="container my-5">
            <h2>Request a booking</p>
            <h1><?php echo $room ?></h1>
            <p>Discover the extraordinary with us.</p>
            <div class="booking">
                <div class="row">
                    <div class="col">
                        <label for="room">Room</label>
                        <select class="form-select" aria-label="Room select" id="room" name="room">
                            <?php echo $room == "" ? "<option selected>-- not selected --</option>" : ""; ?>
                            <option value="<?php echo 'Deluxe Ocean-View Suite'; ?>" <?php echo $room == "Deluxe Ocean-View Suite" ? 'selected' : '' ?>>Deluxe Ocean-View Suite</option>
                            <option value="<?php echo 'Family-Friendly Accommodation'; ?>" <?php echo $room == "Family-Friendly Accommodation" ? 'selected' : '' ?>>Family-Friendly Accommodation</option>

                            <option value="<?php echo 'Elegant Suite with Private Balcony'; ?>" <?php echo $room == "Elegant Suite with Private Balcony" ? 'selected' : '' ?>>Elegant Suite with Private Balcony</option>

                            <option value="<?php echo 'Classic Comfort and Timeless Elegance'; ?>" <?php echo $room == "Classic Comfort and Timeless Elegance" ? 'selected' : '' ?>>Classic Comfort and Timeless Elegance</option>

                        </select>

                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="name">Name</label>
                        <input placeholder="John" type="text" id="name" name="name" class="form-control" value="<?php echo isset($_SESSION['member_id']) ? "{$_SESSION['firstname']} {$_SESSION['lastname']}" : ''; ?>">
                    </div>

                </div>
                <div class="row">
                    <div class="col">
                        <label for="email">Email</label>
                        <input placeholder="example@domain.com" type="email" id="email" name="email" class="form-control" autocomplete="on" value="<?php echo isset($_SESSION['member_id']) ? "{$_SESSION['email']}" : ''; ?>">
                    </div>
                    <div class="col">
                        <label for="phonenumber">Phone</label>
                        <input placeholder="+1 999 99-99-99" type="tel" id="phonenumber" name="phonenumber" class="form-control" value="<?php echo isset($_SESSION['member_id']) ? "{$_SESSION['phone_number']}" : ''; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="checkin">Check-in date</label>
                        <input placeholder="mm/dd/yyyy" type="date" id="checkin" name="checkin" class="form-control">
                    </div>
                    <div class="col">
                        <label for="checkout">Check-out date</label>
                        <input placeholder="mm/dd/yyyy" type="date" id="checkout" name="checkout" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div>
                            <label for="nadults">Number of adults</label>
                            <select class="form-select" aria-label="Adults select" name="nadults" id="nadults">
                                <option selected>- Not selected -</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>

                        </div>
                    </div>
                    <div class="col">
                        <label for="nchildren">Number of Children</label>
                        <select class="form-select" aria-label="Children select" name="nchildren" id="nchildren">
                            <option selected>- Not selected -</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                    <div class="mt-4">
                        <div>
                            <input class="form-check-input" type="checkbox" value="" id="breakfastCheckbox">
                            <label class="form-check-label" for="breakfastCheckbox">
                                breakfast included
                            </label>
                        </div>


                        <div>
                            <input class="form-check-input" type="checkbox" value="" id="parkingCheckbox">
                            <label class="form-check-label" for="parkingCheckbox">
                                parking space included
                            </label>
                        </div>
                        <div>
                            <input class="form-check-input" type="checkbox" value="" id="petCheckbox">
                            <label class="form-check-label" for="petCheckbox">
                                Pet on board
                            </label>
                        </div>
                        <div>
                            <input class="form-check-input" type="checkbox" value="" id="seaViewCheckbox">
                            <label class="form-check-label" for="seaViewCheckbox">
                                sea ​​view
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <label for="Requests">Special Requests</label>
                    <textarea type="text" id="Requests" name="Requests" class="form-control"></textarea>
                </div>
                <div class="d-flex mt-4 justify-content-end">
                    <button type="submit" name="register" value="1" class="btn btn-dark btn-full  w-25 mt-4  " style="outline: none;box-shadow:none !important;
                  border:0px solid #ccc !important;">Book</button>
                    <a type="button" name="register" value="1" class="btn btn-danger  w-25 mt-4 ms-3 " style="outline: none;box-shadow:none !important;
                  border:0px solid #ccc !important;" href="?">Cancel booking</a>
                </div>

                <section id=" learn-more" class=" mt-5">

                </section>
            </div>
        </div>
    </div>
</body>

</html>