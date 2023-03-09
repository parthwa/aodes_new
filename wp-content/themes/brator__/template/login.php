<?php
/**
 * comment for template*
 * Template Name: Login page

 */

get_header(); ?>


    <!-------login-section-here-------->
    <section class="login-section">
        <div class="d-lg-flex half">
            <div class="bg order-1 order-md-2" style="background-image: url('<?php echo get_stylesheet_directory_uri();?>/assets/images/img.jpg');"></div>
                <div class="contents order-2 order-md-1">
                    <div class="container">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-8 text-center">
                                <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/login-logo.png" class="img img-fluid logo">
                                <h2 class="login_title">DEALER LOGIN</h2>
                                <form action="<?php echo site_url( '/wp-login.php' ); ?>" name="loginform" id="loginform" method="post">
                                    <div class="form-group first input-group mb-4 align-items-end justify-content-center">
                                        <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/user.png" width="50px" class="input-group-text icon-image" id="basic-addon1">
                                        
                                        <input type="text" class="form-control" placeholder="Email address" id="username" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="form-group last input-group mb-5 align-items-end justify-content-center">
                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/password.png" width="50px" class="input-group-text icon-image" id="basic-addon2">
                                        <input type="password" class="form-control" placeholder="Password" id="password" aria-label="password" aria-describedby="basic-addon2">
                                    </div>

                                    <input type="submit" name="wp-submit" id="wp-submit" value="SIGN IN" class="btn btn-block btn-primary sign_in_btn">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    


<?php get_footer();?>