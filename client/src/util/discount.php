<div class="modal fade " id="modalDiscount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false>
    <div class=" modal-dialog modal-md position-fixed end-0 bottom-0 mx-2 my-2" style="min-width: 100px; max-width: 400px">
    <div class="modal-content ">
        <div class="modal-header bg-danger text-white">
            <h5 class="modal-title">Discount offer: <strong>10% off</strong></h5>
        </div>

        <!--Body-->
        <div class="modal-body">
            <div class="row">
                <div class="col-3">
                    <p></p>
                    <p class="text-center ">
                        <i class="fa fa-gift fa-4x text-danger"></i>
                    </p>
                </div>

                <div class="col-9">
                    <p>We enjoy surprising our guests with little joys. Today is one of those happy moments.</p>
                    <p>
                        <strong>Reserve your room now using the following code at checkout for an exclusive one-day 10% discount</strong>
                    </p>
                    <h2>
                        <span class="badge bg-danger">v52gs1</span>
                    </h2>
                </div>
            </div>
        </div>

        <!--Footer-->
        <div class="modal-footer justify-content-center">
            <a href="?book" class="btn btn-danger btn-lg" onclick="localStorage.setItem('discountClicked', true );">Book now <i class="far fa-gem ms-1"></i></a>
            <button type="button" class="btn btn-outline-danger btn-lg" onclick="localStorage.setItem('discountClicked', true);" data-bs-dismiss="modal">No, thanks</button>
        </div>
    </div>
</div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let discountClicked = localStorage.getItem("discountClicked");
        if (!discountClicked) {
            var modal = new bootstrap.Modal(document.getElementById('modalDiscount'));
            modal.show();
        }

    });
</script>