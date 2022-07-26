
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
                        
                        
                        <!-- <p class="card-title-desc">For basic styling—light padding and only horizontal dividers—add the base class <code>.table</code> to any -->
                        </p>

                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Money</th>
                                        <th>Status</th>
                                        <th>Request day</th>
                                        <th>Payment day</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i= 1; foreach($data['staff'] as $key => $value) { ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $value['money'] ?></td>
                                            <td><?php 
                                                if($value['status'] == 1){
                                                    echo 'Processing';
                                                }elseif($value['status'] == 2){
                                                    echo 'Approved';
                                                }else{
                                                    echo 'Reject';
                                                }
                                            ?></td>
                                            <td><?= $value['request_day'] ?></td>
                                            <td><?= $value['payment_day'] ?></td>
                                            <td>
                                                <form action="?c=requestpayment&a=update_accept" method="POST" id="update_accept<?= $i ?>">
                                                    <input type="hidden" name="request_id" value="<?= $value['id'] ?>" />
                                                </form>
                                                <form action="?c=requestpayment&a=update_cancel" method="POST" id="update_cancel<?= $i ?>">
                                                    <input type="hidden" name="money" value="<?= $value['money'] ?>" />
                                                    <input type="hidden" name="cancel_id" value="<?= $value['id'] ?>" />
                                                    <input type="hidden" name="staff_id" value="<?= $value['staff_id'] ?>" />
                                                </form>
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