<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="404 - Page Not Found">
    <style>
        .notFound {
            height: 100vh;
            width: 100vw;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .img {

            width: auto;
            object-fit: cover;
            position: relative;
        }
    </style>
</head>

<body>
    <div class="container notFound ">
        <div class="row no-gutters shadow-box " style="min-height: 85vh;">
            <div class="col-lg-6  p-5 align-self-center">
                <div>
                    <h1 class="title">404</h1>
                    <h2 class="card-subtitle mb-2 fw-bold">This is not the page you are looking for!</h2>
                </div>

                <a href="?"><button name="back" value="1" class="btn btn-dark btn-full  mt-4 " style="outline: none;box-shadow:none !important;
              border:0px solid #ccc !important;">Back to Website</button></a>

            </div>
            <div class="col-lg-6  p-0 " style="align-self: center;">
                <img src="res/img/<?= $not_found_img ?>" class="img-fluid img" alt=" MF Palmside Resort">
            </div>

        </div>
</body>