<?= view('manage/common/head') ?>
<div class="bg-gradient-primary login-page">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center main-div">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="main-div-form p-4">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 font-weight-bold mb-4">SM SYSTEM !</h1>
                                    </div>
                                    <form class="user" id="1-login-form" method="get" action="<?= manageURL('authenticate') ?>">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="email" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" name="remember_me" class="custom-control-input" id="remember_me">
                                                <label class="custom-control-label" for="remember_me">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <input type="hidden" id="form_type" name="form_type" value="login"/>
                                        <button type="submit" class="btn btn-primary btn-user btn-block login-form-btn-submit">
                                            Login
                                        </button>
                                        <!-- <hr>
                                        <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a> -->
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= manageURL('forget-password')?>">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?= manageURL('register')?>">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
<?= view('manage/common/footer') ?>