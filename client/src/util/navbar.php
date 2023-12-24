<nav class="navbar navbar-expand-xl  p-4 bg-white sticky-top ">
    <div class="container-fluid">
        <a class="navbar-brand" href="?">
            <img src="res/img/logo.png" alt="MF Palmside Resort" width="200">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto mx-5 ">
                <li class="nav-item mx-3 py-1">
                    <a class="nav-link nav_title " aria-current="page" href="?">Home</a>
                </li>
                <li class="nav-item mx-3 py-1">
                    <a class="nav-link  nav_title" aria-current="page" href="?rooms">Rooms</a>
                </li>
                <li class="nav-item mx-3 py-1">
                    <a class="nav-link  nav_title" href="?news">News</a>
                </li>

                <li class="nav-item <?php echo isset($_SESSION['member_id']) ? 'dropdown' : '' ?> mx-3 py-1">
                    <?php if (isset($_SESSION['member_id'])) : ?>
                        <a class="nav-link dropdown-toggle nav_title" data-bs-toggle='dropdown' href="">
                            <span style='color: red; max-width: 200px; vertical-align: middle;' class='d-inline-block text-truncate'> <?= $_SESSION['firstname'] . " " . $_SESSION['lastname'] ?></span>
                        </a>
                        <ul class='dropdown-menu dropdown-menu-dark'>
                            <a class='dropdown-item nav_title fw-normal' href='?profile'>Profile</a>
                            <a class='dropdown-item nav_title fw-normal' href='?reservations'>Reservations</a>
                            <div class='dropdown-divider '></div>
                            <a class='dropdown-item nav_title fw-normal' href='?logout'>Logout</a>
                        </ul>
                    <?php else : ?>
                        <a class="nav-link nav_title" href="?login"><span>login</span></a>
                    <?php endif; ?>

                </li>
                <?php if (isset($_SESSION['member_id'])) : ?>
                    <?php if ($_SESSION['is_admin'] == 1) : ?>
                        <li class="nav-item dropdown">
                            <div class="mx-3 py-1">
                                <a class=" nav-link dropdown-toggle nav_title" data-bs-toggle='dropdown' href="">
                                    <span>Management</span>
                                </a>
                                <ul class='dropdown-menu dropdown-menu-dark'>
                                    <a class='dropdown-item nav_title fw-normal' href='?members'>Members</a>
                                    <a class='dropdown-item nav_title fw-normal' href='?reservations_management'>Reservations</a>
                                    <a class='dropdown-item nav_title fw-normal' href='?reservations'>News</a>
                                </ul>

                            </div>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
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