
<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="card-body pt-0">
                        <h3 class="text-center mt-4">
                            <a href="index.html" class="logo logo-admin"><img src="assets/images/logo-dark.png"
                                    height="30" alt="logo"></a>
                        </h3>
                        <div class="p-3">
                            <h4 class="text-muted font-size-18 mb-1 text-center">Welcome Back !</h4>
                            <p class="text-muted text-center">Sign in to continue to Lexa.</p>
                            <form class="form-horizontal mt-4" action="?c=login&a=subLogin" method="POST">
                                <div class="form-group">
                                    <label for="username">Email</label>
                                    <input type="text" name="email" class="form-control" id="email" value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : '' ?>" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="userpassword">Password</label>
                                    <input type="password" name="password" class="form-control" id="userpassword" placeholder="Enter password">
                                </div>
                                <?php if(isset($_SESSION['error'])) {?>
                                <div class="alert alert-danger mb-0" role="alert">
                                    <?= $_SESSION['error'] ?>
                                </div>
                                <?php } ?>
                                <div class="form-group row mt-4">
                                    <div class="col-6">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customControlInline">
                                            <label class="custom-control-label" for="customControlInline">Remember me
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6 text-right">
                                        <input class="btn btn-primary w-md waves-effect waves-light" name="login" type="submit" value="Log In"/>
                                    </div>
                                </div>
                                <div class="form-group mb-0 row">
                                    <div class="col-12 mt-4">
                                        <a href="pages-recoverpw.html" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mt-5 text-center">
                    <p>Don't have an account ? <a href="?c=register" class="text-primary"> Signup Now </a></p>