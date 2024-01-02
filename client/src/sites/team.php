<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .team-card {
            min-height: 38vh;
        }

        .social-link {
            width: 30px;
            height: 30px;
            border: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s;
            font-size: 0.9rem;
            text-decoration: none;
        }

        .social-link:hover,
        .social-link:focus {
            background: #ddd;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container text-center">
        <p class="h2 my-4">Meet the Team at MF Palmside Resort</p>
        <p class="h4 text-muted my-4">Dedication, Expertise, and Warmth – Crafting Unforgettable Experiences</p>
        <p class="text-secondary my-4">Join us at <span class="fw-bold">MF Palmside Resort</span>, where our passionate and skilled team is here to make your stay unforgettable. With a commitment to excellence, our experienced staff is dedicated to creating a special experience just for you. Experience the perfect mix of friendliness and efficiency that makes our team the heart of Palmside – your ultimate destination for exceptional hospitality.</p>
        <div class="row mt-5">
            <div class="col-xl-6 col-md-6 mb-5">
                <div class="bg-white rounded shadow-lg py-5 px-4 team-card"><img src="res/img/filip.jpg" alt="" width="100" class=" img-thumbnail mb-3  ">
                    <h5 class="mb-0">Filip Lazarevic</h5><span class="small text-uppercase text-muted">CEO</span>
                    <ul class="social mb-0 list-inline mt-3">
                        <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 mb-5">
                <div class="bg-white rounded shadow-lg py-5 px-4 team-card"><img src="res/img/mina.jpg" alt="" width="100" class=" mb-3 img-thumbnail ">
                    <h5 class="mb-0">Mina Mansour</h5><span class="small text-uppercase text-muted">CEO</span>
                    <ul class="social mb-0 list-inline mt-3">
                        <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="https://www.instagram.com/msr.mina/" target="_blank"="social-link"><i class="fa fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</body>

</html>