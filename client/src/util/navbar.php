<style>
    .sidebar-icon {
        color: grey;
    }
</style>
<nav class="navbar navbar-expand-xl  p-4 bg-white sticky-top ">
    <div class="container-fluid">
        <?php if (isset($_SESSION['member_id'])) : ?>
            <?php if ($_SESSION['is_admin'] == 1) : ?>
                <button class="navbar-toggle btn-lg me-lg-5 btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkManagement" aria-controls="offcanvasDarkManagement" aria-expanded="false" aria-label="Toggle sidebar" style="display: block !important;">
                    <i class="fa fa-align-left bg-transparent"></i>
                </button>
            <?php endif; ?>
        <?php endif; ?>
        <a class="navbar-brand" href="?">
            <img src="res/img/logo.png" alt="MF Palmside Resort" width="200">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto mx-5  ">
                <li class="nav-item mx-3 py-1 ">
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
                            <?php if ($_SESSION['is_admin'] == 0) : ?>
                                <a class='dropdown-item nav_title fw-normal' href='?reservations'>Reservations</a>
                            <?php endif; ?>
                            <a class='dropdown-item nav_title fw-normal btn' onclick="openModal('settingsModal')">Settings</a>

                            <div class='dropdown-divider '></div>
                            <a class='dropdown-item nav_title fw-normal' href='?logout'>Logout</a>
                        </ul>
                    <?php else : ?>
                        <a class="nav-link nav_title" href="?login"><span>login</span></a>
                    <?php endif; ?>

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

                <?php if ((isset($_SESSION['member_id']) && $_SESSION['is_admin'] == 0) || !isset($_SESSION['member_id'])) : ?>
                    <li class="nav-item mx-3 py-1">
                        <a class="btn btn-full" aria-current="page" href="?book">Book Now</a>
                    </li>

                <?php endif; ?>


            </ul>
        </div>
    </div>
</nav>


<!-- Admin Management navigation -->
<div class="container-fluid">
    <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="offcanvasDarkManagement" aria-labelledby="offcanvasDarkManagementLabel">
        <div class="offcanvas-header justify-content-end" data-bs-theme="dark">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="d-flex row align-items-center text-center mt-2">
            <div><img src="<?php echo $_SESSION["image"] ? $_SESSION["image"] : 'src/images/default.png' ?>" alt="Profile Image" class="rounded-circle img-circle" width="80" height="80" id="sidebar-profile"></div>
            <p class="mb-0 mt-2 h5 fw-bold"><?= $_SESSION["firstname"] . " " . $_SESSION["lastname"] ?></p>
            <p class="mb-0 text-secondary">Admin</p>
        </div>
        <div class="offcanvas-body ">
            <hr>

            <h5 class="offcanvas-title" id="offcanvasDarkManagementLabel">Management</h5>
            <hr>

            <ul class="navbar-nav justify-content-end flex-grow-1 ">
                <li class="nav-item">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-users  me-4 sidebar-icon"></i>
                        <a class="nav-link active" aria-current="page" href="?members">Members</a>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-paste me-4 sidebar-icon"></i>
                        <a class="nav-link active" href="?reservations-management">Reservations</a>

                    </div>
                </li>
                <li class="nav-item">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-globe me-4 sidebar-icon"></i>

                        <a class="nav-link active" href="?news-management">News</a>


                    </div>
                </li>
            </ul>
        </div>
        <div class="offcanvas-footer align-items-center text-center mb-4">
            <a class='mb-0 text-secondary' style="text-decoration:none" href='?logout'>Logout</a>
        </div>
    </div>
</div>

<?php include 'settings.php'; ?>
<style>
    .nav_title {
        font-weight: 700;
    }
</style>

<script>

</script>