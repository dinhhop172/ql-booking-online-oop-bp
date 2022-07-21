<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Edit user</h4>
                            <p class="card-title-desc"></p>
                            <?php if($data['room']){ ?>
                            <form class="custom-validation" method="POST" action="?c=room&a=update">
                                <input type="hidden" name="id_room" value="<?= $data['room']['id'] ?>">    
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" value="<?= $data['room']['name'] ?>" name="name" class="form-control" required placeholder="Type something" />
                                    <?php if(isset($_SESSION['error']['name'])){ ?>
                                    <div class="alert alert-danger mb-0" role="alert">
                                        <?= $_SESSION['error']['name'] ?>
                                    </div>  
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <div>
                                        <input value="<?= $data['room']['price'] ?>" name="price" type="text" class="form-control" required placeholder="Enter only numbers" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Update" name="updateRoom" class="form-control" required placeholder="Enter only digits" />
                                </div>
                            </form>
                            <?php }else{ ?>
                            <div class="alert alert-danger">
                                <strong>Error!</strong> Room not found.
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>