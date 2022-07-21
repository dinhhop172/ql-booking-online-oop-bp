<?php

if(!empty($_GET['id'])){
    // $id = $_GET['id'];
    // var_dump($data);exit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <h5 class="card-title">Edit date booking</h5>
                    <div class="card-body">
                        <form action="?c=booking&a=editRoomBooked" method="POST">
                            <input type="hidden" name="id" value="<?= $data['id'] ?>">
                            <div class="form-group">
                                <label for="">Check in</label>
                                <input type="date" class="form-control" name="check_in" value="<?= $data['check_in'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Check out</label>
                                <input type="date" class="form-control" name="check_out" value="<?= $data['check_out'] ?>">
                            </div>
                            .<div class="form-group">
                              <input type="submit" name="update_booking_user" id="" class="form-control">
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
<?php }else{
    echo "Id Not found";
} ?>