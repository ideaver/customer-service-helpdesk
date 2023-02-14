<?php include "header.php";?>

<div class="row">
    <div class="col-md-6 grid-margin stretch-card" style="margin:auto;">
        <div class="card">
            <div class="card-body">

                <h6 class="card-title">Admin Create</h6>

                <form class="forms-sample">
                    <div class="mb-3">
                        <label class="form-label">Fullname</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select class="form-select" id="exampleFormControlSelect1">
                            <option selected disabled>--Select--</option>
                            <option>Active</option>
                            <option>Not Active</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" id="exampleFormControlSelect1">
                            <option selected disabled>--Select--</option>
                            <option>Active</option>
                            <option>Not Active</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                </form>

            </div>
        </div>
        </div>
    </div>
</div>
<?php include "footer.php";?>