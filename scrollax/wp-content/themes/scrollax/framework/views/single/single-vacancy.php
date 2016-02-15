<?php
if ( have_posts() ) while ( have_posts() ) : the_post();

// Default Meta
$meta = array(
  'enabled' => get_post_meta( get_the_ID(), 'job_application_visibility' ) ? get_post_meta( get_the_ID(), 'job_application_visibility' ) : false,
  'caption' => get_post_meta( get_the_ID(), 'job_application_caption' ) ? get_post_meta( get_the_ID(), 'job_application_caption' ) : __( 'Application', MISS_TEXTDOMAIN ),
  'subject' => get_post_meta( get_the_ID(), 'job_application_subject' ) ? get_post_meta( get_the_ID(), 'job_application_subject' ) : get_the_title(),
  'recipient' => get_post_meta( get_the_ID(), 'job_application_recipient' ) ? get_post_meta( get_the_ID(), 'job_application_recipient' ) : get_bloginfo('admin_email'),
  'label' => array(
    'attachment' => get_post_meta( get_the_ID(), 'job_application_label_attachment' ) ? get_post_meta( get_the_ID(), 'job_application_label_attachment' ) : __( 'Upload your CV', MISS_TEXTDOMAIN ),
    'email' => get_post_meta( get_the_ID(), 'job_application_label_email' ) ? get_post_meta( get_the_ID(), 'job_application_label_email' ) : __( 'Full name', MISS_TEXTDOMAIN ),
    'name' => get_post_meta( get_the_ID(), 'job_application_label_name' ) ? get_post_meta( get_the_ID(), 'job_application_label_name' ) : __( 'Full name', MISS_TEXTDOMAIN ),
    'descr' => get_post_meta( get_the_ID(), 'job_application_label_description' ) ? get_post_meta( get_the_ID(), 'job_application_label_description' ) : __( 'Details', MISS_TEXTDOMAIN ),
    'phone' => get_post_meta( get_the_ID(), 'job_application_label_phone' ) ? get_post_meta( get_the_ID(), 'job_application_label_phone' ) : __( 'Phone', MISS_TEXTDOMAIN ),
    'button' => get_post_meta( get_the_ID(), 'job_application_label_button' ) ? get_post_meta( get_the_ID(), 'job_application_label_button' ) : __( 'Apply', MISS_TEXTDOMAIN ),
  )
);

?>
<!-- Content Area -->
  <div class="single_module <?php echo get_post_type(); ?>">
    <div id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="single_content">
        <?php miss_before_entry(); ?>
        <div class="page_content">
          <?php
          if (miss_get_setting('review') == 'enable') {
            echo the_score($post->ID); 
          }
          ?>
          <?php the_content(); ?>
          <div class="clearboth"></div>

          <?php if ( $meta['enabled'] ) : ?>

            <h3><?php echo $meta['caption']; ?></h3>
            <?php echo do_shortcode('[contactform subject="' . $meta['subject'] . '" email="' . $meta['recipient'] . '"][name label="' . $meta['label']['name'] . '" required="true"][email label="' . $meta['label']['email'] . '" required="true"][textfield label="' . $meta['label']['phone'] . '"][textarea label="' . $meta['label']['descr'] . '" required="true"][captcha][submit label="' . $meta['label']['button'] . '"][attachment label="' . $meta['label']['attachment'] . '"][/contactform]'); ?>
            <div class="clearboth"></div>

          <?php endif; ?>

          <?php wp_link_pages( array( 'before' => '<div class="page_link">' . __( 'Pages:', MISS_TEXTDOMAIN ), 'after' => '</div>' ) ); ?>
          <?php edit_post_link( __( 'Edit entry', MISS_TEXTDOMAIN ), '<div class="edit_link">', '</div>' ); ?>
          </div><!-- .entry -->
         <div class="clearboth"></div>
       <?php miss_after_entry(); ?>
      </div><!-- .single_page_content -->
    </div><!-- #page-## -->
  </div><!-- .single_page_module -->
<!-- / Content Area -->
  <?php endwhile; ?>
