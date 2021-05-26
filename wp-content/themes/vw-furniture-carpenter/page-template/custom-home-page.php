<?php
/**
 * Template Name: Custom Home Page
 */

get_header(); ?>

<main id="maincontent" role="main">
  <?php do_action( 'vw_furniture_carpenter_before_slider' ); ?>

  <?php if( get_theme_mod( 'vw_furniture_carpenter_slider_hide_show', false) != '' || get_theme_mod( 'vw_furniture_carpenter_resp_slider_hide_show', false) != '') { ?>

    <section id="slider">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="<?php echo esc_attr(get_theme_mod( 'vw_furniture_carpenter_slider_speed',3000)) ?>"> 
        <?php $vw_furniture_carpenter_slider_pages = array();
          for ( $count = 1; $count <= 4; $count++ ) {
            $mod = intval( get_theme_mod( 'vw_furniture_carpenter_slider_page' . $count ));
            if ( 'page-none-selected' != $mod ) {
              $vw_furniture_carpenter_slider_pages[] = $mod;
            }
          }
          if( !empty($vw_furniture_carpenter_slider_pages) ) :
            $args = array(
              'post_type' => 'page',
              'post__in' => $vw_furniture_carpenter_slider_pages,
              'orderby' => 'post__in'
            );
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) :
              $i = 1;
        ?>     
        <div class="carousel-inner" role="listbox">
          <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
              <?php the_post_thumbnail(); ?>
              <div class="carousel-caption">
                <div class="inner_carousel">
                  <h1><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                  <p><?php $excerpt = get_the_excerpt(); echo esc_html( vw_furniture_carpenter_string_limit_words( $excerpt, esc_attr(get_theme_mod('vw_furniture_carpenter_slider_excerpt_number','30')))); ?></p>
                  <?php if( get_theme_mod('vw_furniture_carpenter_slider_button_text','READ MORE') != ''){ ?>
                    <div class="more-btn">
                      <a class="view-more" href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_theme_mod('vw_furniture_carpenter_slider_button_text',__('READ MORE','vw-furniture-carpenter')));?><?php if(get_theme_mod('vw_furniture_carpenter_slider_button_icon',true)){ ?><i class="<?php echo esc_attr(get_theme_mod('vw_furniture_carpenter_slider_button_icon','fa fa-angle-right')); ?>"></i><?php } ?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('vw_furniture_carpenter_slider_button_text',__('READ MORE','vw-furniture-carpenter')));?></span></a>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          <?php $i++; endwhile; 
          wp_reset_postdata();?>
        </div>
        <?php else : ?>
            <div class="no-postfound"></div>
        <?php endif;
        endif;?>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
          <span class="screen-reader-text"><?php esc_html_e( 'Previous','vw-furniture-carpenter' );?></span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
          <span class="screen-reader-text"><?php esc_html_e( 'Next','vw-furniture-carpenter' );?></span>
        </a>
      </div>
      <div class="clearfix"></div>
    </section>

  <?php } ?>

  <?php do_action( 'vw_furniture_carpenter_after_slider' ); ?>

  <section id="contact-sec">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-3">
          <?php if( get_theme_mod( 'vw_furniture_carpenter_phone_text') != ''| get_theme_mod( 'vw_furniture_carpenter_phone_number') != ''){ ?>
            <div class="styling-box">
              <div class="row m-0">
                <div class="col-lg-3 col-md-3 col-3">
                  <i class="<?php echo esc_attr(get_theme_mod('vw_furniture_carpenter_phone_icon','fas fa-phone')); ?>"></i>
                </div>
                <div class="col-lg-9 col-md-9 col-9">
                  <h2><?php echo esc_html(get_theme_mod('vw_furniture_carpenter_phone_text',''));?></h2>
                  <p><a href="tel:<?php echo esc_url( get_theme_mod('vw_furniture_carpenter_phone_number','') ); ?>"><?php echo esc_html(get_theme_mod('vw_furniture_carpenter_phone_number',''));?></a></p>
                </div>
              </div>
            </div>
          <?php }?>
        </div>
        <div class="col-lg-4 col-md-4">
          <?php if( get_theme_mod( 'vw_furniture_carpenter_email_text') != ''| get_theme_mod( 'vw_furniture_carpenter_email_address') != ''){ ?>
            <div class="styling-box">
              <div class="row m-0">
                <div class="col-lg-2 col-md-2 col-3">
                  <i class="<?php echo esc_attr(get_theme_mod('vw_furniture_carpenter_email_address_icon','far fa-envelope')); ?>"></i>
                </div>
                <div class="col-lg-10 col-md-10 col-9">
                  <h2><?php echo esc_html(get_theme_mod('vw_furniture_carpenter_email_text',''));?></h2>
                  <p><a href="mailto:<?php echo esc_html(get_theme_mod('vw_furniture_carpenter_email_address',''));?>"><?php echo esc_html(get_theme_mod('vw_furniture_carpenter_email_address',''));?></a></p>
                </div>
              </div>
            </div>
          <?php }?>
        </div>
        <div class="col-lg-2 col-md-2 col-4">
          <div class="cart-box">
            <?php if(class_exists('woocommerce')){ ?>
              <span class="cart_no">
                <a href="<?php if(function_exists('wc_get_cart_url')){ echo esc_url(wc_get_cart_url()); } ?>" title="<?php esc_attr_e( 'shopping cart','vw-furniture-carpenter' ); ?>"><i class="<?php echo esc_attr(get_theme_mod('vw_furniture_carpenter_cart_icon','fas fa-shopping-basket')); ?>"></i><span class="screen-reader-text"><?php esc_html_e( 'shopping cart','vw-furniture-carpenter' );?></span></a>
                <span class="cart-value"> <?php echo wp_kses_data( WC()->cart->get_cart_contents_count() );?></span>
              </span>
            <?php } ?>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-8">
          <?php if( get_theme_mod( 'vw_furniture_carpenter_contact_button_url') != ''| get_theme_mod( 'vw_furniture_carpenter_contact_button_text') != ''){ ?>
            <div class="contact-butn">
              <a href="<?php echo esc_url(get_theme_mod('vw_furniture_carpenter_contact_button_url',''));?>"><?php echo esc_html(get_theme_mod('vw_furniture_carpenter_contact_button_text',''));?><span class="screen-reader-text"><?php esc_html_e( 'GET A QUOTE','vw-furniture-carpenter' );?></span></a>
            </div>
          <?php }?>
        </div>
      </div>
    </div>  
  </section>

  <?php do_action( 'vw_furniture_carpenter_after_contact' ); ?>

  <?php if( get_theme_mod( 'vw_furniture_carpenter_section_title') != '' ||get_theme_mod( 'vw_furniture_carpenter_services') != '') { ?>

  <section id="serv-section">
    <div class="container">
      <?php if( get_theme_mod( 'vw_furniture_carpenter_section_title') != '') { ?>
        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/icon.png'); ?>" class="border-image" alt="border-image" role="img">
        <h3><?php echo esc_html(get_theme_mod('vw_furniture_carpenter_section_title',''));?></h3>
        <hr>
      <?php }?>
      <div class="row">
        <?php
          $vw_furniture_carpenter_catData =  get_theme_mod('vw_furniture_carpenter_services','');
          if($vw_furniture_carpenter_catData){
          $page_query = new WP_Query(array( 'category_name' => esc_html($vw_furniture_carpenter_catData,'vw-furniture-carpenter'))); ?>
          <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
          <div class="col-lg-3 col-md-4">
            <div class="serv-box">
              <?php the_post_thumbnail(); ?>
              <div class="service-inner">
                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?><span class="screen-reader-text"><?php the_title(); ?></span></a></h4>
                <p><?php $excerpt = get_the_excerpt(); echo esc_html( vw_furniture_carpenter_string_limit_words( $excerpt, esc_attr(get_theme_mod('vw_furniture_carpenter_services_excerpt_number','30')))); ?></p>
              </div>
            </div>
          </div>
          <?php endwhile;
          wp_reset_postdata();
        } ?>
      </div>
    </div>
  </section>

  <?php } ?>

  <?php do_action( 'vw_furniture_carpenter_after_services' ); ?>

  <div class="content-vw">
    <div class="container">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; // end of the loop. ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>