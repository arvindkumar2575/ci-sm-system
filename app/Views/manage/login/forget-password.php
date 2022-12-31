<?= view('manage/common/head') ?>
<div class="bg-gradient-primary forgetpassword-page">
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
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                            and we'll send you a link to reset your password!</p>
                                    </div>
                                    <form class="user" id="3-forget-password-form" method="post" action="<?= manageURL('authenticate') ?>">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                        </div>
                                        <input type="hidden" name="form_type" value="forget_password"/>
                                        <button type="submit" class="btn btn-primary btn-user btn-block forget-password-form-btn-submit">
                                            Reset Password
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= manageURL('register')?>">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?= manageURL()?>">Already have an account? Login!</a>
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