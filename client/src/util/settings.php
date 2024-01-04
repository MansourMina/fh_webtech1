<style>
    .settings-tab.active {
        background-color: lightgray !important;
    }

    .settings-tab,
    .settings-tab.active,
    .settings-icon {
        color: black !important;
    }

    <?php if ($GLOBALS["darkMode"]) : ?>.settings-tab.active {
        background-color: gray !important;
    }

    .settings-tab,
    .settings-tab.active,
    .settings-icon {
        color: white !important;
    }

    <?php endif; ?>#selectTheme {
        align-self: center;
    }

    .modal-settings {
        min-height: 40vh !important;
    }
</style>

<div class="modal" tabindex="-1" id="settingsModal">
    <div class="modal-dialog modal-lg  modal-dialog-centered">
        <div class="modal-content modal-settings">
            <div class="modal-header">
                <h5 class="modal-title">Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mb-5">
                <div class="d-flex align-items-start">
                    <div class="nav flex-column nav-pills me-3 " id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active settings-tab" id="v-pills-account-tab" data-bs-toggle="pill" data-bs-target="#v-pills-account" type="button" role="tab" aria-controls="v-pills-account" aria-selected="true">
                            <div class="d-flex align-items-center justify-content-start">
                                <i class="fa fa-user me-4 settings-icon"></i>
                                Account
                            </div>

                        </button>

                        <button class="nav-link  settings-tab" id="v-pills-general-tab" data-bs-toggle="pill" data-bs-target="#v-pills-general" type="button" role="tab" aria-controls="v-pills-general" aria-selected="false">
                            <div class="d-flex align-items-center justify-content-start">
                                <i class="fa fa-gears me-4 settings-icon"></i>
                                Theme
                            </div>

                        </button>


                    </div>
                    <div class="tab-content w-75" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-account" role="tabpanel" aria-labelledby="v-pills-account-tab" tabindex="0">
                            <div class="d-flex justify-content-between">
                                <span class="col-form-label">Profile</span>
                                <a id="editProfile" type="button" href="?profile">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                        <path fill="<?= $GLOBALS["darkMode"] ? 'white' : 'black' ?>" d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z" />
                                </a>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <label for="changePassword" class="col-form-label">Password</label>
                                <button id="changePassword" onclick="openModal('passwordModal')" class="btn btn-outline-<?= $GLOBALS["darkMode"] ? 'light' : 'dark' ?>" type="button">
                                    Change</button>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <label for="deleteAccount" class="col-form-label">Delete Account</label>
                                <button id="deleteAccount" class="btn btn-danger" type="button">
                                    Delete</button>
                            </div>

                        </div>
                        <div class="tab-pane fade " id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab" tabindex="0">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="col-form-label">Theme</span>

                                <form action="" method="post" id="selectTheme">
                                    <a class="nav-link dropdown-toggle nav_title btn fw-normal fs-6 mb-0" data-bs-toggle='dropdown' href="#">
                                        <?= $GLOBALS["darkMode"] ? "Dark" : "Light" ?>
                                    </a>
                                    <ul class='dropdown-menu '>
                                        <button type="submit" name="theme_color" value="light" class='dropdown-item nav_title fw-normal btn'>Light</button>
                                        <button type="submit" name="theme_color" value="dark" class='dropdown-item nav_title fw-normal btn'>Dark</button>
                                    </ul>
                                </form>
                            </div>

                        </div>




                    </div>
                </div>


            </div>

        </div>
    </div>
</div>