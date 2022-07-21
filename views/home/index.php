<section>
    <div class="container mt-4">
        <h1 class="text-secondary text-center">All rooms</h1><br>
        <div class="row">
        <?php foreach($data['rooms'] as $value) { ?>
            <div class="col-md-4 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="http://xuonggooccho.com/wp-content/uploads/2019/07/Hinh-anh-phong-ngu-dep-1.jpg" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                        <h5 class="card-title">Name: <?= $value['name'] ?></h5>
                        <p class="card-text">Price: <?= $value['price'] ?></p>
                        <p class="card-text <?= ($value['status'] == 1 ? 'text-success' : 'text-danger') ?>">Status: <?= ($value['status'] == 1 ? 'Empty room' : 'Room booked') ?></p>
                        <?php if($value['status'] == 1){ ?>
                            <?php if(isset($_SESSION['user']) && !empty($_SESSION['user']['email_verified_at'])){ ?>
                            <a href="?c=booking&room_id=<?= $value['id'] ?>&user_id=<?= $_SESSION['user']['id'] ?>" class="btn btn-primary">Book room</a>
                            <?php }else{ ?>
                                <a onclick="alert('Vui lòng đăng nhập hoặc xác thực tài khoản')" class='btn btn-primary'>Book room</a>
                                <?php } ?>
                            <?php }else{ ?>
                            <button type='button' class="btn btn-danger">Room booked</button> 
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
</section>