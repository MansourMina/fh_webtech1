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
                        <button class="nav-link active settings-tab" id="v-pills-general-tab" data-bs-toggle="pill" data-bs-target="#v-pills-general" type="button" role="tab" aria-controls="v-pills-general" aria-selected="true">
                            <i class="fa fa-gears me-4 settings-icon"></i>
                            General</button>
                        <button class="nav-link settings-tab" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                            <i class="fa fa-user me-4 settings-icon"></i>
                            Profile</button>
                    </div>
                    <div class="tab-content w-75" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab" tabindex="0">
                            <div class="d-flex justify-content-between">
                                <label for="selectTheme" class="col-form-label">Theme</label>

                                <form action="" method="post">
                                    <a class="nav-link dropdown-toggle nav_title btn fw-normal fs-6 mb-0" data-bs-toggle='dropdown' id="selectTheme">
                                        <?= $GLOBALS["darkMode"] ? "Dark" : "Light" ?>
                                    </a>
                                    <ul class='dropdown-menu '>
                                        <button type="submit" name="theme_color" value="light" class='dropdown-item nav_title fw-normal btn'>Light</button>
                                        <button type="submit" name="theme_color" value="dark" class='dropdown-item nav_title fw-normal btn'>Dark</button>
                                    </ul>
                                </form>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <label for="selectTheme" class="col-form-label">Delete Account</label>
                                <button class="btn btn-danger" type="button">
                                    Delete</button>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
                            <div class="d-flex justify-content-between">
                                <label class="col-form-label">Edit</label>
                            </div>
                            <hr>

                        </div>

                    </div>
                </div>


            </div>

        </div>
    </div>
</div>