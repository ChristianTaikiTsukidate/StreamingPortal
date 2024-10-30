<?php require_once("header.php");
createHeader("Create your account on Your Site Name to enjoy personalized features, manage your profile, and access exclusive content. Join us today!", "registration, sign up, create account, join us, user registration, Streaming Search Engine", "Register | Streaming Search Engine - Create Your Account", false);
?>
<?php require_once ("../controller/RegisterController.php")?>
    <!-- Normal Breadcrumb Begin -->
    <section class="normal-breadcrumb set-bg" data-setbg="img/normal-breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h1>Sign Up</h1>
                        <p>Welcome to the official Anime blog.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Normal Breadcrumb End -->

    <!-- Signup Section Begin -->
    <section class="signup spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login__form">
                        <h3>Sign Up</h3>
                        <form method="post" class="form-horizontal" enctype="multipart/form-data"
                              onSubmit="return image_validate();">
                            <div class="input__item">
                                <input type="text" name="name" placeholder="Your Name" required>
                                <span class="icon_profile"></span>
                            </div>
                            <div class="input__item">
                                <input type="text" name="email" placeholder="Email address" required>
                                <span class="icon_mail"></span>
                            </div>
                            <div class="input__item">
                                <input type="password" placeholder="Password" name="password" id="password" required>
                                <span class="icon_lock"></span>
                            </div>
                            <button type="submit" class="site-btn" name="register">Register</button>
                        </form>
                        <h5>Already have an account? <a href="login.php">Log In!</a></h5>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login__social__links">
                        <h3>Login With:</h3>
                        <ul>
                            <li><a href="#" class="facebook"><i class="fa fa-facebook"></i> Sign in With Facebook</a>
                            </li>
                            <li><a href="#" class="google"><i class="fa fa-google"></i> Sign in With Google</a></li>
                            <li><a href="#" class="twitter"><i class="fa fa-twitter"></i> Sign in With Twitter</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Signup Section End -->
<?php require_once("footer.php") ?>