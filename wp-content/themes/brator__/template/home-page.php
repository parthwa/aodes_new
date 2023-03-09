<?php
/**
 * comment for template*
 * Template Name: Home page

 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>


   <!-------hero-starts-here-------->
   <section class="hero">
   <?php $banner_image = get_field( "banner_image"); $banner_bottom_image = get_field( "banner_bottom_image"); $banner_title = get_field( "banner_title");  ?>
    <img src="<?php echo $banner_image;?>" alt="image" class="img-fluid">
    <div class="hero-content">
      <a href="#" class="find-deal">
        FIND A Dealer
      </a>
      <a href="#" class="contact-us">
        CONTACT US NOW
      </a>
    </div>

    <div class="hero-title">
      <div class="hero-title-img">
        <img src="<?php echo $banner_bottom_image;?>" alt="image" class="img-fluid">
        <div class="hero-title-text">
        <h1><?php echo $banner_title;?></h1>
        </div>
      </div>
    </div>
  </section>
  <!------vehicle-categort-starts------>
  <section class="vehicle-category">
    <div class="container">
      <div class="row">
        <div class="vehicle-product">
          <h2 class="vehicle-category-title">
            Vehicle Category
          </h2>
          <div class="vehicle-products-1">
          <?php   $taxonomy     = 'product_cat';
                    $orderby      = 'ID';  
                    $show_count   = 0;      // 1 for yes, 0 for no
                    $pad_counts   = 0;      // 1 for yes, 0 for no
                    $hierarchical = 1;      // 1 for yes, 0 for no  
                    $title        = '';  
                    $empty        = 0;

                    $args = array(
                            'taxonomy'     => $taxonomy,
                            'orderby'      => $orderby,
                            'show_count'   => $show_count,
                            'pad_counts'   => $pad_counts,
                            'hierarchical' => $hierarchical,
                            'title_li'     => $title,
                            'hide_empty'   => $empty,
                            'order'   => 'DESC',
                            'number' => 4
                    );
                    $all_categories = get_categories( $args );
                    foreach ($all_categories as $cat) {
                        if($cat->category_parent == 0) {
                            $category_id = $cat->term_id;       
                           

                            $args2 = array(
                                    'taxonomy'     => $taxonomy,
                                    'child_of'     => 0,
                                    'parent'       => $category_id,
                                    'orderby'      => $orderby,
                                    'show_count'   => $show_count,
                                    'pad_counts'   => $pad_counts,
                                    'hierarchical' => $hierarchical,
                                    'title_li'     => $title,
                                    'hide_empty'   => $empty
                            );
                            
                            $term_id      = get_term_by( 'slug', $cat->slug, $taxonomy )->term_id;
                            $thumbnail_id = get_woocommerce_term_meta( $term_id, 'thumbnail_id', true );
                            $image        = wp_get_attachment_url( $thumbnail_id );
            ?>
            <div class="vehicle-content">
              <img src="<?php echo $image;?>" alt="image" class="img-fluid">
              <h2 class="vehicle-content-title"><?php echo $cat->name;?></h2>
              <div class="vehicle-content-button">
                <a href="<?php echo get_term_link($cat->slug, 'product_cat');?>" class="vehicle-product-link">Explore More</a>
              </div>
            </div>
            <?php }       
                    }?>
            
          </div>
   
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
  <!-------vehicle-trial-starts-->
  <section class="vehicle-trial">
    
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <?php 
            $count = 1;
            $args = array( 'post_type' => 'testimonials', 'posts_per_page' => -1,'post_status' => 'publish' );
            $the_query = new WP_Query( $args );  ?>
            <?php if ( $the_query->have_posts() ) : ?>
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); 

            $video_url = get_field( "video_url", get_the_id() );
            $rating = get_field( "rating", get_the_id() );
            $add_review = get_field( "add_review", get_the_id() );
            $user_name = get_field( "user_name", get_the_id() );
        ?>
        <div class="carousel-item <?php if($count == 1){ echo "active";}?>">
          <iframe width="1200" height="800" src="<?php echo $video_url;?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
             <div class="curved-image">
            <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/vehicle-slideshow-wraop.png" alt="image" class="img-fluid">
          </div>
          <div class="vehicle-trial-content">
            <div class="vehicle-text">
            <h2 class="vehicle-trial-content-title"><?php echo the_title();;?></h2>
            <div class="rating-img">
                <?php for($i=1;$i<= 5;$i++){
                    if($rating < $i){
                    ?>
                     <i class="fa-sharp fa-solid fa-star"></i>
                
                <?php }else{?>
                    <i class="fa-sharp fa-solid fa-star active"></i>
                <?php }?>
                <?php }?>
            </div>
            <div class="rating-text">
              <p>"<?php echo $add_review;?>"</p>
            </div>
            <div class="customer-name">
              <p><?php echo $user_name;?></p>
            </div>
            <div class="video-link">
              <a href="<?php echo $video_url;?>" target="_blank">
              <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/you-tube-icon.png" alt="image" class="img-fluid"></a><span>Watch the video
                  now</span>
            </div>
          </div>
          </div>
         
        </div>
        <?php $count++;
                endwhile;
        wp_reset_postdata(); ?>
        <?php endif; ?>
        
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    </div>
    </div>
   
  </section>

  <!-----accessories-starts----->
  <section class="accessories">
    <div class="container">
      <div class="accessoris-content">
        <h2 class="accessories-title">
          ACCESSORIES
        </h2>
        <?php $count = 1;
            $args = array( 'post_type' => 'catalogs', 'posts_per_page' => 2,'post_status' => 'publish' ,'orderby'      => 'ID', 'order'=>'DESC');
            $the_query = new WP_Query( $args );  ?>
            <?php if ( $the_query->have_posts() ) : ?>
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); 

            $upload_pdf = get_field( "upload_pdf", get_the_id() );
            $preview_image = get_field( "preview_image", get_the_id() );
           
            if($count == 1){
        ?>
        <div class="accessories-img">
          <a href="<?php echo $upload_pdf;?>" target="_blank"><div class="accessories-img-bumpers">
            <img src="<?php echo $preview_image;?>" alt="image" class="img-fluid">
            </a>
          <a href="<?php echo $upload_pdf;?>" target="_blank"><p class="bumper">
              <?php echo get_the_title();?>
            </p></a>
          </div>
          <?php }else{ ?>
            <div class="accessories-img-doors">
            <a href="<?php echo $upload_pdf;?>" target="_blank">
                <img src="<?php echo $preview_image;?>" alt="image" class="img-fluid">
                </a>
                <a href="<?php echo $upload_pdf;?>" target="_blank"><p class="doors">
                <?php echo get_the_title();?>
                </p></a>
            </div>
            <?php } $count++;
                endwhile;
        wp_reset_postdata(); ?>
        <?php endif; ?>
        
          
        </div>
        <div class="accessories-img-mobile">
        <?php $count = 1;
            $args = array( 'post_type' => 'catalogs', 'posts_per_page' => 2,'post_status' => 'publish' ,'orderby'      => 'ID', 'order'=>'DESC');
            $the_query = new WP_Query( $args );  ?>
            <?php if ( $the_query->have_posts() ) : ?>
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); 

            $upload_pdf = get_field( "upload_pdf", get_the_id() );
            $preview_image = get_field( "preview_image", get_the_id() );
           
            
        ?>
            <div class="mobile-accesories">

                <img src="<?php echo $preview_image;?>" alt="image" class="img-fluid">
                <a href="<?php echo $upload_pdf;?>">
                    <p class="bumper">
                    <?php echo get_the_title();?>
                    </p>
                </a>
            </div>
            <?php $count++;
                endwhile;
        wp_reset_postdata(); ?>
        <?php endif; ?>
        </div>
            <div class="accessories-button">
              <a href="#" class="accessories-link">
                explore more
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!------find-dealer-starts------>
  <section class="find-dealer">
    <div class="container">
      <div class="find-dealer-content">
        <div class="row">
          <div class="col-lg-5">
            <div class="location">
              <h2 class="deal">
                Find a Dealer
              </h2>
              <div class="loction-address">
                <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/location.png" alt="image" class="img-fluid"><span class="address-input"><input
                    type="text" placeholder="Enter your zip"></span>
                <div class="discover-your-button">
                  <a href="#" class="discover-your">Discover Yours</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-2">
            <div class="verticle-line">
              <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/verticle-line.png" alt="image" class="img-fluid">
            </div>
          </div>
          <div class="col-lg-5">
            <div class="dealer-login-content">
              <div class="login-dealer">
                <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/dealer.png" alt="image" class="img-fluid"><a href="#"
                  class="login-dealer-button">Dealer
                  Login</a>
              </div>
              <div class="become-leader">
                <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/become-dealer.png" alt="image" class="img-fluid"><a href="#"
                  class="become-leader-button">Become a
                  dealer</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


<?php get_footer();?>