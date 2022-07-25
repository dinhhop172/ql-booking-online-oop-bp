<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Edit user</h4>
                            <p class="card-title-desc"></p>
                            <?php if($data['user']){ ?>
                            <form class="custom-validation" method="POST" action="?c=user&a=update">
                                <input type="hidden" name="id_user" value="<?= $data['user']['id'] ?>">    
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" value="<?= $data['user']['username'] ?>" name = "username" class="form-control" required placeholder="Type something" />
                                </div>

                                <div class="form-group">
                                    <label>Equal To</label>
                                    <div>
                                        <input type="password" id="pass2" name="password" class="form-control" required placeholder="Password" />
                                    </div>
                                    <div class="mt-2">
                                        <input type="password" name="re-password" class="form-control" required data-parsley-equalto="#pass2" placeholder="Re-Type Password" />
                                    </div>
                                    <?php if(isset($_SESSION['error']['password'])) {?>
                                        <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            </button>
                                            <?= $_SESSION['error']['password'] ?>
                                        </div>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label>E-Mail</label>
                                    <div>
                                        <input type="email" name="email" value="<?= isset($_SESSION['data']['email']) ? $_SESSION['data']['email'] : $data['user']['email'] ?>" class="form-control" required parsley-type="email" placeholder="Enter a valid e-mail" />
                                    </div>
                                    <?php if(isset($_SESSION['error']['email'])) {?>
                                        <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            </button>
                                            <?= $_SESSION['error']['email'] ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label>Phone number</label>
                                    <div>
                                        <input value="<?= isset($_SESSION['data']['phone_number']) ? $_SESSION['data']['phone_number'] : $data['user']['phone_number'] ?>" type="number" name="phone_number" class="form-control" required placeholder="Phone" />
                                    </div>
                                    <?php if(isset($_SESSION['error']['phone_number'])) {?>
                                        <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            </button>
                                            <?= $_SESSION['error']['phone_number'] ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label>Gender</label>
                                    <input type="radio" name="sex" value="male" <?= ($data['roles']['sex'] == 'male' ? 'checked' : '') ?>> Male &emsp;
                                    <input type="radio" name="sex" value="female" <?= ($data['roles']['sex'] == 'female' ? 'checked' : '') ?>> Female;
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <div>
                                        <input value="<?= $data['user']['address'] ?>" name="address" type="text" class="form-control" required placeholder="Enter only numbers" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="userpassword">Role</label><br>
                                    <?php if(isset($_SESSION['admin'])) {?>
                                    <input type="radio" name="roles" value="admin" <?= ($data['roles']['roles'] == 'admin' ? 'checked' : '') ?>> Admin &emsp;
                                    <input type="radio" name="roles" value="staff" <?= ($data['roles']['roles'] == 'staff' ? 'checked' : '') ?>> Staff &emsp;
                                    <?php } ?>
                                    <input type="radio" name="roles" value="user" <?= ($data['roles']['roles'] == 'user' ? 'checked' : '') ?>> User
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Update" name="updateUser" class="form-control" required placeholder="Enter only digits" />
                                </div>
                            </form>
                            <?php }else{ ?>
                            <div class="alert alert-danger">
                                <strong>Error!</strong> User not found.
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>