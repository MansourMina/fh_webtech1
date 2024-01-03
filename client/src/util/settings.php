<style>
    .nav-link {
        color: black;
    }

    .nav-link:hover {
        color: #15736b;
    }
</style>

<div class="modal" tabindex="-1" id="settingsModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex align-items-start">
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active " id="v-pills-general-tab" data-bs-toggle="pill" data-bs-target="#v-pills-general" type="button" role="tab" aria-controls="v-pills-general" aria-selected="true">
                            <i class="fa fa-gears me-4" style="color: black"></i>
                            General</button>
                        <button class="nav-link " id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                            <i class="fa fa-gears me-4" style="color: black"></i>
                            Profile</button>
                    </div>
                    <div class="tab-content w-75" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-general-tab" tabindex="0">
                            <div class="d-flex justify-content-between">
                                <label for="selectTheme" class="col-form-label">Theme</label>
                                <select class="form-select form-select-md mb-3 w-25" aria-label="Large select example" id="selectTheme">
                                    <option value="light" selected>Light</option>
                                    <option value="dark">Dark</option>
                                </select>
                            </div>
                            <hr>

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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>