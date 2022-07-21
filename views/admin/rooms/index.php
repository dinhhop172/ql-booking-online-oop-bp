
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title-box">
                        <h4>Data Table</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Lexa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Data Table</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">All rooms<a href="?c=room&a=create" class="float-right btn btn-primary">Add new room</a></h4>
                            
                            <!-- <p class="card-title-desc">For basic styling—light padding and only horizontal dividers—add the base class <code>.table</code> to any -->
                            </p>

                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i= 1; foreach($data['rooms'] as $value) { ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $value['name'] ?></td>
                                                <td><?= $value['price'] ?></td>
                                                <td><?= $value['status'] == 1 ? "Empty room" : 'Room booked' ?></td>
                                                <td>
                                                    <a href="?c=room&a=edit&id=<?= $value['id'] ?>" class="btn btn-info waves-effect waves-light"><i class="mdi mdi-circle-edit-outline"></i></a>
                                                    <a onclick="return confirm('Bạn chắc chắn muốn xóa')" href="?c=room&a=destroy&id=<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-delete"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            © 2018 - <script>document.write(new Date().getFullYear())</script> Lexa <span class="d-none d-sm-inline-block"> - Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand.</span>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
 </div>