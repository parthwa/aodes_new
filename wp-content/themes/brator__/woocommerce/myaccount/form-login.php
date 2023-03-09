<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); 
?>
<style>
    .woocommerce-error{
        margin: 0;
    }
</style>
<section class="login-section">
        <div class="d-lg-flex half">
            <div class="bg order-1 order-md-2" style="background-image: url('<?php echo get_stylesheet_directory_uri();?>/assets/images/img.jpg');"></div>
                <div class="contents order-2 order-md-1">
                    <div class="container">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-8 text-center">
                                <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/login-logo.png" class="img img-fluid logo">
                                <h2 class="login_title">DEALER LOGIN</h2>
                                <form class="woocommerce-form woocommerce-form-login" name="loginform" id="loginform" method="post">
                                    <?php do_action( 'woocommerce_login_form_start' ); ?>
                                    <div class="form-group first input-group mb-4 align-items-end justify-content-center">
                                        <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/user.png" width="50px" class="input-group-text icon-image" id="basic-addon1">
                                        
                                        <input type="text" class="form-control" placeholder="Email address" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="form-group last input-group mb-5 align-items-end justify-content-center">
                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/password.png" width="50px" class="input-group-text icon-image" id="basic-addon2">
                                        <input type="password" class="form-control" placeholder="Password" name="password" id="password" autocomplete="current-password" aria-label="password" aria-describedby="basic-addon2">
                                    </div>
                                    <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                                    <input type="submit"  name="login" id="wp-submit" value="SIGN IN" class=" btn btn-block btn-primary sign_in_btn">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <?php do_action( 'woocommerce_after_customer_login_form' ); ?>