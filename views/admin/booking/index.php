<?php 
    echo Session::getSession('success');
    echo Session::getSession('error');
?>
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
                        <!-- <h4 class="card-title">All booking<a href="create.php" class="float-right btn btn-primary">Add new booking</a></h4> -->
                        
                        <!-- <p class="card-title-desc">For basic styling—light padding and only horizontal dividers—add the base class <code>.table</code> to any -->
                        </p>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>Account booking</th>
                                        <th>Room booking</th>
                                        <th>Total price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($data['booking']){ ?>
                                        <?php foreach($data['booking'] as $value) { ?>
                                            <tr>
                                                <td><?= $value['email'] ?></td>
                                                <td><?= $value['name'] ?></td>
                                                <td><?= $value['total_price'] ?></td>
                                                <td>
                                                    <?php if($value['status'] == 1){ echo 'Not payment'; }elseif($value['status'] == 2){echo 'Paid';} ?>
                                                </td>
                                                <td>
                                                    <?php if($value['status'] == 1) {?>
                                                    <form action="?c=book&a=payment" id="payment_<?= $value['id'] ?>" method="POST">
                                                        <input type="hidden" name="total_price" value="<?= $value['total_price'] ?>">
                                                        <input type="hidden" name="room_id" value="<?= $value['room_id'] ?>">
                                                        <input type="hidden" name="id" value="<?= $value['id'] ?>">
                                                        <input type="hidden" name="user_id" value="<?= $value['account_id'] ?>">
                                                    </form>
                                                    <input type="submit" class="btn btn-success waves-effect waves-light" form="payment_<?= $value['id'] ?>" value="Pay"/>
                                                    <?php }?>
                                                    <a href="?c=booking&a=edit&id=<?= $value['id'] ?>" class="btn btn-info waves-effect waves-light"><i class="mdi mdi-circle-edit-outline"></i></a>
                                                    <a onclick="return confirm('Are you sure?')" href="?c=booking&a=destroy&id=<?= $value['id'] ?>" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-delete"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php }else{ ?>
                                        <tr>
                                            <td colspan="5" class="text-center">No data</td>
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

<?php Session::unsetSession('success'); ?>
<?php Session::unsetSession('error'); ?>