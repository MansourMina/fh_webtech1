<nav class="navbar navbar-expand-xl  p-4 bg-white sticky-top ">
    <div class="container-fluid">
        <a class="navbar-brand" href="?index">
            <img src="res/img/logo.png" alt="MF Palmside Resort" width="200">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto mx-5 ">
                <li class="nav-item mx-3 py-1">
                    <a class="nav-link nav_title " aria-current="page" href="?index">Home</a>
                </li>
                <li class="nav-item mx-3 py-1">
                    <a class="nav-link  nav_title" aria-current="page" href="?rooms">Rooms</a>
                </li>
                <li class="nav-item mx-3 py-1">
                    <a class="nav-link  nav_title" href="?news">News</a>
                </li>

                <li class="nav-item <?php echo isset($_SESSION['email']) ? 'dropdown' : '' ?> mx-3 py-1">
                    <a class="nav-link <?php echo isset($_SESSION['email']) ? 'dropdown-toggle' : '' ?> nav_title" <?php echo isset($_SESSION['email']) ? "data-bs-toggle='dropdown'" : "" ?> href="?login">
                        <?php echo isset($_SESSION['email']) ? "<span style='color: red'>" . "{$_SESSION['name']} " : "<span>login"  . "</span>" ?>
                    </a>
                    <?php
                    if (isset($_SESSION['email'])) {
                        echo "<ul class='dropdown-menu dropdown-menu-dark'>
                        <a class='dropdown-item nav_title fw-normal' href='?profile'>Profile</a>
                        <a class='dropdown-item nav_title fw-normal' href='?reservations'>Reservations</a>
                        <div class='dropdown-divider '></div>
                        <a class='dropdown-item nav_title fw-normal' href='?logout'>Logout</a>
                        </ul>";
                    }
                    ?>
                </li>
                <li class="nav-item dropdown mx-3 py-1">
                    <a class="nav-link dropdown-toggle nav_title" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        About
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <a class="dropdown-item nav_title fw-normal" href="?team">MF Team</a>
                        <a class="dropdown-item nav_title fw-normal" href="?faq">FAQ</a>
                    </ul>
                </li>
                <li class="nav-item mx-3 py-1">
                    <a class="btn btn-full" aria-current="page" href="?book">Book Now</a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<style>
    .nav_title {
        font-weight: 700;
    }
</style>