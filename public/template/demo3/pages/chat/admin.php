<?php include "header.php";?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-header">
            <a href="admin_create.php" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i></a>
        </div>
        <div class="card-body">
            <h6 class="card-title">Admin</h6>
            <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>FULLNAME</th>
                                <th>EMAIL</th>
                                <th>ROLE</th>
                                <th>STATUS</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Muhammad Razakki</th>
                                <td>razakki@maimaid.id</td>
                                <td>Super Admin</td>
                                <td>Active</td>
                                <td> 
                                    <a href="admin_update.php" class="btn btn-primary"><i class="link-icon" data-feather="edit"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <nav aria-label="Page navigation example">
                    <ul class="pagination pagination-rounded">
                        <li class="page-item"><a class="page-link" href="#"><i data-feather="chevron-left"></i></a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item disabled"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#"><i data-feather="chevron-right"></i></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    
</div>
<?php include "footer.php";?>