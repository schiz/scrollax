<?php
/**
 * Deny hack attempt
 */
if ( !defined( 'ABSPATH' ) ) {
	header('HTTP/1.1 403 Forbidden');
	exit;
}


function miss_shop_featured_products()
{
    if(miss_get_setting( 'store_display_featured_products' ) != 'yes') {
        return;
    }
    $out = '<section class="row featured-products">
                <header class="section-header span12 nomargintop">
                    <h1 class="header"><span>Featured Products</span></h1>
                </header>
                <div class="span12"><div class="products row-fluid auto">';
    
    $ids = miss_get_setting( 'featured_products_ids' );
    $filter_args = array( 'width' => 220, 'height' => 220, 'img_class' => $img_class, 'link_class' => 'sc_image_load', 'preload' => true, 'disable' => $disable, 'column' => $column, 'type' => 'product', 'shortcode' => true, 'echo' => false, 'wraptitle' => false );
    if($ids != '')
    {
        $exids = explode(',', $ids);
        foreach($exids as $k => $v)
        {
            $exids[$k] = trim($v);
        }
        
        $query_args = array(
			'post_type' => 'product',
			'nopaging' => 0,
			'ignore_sticky_posts' => 1,
            'orderby' => 'post_date',
            'order' => 'DESC',
            'post__in' => $exids
		);
        
        $sc_post_query = new WP_Query();
		$sc_post_query->query( $query_args );

		if( $sc_post_query->have_posts() ) {
            while( $sc_post_query->have_posts() ) {
                $sc_post_query->the_post();
                
                $price = get_post_meta(get_the_id(), '_regular_price', true); 
                $price_disc = get_post_meta(get_the_id(), '_sale_price', true); 
                
                $out .= '<section class="span4 product_item content-item">
                                <header class="header">
                                  <div class="preview-container preview-small base-preview">
                                    <div class="preview-image">
                                      '.miss_get_post_image( $filter_args ).'
                                    </div>
                                    <div class="preview-info-wrapper">
                                      <div class="controls">
                                        <a href="'.miss_get_post_image( array('width' => 'auto', 'height' => 'auto', 'get_src' => true, 'echo' => false) ).'" rel="prettyPhoto[' . get_post_type() . '_' . get_the_ID() . ']" class="control zoom"><i class="marker im-icon-zoom-in"></i></a>
                                      </div>
                                    </div>
                                  </div>
                
                                  <div class="price">
                                    <span class="small">$ '.$price.'</span>
                                    <span class="big">$ '.$price_disc.'</span>
                                  </div>
                                </header>
                
                                <article class="article black-color">
                                  <p>'.miss_post_title( $filter_args ).'</p>
                                </article>
                                
                                <a href="'.esc_url( get_permalink() ).'" class="btn ribbon-style small-ribbon">Read more</a>
                              </section>';
            }
		}
    }
    
    $out .= '</div></div></section>';
    echo $out;
}

function miss_woocommerce_content() {

	if ( is_singular( 'product' ) ) {

		while ( have_posts() ) : the_post();

			woocommerce_get_template_part( 'content', 'single-product' );

		endwhile;

	} else { ?>

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
            <div class="bread-container">
                <div class="bread-wrapper">
                    <div class="blog-title"><?php woocommerce_page_title(); ?></div>
                    <?php dimox_breadcrumbs(); ?>
                </div>
            </div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_archive_description' ); ?>

		<?php if ( have_posts() ) : ?>

			<?php do_action('woocommerce_before_shop_loop'); ?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php woocommerce_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php do_action('woocommerce_after_shop_loop'); ?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif;

	}
}

add_action( 'wp_enqueue_scripts', 'child_manage_woocommerce_styles', 99 );
/**
 * Remove WooCommerce Generator tag, styles, and scripts from the homepage.
 * Tested and works with WooCommerce 2.0+
 *
 * @author Greg Rickaby
 * @since 2.0.0
 */

function child_manage_woocommerce_styles() {
	remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
	//if ( is_front_page() || is_home() ) {
		//wp_dequeue_style( 'woocommerce_frontend_styles' );
		//wp_dequeue_style( 'woocommerce_fancybox_styles' );
		//wp_dequeue_style( 'woocommerce_chosen_styles' );
		//wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
		//wp_dequeue_script( 'wc_price_slider' );
		//wp_dequeue_script( 'wc-single-product' );
		//wp_dequeue_script( 'wc-add-to-cart' );
		//wp_dequeue_script( 'wc-cart-fragments' );
		//wp_dequeue_script( 'wc-checkout' );
		//wp_dequeue_script( 'wc-add-to-cart-variation' );
		//wp_dequeue_script( 'wc-single-product' );
		//wp_dequeue_script( 'wc-cart' );
		//wp_dequeue_script( 'wc-chosen' );
		//wp_dequeue_script( 'woocommerce' );
		wp_dequeue_script( 'prettyPhoto' );
		wp_dequeue_script( 'prettyPhoto-init' );
		//wp_dequeue_script( 'jquery-blockui' );
		//wp_dequeue_script( 'jquery-placeholder' );
		//wp_dequeue_script( 'fancybox' );
		//wp_dequeue_script( 'jqueryui' );
    //}
}

function dimox_breadcrumbs() {  
  
  /* === ОПЦИИ === */  
  $text['home'] = 'Home'; // текст ссылки "Главная"  
  $text['category'] = 'Archive category "%s"'; // текст для страницы рубрики  
  $text['search'] = 'Serch result "%s"'; // текст для страницы с результатами поиска  
  $text['tag'] = 'Posts with tag "%s"'; // текст для страницы тега  
  $text['author'] = 'Author posts %s'; // текст для страницы автора  
  $text['404'] = 'Error 404'; // текст для страницы 404  
  
  $show_current = 1; // 1 - показывать название текущей статьи/страницы/рубрики, 0 - не показывать  
  $show_on_home = 0; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать  
  $show_home_link = 1; // 1 - показывать ссылку "Главная", 0 - не показывать  
  $show_title = 1; // 1 - показывать подсказку (title) для ссылок, 0 - не показывать  
  $delimiter = ' <span class="tr"></span> '; // разделить между "крошками"  
  $before = '<span class="text">'; // тег перед текущей "крошкой"  
  $after = '</span>'; // тег после текущей "крошки"  
  /* === КОНЕЦ ОПЦИЙ === */  
  
  global $post;  
  $home_link = home_url('/');  
  $link_before = '<span typeof="v:Breadcrumb">';  
  $link_after = '</span>';  
  $link_attr = ' rel="v:url" property="v:title"';  
  $link = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;  
  $parent_id = $parent_id_2 = $post->post_parent;  
  $frontpage_id = get_option('page_on_front');  
  $style = '';
  if(function_exists('is_product'))
  {
    if(is_product())
    {
        $style = ' style="text-align: left;"';
    }
  }
  
  
  if (is_home() || is_front_page()) {  
  
      if ($show_on_home == 1) echo '<div class="breadcrumbs" '.$style.'><a href="' . $home_link . '">' . $text['home'] . '</a></div>';  
  
  } else {  
  
      echo '<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#" '.$style.'>';  
      if ($show_home_link == 1) {  
          echo '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $text['home'] . '</a>';  
          if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;  
      }  
  
      if ( is_category() ) {  
          $this_cat = get_category(get_query_var('cat'), false);  
          if ($this_cat->parent != 0) {  
              $cats = get_category_parents($this_cat->parent, TRUE, $delimiter);  
              if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);  
              $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);  
              $cats = str_replace('</a>', '</a>' . $link_after, $cats);  
              if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);  
              echo $cats;  
          }  
          if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;  
  
      } elseif ( is_search() ) {  
          echo $before . sprintf($text['search'], get_search_query()) . $after;  
  
      } elseif ( is_day() ) {  
          echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;  
          echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;  
          echo $before . get_the_time('d') . $after;  
  
      } elseif ( is_month() ) {  
          echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;  
          echo $before . get_the_time('F') . $after;  
  
      } elseif ( is_year() ) {  
          echo $before . get_the_time('Y') . $after;  
  
      } elseif ( is_single() && !is_attachment() ) {  
          if ( get_post_type() != 'post' ) {  
              $post_type = get_post_type_object(get_post_type());  
              $slug = $post_type->rewrite;  
              //printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);  
              if ($show_current == 1) echo  $before . get_the_title() . $after;  
          } else {  
              $cat = get_the_category(); $cat = $cat[0];  
              $cats = get_category_parents($cat, TRUE, $delimiter);  
              if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);  
              $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);  
              $cats = str_replace('</a>', '</a>' . $link_after, $cats);  
              if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);  
              echo $cats;  
              if ($show_current == 1) echo $before . get_the_title() . $after;  
          }  
  
      } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {  
          $post_type = get_post_type_object(get_post_type());  
          echo $before . $post_type->labels->singular_name . $after;  
  
      } elseif ( is_attachment() ) {  
          $parent = get_post($parent_id);  
          $cat = get_the_category($parent->ID); $cat = $cat[0];  
          $cats = get_category_parents($cat, TRUE, $delimiter);  
          $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);  
          $cats = str_replace('</a>', '</a>' . $link_after, $cats);  
          if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);  
          echo $cats;  
          printf($link, get_permalink($parent), $parent->post_title);  
          if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;  
  
      } elseif ( is_page() && !$parent_id ) {  
          if ($show_current == 1) echo $before . get_the_title() . $after;  
  
      } elseif ( is_page() && $parent_id ) {  
          if ($parent_id != $frontpage_id) {  
              $breadcrumbs = array();  
              while ($parent_id) {  
                  $page = get_page($parent_id);  
                  if ($parent_id != $frontpage_id) {  
                      $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));  
                  }  
                  $parent_id = $page->post_parent;  
              }  
              $breadcrumbs = array_reverse($breadcrumbs);  
              for ($i = 0; $i < count($breadcrumbs); $i++) {  
                  echo $breadcrumbs[$i];  
                  if ($i != count($breadcrumbs)-1) echo $delimiter;  
              }  
          }  
          if ($show_current == 1) {  
              if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;  
              echo $before . get_the_title() . $after;  
          }  
  
      } elseif ( is_tag() ) {  
          echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;  
  
      } elseif ( is_author() ) {  
          global $author;  
          $userdata = get_userdata($author);  
          echo $before . sprintf($text['author'], $userdata->display_name) . $after;  
  
      } elseif ( is_404() ) {  
          echo $before . $text['404'] . $after;  
      }  
  
      if ( get_query_var('paged') ) {  
          if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';  
          echo ' '.__('Page') . ' ' . get_query_var('paged');  
          if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';  
      }  
  
      echo '</div><!-- .breadcrumbs -->';  
  
  }  
} // end dimox_breadcrumbs()  

if ( !function_exists( 'miss_theme_style' ) ) :

function miss_theme_style()
{
    $theme_class = ' black-theme ';
    $theme = get_post_meta(get_the_id(), 'page_theme', true);
    if($theme == 'white')
    {
        $theme_class = ' white-theme ';
    }
    elseif($theme == 'black')
    {
        $theme_class = ' black-theme ';
    }
    echo $theme_class;
}

endif;


if ( !function_exists( 'miss_feedback_form' ) ) :

function miss_feedback_form()
{
    if((function_exists( 'is_cart' ) && is_cart()) || (function_exists( 'is_product' ) && is_product())) return;
    
    
    $out = '<!-- Main Section 14 - Start -->
      <section class="main-section-14">
        <!-- Feedback form - Start -->
        <div class="container">
          <div class="row feedback-form">
            <header class="span12 spacial-header">
              <h2 class="caption alig-left size60">Send Message</h2>
            </header>

            <div class="span12 form-container">
              <div class="row">
                <form id="feedback_form">
                  <div class="span4 text-field-wrapper input">
                    <div class="field-label required">Name</div>
                    <input type="text" name="name" pattern="^[A-Za-zРђ-РЇР°-СЏРЃС‘\s]+$" required value="" class="text-field placeholder" data-val="">
                  </div>
                  <div class="span4 text-field-wrapper input">
                    <div class="field-label required">Email</div>
                    <input type="email" name="email" pattern="[^ @]*@[^ @]*" required value="" class="text-field placeholder" data-val="">
                  </div>
                  <div class="span4 text-field-wrapper input">
                    <div class="field-label required">Subject</div>
                    <input type="text" name="subject" required value="" class="text-field placeholder" data-val="">
                  </div>
                  <div class="span12 text-field-wrapper textarea">
                    <div class="field-label">Your Message...</div>
                    <textarea name="text" required class="text-field placeholder" data-val=""></textarea>
                  </div>
                  <div class="span12">
                    <div class="row">
                      <div class="form-caption span9">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui</p>
                      </div>
                      <div class="aside span3">
                        <p><i class="marker required">*</i> Please fill in all required fields</p>
                        <input type="submit" name="send_f" value="Send" class="ribbon-style ribbon-light-style" />
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="action" value="send_feedback" />
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Feedback form - End -->
      </section>
      <!-- Main Section 14 - End -->';
      $out .= '<script type="text/javascript" >  
                function send_callback()
                {
                    var data = jQuery("#feedback_form").serialize();
                    var ajaxurl = "/wp-admin/admin-ajax.php";
                    
                    jQuery.post(ajaxurl, data, function(response) {  
                        alert(\'Got this from the server: \' + response);  
                    });  
                }
                </script>';
      
      echo $out;
}

endif;


add_action('wp_ajax_send_feedback', 'send_feedback');  
add_action('wp_ajax_nopriv_send_feedback', 'send_feedback');

function send_feedback()
{
    if (isset($_POST['name'])) {$name = $_POST['name']; if ($name == '') {unset($name);}}
    if (isset($_POST['email'])) {$email = $_POST['email']; if ($email == '') {unset($email);}}
    if (isset($_POST['subject'])) {$sub = $_POST['subject']; if ($sub == '') {unset($sub);}}
    if (isset($_POST['text'])) {$body = $_POST['text']; if ($body == '') {unset($body);}}
      
    if (isset($name) && isset($email) && isset($sub) && isset($body)) {
        $address = get_option('admin_email');
        $mes = "Name: $name \nE-mail: $email \Subject: $sub \Text: $body";
        $send = mail ($address,$sub,$mes,"Content-type:text/plain; charset = UTF-8\r\nFrom:$email");
        if ($send == 'true')
        {
            echo "Message sent!";
        }
        else
        {
            echo "Server error!";
        }
    }
    else
    {
        echo "Fill in all required fields!";
    }
    die();
}

add_action('wp_ajax_get_lastpost_ajax', 'get_lastpost_ajax');  
add_action('wp_ajax_nopriv_get_lastpost_ajax', 'get_lastpost_ajax');

function get_lastpost_ajax()
{
    $query_args = array(
			'post_type' => $_POST['type'],
			'showposts' => $_POST['limit'],
            'offset' => $_POST['offset'],
			'category__in' => explode(',', $_POST['catin']),
			'nopaging' => 0,
			'ignore_sticky_posts' => 1,
            'orderby' => 'post_date',
            'order' => 'DESC'
		);
    $img_class = 'image';
			$filter_args = array( 'width' => $width, 'height' => $height, 'img_class' => $img_class, 'link_class' => 'sc_image_load', 'preload' => true, 'disable' => $disable, 'column' => $column, 'type' => $posttype, 'shortcode' => true, 'echo' => false, 'wraptitle' => false );
    $sc_post_query = new WP_Query();
    $sc_post_query->query( $query_args );
    $out = '';
    if( $sc_post_query->have_posts() ) {
        while( $sc_post_query->have_posts() ) {
                    $sc_post_query->the_post();
                    $out .= '<div class="span3 content-item">';
                    if($i % 2 == 1)
                    {
                        $out .= '<div class="preview-container preview-small extended-preview">
                                    <div class="preview-image">
                                      '.miss_get_post_image( $filter_args ).'
                                    </div>
                                    <div class="preview-info-wrapper">
                                      <div class="controls">
                                        <!--a href="#" class="control zoom"><i class="marker im-icon-zoom-in"></i></a-->
                                        <a href="'.miss_get_post_image( array('get_src' => true, 'echo' => false) ).'" class="control zoom" rel="prettyPhoto[' . get_post_type() . '_' . get_the_ID() . ']"><i class="marker im-icon-zoom-in"></i></a>
                                        <a href="'.esc_url( get_permalink() ).'" class="control link"><i class="marker im-icon-link"></i></a>
                                      </div>
                                    </div>
                                  </div>';
                    }
                    
                    $out .= '<div class="content">';
                    $out .= '<h4 class="header">'.miss_post_title( $filter_args ).'</h4>
                            <div class="article-info">
                              <div class="published">On <span class="date">'.get_the_date().'</span></div>';
                    $out .= '<div class="comments"><i class="marker im-icon-bubble-10"></i>';
                    $num_comments = get_comments_number(); // возвратит число

                    if ( comments_open() ) {
                    	if ( $num_comments == 0 ) {
                    		$comments = __('No Comments');
                    	} elseif ( $num_comments > 1 ) {
                    		$comments = $num_comments . __(' Comments');
                    	} else {
                    		$comments = __('1 Comment');
                    	}
                    	$out .= '<a class="caption" href="' . get_comments_link() .'">'. $comments.'</a>';
                    } else {
                    	$out .=  __('Comments are off for this post.');
                    }
                    $out .= '</div>
                            </div>';
                    if($i % 2 != 1)
                    {
                        $out .= '<div class="article">
                                  <p>'.miss_excerpt( get_the_excerpt(), $excerpt_lenth, THEME_ELLIPSIS ).'</p>
                                </div>';
                    }
                    $out .= '<a href="'.esc_url( get_permalink() ).'" class="btn ribbon-style smallest-ribbon">View details</a>';
                    $out .= '</div>';
                    $out .= '</div>';
                    
                    $i++;
                }
        $out .= '<script> lpost_offset = "'.((int)$_POST['offset']+(int)$_POST['limit']).'"; </script>';
        echo $out;
    }
    
    die();
}

if ( !function_exists( 'miss_document_title' ) ) :
/**
 *
 */
function miss_document_title() {
	global $page, $paged, $wp_query;

	/* Set up some default variables. */
	$domain = MISS_TEXTDOMAIN;
	$doctitle = get_bloginfo( 'name' );
	$separator = ' | ';
	$description = get_bloginfo( 'description','display' );
        //$doctitle = get_bloginfo( 'name' );

	/* If viewing the front page and posts page of the site. */
	if ( is_front_page() && is_home() && !is_singular() )
	    if ( $description != "") {
		$doctitle =  $description;
	    } else {
		$separator = '';
	}

	/* If viewing the posts page or a singular post. */
	if ( is_home() || is_singular() ) {
		$post_id = $wp_query->get_queried_object_id();

		$prefix = get_post_meta( $post_id, 'Title', true );

		if ( empty( $prefix ) && is_front_page() ) {
			$prefix = get_bloginfo( 'name' );
		} elseif ( empty( $prefix ) ) {
			$prefix = get_post_field( 'post_title', $post_id );
		}
	}

	/* If viewing any type of archive page. */
	elseif ( is_archive() ) {

		/* If viewing a taxonomy term archive. */
		if ( is_category() || is_tag() || is_tax() ) {
			$term = $wp_query->get_queried_object();
			$prefix = $term->name;
		}

		/* If viewing a post type archive. */
		elseif ( function_exists( 'is_post_type_archive' ) && is_post_type_archive() ) {
			$post_type = get_post_type_object( get_query_var( 'post_type' ) );
			$prefix = miss_get_setting( get_post_type() . '_page_caption' ) ? miss_get_setting( get_post_type() . '_page_caption' ) : $post_type->labels->name;
		}
		/* If viewing an author/user archive. */
		elseif ( is_author() )
			$prefix = get_the_author_meta( 'display_name', get_query_var( 'author' ) );

		/* If viewing a date-/time-based archive. */
		elseif ( is_date () ) {
			if ( get_query_var( 'minute' ) && get_query_var( 'hour' ) )
				$prefix = sprintf( __( 'Archive for %1$s', MISS_TEXTDOMAIN ), get_the_time( __( 'g:i a', MISS_TEXTDOMAIN ) ) );

			elseif ( get_query_var( 'minute' ) )
				$prefix = sprintf( __( 'Archive for minute %1$s', MISS_TEXTDOMAIN ), get_the_time( __( 'i', MISS_TEXTDOMAIN ) ) );

			elseif ( get_query_var( 'hour' ) )
				$prefix = sprintf( __( 'Archive for %1$s', MISS_TEXTDOMAIN ), get_the_time( __( 'g a', MISS_TEXTDOMAIN ) ) );

			elseif ( is_day() )
				$prefix = sprintf( __( 'Archive for %1$s', MISS_TEXTDOMAIN ), get_the_time( __( 'F jS, Y', MISS_TEXTDOMAIN ) ) );

			elseif ( get_query_var( 'w' ) )
				$prefix = sprintf( __( 'Archive for week %1$s of %2$s', MISS_TEXTDOMAIN ), get_the_time( __( 'W', MISS_TEXTDOMAIN ) ), get_the_time( __( 'Y', MISS_TEXTDOMAIN ) ) );

			elseif ( is_month() )
				$prefix = sprintf( __( 'Archive for %1$s', MISS_TEXTDOMAIN ), single_month_title( ' ', false) );

			elseif ( is_year() )
				$prefix = sprintf( __( 'Archive for %1$s', MISS_TEXTDOMAIN ), get_the_time( __( 'Y', MISS_TEXTDOMAIN ) ) );
		}
	}

	/* If viewing a search results page. */
	elseif ( is_search() )
		$prefix = sprintf( __( 'Search results for &quot;%1$s&quot;', MISS_TEXTDOMAIN ), esc_attr( get_search_query() ) );

	/* If viewing a 404 not found page. */
	elseif ( is_404() )
		$prefix = __( '404 Not Found', MISS_TEXTDOMAIN );

	elseif ( function_exists( 'bp_is_activity_component' ) && bp_is_activity_component() )
		$prefix = __( 'Activity', MISS_TEXTDOMAIN );

	elseif ( function_exists( 'bp_is_group' ) && bp_is_group() )
		$prefix = __( 'Group', MISS_TEXTDOMAIN );


	/**
	 * Events Calendar PRO Support
	 * 
	 * @since 1.8
	 */

	if ( class_exists('TribeEventsPro') ) {
		if( function_exists('tribe_is_month') && tribe_is_month() ) {
			$prefix  = __( 'Events for', MISS_TEXTDOMAIN );
			$prefix .= Date("F Y", strtotime($wp_query->get('start_date') ) );
		}

		if( function_exists('tribe_is_day') && tribe_is_day() ) {
			$prefix  = __( 'Events for', MISS_TEXTDOMAIN );
			$prefix .= Date("l, F jS Y", strtotime($wp_query->get('start_date') ) );
		}

		if( function_exists('tribe_is_week') && tribe_is_week() ) {
			if ( function_exists( 'tribe_get_first_week_day' ) ) {
				$prefix = sprintf( __('Events for week of %s', MISS_TEXTDOMAIN),
						Date("l, F jS Y", strtotime(tribe_get_first_week_day($wp_query->get('start_date'))))
				);
			}
			//$page_tagline = Date("l, F jS Y", strtotime($wp_query->get('start_date') ) );
		}
		if( (function_exists('tribe_is_map') && tribe_is_map() ) || ( function_exists('tribe_is_photo') && tribe_is_photo() ) ) {
			if( tribe_is_past() ) {
				$prefix = __( 'Past Events', MISS_TEXTDOMAIN );
			} else {
				$prefix = __( 'Upcoming Events', MISS_TEXTDOMAIN );
			}
		}
		if( function_exists('tribe_is_showing_all') && tribe_is_showing_all() ){
			$prefix = sprintf( '%s %s',
				__( 'All events for', MISS_TEXTDOMAIN ),
				get_the_title()
			);
		} 
	}


	/* If the current page is a paged page. */
	if ( ( ( $page = $wp_query->get( 'paged' ) ) || ( $page = $wp_query->get( 'page' ) ) ) && $page > 1 )
		$prefix = sprintf( __( '%1$sPage %2$s', MISS_TEXTDOMAIN ), $prefix . $separator, number_format_i18n( $page ) );
		if (is_front_page()){
			$doctitle = $doctitle . $separator . $description;
		} else {
			$doctitle = $prefix . $separator . $doctitle;
		}

	/* Apply the wp_title filters so we're compatible with plugins. */
	$doctitle = apply_filters( 'wp_title', $doctitle, '', '' );

	/* Return the title to the screen. */
	return apply_atomic( 'document_title', esc_attr( $doctitle ) );
}
endif;

if ( !function_exists( 'miss_bp_document_title' ) ) :
    function miss_bp_document_title () {
	global $page, $paged, $wp_query;

	/* Set up some default variables. */
	$domain = MISS_TEXTDOMAIN;
	$doctitle = get_bloginfo( 'name' );
	$separator = ' | ';
	$description = get_bloginfo( 'description','display' );

	/* bp */
	if ( function_exists( 'bp_is_user_friends' ) && bp_is_user_friends() )
		$prefix = __( 'Friends', MISS_TEXTDOMAIN );

	elseif ( function_exists('bp_is_user_profile_edit') && bp_is_user_profile_edit() )
		$prefix = __( 'Edit Profile', MISS_TEXTDOMAIN );

	elseif( function_exists('bp_is_user_profile') && bp_is_user_profile() )
		$prefix = __( 'User Profile', MISS_TEXTDOMAIN );

	elseif ( function_exists('bp_is_activity_component') && bp_is_activity_component() && is_numeric( $bp->current_action )) {
		$activity = bp_activity_get_specific( array( 'activity_ids' => $bp->current_action ) );
		if ( $activity = $activity['activities'][0]) {
			if(!empty($activity->content)) {
				$prefix = mb_strimwidth(preg_replace("/[^A-Za-z0-9\s\s+\-]/", "", strip_tags( $activity->content)), 0, 70-3-3-strlen($blog_title), '...');
			}
		}
	}

	/* If the current page is a paged page. */
	if ( ( ( $page = $wp_query->get( 'paged' ) ) || ( $page = $wp_query->get( 'page' ) ) ) && $page > 1 )
		$prefix = sprintf( __( '%1$sPage %2$s', MISS_TEXTDOMAIN ), $prefix . $separator, number_format_i18n( $page ) );

	$doctitle = $prefix . $separator . $doctitle;

	/* Apply the wp_title filters so we're compatible with plugins. */
	//	$doctitle = apply_filters( 'bp_page_title', $doctitle, '', '' );
	//	echo apply_atomic( 'bp_page_title', esc_attr( $doctitle ) );
	return $doctitle;
    }
    add_filter('bp_page_title', 'miss_bp_document_title','');
endif;


if ( !function_exists( 'miss_primary_header' ) ) :
/**
 * Primary Header
 *
 * @since 1.6
 */
function miss_header_sociable($args = array()) {
	$defaults = array(
	'echo' => true,
	'container_class' => 'social-media',
    'place' => 'header'
	);
	$args = wp_parse_args( $args, $defaults );
	$args = (object) $args;
    
    if($args->place == 'footer')
    {
        $args->container_class = 'row widget-social-media';
    }
    else
    {
        $heading = miss_get_setting( 'sociable_heading' );
    }

	$out = '';
    if($args->place == 'footer')
    {
        $out .= '<div class="'.$args->container_class.' clearfix">';
        $out .= '<div class="inner-wrapp span12">';
        $out .= miss_social_shortcuts();
        $out .= '</div>';
        $out .= '</div>';
    }
    else
    {
        $out .= '<section class="row social-media clearfix">';
        $out .= '<header class="span12 spacial-header">
                  <h2><span>'.$heading.'</span></h2>
                </header>';
        $out .= '<div class="inner-wrapp span12">';
    	$out .= miss_social_shortcuts();
        $out .= '</div>';
    	$out .= '</section>';
    }
    
    return $out;
}
add_shortcode('sociable_icons', 'miss_header_sociable');
endif;

if ( !function_exists( 'miss_header_extras' ) ) :
/**
 *
 */
function miss_header_extras() {
	$out = '';
	$header_links = '';
	$sociables = '';
	$header_text = miss_get_setting( 'extra_header' );

	# If header-links has a menu assigned display it.
	if ( has_nav_menu('header-links' ) ) {
		$header_links = wp_nav_menu(
			array(
			'theme_location' => 'header-links',
			'container_class' => 'header_links',
			'container_id' => 'header_links',
			'menu_class' => 'header_links_menu',
			'fallback_cb' => false,
			'echo' => false
		));
	}

	# Display sociables in header.
	$sociable = miss_get_setting( 'sociable' );

	if( $sociable['keys'] != '#' ) {
		$sociable_keys = explode( ',', $sociable['keys'] );

		foreach ( $sociable_keys as $key ) {
			if( $key != '#' ) {

				if( !empty( $sociable[$key]['custom'] ) )
					$sociable_icon = $sociable[$key]['custom'];

				elseif( empty( $sociable[$key]['custom'] ) )
					$sociable_icon = THEME_IMAGES . '/sociables/' . $sociable[$key]['color'] . '/' . $sociable[$key]['icon'];

				$sociable_link = ( !empty( $sociable[$key]['link'] ) ) ? $sociable[$key]['link'] : '#';

				$sociables .= '<div class="social_icon ' . $sociable[$key]['color'] . '">';
				$sociables .= '<a href="' . esc_url( $sociable_link ) . '"><img src="' . esc_url( $sociable_icon ) . '" alt="" /></a>';
				$sociables .= '</div>';
			}
		}
	}

	if( !empty( $header_links ) || !empty( $sociables ) || !empty( $header_text ) ) {
		
		$out .= '<div class="sixteen columns">';
		$out .= '<div id="header_extras">';

		$out .= $header_links;

		if( !empty( $sociables ) ) {
			$out .= '<div class="header_social">';
			$out .= $sociables;
			$out .= '</div>';
		}

		if( !empty( $header_text ) ) {
			$out .= '<div class="header_text">';
			$out .= stripslashes( $header_text );
			$out .= '</div>';
		}

		$out .= '<div class="clearboth"></div>';

		$out .= '</div><!-- #header_extras -->';
		$out .= '</div>';
	}

	echo apply_atomic_shortcode( 'header_extras', $out );
}
endif;


/**
 * Strip theme-check Recommended outpots. This is only for development purpose.
*/
if ( ! function_exists( 'miss_strip_tc' ) ):
function miss_strip_tc() {
	the_post_thumbnail();
	add_theme_support( 'custom-header' );
	add_theme_support( 'custom-background' );
	//add_custom_image_header();
	//add_custom_background();
	
	return;
	
}
endif;


if ( !function_exists( 'miss_portfolio_date' ) ) :
/**
 *
 */
function miss_portfolio_date() {
	global $post;
	
	$out = '';
	$_date = get_post_meta( $post->ID, '_date', true );
	
	if( !empty( $_date ) )
		$out .= '<p class="date">' . $_date . '</p>';
		
	echo apply_atomic( 'portfolio_date', $out ); 
}
endif;


if ( !function_exists( 'miss_shortcodes_init' ) ) :
/**
 *
 */
function miss_shortcodes_init() {
	foreach( miss_shortcodes() as $shortcodes ) {
		require_once THEME_SHORTCODES . '/' . $shortcodes;
	}
	if( is_admin() )
		return;
		
	# Long posts should require a higher limit, see http://core.trac.wordpress.org/ticket/8553
	//@ini_set('pcre.backtrack_limit', 9000000);
		
	foreach( miss_shortcodes() as $shortcodes ) {
		$class = 'miss' . ucfirst( preg_replace( '/[0-9-_]/', '', str_replace( '.php', '', $shortcodes ) ) );
		$class_methods = get_class_methods( $class );

		if (isset($class_methods)) {
			foreach( $class_methods as $shortcode ) {
				if( $shortcode[0] != '_' && $class != 'missLayouts' ) {
					add_shortcode( $shortcode, array( $class, $shortcode ) );
				}
			}
		}
	}
}
endif;

if ( !function_exists( 'miss_queryvars' ) ) :
/**
 *
 */
function miss_queryvars( $query_vars ) {
	$query_vars[] = 'gallery';
	return $query_vars;
}
endif;

if ( !function_exists( 'miss_rewrite_rules' ) ) :
/**
 *
 */
function miss_rewrite_rules( $rules ) {
	$newrules = array();
	$newrules['(portfolio)/([^/]+)/gallery/([^/]+)/comment-page-([0-9]{1,})/?$'] = 'index.php?post_type=$matches[1]&name=$matches[2]&gallery=$matches[3]&cpage=$matches[4]';
	$newrules['(portfolio)/([^/]+)/gallery/([^/]+)'] = 'index.php?post_type=$matches[1]&name=$matches[2]&gallery=$matches[3]';
	return $newrules + $rules;
}
endif;

if ( !function_exists( 'miss_color_variations' ) ) :
/**
 *
 */
function miss_color_variations() {
	$variations = array(
		'black' => 'Default',
		'red' => 'Red',
		'orange' => 'Orange',
		'yellow' => 'Yellow',
		'green' => 'Green',
		'olive' => 'Olive',
		'teal' => 'Teal',
		'blue' => 'Blue',
		'deepblue' => 'Deep Blue',
		'purple' => 'Purple',
		'hotpink' => 'Hot Pink',
		'slategrey' => 'Slate Grey',
		'mauve' => 'Mauve',
		'pearl' => 'Pearl',
		'steelblue' => 'Steel Blue',
		'mossgreen' => 'Moss Green',
		'wheat' => 'Wheat',
		'coffee' => 'Coffee',
		'copper' => 'Copper',
		'silver' => 'Silver',
		'black' => 'Black' );

	return $variations;
}
endif;


if ( !function_exists( 'miss_header_scripts' ) ) :
/**
 *
 */
function miss_header_scripts() {
	global $is_IE;
	$script_header = apply_atomic_shortcode( 'script_header', '' );
	
	if( !empty( $script_header ) ) {
		echo $script_header;
		return;
	}
	$document_style[] = '<style type="text/css">';
	//$is_IE = miss_ie();
	if( $is_IE )
		$document_style[] = '.noscript{visibility: collapse;}';
	else
		$document_style[] = '.noscript{visibility: hidden;}';
	$active_skin = apply_filters( 'miss_active_skin', get_option( MISS_ACTIVE_SKIN ) );
	$fonts_in_use = apply_filters( 'miss_active_skin', get_option( MISS_ACTIVE_SKIN ) );
	$google_fonts = array();
	//var_dump($fonts_in_use);
	$font_subject = '([^"]+)';
	if (isset($fonts_in_use['fonts'])) {
		foreach( $fonts_in_use['fonts'] as $declaration => $font ) { 
			if (preg_match('/"([^"]+)"/', $font, $m)) {
			    $google_fonts[] = $m[1];
			} else {
			   //preg_match returns the number of matches found, 
			   //so if here didn't match pattern
			}
		}
	}
	$document_style[] = '</style>';
	$document_write = join( '', array_unique( $document_style ) );
	
	$nonce = home_url();
	$image_resize = miss_get_setting( 'image_resize' );
	$skin_nt_writable = get_option( MISS_SKIN_NT_WRITABLE );
	//output Google Fonts if used
	foreach ($google_fonts as $gfont) {
	//	echo "<link href='http://fonts.googleapis.com/css?family=".$gfont."' rel='stylesheet' type='text/css'> \n";
	}
	
?>

  <!--[if lt IE 9]><script src="<?php echo THEME_ASSETS; ?>/scripts/compat/html5.js"></script><![endif]-->
  <!--[if IE 7]><link rel="stylesheet" type="text/css" href="<?php echo THEME_STYLES; ?>/_ie/ie7.css"><![endif]-->
  <!--[if IE 8]><link rel="stylesheet" type="text/css" href="<?php echo THEME_STYLES; ?>/_ie/ie8.css"><![endif]-->
  <!--[if IE 9]><link rel="stylesheet" type="text/css" href="<?php echo THEME_STYLES; ?>/_ie/ie9.css"><![endif]-->
  <!--[if lt IE 10]><link rel="stylesheet" type="text/css" href="<?php echo THEME_STYLES; ?>/_ie/ie.css"><![endif]-->
<?php if ( miss_get_setting( 'responsive' ) != 'disabled' ) : ?>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php endif; ?>
<?php if( miss_get_setting( 'favicon_url' ) ) : ?>
  <link rel="shortcut icon" href="<?php echo esc_url( miss_get_setting( 'favicon_url' ) ) ?>" />
<?php endif; ?>
<?php if( miss_get_setting( 'apple_icon' ) ) : ?>
  <link rel="apple-touch-icon-precomposed" href="<?php echo esc_url( miss_get_setting( 'apple_icon' ) ) ?>" />
<?php endif; ?>
  <script type="text/javascript">
  /* <![CDATA[ */
  	var imageResize = "<?php echo miss_get_setting( 'image_resize_type' ); ?>",
        resizeDisabled = "<?php echo $image_resize[0]; ?>",
        assetsUri = "<?php echo THEME_IMAGES_ASSETS; ?>",
        imageNonce = "<?php echo wp_create_nonce( $nonce ); ?>";
  	document.write('<?php echo $document_write; ?>');
  /* ]]> */
  </script>
<?php
}
endif;


if ( !function_exists( 'miss_logo' ) ) :
/**
 *
 */
function miss_logo($args = array()) {
    
    $out = '';
    if(miss_get_setting( 'display_logo' ) == true)
    {
        $out .= '<div class="span3"><a class="logo" href="./">';
        $out .= '<img src="'.miss_get_setting( 'logo_url' ).'">';
        $out .= '<span class="slogan">'.get_bloginfo('description').'</span>';
        $out .= '</a></div>';
    }
    return $out;
	/*$out = '';
	
	$defaults = array(
	'echo' => true,
	'container_class' => 'logo',
	'img_class' => 'primary-logo',
	'container_style' => '',
	'site_title' => true,
	);
	$args = wp_parse_args( $args, $defaults );
	$args = (object) $args;
	
	$display_logo = miss_get_setting( 'display_logo' );

	//Logo params
	$opts = Array(
		'header' => Array(
			'height' => miss_get_setting('header_height', true) ? miss_get_setting('header_height', true) : '43',
			'width' => miss_get_setting('header_width', true) ? miss_get_setting('header_width', true) : '216',
		),
		'logo' => Array(
			'image' => miss_get_setting( 'logo_url' ),
			'retina' => miss_get_setting( 'retina_logo_url' ),
			'width' => miss_get_setting('logo_width') ? miss_get_setting('logo_width') : '38',
			'height' => miss_get_setting('logo_height') ? miss_get_setting('logo_height') : '48',
		),
		'sticky' => Array(
			'logo_height' => miss_get_setting('logo_sticky_height') ? miss_get_setting('logo_sticky_height') : '32',
		)
	);
	if ( $display_logo ) {
		//Return image logo
		
		if ( miss_get_setting( 'add_menu_logo' ) ) {
			// Add logo to primary menu
        	$logo = Array(
        		'src' => $opts['logo']['image'],
        	);
	        if ( miss_get_setting('logo_url') || miss_get_setting('retina_logo_url') ) {
	        	$logo = '<img src="' . $logo['src'] . '" alt="' . get_bloginfo('name') . '" />';
	        } else {
	        	$logo = '<img src="' . THEME_ASSETS . '/images/branding/og-logo-l1.png" alt="' . get_bloginfo('name') . '" />';
	        }
		} else {
			// Add logo to after-header region
	        if ( miss_get_setting('logo_url') || miss_get_setting('retina_logo_url') ) {
	        	$logo = Array(
	        		'src' => $opts['logo']['image'],
	        	);
	        	if ( miss_get_setting('retina_logo_url') ) {
	        		$logo['src'] = $opts['logo']['retina'];
	        	}
	        	$logo = '<img src="' . $logo['src'] . '" data-width="' . $opts['logo']['width'] . 'px" height="' . $opts['logo']['height'] . '" data-height="' . $opts['logo']['height'] . '"  data-sticky-height="' . $opts['sticky']['logo_height'] . '" class="main_header_logo ' . $args->img_class . '" style="width:auto; height:' . $opts['logo']['height'] . 'px;" alt="' . get_bloginfo('name') . '" />';
	        } else {
	        	$logo = '<img src="' . THEME_ASSETS . '/images/branding/og-logo-l1.png" data-height="' . $opts['logo']['height'] . '" data-sticky-height="' . $opts['sticky']['logo_height'] . '" alt="' . get_bloginfo('name') . '" height="' . $opts['logo']['height'] . '" class="main_header_logo ' . $args->img_class . '" />';
	        }
		}
	} else {
		//Return text logo
		$tagline = explode( " ", get_bloginfo('name') );
		$logo = '';
		foreach( $tagline as $word ) {
			$logo .= '<span>' . $word . '</span> ';
		}
		$logo = '<h1 class="site-text-logo">' . $logo . '</h1>';
	}


	if($args->site_title != false){
		$tagline = '<h3>' . get_bloginfo('description') . '</h3>';
	} else {
		$tagline = '';
	}
	
	if( !empty( $logo ) ) {
		$class = ( !$display_logo ) ? ' class="site_title"' : ' class="site_logo"';
		$out .= '<div class="' . $args->container_class . '"' . $args->container_style . '>';
		$out .= '<a rel="home" href="' . esc_url( home_url( '/' ) ) . '"' . $class . '>';
		$out .= $logo;
		$out .= '</a>';
		$out .= $tagline;
		$out .= '</div><!-- /.logo -->';
	}
	
	if ( $args->echo )
		echo apply_atomic_shortcode( 'logo', $out );
	else
		return $out;*/
}
endif;


if ( !function_exists( 'miss_header_ad' ) ) :
/**
 *
 */
function miss_header_ad() {
	$out = '';
	$out .= '<div id="header_ad">';
	$out .= stripslashes(miss_get_setting( 'header_top_right' ));
	$out .= '</div>';
	echo apply_atomic_shortcode ('header_ad', $out);
}
endif;

if ( !function_exists( 'miss_main_menu' ) ) :
/**
 * DELETE
 */
// function miss_main_menu() {
// 	$out = '<div id="main_menu" class="sixteen columns navbar">';
// 	$out .= '<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">+</button>';	
// 	$out .= '<div class="navbar-inner">';
// 	ob_start();
// 	miss_main_menu_begin();
	
// 	$out .= ob_get_clean();
		
// 	$out .= wp_nav_menu(
// 		array(
// 		'theme_location' => 'primary-menu',
// 		'container_class' => 'main_navigation',
// 		'menu_class' => ( !has_nav_menu( 'primary-menu' ) ? 'main_navigation menu-main menu sf-js-enabled' : 'menu-main menu sf-js-enabled'),
// 		'echo' => false,
// 		'walker' => ( has_nav_menu( 'primary-menu' ) ?  new missDescriptionWalker() : '')
// 	));
	
// 	ob_start(); miss_main_menu_end();
// 	$out .= ob_get_clean();
	
// 	$out .= '</div><!-- /.navbar-inner -->';
// 	$out .= '</div><!-- #main_menu -->';
	
// 	echo apply_atomic_shortcode( 'main_menu', $out );
// }

endif;

if ( !function_exists( 'miss_teaser' ) ) :
/**
 *
 */
function miss_teaser() {
	global $author, $post;
	
	$out = '';
	$teaser = '';
	
	if( is_front_page() ) {
		$home_text = '';
		$teaser_button = miss_get_setting( 'teaser_button' );
		$teaser_button_text = miss_get_setting( 'teaser_button_text' );
		
		if( ( $teaser_button != 'disable' ) && ( !empty( $teaser_button_text ) ) ) {
			if( $teaser_button == 'page' ) {
				$btn_page_id = miss_get_setting( 'teaser_button_page' );
				
				if( !empty( $btn_page_id ) )
					$btn_link = get_permalink( $btn_page_id );
				else
					$btn_link = '#';
					
			} elseif( $teaser_button == 'custom' ) {
				$btn_link = ( miss_get_setting( 'teaser_button_custom' ) )
				? miss_get_setting( 'teaser_button_custom' ) : '#';
			}
			
			$home_text .= '<a class="btn1 call_to_action alignright" href="' . esc_url( $btn_link ) . '"><span>' . stripslashes( $teaser_button_text ) . '</span></a>';
		}
		
		$homepage_teaser_text = miss_get_setting( 'homepage_teaser_text' );
		if( !empty( $homepage_teaser_text ) ) {
			if( preg_match('/\</', $homepage_teaser_text ) ) 
				$home_text .= stripslashes( $homepage_teaser_text );
			else
				$home_text .= '<h3>' . stripslashes( $homepage_teaser_text ) . '</h3>';
		}
	}
	
	if( is_singular() ) {
		$intro_text = get_post_meta( $post->ID, '_intro_text', true );
		$blog_page = miss_blog_page();
		
		if ( empty( $intro_text ) )
			$intro_text = 'default';
		
		# Intro text post meta overide
		if( $intro_text != 'default' ) {
			
			if( in_array( $intro_text, array( 'title_only', 'title_teaser', 'title_tweet' ) ) ) {
				if( ( is_singular( 'post' ) ) && ( is_numeric( $blog_page ) ) )
					$title = get_the_title( $blog_page );
					
				elseif( is_singular( 'portfolio' ) )
					$title = __('Portfolio', MISS_TEXTDOMAIN );
				
				else
					$title = get_the_title( $post->ID );
			}
			
			if( $intro_text == 'custom' )
				$raw =  get_post_meta( $post->ID, '_intro_custom_html', true );
			
			if( $intro_text == 'title_teaser' )
				$text =  get_post_meta( $post->ID, '_intro_custom_text', true );
				
			if( $intro_text == 'title_tweet' ) {
				$twitter_id = miss_get_setting( 'twitter_id' );
				$limit = '1';
				$twitter_type = 'teaser';
				$text = miss_twitter_feed( $twitter_id, $limit, $twitter_type );
			}
			
		# Default intro text options
		} else {
			$intro_options = miss_get_setting('intro_options');
			
			if( in_array( $intro_options, array( 'title_only', 'title_teaser', 'title_tweet' ) ) ) {
				if( ( is_singular( 'post' ) ) && ( is_numeric( $blog_page ) ) )
					$title = get_the_title( $blog_page );
					
				elseif( is_singular( 'portfolio' ) )
					$title = __('Portfolio', MISS_TEXTDOMAIN );
				
				else
					$title = get_the_title( $post->ID );
			}
			
			if( $intro_options == 'custom' )
			 	$raw =  miss_get_setting('custom_teaser_html');
			
			if( $intro_options == 'title_teaser' )
			 	$text =  miss_get_setting('custom_teaser');
			
			if( $intro_options == 'title_tweet' ) {
				$twitter_id = miss_get_setting( 'twitter_id' );
				$limit = '1';
				$twitter_type = 'teaser';
				$text = miss_twitter_feed( $twitter_id, $limit, $twitter_type );
			}
		}
	}
	
	if ( is_search() ) {
		$intro_options = miss_get_setting( 'intro_options' );
		if( $intro_options != 'disable' ) {
			$title = __( 'Search', MISS_TEXTDOMAIN );
			$text = sprintf( __('Search Results for: %1$s', MISS_TEXTDOMAIN ), '&lsquo;' . get_search_query() . '&rsquo;');
		}
	}
	
	if ( is_archive() ) {
		$intro_options = miss_get_setting( 'intro_options' );
		if( $intro_options != 'disable' ) {
			$title =  __( 'Archives', MISS_TEXTDOMAIN );
			if( is_category() ) {
				$text = sprintf( __('Category Archive for: %1$s', MISS_TEXTDOMAIN ), '&lsquo;' . single_cat_title('',false) . '&rsquo;');
			} elseif ( is_tag () ) {
				$text = sprintf( __('All Posts Tagged Tag: %1$s', MISS_TEXTDOMAIN ), '&lsquo;' . single_tag_title('',false) . '&rsquo;');
			} elseif ( is_day() ) {
				$text = sprintf( __('Daily Archive for: %1$s', MISS_TEXTDOMAIN ), '&lsquo;' . get_the_time('F jS, Y') . '&rsquo;');
			} elseif ( is_month() ) {
				$text = sprintf( __('Monthly Archive for: %1$s', MISS_TEXTDOMAIN ), '&lsquo;' . get_the_time('F, Y') . '&rsquo;');
			} elseif ( is_year() ) {
				$text = sprintf( __('Yearly Archive for: %1$s', MISS_TEXTDOMAIN ), '&lsquo;' . get_the_time('Y') . '&rsquo;');
			} elseif ( is_author() ) {
				$curauth = get_userdata( intval($author) );
				$text = sprintf( __('Author Archive for: %1$s', MISS_TEXTDOMAIN ), '&lsquo;' . $curauth->nickname . '&rsquo;');
			} elseif ( is_tax() ) {
				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
				$text = sprintf( __('Archives for: %1$s', MISS_TEXTDOMAIN ), '&lsquo;' . $term->name . '&rsquo;');
			}
		} 
	}
	
	if( is_404() ) {
		$intro_options = miss_get_setting( 'intro_options' );
		if( $intro_options != 'disable' ) {
			$title =  __( 'Not Found', MISS_TEXTDOMAIN );
			$text = __( 'The requested page could not be found', MISS_TEXTDOMAIN );
		}
	}
	
	if( isset( $title ) )
		$teaser .= '<h1 class="intro_title"><span>' . $title . '</span></h1>';
	
	if( isset( $text ) )
		$teaser .= '<p class="teaser"><span>' . stripslashes( $text ) . '</span></p>';
		
	if( !empty( $home_text ) )
		$teaser = stripslashes( $home_text );
		
	if( isset( $raw ) )
		$teaser = stripslashes( $raw );
	
	if( !empty( $teaser ) )	{
		$out .= '<div id="intro">';
		$out .= '<div id="intro_inner">';
		
		ob_start(); miss_intro_begin();
		$out .= ob_get_clean();
		
		$out .= $teaser;
		
		ob_start(); miss_intro_end();
		$out .= ob_get_clean();
		
		$out .= '<div class="clearboth"></div>';
		$out .= '</div><!-- #intro_inner -->';
		$out .= '</div><!-- #intro -->';
	}
	
	echo apply_atomic_shortcode( 'teaser', $out );
}
endif;


if ( !function_exists( 'miss_breadcrumbs' ) ) :
/**
 *
 */
function miss_breadcrumbs() {
	if( is_front_page() ) {
		return;
	}
		
	global $wp_query;
	
	$post_obj = $wp_query->get_queried_object();
	
	if( !empty( $post_obj ) && !empty( $post_obj->ID ) && get_post_meta( $post_obj->ID, '_disable_breadcrumbs', true ) ) {
		return;
	}
		
	$disable_breadcrumb = apply_atomic( 'disable_breadcrumb', miss_get_setting( 'disable_breadcrumbs' ) );
	
	if( !empty( $disable_breadcrumb ) ) {
		return;
	}
	if ( function_exists( "breadcrumbs_plus" ) ) {
		$out = '<div id="breadcrumbs">';
		$out .= '<div id="breadcrumbs_inner">';
		$args = is_archive() ? array( 'show_blog' => false ) : array();

		if ( function_exists('miss_get_breadcrumbs') ) {
			$out .= miss_get_breadcrumbs( $args );
		}
		//$out .= breadcrumbs_dimox();
		$out .= '</div><!-- #breadcrumbs_inner -->';
		$out .= '</div><!-- #breadcrumbs -->';
		return $out;
		//echo apply_atomic( 'breadcrumbs', $out );
	} else {
		return;
	}
}
endif;


if ( !function_exists( 'miss_recent_tweets' ) ) :
/**
 * Recent Tweets
 */
function miss_recent_tweets() {
	global $wp_query;
	
	$post_obj = $wp_query->get_queried_object();

	if( !empty( $post_obj ) && !empty( $post_obj->ID ) && get_post_meta( $post_obj->ID, '_disable_tweets', true ) ) {
		return;
	}


	$disable_tweets = apply_atomic( 'disable_tweets', miss_get_setting( 'disable_tweets' ) );
	//$disable_tweets = miss_get_setting( 'disable_tweets' );
	if( !empty( $disable_tweets ) ) {
		return;
	}

	$out = '';

    $number = 10;
    $username = miss_get_setting( 'twitter_id' );
    $miss_get_user_timeline = new miss_timeline_store(
      $oauth_access_token = miss_get_setting( 'oauth_access_token' ),
      $oauth_access_token_secret = miss_get_setting( 'oauth_access_token_secret' ),
      $consumer_key = miss_get_setting( 'consumer_key' ),
      $consumer_secret = miss_get_setting( 'consumer_secret' ),
      $screen_name = $username,
      $count = $number
    );

    $results = $miss_get_user_timeline->returnTweet();

    if ( isset( $results ) && is_array( $results ) && !empty( $results ) ) {
      foreach ( $results as $key => $tweet ) {
        if ( $key == "errors" ) {
        	if ( isset($tweet) && isset($tweet[0]) && isset($tweet[0]['message']) ) {
	            $out .= '<li>
                            <div class="date">message</div>
                            <div class="text">' . $tweet[0]['message'] . '</div>
                         </li>';
	        }
        } else {
            $out .= '<li>';
            $out .= '<div class="date">' . sprintf( esc_attr__( ' %1$s ago ', MISS_TEXTDOMAIN ), miss_relative_time(strtotime( $tweet['created_at'] ) ) ) . '</div>';
            //$out .= '<span class="tw-icon"><i class="im-icon-twitter"></i></span>';
            $out .= '<div class="text">'.miss_filter_tweet( $tweet['text'] ).'</div>';
            $out .= '<div class="button_container"><a target="_BLANK" href="http://twitter.com/1/status/' . $tweet['id_str'] . '" class="btn ribbon-style">View details</a></div>';
            $out .= '</li>';
        }
      }
    } else {
        $out .= '<li>' . __('Tweets not found.', MISS_TEXTDOMAIN ) . '</li>';
    }

	$out = '
	<div class="twitter-crousel">
	<div id="lasttweet">
	<!--div class="twitter_controls pull-right"><div class="twitter-prev"><i class="fa-icon-chevron-left"></i></div><div class="twitter-next"><i class="fa-icon-chevron-right"></i></div></div-->
	<ul class="tweet_holder">' . $out . '</ul>
	</div>
    <span class="tw-icon"><i class="im-icon-twitter"></i></span>            
	</div>';
	return $out;

}

add_shortcode('tweets', 'miss_recent_tweets');
endif;


if ( !function_exists( 'miss_post_before_title' ) ) :
/**
 *
 */
function miss_post_before_title( $args = array() ) {
  return '<div class="title-block">';
}
endif;

if ( !function_exists( 'miss_post_after_title' ) ) :
/**
 *
 */
function miss_post_after_title( $args = array() ) {
  return '</div><!-- /.title -->';
}
endif;


if ( !function_exists( 'miss_post_title' ) ) :
/**
 *
 */
function miss_post_title( $args = array() ) {
	global $post;
	
	$defaults = array(
		'shortcode' => false,
		'no_link' => false,
		'echo' => true,
        'wraptitle' => true
	);
	
	$args = wp_parse_args( $args, $defaults );
	
	extract( $args );
	if($wraptitle)
    {
        $title = the_title( '<h3>', '</h3>', false );
    }
    else
    {
        $title = the_title('', '', false);
    }
    
	/*if( is_page() && !$shortcode )
		return;
	
	$title = '';
	if ( $no_link == true ) {
		$title = the_title( '<h2 class="post_title">', '</h2>', false );
	} elseif( $shortcode && strpos( $type, 'list') && $thumb == 'small' )
		$title = the_title( '<h3 class="post_title"><a href="' . esc_url( get_permalink() ) . '" title="' .
		esc_attr( the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">', '</a></h3>', false );
		
	elseif( $shortcode &&  strpos( $type, 'grid') && ( $column == 3 || $column == 4 ) )
		$title = '<h2 class="post_title"><a href="' . esc_url( get_permalink() ) . '" title="' .
		esc_attr( the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">' . miss_excerpt( the_title('', '', false ), 30, THEME_ELLIPSIS ) . '</a></h2>';
			
	elseif( is_single() && !is_attachment() )
		$title = the_title( '<h2 class="post_title">', '</h2>', false );
		
	elseif( is_attachment() && miss_get_setting ( 'intro_options' ) == 'disable' )
		$title = the_title( '<h2 class="post_title"><a href="' . esc_url( get_permalink() ) . '" title="' .
		esc_attr( the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">', '</a></h2>', false );
		
	elseif( !is_attachment() )
		$title = the_title( '<h2 class="post_title"><a href="' . esc_url( get_permalink() ) . '" title="' .
		esc_attr( the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">', '</a></h2>', false );
    
	if( $echo )
		echo apply_atomic( 'entry_title', $title );
	else
    */
		return apply_atomic( 'entry_title', $title );
}
endif;


if ( !function_exists( 'miss_home_content' ) ) :
/**
 *
 */
function miss_home_content() {
	if( !is_front_page() )
		return;
	
	$out = '';
	
	if( miss_get_setting( 'content' ) ) {
		$content = stripslashes( miss_get_setting( 'content' ) ); 
		if (!empty($content)) {
			$content = apply_filters( 'the_content', $content );
		
			$out .= '<div class="divider_dotted"></div><div id="header-info-banner" class="page">';
			$out .= $content;
			$out .= '</div><div class="divider_dotted"></div>';
		}
	}
	
	echo apply_atomic_shortcode( 'home_content', $out );;
}
endif;

if ( !function_exists( 'miss_excerpt_length_long' ) ) :
function miss_excerpt_length_long( $length = 180) {
	return $length;
}
endif;

if ( !function_exists( 'miss_excerpt_length_medium' ) ) :
function miss_excerpt_length_medium( $length = 120) {
	return $length;
}
endif;

if ( !function_exists( 'miss_excerpt_length_short' ) ) :
function miss_excerpt_length_short( $length = 80) {
	return $length;
}
endif;

if ( !function_exists( 'miss_excerpt_length_shortest' ) ) :
function miss_excerpt_length_shortest( $length = 40 ) {
	return $length;
}
endif;

if ( !function_exists( 'miss_excerpt_more' ) ) :
function miss_excerpt_more( $more ) {
	return ' <small>...</small>';
}
endif;

if ( !function_exists( 'miss_read_more' ) ) :
function miss_read_more($title = false, $link = false) {
	global $post;
	$readmore_option = miss_get_setting("disable_readmore_button");
	if ($title == false) {
		$title = __( 'Read More', MISS_TEXTDOMAIN );
	}
	if ($link == false) {
		$link = get_permalink( $post->ID );
	}
	if (!$readmore_option) {
		$out = '<span class="post_more_link"><a class="post_more_link_a" href="' . esc_url( $link ) . '">'. $title . '</a></span>';
	}
	return $out;
}
endif;

if ( !function_exists( 'miss_full_read_more' ) ) :
function miss_full_read_more( $echo = false ) {
	global $post;
	$readmore_option = miss_get_setting("disable_readmore_button");
	if (!$readmore_option) {
	    $out = '<a href="'. esc_url( get_permalink( $post->ID ) ) .'" class="btn ribbon-style">View details</a>';
		//$out = '<span class="post_more_link"><a class="post_more_link_a" href="' . esc_url( get_permalink( $post->ID ) ) . '#more-' . $post->ID . '">' . __( 'Read More <i class="fa-icon-angle-right"></i>', MISS_TEXTDOMAIN ) . '</a></span>';
	} else {
		$out = '';
	}

	if( $echo )
		echo $out;
	else
		return $out;
}
endif;

if ( !function_exists( 'miss_post_content' ) ) :
/**
 *
 */
function miss_post_content( $args = array() ) {
	global $irish_framework_params;
	
	extract( $args );
/*	
	$star_color = '';
	
	$column = !empty( $column ) ? $column : '';
	$type = !empty( $type ) ? $type : '';
	$thumb = !empty( $thumb ) ? $thumb : '';
	$blog_layout = !empty( $blog_layout ) ? $blog_layout : '';
	
	if( $blog_layout == 'blog_layout6' || ( $type == 'blog_list' && $thumb == ' medium '.$star_color.'' ) )
		add_filter( 'excerpt_length', 'miss_excerpt_length_medium', 500 );
	
	elseif( empty( $featured_post ) && $blog_layout != 'blog_layout1' && $column != 1 && $column != 4 && $thumb != 'large' )
		add_filter( 'excerpt_length', 'miss_excerpt_length_short', 200 );

	if( $blog_layout == 'blog_layout4' )
		add_filter( 'excerpt_length', 'miss_excerpt_length_shortest', 100 );
*/
	$readmore_option = miss_get_setting("disable_readmore_button");
	if( miss_is_blog() && miss_get_setting( 'display_full' ) ) {
/*
*/
		global $more;
		$more = 0;
		$more_link_text = (!$readmore_option) ? 'Read More <i class="fa-icon-angle-right">' : '';
		the_content( $more_link_text );
	} else {
		$excerpt_length = ( isset($excerpt_length) ) ? $excerpt_length : 120;
		echo '<div class="content-excerpt">';
		echo miss_excerpt('', $excerpt_length, '...');// the_excerpt();
		$permalink = get_permalink( get_the_ID() );
		
		if( ( !empty( $disable ) && strpos( $disable, 'more' ) === false ) || empty( $disable ) ) {
			/* Return Readmore Link or Button */
			if (!$readmore_option) {
				echo apply_filters( 'miss_read_more_link', $permalink );
			}
		}
		echo '</div>';
	}
	
}
endif;

if ( !function_exists( 'miss_page_content' ) ) :
/**
 *
 */
function miss_page_content() {
	if( !is_front_page() )
		return;
		
	if( miss_get_setting( 'mainpage_content' ) ){
		
		$content = miss_get_setting( 'mainpage_content' );
			
		$args = array( 'post_type'=>'page', 'post__in' => array( $content ) );
			
		$my_query = new WP_Query( $args );
			
		if ( $my_query->have_posts() ) {
			global $more;
			echo '<div class="' . join( ' ', get_post_class( 'page' ) ) . '">';
			while ( $my_query->have_posts() ) { 
				$my_query->the_post();
				$more = 0;
		        the_content();
			}
			echo '</div>';
		}
		
		wp_reset_postdata();
	}
}
endif;

if ( !function_exists( 'miss_featured_post' ) ) :
/**
 *
 */
function miss_featured_post() {
	
	global $wp_query, $irish_framework_params;
	
	$paged = miss_get_page_query();
	$layout = $irish_framework_params->layout['blog'];
	
	if( is_archive() || is_search() ) {
	 	return false;
	}

	if( $paged != 1 ) {
	 	return false;
	 }

	if( $layout['blog_layout'] != 'blog_layout2' && $layout['blog_layout'] != 'blog_layout3' ) {
	 	return false;
	}
		
	$args = array_merge( $wp_query->query, array( 'post_type'=> 'post', 'category__not_in' => miss_exclude_category_array( $minus = false ), 'showposts' => $layout['featured'], 'posts_per_page' => 1, 'offset' => 0 ) );
		
	$temp = $wp_query;
	$wp_query= null;
	remove_filter( 'post_limits', 'my_post_limit' );
	
	
	$wp_query = new WP_Query();
	$wp_query->query( $args );
	
	?><div id="post-<?php the_ID(); ?>" <?php post_class( $layout['post_class'] . ' featured_post_module' ); ?>><?php
	
	while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
	
		<?php miss_before_post( array( 'featured_post' => true, 'post_id' => get_the_ID() ) ); ?>
	
		<div class="<?php echo $layout['content_class']; ?>">
			
			<?php miss_before_entry(); ?>

			<div class="post_excerpt">
				<?php miss_post_content( array( 'featured_post' => true, 'blog_layout' => $layout['blog_layout'] ) ); ?>
			</div>
			
			<?php miss_after_entry(); ?>
	
		</div><!-- .content_class -->
		
	<?php endwhile;
	
	?></div><div class="clearboth"></div><?php
	
	$wp_query = null;
	$wp_query = $temp;
}
endif;


if ( !function_exists( 'miss_query_posts' ) ) :
/**
 *
 */
function miss_query_posts() {
	global $wp_query, $irish_framework_params;
	
	$post_obj = $wp_query->get_queried_object();
	$exclude_categories = miss_exclude_category_string();
	$blog_layout = $irish_framework_params->layout['blog']['blog_layout'];
	$irish_framework_params->offset = ( $blog_layout == 'blog_layout2' || $blog_layout == 'blog_layout3' ) ? $irish_framework_params->layout['blog']['featured'] : false;
	if ($irish_framework_params->offset) {
		$irish_framework_params->offset = "1";
	}
	// $blog_page = miss_blog_page();
	// if( $blog_page == $post_obj->ID ) {
	// 	$irish_framework_params->is_blog = true;
	// }
	/* Reset offset for categories and search results */
	if ( is_archive() || is_search() ) {
		$irish_framework_params->offset = "0";
	}

	$paged = miss_get_page_query();

	if( !empty( $exclude_categories ) ) {
		$query_string = "cat={$exclude_categories}&paged={$paged}";
	} else {
		$query_string = "paged={$paged}";
	}
	if ( is_home() || is_front_page() ) {
		$query_string = $query_string . "&offset={$irish_framework_params->offset}";
	} else {
		if( !empty( $irish_framework_params->offset ) ) {
			if ($paged > 1) {
				$irish_framework_params->offset = 1;
				//$irish_framework_params->offset = (get_settings('posts_per_page')*$paged)/2+1;
			} else {
				$irish_framework_params->offset = 1;
			}
			$query_string = $query_string . "&offset={$irish_framework_params->offset}";
		} else {
			$irish_framework_params->offset = "0";
			$query_string = $query_string . "&offset={$irish_framework_params->offset}";
		}
	}
		
	//print $query_string;
	if( isset( $irish_framework_params->is_blog ) ) {
		return query_posts( $query_string );
	}

	if( is_archive() || is_search() ) {
		$irish_framework_params->archive_search = true;
		$irish_framework_params->offset = "0";
		$args = array_merge(
			$wp_query->query,
			array(
				'post_type'=> get_post_type(), //Array('post', 'news', 'page'),
				'category__not_in' => miss_exclude_category_array( $minus = false ),
				'offset' => $irish_framework_params->offset
			)
		);
		return query_posts( $args );
	} elseif( !empty( $post_obj->ID ) ){
		$blog_page = miss_blog_page();
		if( $blog_page == $post_obj->ID ) {
			$irish_framework_params->is_blog = true;
			$irish_framework_params->blog_page = $post_obj->ID;
			if( !empty( $irish_framework_params->offset ) ) {
				$irish_framework_params->posts_per_page = get_option( 'posts_per_page' );
				add_filter( 'post_limits', 'my_post_limit' );
			}
			return query_posts( $query_string );
		}
	} elseif( ( is_front_page() && miss_get_setting( 'frontpage_blog' ) ) || ( !empty( $post_obj->ID ) && get_option('page_for_posts') == $post_obj->ID ) ) {
		if( !empty( $irish_framework_params->offset ) ) {
			$irish_framework_params->posts_per_page = get_option( 'posts_per_page' );
			add_filter( 'post_limits', 'my_post_limit' );
		}
		$args = array_merge( $wp_query->query, array( 'post_type'=> 'post', 'paged'=> $paged, 'offset' => $irish_framework_params->offset, 'category__not_in' => miss_exclude_category_array( $minus = false ) ) );
		return query_posts( $args );
	}
	return false;

}
endif;

/*
if ( !function_exists( 'miss_post_meta' ) ) :
function miss_post_meta( $args = array() ) {
	$defaults = array(
		'shortcode' => false,
		'echo' => true
	);
	
	$args = wp_parse_args( $args, $defaults );
	
	extract( $args );
	
	if( is_page() && !$shortcode ) return;
	
	$out = '';
	$meta_options = miss_get_setting( 'disable_meta_options' );
	$_meta = ( is_array( $meta_options ) ) ? $meta_options : array();
	$meta_output = '';
	
	if( !in_array( 'date_meta', $_meta ) ) {
		$meta_output .= '[post_date text="';
		if( !in_array( 'posted_title_meta', $_meta ) ) {
			$meta_output .=  __( '<em>Posted on: </em>', MISS_TEXTDOMAIN );
		}
		$meta_output .=' "] ';
	}
	if( !in_array( 'comments_meta', $_meta ) )
		$meta_output .= '[post_comments text="' . __( '<em>With: </em>', MISS_TEXTDOMAIN ) . ' "] ';
		
	if( !in_array( 'author_meta', $_meta ) )
		$meta_output .= '[post_author text="' . __( '<em>Posted by: </em>', MISS_TEXTDOMAIN ) . ' "] ';
	
	if( !empty( $meta_output ) )
		$out .='<div class="post_meta">' . $meta_output . '</div>';
	
	if( $echo )
		echo apply_atomic_shortcode( 'post_meta', $out );
	else
		return apply_atomic_shortcode( 'post_meta', $out );
}
endif;
*/

if ( !function_exists( 'miss_post_date' ) ) :
/*
 *
 */
function miss_post_date( $args = array() ) {
	$defaults = array(
		'shortcode' => false,
		'echo' => true
	);
	
	$args = wp_parse_args( $args, $defaults );
	
	extract( $args );
	
	if( is_page() && !$shortcode ) return;
	
	$out = '';
	$meta_options = miss_get_setting( 'disable_meta_options' );
	$_meta = ( is_array( $meta_options ) ) ? $meta_options : array();
	if( !in_array( 'date_meta', $_meta ) ) {
		$meta_output = '[post_date_box text=""]';
	} else {
	
	}
	$out = $meta_output;
	
	if( $echo )
		echo apply_atomic_shortcode( 'post_meta', $out );
	else
		return apply_atomic_shortcode( 'post_meta', $out );
}
endif;

if ( !function_exists( 'miss_post_meta_bottom' ) ) :
/**
 *
 */
function miss_post_meta_bottom() {
	if( is_page() ) return;
	
	$out = '';
	$meta_options = miss_get_setting( 'disable_meta_options' );
	$_meta = ( is_array( $meta_options ) ) ? $meta_options : array();
	$meta_output = '';

	if( !in_array( 'categories_meta', $_meta ) )
		$meta_output .= '[post_terms separator=", " taxonomy="category" text=' . __( '<em>Categories:</em>&nbsp;', MISS_TEXTDOMAIN ) . '] ';

	if( !in_array( 'tags_meta', $_meta ) )
		$meta_output .= '[post_terms separator=", " text=' . __( 'Tags: ', MISS_TEXTDOMAIN ) . ']';

	if( !empty( $meta_output ) )
		$out .='<p class="post_meta_bottom">' . $meta_output . '</p>';
	
	echo apply_atomic_shortcode( 'post_meta_bottom', $out );
}
endif;

if ( !function_exists( 'miss_before_post_sc' ) ) :
/**
 *
 */
function miss_before_post_sc( $filter_args ) {
	$out = '';
	if( in_array( 'post_list_image', $filter_args ) )
		$filter_args = array_merge( $filter_args, array( 'inline_width' => true ) );

	if( strpos( $filter_args['disable'], 'image' ) === false ){
		$out .= miss_get_post_image( $filter_args );
	}
	/*
	 elseif( $filter_args['type'] == 'blog_list' ) {
		$out .= '<a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '" title="' . sprintf( get_the_time( __( 'l, F jS, Y, g:i a', MISS_TEXTDOMAIN ) ) ) . '" class="month pull-left"><span class="day">' . get_the_time( 'd' ) . '</span>' . get_the_time( 'M' ) . '</a>';
	}
	*/
	if( strpos( $filter_args['disable'], 'title' ) === false )
		$out .= miss_post_title( $filter_args );
	if ( $filter_args['type'] != 'staff' ) {
		if( strpos( $filter_args['disable'], 'meta' ) === false )
			$out .= miss_post_meta_diferent( $filter_args );
	} else {
		$out .= '<div class="employee_position">' . get_post_meta( get_the_id( ), 'position', true ) . '</div>';
	}
		
	return $out;
}
endif;


if ( !function_exists( 'miss_before_entry_sc' ) ) :
/**
 *
 */
function miss_before_entry_sc( $filter_args ) {
	$out = '';
	
	if( strpos( $filter_args['disable'], 'meta' ) === false )
		$out .= miss_post_meta( $filter_args );
	
	return $out;
}
endif;

if ( !function_exists( 'miss_after_entry_sc' ) ) :
/**
 *
 */
function miss_after_entry_sc( $filter_args ) {
	
}
endif;

if ( !function_exists( 'miss_post_image' ) ) :
/**
 *
 */
function miss_post_image( $args = array() ) {
	global $wp_query, $irish_framework_params;
	
	$post_obj = $wp_query->get_queried_object();
	
	extract( $args );
	
	# if portfolio post image disables
	$type = isset($type) ? $type : '';
	if (!$type) {
		$type = get_post_type();
	};
	if( $type == 'portfolio' ) {
		$_fullsize = get_post_meta( get_the_ID(), '_fullsize', true );
		if( $_fullsize ) return;
	}
	
	# if featured image image disables
	if( is_single() ) {
		$_disable_post_image = get_post_meta( $post_obj->ID, '_disable_post_image', true );
		if( !empty( $_disable_post_image ) ) return;
	}
		
	
	$width = '';
	$height = '';
	
	$index = ( isset( $index ) ) ? $index : '';
	$post_layout = $irish_framework_params->layout['blog']['blog_layout'];
	
	if( !empty( $irish_framework_params->is_blog ) ) {
		$_layout = get_post_meta( $irish_framework_params->blog_page, '_layout', true );
		$img_layout = ( $_layout == 'full_width' ? 'images' : ( $_layout == 'left_sidebar' ? 'small_sidebar_images' : 'big_sidebar_images' ) );
		
	} elseif( !empty( $post_obj->ID ) ) {
		$_layout = get_post_meta( $post_obj->ID, '_layout', true );
		$img_layout = ( $_layout == 'full_width' ? 'images' : ( $_layout == 'left_sidebar' ? 'small_sidebar_images'
		: ( empty( $_layout ) && $type == 'portfolio' ? 'images': 'big_sidebar_images' ) ) );

	} elseif( !empty( $irish_framework_params->archive_search ) ) {
		$img_layout ='big_sidebar_images';
		
	} elseif( is_front_page() ) {
		$_layout = miss_get_setting( 'homepage_layout' );
		$img_layout = ( $_layout == 'full_width' ? 'images' : ( $_layout == 'left_sidebar' ? 'small_sidebar_images' : 'big_sidebar_images' ) );
	} else {
		$_layout = miss_get_setting( 'homepage_layout' );
                $img_layout = ( $_layout == 'full_width' ? 'images' : ( $_layout == 'left_sidebar' ? 'small_sidebar_images' : 'big_sidebar_images' ) );
        }
	
	$img_class = ( is_single() ) ? 'single_post_image' : $irish_framework_params->layout['blog']['img_class'];
	
	/* wp medium single page thumbnail */
	$img_sizes = $post_layout;
	
	if( is_singular( 'portfolio' ) ){
		$img_sizes = 'portfolio_single_full';

	} elseif ( $type == 'portfolio' ) {
		$img_sizes = get_post_meta( $post_obj->ID, 'portfolio_layout' );
		$img_sizes = $img_sizes[0];

	} elseif( is_single() ){
		$img_sizes = 'blog_layout1';
		
	}else{
		$img_sizes = $img_sizes;
	}
	$width = $irish_framework_params->layout[$img_layout][$img_sizes][0];
	$height = $irish_framework_params->layout[$img_layout][$img_sizes][1];
	
	if( !empty( $post_obj->ID ) )
		$_featured_video = get_post_meta( $post_obj->ID, '_featured_video', true );
		
	elseif( !empty( $post_id ) )
		$_featured_video = get_post_meta( $post_id, '_featured_video', true );
	
	$args = array(
		'index' => $index,
		'width' => $width,
		'height' => $height,
		'img_class' => $img_class,
		'link_class' => 'blog_index_image_load',
		'video' => ( !empty( $_featured_video ) ? $_featured_video : false ),
		'inline_width' => ( $post_layout == 'blog_layout2' ? true : false ),
		'featured_post' => ( !empty( $featured_post ) ? true : false )
	);
	if( is_single() ) {
		$args['link_class'] = 'one_column_blog prettyPhoto';
		$args['img_class'] = $img_class . ' has_preview';
	}
	if ($post_layout == 'blog_layout1') {
		$args['noimage'] = false;
	}
	if ($post_layout == 'blog_layout2') {
		$args['rank'] = true;
	}
	if( is_singular( 'portfolio' ) && $_layout == 'full_width' ) {
		$args = array_merge( $args, array( 'portfolio_full' => true ) );
	}
	miss_get_post_image( $args );
}
endif;

if ( !function_exists( 'post_type_additional_post_media' ) ) :
/**
 *
 */
function post_type_additional_post_media() {
	if ( get_post_meta( get_the_ID(), '_post_feature_display_type', true ) == 'additional_images' ) {
        $images = new miss_gallery_attachments( $limit = 999, $order = 'ASC', $post_id = get_the_ID() );
        if ( count( $images->get_media() ) > 2 ) {
          echo '<div class="row-fluid media-images ' . get_post_type() . '"><div class="span12">';
          $this_post_media_counter = 0;
          foreach ( $images->get_media() as $image ) {
            if ( $this_post_media_counter > 0 ) {
/*
              $double_resolution = (miss_get_setting('hires') == 'enabled') ? true : false;
              if ( $double_resolution == true ) {
                $width = 340;
                $height = 244;
              } else {
                $width = 170;
                $height = 122;
              }
              $thumb = miss_wp_image( $image->guid, $width, $height );
              echo '<div class="single_post_image has_preview small-single-image"><a href="' . $image->guid . '"><img src="' . $thumb . '" /></a>
              <div class="preview_info_wrap"><a rel="prettyPhoto" href="' . $image->guid . '" title="" class="one_column_blog"></a><a class="controls img single" href="' . $image->guid . '" rel="prettyPhoto[' . get_post_type() . '_' . get_the_ID() . ']"><i class="im-icon-zoom-in"></i></a> <!-- /.controls --></div>
              </div>';
*/
              $width = 170;
              $height = 122;
			  $thumb = miss_get_post_image( $args = array( 'src' => $image->guid, 'img_class' => 'hover_fade_js image-resize w', 'width' => $width, 'height' => $height, 'echo' => false, 'preview_info_wrap' => false, ) );
              echo '<div class="single_post_image has_preview small-single-image"><a href="' . $image->guid . '">' . $thumb . '</a>
              <div class="preview_info_wrap"><a rel="prettyPhoto" href="' . $image->guid . '" title="" class="one_column_blog"></a><a class="controls img single" href="' . $image->guid . '" rel="prettyPhoto[' . get_post_type() . '_' . get_the_ID() . ']"><i class="im-icon-zoom-in"></i></a> <!-- /.controls --></div>
              </div>';

            }
            $this_post_media_counter++;
          }
          echo '</div></div>';
        }
	}
}
endif;

if ( !function_exists( 'post_type_quote' ) ) :
/**
 *
 */
function post_type_quote() {
	if ( get_post_meta( get_the_ID(), '_post_feature_display_type', true ) == 'quote' ) {
		echo '<div class="post_grid_image">';
		echo '<div class="custom_quote">';
		echo '<i class="fa-icon-quote-left"></i>';
		echo '<a href="' . get_permalink() . '">';
		echo get_post_meta( get_the_ID(), '_custom_quote', true );
		echo '</a>';
		echo '</div><!-- class="custom_quote" -->';
		echo '</div><!-- class="post_grid_image" -->';
/*
		if ( !is_single() ) {
			echo '</div><!-- close post holder --> <div class="hidden">'; // this sting deliberately close previous tag and open new tag which hidde content below
		}
*/
	}
}
endif;

if ( !function_exists( 'post_type_sound_cloud' ) ) :
/**
 *
 */
function post_type_sound_cloud() {
	if ( get_post_meta( get_the_ID(), '_post_feature_display_type', true ) == 'sound_cloud' ) {
		echo '<div class="post_grid_image">';
		echo do_shortcode('[im_soundcloud width="100%" height="80px" comments="true"]' . get_post_meta( get_the_ID(), '_sound_cloud', true ) . '[/im_soundcloud]') ;
		echo '</div><!-- class="post_grid_image" -->';
	}
}
endif;

if ( !function_exists( 'post_feature_display_type' ) ) :
/**
 *
 */
function post_feature_display_type() {
	$_post_feature_display_type = ( get_post_meta( get_the_ID(), '_post_feature_display_type', true ) ) ? get_post_meta( get_the_ID(), '_post_feature_display_type', true ) : 'default';
	if ( $_post_feature_display_type == 'additional_images' ) {
		miss_post_image();
		post_type_additional_post_media();
	} elseif ( $_post_feature_display_type == 'quote' ) {
        echo '<div class="post_grid_image">';
		echo '<div class="custom_quote">';
		echo '<i class="fa-icon-quote-left"></i>';
		echo '<a href="' . get_permalink() . '">';
		echo get_post_meta( get_the_ID(), '_custom_quote', true );
		echo '</a>';
		echo '</div><!-- class="custom_quote" -->';
		echo '</div><!-- class="post_grid_image" -->';
		//post_type_quote();
	} elseif ( $_post_feature_display_type == 'sound_cloud' ) {
		post_type_sound_cloud();
	} else {
		miss_post_image();
	}
}
endif;

if ( !function_exists( 'miss_page_navi' ) ) :
/**
 *
 */
function miss_page_navi() {
	echo '<div class="miss_pagenavi">';
	echo miss_pagenavi();
	echo '</div><!-- .miss_pagenavi -->';
}
endif;

if ( !function_exists( 'miss_post_nav' ) ) :
/**
 *
 */
function miss_post_nav() {
	$out = '';
	$index = '';
	$disable_post_nav = apply_atomic( 'disable_post_nav', miss_get_setting( 'disable_post_nav' ) );
	if( !empty( $disable_post_nav ) )
		return;
	if(is_singular('portfolio')){
		$index_id = miss_get_setting('portfolio_page');
		$prev = '';
		$next = '';
		if ( !empty( $index_id ) ) {
			$index = '<div class="index_lage"><a href="' . get_permalink( $index_id ) . '"><i class="im-icon-grid-5"></i></a></div>';
		}

	} else {
		$prev = __('Previous', MISS_TEXTDOMAIN);
		$next = __('Next', MISS_TEXTDOMAIN);
	}
	echo '<div class="more-posts span8 big-ribbon-style">';
    echo '<div class="wrapper">';
    echo '<div class="additional-wrapper">';
	echo '<div class="remaining">';
	previous_post_link( '%link', $prev );
	echo '</div>';
	echo $index;
	echo '<div class="next">';
	next_post_link( '%link', $next );
	echo '</div>';
    echo '<div class="title"><span>Show more posts</span></div>';
	echo '</div>';
    echo '</div>';
	echo '</div><!-- #nav-below -->';
//	echo apply_filters( 'miss_post_nav', $out );

}
endif;

if ( !function_exists( 'miss_post_sociables' ) ) :
/**
 *
 */
function miss_post_sociables() {
	$out = '';
	
	$social_bookmarks = miss_get_setting( 'social_bookmarks' );
	$social_bookmarks_post = get_post_meta( get_the_ID(), '_disable_social_bookmarks', true );
	
	if( empty( $social_bookmarks ) && empty( $social_bookmarks_post ) ) {
		$out .= '<div class="share_this_module">';
		$out .= '<h3>' . __( 'Share', MISS_TEXTDOMAIN ) . '</h3>';
		$out .= '<div class="share_this_content">';
		
		$out .= miss_sociable_bookmarks();
		
		$out .= '</div><!-- .share_this_content -->';
		$out .= '</div><!-- .share_this_module -->';
	}
	
	echo apply_filters( 'miss_post_sociables', $out );
}
endif;

if ( !function_exists( 'miss_social_shortcuts' ) ):
/**
 * Build social shortcuts from global options
 * @since 1.5
 */
function miss_social_shortcuts() {
    $sociables = "";
    $sociable = miss_get_setting( 'sociable' );
    if( $sociable['keys'] != '#' ) {
        $sociable_keys = explode( ',', $sociable['keys'] );
        foreach ( $sociable_keys as $key ) {
            if( $key != '#' ) {
                $sociable_link = ( !empty( $sociable[$key]['link'] ) ) ? $sociable[$key]['link'] : '#';
                $sociable_bg = ( !empty( $sociable[$key]['background'] ) ) ? $sociable[$key]['background'] : '';
                $sociables .= '<a href="' . $sociable_link . '" class="social-media-item" style="background: '.$sociable_bg.';"><i class="' . $sociable[$key]['icon'] . '"></i></a>';
            }
        }
    }
    return $sociables;
}
endif;

if ( !function_exists( 'miss_langs_shortcuts' ) ):
/**
 * Build langs shortcuts from global options
 * @since 1.5
 */
function miss_langs_shortcuts() {
    $langs = '';
    $extra_header_langs = miss_get_setting( 'extra_header_langs' );
    if( $extra_header_langs['keys'] != '#' ) {
        $extra_header_langs_keys = explode( ',', $extra_header_langs['keys'] );
        foreach ( $extra_header_langs_keys as $key ) {
            if( $key != '#' ) {
                $extra_header_langs_link = ( !empty( $extra_header_langs[$key]['link'] ) ) ? $extra_header_langs[$key]['link'] : '#';
                $langs .= '<li><a href="' . $extra_header_langs_link . '">' . $extra_header_langs[$key]['custom'] . '</a></li>';
            }
        }
    }
$langs = '
<ul class="nav">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="im-icon-earth"></i> ' . __( 'Language', MISS_TEXTDOMAIN ) . '</a>
		<ul class="dropdown-menu">
			' . $langs . '
		</ul>
	</li>
</ul>
';
	return $langs;
}
endif;


/* Partners */
if ( !function_exists( 'miss_partners_shortcuts' ) ):
/**
 * Build partners shortcuts from global options
 * @since 1.5
 */
function miss_partners_shortcuts( $limit = 999, $start = 0 ) {
        $out = "";
        $empty_cell = "";
        $partners = miss_get_setting( 'partners' );
        if( ($partners['keys'] != '#') and ($partners != '') ) {
            $partners_keys = explode( ',', $partners['keys'] );

			if ( array_key_exists('#', $partners) ) {
				unset($partners['#']);
				unset($partners['keys']);
			};
			$spans_in_row = miss_get_setting( 'partners_on_one_slide' ) ? miss_get_setting( 'partners_on_one_slide' ) : 6;
			$span_walk = 0;
			$row_walk = 1;
			$flag = false;
			$span_width = 100 / $spans_in_row;

			$counter_item = count( $partners );
			$counter_row = $counter_item / $spans_in_row;
			if ( !is_int($counter_row) ){
				$counter_row = ceil( $counter_row );
				$counter_residue = $counter_item - (($counter_row-1) * $spans_in_row);
				$counter_empty_cell = floor( ($spans_in_row - $counter_residue) / 2 );
			} else {
				$counter_residue = $counter_item - (($counter_row) * $spans_in_row);
				$counter_empty_cell = 0;
			}
			$counter_total_cell = $counter_item+$counter_empty_cell;
			foreach ($partners as $key => $value) {
				if (isset($partners[$key]['custom'])){
					$out .= '<div class="content-item">';
					$out .= '<a href="' . esc_url( $partners[$key]['link'] ) . '"><img src="' . esc_url( $partners[$key]['custom'] ) . '" alt="' . esc_url( $partners[$key]['link'] ) . '" /></a>';
					$out .= '</div>';
				}
			}
    }
    return $out;
}
endif;


if ( !function_exists( 'miss_about_author' ) ) :
/**
 *
 */
function miss_about_author() {
	$disable_post_author = apply_atomic( 'disable_post_author', miss_get_setting( 'disable_post_author' ) );
	if( !is_singular( 'post' ) || !empty( $disable_post_author ) )
		return;
		
	$out = '';
	
	if( get_the_author_meta( 'description' ) ) {
		$out .= '<div class="about_author_module">';
		$out .= '<h3 class="about_author_title">' . __( 'About the Author', MISS_TEXTDOMAIN ) . '</h3>';
		$out .= '<div class="about_author_content">';
		
		$out .= get_avatar( get_the_author_meta('user_email'), apply_filters( 'miss_author_avatar_size', '80' ), THEME_IMAGES_ASSETS . '/avatars/default-avatar_80.png' );
		$out .= '<p class="author_bio"><span class="author_name">' . esc_attr(get_the_author()) . '</span>' . get_the_author_meta( 'description' );
		$out .= '[styled_link link="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '"]' . sprintf( __( 'View all posts by %s', MISS_TEXTDOMAIN ), get_the_author() ) . '[/styled_link]';
		$out .= '</p><!-- .author_bio -->';
		
		$out .= '<div class="clearboth"></div>';
		$out .= '</div><!-- .about_author_content -->';
		$out .= '</div><!-- .about_author_module -->';
	}
	
	echo apply_atomic_shortcode( 'about_author', $out );
}
endif;


if ( !function_exists( 'miss_render_tweets' ) ):

function miss_render_tweets($username, $limit) {
	$hash = rand(100,200);

	$script = '<script type="text/javascript">
		var a' . $hash . ' = {
			include_entities: true,
		    screen_name: "'.$username.'",
		    include_rts: false,
		    count: '.$limit.'
		};
		jQuery.get("https://api.twitter.com/1/statuses/user_timeline.json", a' . $hash . ', function (c) {
		    if (c.length > 0) {
		        var b = "";
		        jQuery("#twitter_update_list_' . $hash . ' li").remove();
		        jQuery.each(c, function (d, e) {
		        	e.from_user = e.user.screen_name .replace(/([-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig, function(url) {
		        		return \'<a href="http://twitter.com/\'+url+\'">\'+url+\'</a>\';
		        	});
	        		// e.text = e.text.substring(0,100) + \'...\';
					e.text = e.text.replace(/(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig, function(url) {
						return \'<a href="\'+url+\'" target="_blank">\'+url+\'</a>\';
					}).
					replace(/B@([_a-z0-9]+)/ig, function(reply) {
						return  reply.charAt(0)+\'<a href="http://twitter.com/%27+reply.substring%281%29+%27" data="http://twitter.com/%27+reply.substring%281%29+%27">\'+reply.substring(1)+\'</a>\';
					});
		            b += "<li><div class=\"tweet_feed\">" + e.text + "<span class=\"arrow\"></span></div><div class=\"badge-large\"><i class=\"fa-icon-twitter\"></i></div><div class=\"tw_username\">' . $username . '</div></li>"
		        });
		        jQuery("#twitter_update_list_' . $hash . '").append(b).find(".loading").remove();
		        jQuery("#twitter_update_list_' . $hash . '").cycle({
		            fx: "scrollUp",
		            easing: "easeInOutCirc",
		    		prev:   \'.twitter-prev\',
		    		next:   \'.twitter-next\'
		        })
		    } else {
		        jQuery("#twitter_update_list_' . $hash . '").append("<li>' . __("No tweets found for user", MISS_TEXTDOMAIN) . '</li>").find(".loading").remove()
		    }
		}, "jsonp");
	</script>';
	$out = $script . '<ul id="twitter_update_list_' . $hash . '" class="twitter_list"><li>' . __("Loading Tweets, please wait...", MISS_TEXTDOMAIN) . '</li></ul>';
	return $out;
}

endif;


if ( !function_exists( 'miss_render_subblock' ) ):

  /**
   * Subblock Render Function
   * @since 1.5
   */

  function miss_render_subblock ($data = false, $type = false, $layout = 'default') {
    if ($data == false || $type == false) {
      return false;
    }
    $out = '';
    $data = $data[$type];
    if ($type == 'testimony' || $type == 'testimonials') {
          //$args = array( 'numberposts' => 1, 'order'=> 'DESC', 'orderby' => 'date', 'category' => implode(",", $whatson['categories'] ) );
          $args = array( 'numberposts' => $data['limit'], 'order'=> 'DESC', 'orderby' => 'date',
          'post_type' => 'testimony' );

          $query = new WP_Query();
          $query->query($args);
          $out .= '<ul id="testimonials" data-delay="' . $data['delay'] . '">';
          $postslist = get_posts( $args );
          while ($query->have_posts()) {
            $query->the_post();
            //setup_postdata($post);
            $out .= '<li>';
            $out .= '<div class="inner">' . miss_excerpt( get_the_excerpt(), apply_filters( 'miss_home_testimonials_excerpt', $data['excerpt']['content'] ), apply_filters( 'miss_home_testimonials_excerpt', THEME_ELLIPSIS ) ) . '</div>';
            $out .= '<div class="arrow"></div>';
            $out .= '<div class="author"><div class="person"></div><h4><a href="'. get_permalink(get_the_ID()) .'">'. miss_excerpt( get_the_title(get_the_ID()), apply_filters( 'miss_home_testimonials_title_excerpt', $data['excerpt']['content'] ), apply_filters( 'miss_home_testimonials_title_excerpt', THEME_ELLIPSIS ) ) . '</a></h4></div>';
            $out .= '</li>';
          }
          $out .= '</ul>';
    }
    if ($type == 'whatson') {
        $out .= '<h3 class="show767">' . $data['caption'] . '</h3>';
        $args = array( 'numberposts' => 1, 'posts_per_page'=> 1, 'order'=> 'DESC', 'orderby' => 'date', 'post_type' => 'news' );
        $query = new WP_Query();
        $query->query($args);
        while ($query->have_posts()) {
          $query->the_post();
          $out .= '<h4><a href="'. get_permalink(get_the_ID()) .'">'. get_the_title().'</a></h4>';
          $out .= '<div class="date">' . get_the_time('l, M j Y') . '</div>';
          $out .= '<p>' .miss_excerpt( get_the_excerpt(), apply_filters( 'miss_home_whatson_excerpt', $data['excerpt']['content'] ), apply_filters( 'miss_home_whatson_excerpt', THEME_ELLIPSIS ) ) . '</p>';
          if ( has_post_thumbnail() ) {
            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'medium' );
            $thumb = miss_wp_image($thumb[0], 518, 338);
            $out .= '<div class="post-thumbnail"><a href="' . get_permalink() . '" title="' . get_the_title() . '" class="pic"><img src="' . $thumb . '" class="image-resize w" alt="' . get_the_title() . '" title="' . get_the_title() . '" /></a></div>';
          }
        } 
    }
    if ($type == 'custom') {
      $out .= do_shortcode($data);
    }
    return $out;
  }
endif;

if ( !function_exists('miss_region_news') ):
/**
 * Rendering News Sections
 * @since 1.5
 */

function miss_region_news( $news = Array() ) {
    $out = '';
    if(isset($news['enable'][0]) && $news['enable'][0] == "true") {
        $opt['custom'] = $news['custom'];
        $out .= '<!-- Begin News -->';
		$out .= '<div class="divider_dotted"></div>';
        $out .= '<div id="latest-news">';
        $out .= '<div class="inner">';
        $out .= '<h2 class="display-inline-block">' . $news['caption'] . '</h2>';
        $out .= '<div class="news-controls">';
        $out .= '<li class="news-readmore"><a href="' . $news['url'] . '">' . $news['more'] . '</a></li>';
        $out .= '</div>';
        $args = array( 'showposts' => $news['limit'], 'order'=> 'DESC', 'orderby' => 'date',
          'post_type' => 'news' );
        $out .= '<div id="news-list">';

        $query = new WP_Query();
        $query->query($args);
	    if ($query->have_posts()) {
	        while ($query->have_posts()) {
	            $query->the_post();

	        // $postslist = get_posts( $args );
	        // foreach ($postslist as $post) {
	        //     setup_postdata($post);
	            $out .= '<div class="column6">';
	            $out .= '<div class="news-inner">';
	            if ( has_post_thumbnail()) {
	                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'medium' );
	                $thumb = miss_wp_image($thumb[0], 207, 207);
	                $out .= '<div class="news_thumb post-thumbnail round">';
	                
	                $out .= '<div class="post-thumbnail round"><a href="' . get_permalink() . '" title="' . get_the_title() . '" class="pic"><img src="' . $thumb . '" class="image-resize w" alt="' . get_the_title() . '" title="' . get_the_title() . '" /></a></div>';
	                $out .= '<div class="shadow small"></div>';
	                $out .= '</div>';
	            }

	            // $out .= '<div class="date ' . $news['date_style'] .'"><span class="span">' . get_the_time('M') . '</span><br /><span class="day">' . get_the_time('j') . '</span></div>';
	            $out .= '<div class="entry"><h4><a href="'. get_permalink() .'">'. get_the_title().'</a></h4>' . miss_excerpt( get_the_excerpt(), apply_filters( 'miss_home_news_excerpt', $news['excerpt']['content'] ), apply_filters( 'miss_home_news_excerpt', THEME_ELLIPSIS ) ) . '</div>';
	            $out .= '</div>';
	            $out .= '</div>';
	        }
	    }
        $out .= '</ul>';
        $out .= '</div>';
        if ($news['layout'] == 'split') {
          $out .= '<div class="inner ' . $news['layout'] . ' pull-right">';
          $out .= miss_render_subblock($opt, $news['subblock']);
          $out .= '</div>';
        }
        $out .= '</div>';
        $out .= '<div class="clearfix"></div>';

    }
    return $out;
}
endif;

if ( !function_exists('miss_carousel_partners') ):
/**
 * Partners Carousel
 * @since 1.5
 */
function miss_carousel_partners($partners = Array()) {
  /* Options */
  $out = '';
  if (isset($partners['enable'][0]) && $partners['enable'][0] == "true") {

			$out .= '<!-- Begin Partners -->';
			$out .= '<div id="latest-partners" class="clearfix">';
			$out .= '<h3 class="display-inline-block">' . $partners['caption'] . '</h3>';
			$out .= '<div class="wp-partners-controls">';
			$out .= '<li class="wp-partners-readmore"><a href="' . $partners['url'] . '">' . $partners['more'] . '</a></li>';
			$out .= '<li class="wp-partners-prev">&lt;</li>';
			$out .= '<li class="wp-partners-next">&gt;</li>';
			$out .= '</div>';
			$out .= '<div class="wp-partners" data-delay="' . $partners['delay'] . '" data-autoplay="' . $partners['autoplay'][0] . '">';
			$out .= '<ul class="carousel-inner">';
            $partners_i = 0;
            $query = new WP_Query();
            $query->query('post_type=partners&posts_per_page=20');
            if ($query->have_posts()) :
                while ($query->have_posts()) :
                    $query->the_post();
                    $site= get_post_custom_values('project_Link');
                    $shortDesc = get_post_custom_values('project_Desc');
                    $project_image1 = get_post_custom_values('project_image1');
                    $partners_i++;
                    $out .= '<li>';
                    $out .= '<div class="entry">';
                    if ( has_post_thumbnail()) :
                      $work_preview = true;
                      if ( has_post_thumbnail()) {
                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'medium' );
                            $thumb = miss_wp_image($thumb[0], 480, 250);
                            $out .= '<div class="post-thumbnail"><a href="' . get_permalink() . '" title="' . get_the_title() . '" class="video"><img src="' . $thumb . '" class="image-resize w" alt="' . get_the_title() . '" title="' . get_the_title() . '" /></a></div>';
                      }
                      $work_preview = true;
                    else:
                        $out .= '<div class="post-thumbnail"><a href="' . get_permalink() . '" title="' . get_the_title() . '" class="video">' . get_the_title() . '</a></div>';
                    endif;
                    $out .= '</div>';
                    $out .= '</li>';
                endwhile;
          endif;
          if ($partners_i == 0) {
            $out .= '<li>' . _e('Please add more partners', MISS_TEXTDOMAIN) . '</li>';
          }
          $out .= '</ul>';
        $out .= '</div>';
        $out .= '</div>';
    }
    return $out;
}
endif;

if ( !function_exists( 'miss_like_module' ) ) :
/**
 *
 */
function miss_like_module() {
	if( !is_singular( 'post' ) )
		return;
	
	$out = '';
	$popular_posts = '';
	$related_posts = '';
	
	$option = apply_atomic( 'post_like_module', miss_get_setting( 'post_like_module' ) );
	
	if( $option == 'disable' )
		return;
	
	if( $option == 'column' ) {
		
		$popular_posts = miss_popular_posts( array( 'showposts' => 3, 'module' => $option ) );
		$related_posts = miss_related_posts( array( 'showposts' => 3, 'module' => $option ) );
		
//		$out .= apply_filters( 'miss_additional_posts_title', '<h3 class="additional_posts_title">' . __( 'Additional Posts', MISS_TEXTDOMAIN ) . '</h3>' );
		
		$out .= '<div class="row-fluid">';
		$out .= '<div class="span6">';
		$out .= '<div class="additional_posts">';
		$out .= '<h3>' . __( 'Popular Posts', MISS_TEXTDOMAIN ) . '</h3>';
		$out .= $popular_posts;
		$out .= '</div>';
		$out .= '</div>';
		
		$out .= '<div class="span6 last">';
		$out .= '<div class="additional_posts">';
		$out .= '<h3>' . __( 'Related Posts', MISS_TEXTDOMAIN ) . '</h3>';
		$out .= $related_posts;
		$out .= '</div>';
		$out .= '</div>';
		$out .= '</div>';
	}
	
	if( $option == 'tab' ) {
		
		$popular_posts = miss_popular_posts( array( 'showposts' => 4, 'module' => $option ) );
		$related_posts = miss_related_posts( array( 'showposts' => 4, 'module' => $option ) );
		
		$out .= '<div class="blog_tabs_container">';
		
		$out .= '<ul class="blog_tabs">';
		$out .= '<li><a href="#" class="current">' . __( 'Popular Posts', MISS_TEXTDOMAIN ) . '</a></li>';
		$out .= '<li><a href="#">' . __( 'Related Posts', MISS_TEXTDOMAIN ) . '</a></li>';
		$out .= '<div class="clearboth"></div>';
		$out .= '</ul>';
		
		$out .= '<div class="blog_tabs_content">' . $popular_posts . '</div>';
		$out .= '<div class="blog_tabs_content">' . $related_posts . '</div>';
		
		$out .= '</div>';
	}
	
	if ( !empty( $popular_posts ) || !empty( $related_posts ) )
		echo '<div class="additional_posts_module">' . $out . '</div>';
	else
		echo $out;
}
endif;

if ( !function_exists( 'miss_popular_posts' ) ) :
/**
 *
 */
function miss_popular_posts( $args = array() ) {
	global $post;
	
	$out = '';
	
	extract( $args );

	$popular_query = new WP_Query(array(
		'showposts' => $showposts, 
		'nopaging' => 0, 
		'orderby'=> 'comment_count', 
		'post_status' => 'publish',
		'category__not_in' => array( miss_exclude_category_array( $minus = false ) ),
		'ignore_sticky_posts' => 1
	));
	
	if ( $popular_query->have_posts() ) {
		
		global $irish_framework_params;
		$img_sizes = ( $module == 'column' ) ? 'small_post_list' : 'additional_posts_grid';
		$_layout = get_post_meta( $post->ID, '_layout', true );
		$img_layout = ( $_layout == 'full_width' ? 'images'
		: ( $_layout == 'left_sidebar'
		? 'small_sidebar_images' : 'big_sidebar_images' ) );
		
		$out .= ( $module == 'column' ? '<ul class="post_list small_post_list">'
		: '<div class="post_grid four_column_blog">'
		);
		
		$i=1;
		while ( $popular_query->have_posts() ) {
			$popular_query->the_post();
			
			$out .= ( $module == 'column' ? '<li class="post_list_module">'
			: '<div class="' . ( $i%$showposts == 0 ? 'span3 last'
			: 'span3' ) . '">'
			);
			
			$out .= ( $module == 'tab' ? '<div class="post_grid_module">' : '' );
			$out .= miss_get_post_image(array(
				'width' => $irish_framework_params->layout[$img_layout][$img_sizes][0],
				'height' => $irish_framework_params->layout[$img_layout][$img_sizes][1],
				'img_class' => ( $module == 'tab' ? 'post_grid_image image-resize w' : 'post_list_image' ),
				'preload' => false,
				'link_to' => get_permalink(),
				'prettyphoto' => false,
				'placeholder' => true,
				'echo' => false,
				'wp_resize' => ( miss_get_setting( 'image_resize_type' ) == 'wordpress' ? true : false )
			));
			
			$out .= '<div class="' . ( $module == 'tab' ? 'post_grid_content' : 'post_list_content' ) . '" >';
			$out .= the_title( '<p class="post_title"><a href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">', '</a></p>', false );
			
			$out .= ( $module == 'column' ? '<p class="post_meta">' . apply_filters( 'miss_widget_meta', do_shortcode( '[post_date]' ) ) . '</p>' : '' );
			// $out .= the_date();
			$out .= '</div>';
			$out .= ( $module == 'column' ? '</li>' : '</div></div>' );
			
			$i++;
		}
		
		$out .= ( $module == 'column' ? '</ul>' : '</div>' );
	}
	
	wp_reset_postdata();
	
	if ( !empty( $out ) )
		return $out;
	else
		return false;
}
endif;

if ( !function_exists( 'miss_related_posts' ) ) :
/**
 *
 */
function miss_related_posts( $args = array() ) {
	global $post;
	$backup = $post;
	
	$out = '';
	
	extract( $args );
	
	$tags = wp_get_post_tags( $post->ID );
	$tagIDs = array();
	$related_post_found = false;
	
	if ( $tags ) {
		$tagcount = count( $tags );
		for ($i = 0; $i < $tagcount; $i++) {
			$tagIDs[$i] = $tags[$i]->term_id;
		}
		$related_query = new WP_Query(array(
			'tag__in' => $tagIDs,
			'post__not_in' => array( $post->ID ),
			'showposts'=>$showposts,
			'category__not_in' => array( miss_exclude_category_array( $minus = false ) ),
			'ignore_sticky_posts' => 1
		));
		
		if( $related_query->have_posts() )
			$related_post_found = true;
	}
	
	if( !$related_post_found )
		$related_query = new WP_Query(array( 'showposts' => $showposts,
			'nopaging' => 0,
			'post_status' => 'publish',
			'category__not_in' => array( miss_exclude_category_array( $minus = false ) ),
			'ignore_sticky_posts' => 1
		));
		
	if ( $related_query->have_posts() ) {
		
		global $irish_framework_params;
		$img_sizes = ( $module == 'column' ) ? 'small_post_list' : 'additional_posts_grid';
		$_layout = get_post_meta( $post->ID, '_layout', true );
		$img_layout = ( $_layout == 'full_width' ? 'images'
		: ( $_layout == 'left_sidebar'
		? 'small_sidebar_images' : 'big_sidebar_images' ) );

		$out .= ( $module == 'column' ? '<ul class="post_list small_post_list">'
		: '<div class="post_grid four_column_blog">'
		);
		
		$i=1;
		while ( $related_query->have_posts() ) {
			$related_query->the_post();

			$out .= ( $module == 'column' ? '<li class="post_list_module">'
			: '<div class="' . ( $i%$showposts == 0 ? 'span3 last'
			: 'span3' ) . '">'
			);

			$out .= ( $module == 'tab' ? '<div class="post_grid_module">' : '' );
			$out .= miss_get_post_image(array(
				'width' => $irish_framework_params->layout[$img_layout][$img_sizes][0],
				'height' => $irish_framework_params->layout[$img_layout][$img_sizes][1],
				'img_class' => ( $module == 'tab' ? 'post_grid_image image-resize w' : 'post_list_image' ),
				'preload' => false,
				'link_to' => get_permalink(),
				'prettyphoto' => false,
				'placeholder' => true,
				'echo' => false,
				'wp_resize' => ( miss_get_setting( 'image_resize_type' ) == 'wordpress' ? true : false )
			));
			
			$out .= '<div class="' . ( $module == 'tab' ? 'post_grid_content' : 'post_list_content' ) . '">';
			$out .= the_title( '<p class="post_title"><a href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">', '</a></p>', false );
			
			$out .= ( $module == 'column' ? '<p class="post_meta">' . apply_filters( 'miss_widget_meta', do_shortcode( '[post_date]' ) ) . '</p>' : '' );
			// $out .= the_rate();
			$out .= '</div>';
			$out .= ( $module == 'column' ? '</li>' : '</div></div>' );

			$i++;
		}

		$out .= ( $module == 'column' ? '</ul>' : '</div>' );
	}
	
	$post = $backup;
	wp_reset_postdata();

	if ( !empty( $out ) )
		return $out;
	else
		return false;
}
endif;


if ( !function_exists( 'miss_sub_footer' ) ) :
/**
 *
 */
function miss_sub_footer() {
	$out = '';
	$menu = '';
	$footer_text = '';
	
	if( miss_get_setting( 'footer_text' ) ) {
		$footer_text = miss_get_setting( 'footer_text' );
		$footer_text = stripslashes( $footer_text );
		$footer_text = '<div class="copyright_text">' . $footer_text . '</div>';
	}
	
	if ( has_nav_menu( 'footer-links' ) ) {
		$menu = wp_nav_menu(
			array(
			'theme_location' => 'footer-links',
			'container_class' => 'footer_links',
			'container_id' => '',
			'menu_class' => '',
			'fallback_cb' => '',
			'echo' => false
		));
	}
	
	
	if( !empty( $footer_text ) || !empty( $menu ) ) {
		$out .= '<div id="sub_footer">';
		$out .= '<div class="container">';
		$out .= '<div class="fourteen columns">';
		
		$out .= $footer_text;
		$out .= $menu;
		
		$out .= '</div><!-- columns -->';
		$out .= '<div class="two columns last pull-right pull-right-important align-right">';
		$out .= '<a href="#top" class="to_top">' . __( 'Back to Top', MISS_TEXTDOMAIN ) . '<span class="top-icon"></span></a>';
		$out .= '</div><!-- columns -->';

		$out .= '</div><!-- container -->';
		$out .= '</div><!-- #sub_footer -->';
		
	}
	
	echo apply_atomic_shortcode( 'sub_footer', $out );;
}
endif;

if ( !function_exists( 'miss_analytics' ) ) :
/**
 * Google Analytics Code
 * @since 1.1
 */
function miss_analytics() {
	$analytics = miss_get_setting( 'analytics_code' );

	if( empty( $analytics ) )
		return;
	
	echo stripslashes( $analytics );
}
endif;


if( !function_exists( 'miss_automore_print_script' ) ):
/**
 * Automore Function
 * @since 1.5
 */
function miss_automore_print_script( $echo = true, $selector = '.container-isotope', $navSelector =  '.auto-more', $nextSelector =  'a', $itemSelector = '.autoload-item', $isotope = true, $path = false ) {
$out = '<!-- Infinite Scroll Script -->
<script type="text/javascript">
//(function(){
	jQuery(document).ready(function(){
		var infinite_scroll = {
		        loading: {
		            img: "' . get_template_directory_uri() . '/assets/images/preloaders/preloader.gif",
		            msgText: "' . __( 'Loading...', MISS_TEXTDOMAIN ) . '",
		            finishedMsg: ""
		        },
		        navSelector     : "' . $navSelector . '",
		        nextSelector    : "' . $navSelector . ' ' . $nextSelector . '",
		        itemSelector    : "' . $itemSelector . '",
		        contentSelector : "' . $selector . '",
				debug		 	: true,
				dataType	 	: "html",
		};
		';
		if ( $path ) {
			// $out .= '
			// 	infinite_scroll.path = ' . $path . ';
			// ';
		}
		if ( $isotope == true ) {
			$out .= '
			jQuery(window).scroll( function () {
			jQuery( infinite_scroll.contentSelector ).infinitescroll( infinite_scroll, function ( newElements ) {
				miss_preview_overlay(".has_preview a");
				jQuery( infinite_scroll.contentSelector ).isotope( "appended", jQuery( newElements ) );
			} );
			});
			';
		} else {
			$out .= '
			jQuery("' . $selector . '").infinitescroll( infinite_scroll, function ( newElements ) {
				jQuery( this ).appendTo( infinite_scroll.contentSelector );
			} );
			';


		}
		$out .= '
	});
//});
</script>';
	if ( $echo == true ) {
		echo $out;
	} else {
		return $out;
	}
}
endif;


// function miss_automore_script() {
// $out = '<!-- Auto More Script -->
// <script type="text/javascript">
// </script>
// <!-- /.AutoMore Script -->';
// 	return $out;
// }

if ( !function_exists( 'miss_image_preloading' ) ) :
/**
 *
 */
function miss_image_preloading() {
	//global $is_IE;
	$is_IE = miss_ie();
	$out = "
	<script type=\"text/javascript\">
	/* <![CDATA[ */
	/*
	jQuery( '.blog_layout1' ).preloader({ imgSelector: '.blog_index_image_load span img', imgAppend: '.blog_index_image_load' });
	jQuery( '.blog_layout2' ).preloader({ imgSelector: '.blog_index_image_load span img', imgAppend: '.blog_index_image_load' });
	jQuery( '.blog_layout3' ).preloader({ imgSelector: '.blog_index_image_load span img', imgAppend: '.blog_index_image_load' });
	jQuery( '.single_post_module' ).preloader({ imgSelector: '.blog_index_image_load span img', imgAppend: '.blog_index_image_load' });
	
	jQuery( '.one_column_portfolio' ).preloader({ imgSelector: '.portfolio_img_load span img', imgAppend: '.portfolio_img_load' });
	jQuery( '.two_column_portfolio' ).preloader({ imgSelector: '.portfolio_img_load span img', imgAppend: '.portfolio_img_load' });
	jQuery( '.three_column_portfolio' ).preloader({ imgSelector: '.portfolio_img_load span img', imgAppend: '.portfolio_img_load' });
	jQuery( '.four_column_portfolio' ).preloader({ imgSelector: '.portfolio_img_load span img', imgAppend: '.portfolio_img_load' });
	
	jQuery( '.portfolio_gallery.large_post_list' ).preloader({ imgSelector: '.portfolio_img_load span img', imgAppend: '.portfolio_img_load' });
	jQuery( '.portfolio_gallery.medium_post_list' ).preloader({ imgSelector: '.portfolio_img_load span img', imgAppend: '.portfolio_img_load' });
	jQuery( '.portfolio_gallery.small_post_list' ).preloader({ imgSelector: '.portfolio_img_load span img', imgAppend: '.portfolio_img_load' });
	
	jQuery( '#main_inner' ).preloader({ imgSelector: '.portfolio_full_image span img', imgAppend: '.portfolio_full_image' });
	jQuery( '#main_inner' ).preloader({ imgSelector: '.blog_sc_image_load span img', imgAppend: '.blog_sc_image_load' });
	jQuery( '#main_inner' ).preloader({ imgSelector: '.styled_image_load span img', imgAppend: '.styled_image_load' });
	jQuery( '#intro_inner' ).preloader({ imgSelector: '.styled_image_load span img', imgAppend: '.styled_image_load' });
	*/
	/* ]]> */
	</script>
	<!--[if lt IE 10]>
	<![endif]-->
	";
	if ($is_IE) {
	$out .= "
		<style>
		.miss_flexslider .slides, .miss_flexslider .slides li, .miss_flexslider .slides .flex-imageLink img {
			height: 387px !important;
		}
		</style>
		<script type=\"text/javascript\">
			setTimeout(function () {
				jQuery(\".miss_flexslider .flex-imageLink img\").animate({\"height\":\"386px\"},500);
			}, 1);
		</script>";
	}

	echo preg_replace( "/(\r\n|\r|\n)\s*/i", '', $out );

}
endif;

if ( !function_exists( 'miss_custom_javascript' ) ) :
/**
 *
 */
function miss_custom_javascript() {
$custom_js = miss_get_setting( 'custom_js' );

if( empty( $custom_js ) )
	return;
	
$custom_js = preg_replace( "/(\r\n|\r|\n)\s*/i", '', $custom_js );
?><script type="text/javascript">
/* <![CDATA[ */
<?php echo stripslashes( $custom_js ); ?>
/* ]]> */
</script>
<?php
}
endif;

if ( !function_exists( 'miss_main_footer' ) ) :
/**
 *
 */
function miss_main_footer( $args = array( ) ) {
	$defaults = array(
		'echo' => true
	);
	$args = wp_parse_args( $args, $defaults );
	$args = (object) $args;

	//$main_footer = apply_atomic_shortcode( 'main_footer', '' );
	
	if( !empty( $main_footer ) ) {
		echo $main_footer;
		return;
	}
	
	if( !miss_get_setting( 'footer_disable' ) ) {
		$footer_column = miss_get_setting( 'footer_columns' );
		
		if( is_numeric( $footer_column ) ) {
			$class = '';
			
			switch ( $footer_column ):
				case 1:
					$class = 'span12';
					break;
				case 2:
					$class = 'span6';
					break;
				case 3:
					$class = 'span4';
					break;
				case 4:
					$class = 'span3';
					break;
//				case 5:
//					$class = 'one_fifth';
//					break;
				case 6:
					$class = 'span2';
					break;
			endswitch;
			for( $i=1; $i<=$footer_column; $i++ ){
				$last = ( $i == $footer_column ) ? ' last' : '' ;

				echo '<div class="' . $class . $last . '">';
				 	dynamic_sidebar( "footer{$i}" );
				echo '</div>';
			}

		} else {
			switch( $footer_column ) :
				case 'third_twothird':
					echo '<div class="span4">';
					dynamic_sidebar( 'footer1' );
					echo '</div>';
					echo '<div class="span8 last">';
					dynamic_sidebar( 'footer2' );
					echo '</div>';
					break;
				case 'fourth_threefourth':
					echo '<div class="span3">';
					dynamic_sidebar( 'footer1' );
					echo '</div>';
					echo '<div class="spna9 last">';
					dynamic_sidebar( 'footer2' );
					echo '</div>';
					break;
				case 'fourth_fourth_half':
					echo '<div class="span3">';
					dynamic_sidebar( 'footer1' );
					echo '</div>';
					echo '<div class="span3">';
					dynamic_sidebar( 'footer2' );
					echo '</div>';
					echo '<div class="span6 last">';
					dynamic_sidebar( 'footer3' );
					echo '</div>';
					break;
				case 'sixth_fivesixth':
					echo '<div class="span2">';
					dynamic_sidebar( 'footer1' );
					echo '</div>';
					echo '<div class="span10 last">';
					dynamic_sidebar( 'footer2' );
					echo '</div>';
					break;
				case 'third_sixth_sixth_sixth_sixth':
					echo '<div class="span4">';
					dynamic_sidebar( 'footer1' );
					echo '</div>';
					echo '<div class="span2">';
					dynamic_sidebar( 'footer2' );
					echo '</div>';
					echo '<div class="span2">';
					dynamic_sidebar( 'footer3' );
					echo '</div>';
					echo '<div class="span2">';
					dynamic_sidebar( 'footer4' );
					echo '</div>';
					echo '<div class="span2 last">';
					dynamic_sidebar( 'footer5' );
					echo '</div>';
					break;
				case 'half_sixth_sixth_sixth':
					echo '<div class="span6">';
					dynamic_sidebar( 'footer1' );
					echo '</div>';
					echo '<div class="span2">';
					dynamic_sidebar( 'footer2' );
					echo '</div>';
					echo '<div class="span2">';
					dynamic_sidebar( 'footer3' );
					echo '</div>';
					echo '<div class="span2 last">';
					dynamic_sidebar( 'footer4' );
					echo '</div>';
					break;

				case 'twothird_third':
					echo '<div class="span8">';
					dynamic_sidebar( 'footer1' );
					echo '</div>';
					echo '<div class="span4 last">';
					dynamic_sidebar( 'footer2' );
					echo '</div>';
					break;
				case 'threefourth_fourth':
					echo '<div class="spna9">';
					dynamic_sidebar( 'footer1' );
					echo '</div>';
					echo '<div class="span3 last">';
					dynamic_sidebar( 'footer2' );
					echo '</div>';
					break;
				case 'half_fourth_fourth':
					echo '<div class="span6">';
					dynamic_sidebar( 'footer1' );
					echo '</div>';
					echo '<div class="span3">';
					dynamic_sidebar( 'footer2' );
					echo '</div>';
					echo '<div class="span3 last">';
					dynamic_sidebar( 'footer3' );
					echo '</div>';
					break;
				case 'fivesixth_sixth':
					echo '<div class="span10">';
					dynamic_sidebar( 'footer1' );
					echo '</div>';
					echo '<div class="span2 last">';
					dynamic_sidebar( 'footer2' );
					echo '</div>';
					break;
				case 'sixth_sixth_sixth_sixth_third':
					echo '<div class="span2">';
					dynamic_sidebar( 'footer1' );
					echo '</div>';
					echo '<div class="span2">';
					dynamic_sidebar( 'footer2' );
					echo '</div>';
					echo '<div class="span2">';
					dynamic_sidebar( 'footer3' );
					echo '</div>';
					echo '<div class="span2">';
					dynamic_sidebar( 'footer4' );
					echo '</div>';
					echo '<div class="span4 last">';
					dynamic_sidebar("footer5");
					echo '</div>';
					break;
				case 'sixth_sixth_sixth_half':
					echo '<div class="span2">';
					dynamic_sidebar( 'footer1' );
					echo '</div>';
					echo '<div class="span2">';
					dynamic_sidebar( 'footer2' );
					echo '</div>';
					echo '<div class="span2">';
					dynamic_sidebar( 'footer3' );
					echo '</div>';
					echo '<div class="span6 last">';
					dynamic_sidebar( 'footer4' );
					echo '</div>';
					break;
			endswitch;
		}

		echo '<div class="clearboth"></div>';
	}
	/*
	if ( $args->echo != true )
		echo apply_atomic_shortcode( 'footer_colum', $out );
	else
		return $out;
	*/
}
endif;

if ( !function_exists( 'miss_archive' ) ) :
/**
 *
 */
function miss_archive() {
	get_template_part( 'loop', 'archive' );
}
endif;



if ( !function_exists( 'miss_sitemap' ) ) :
/**
 *
 */
function miss_sitemap() {
?><h2><?php _e( 'Pages', MISS_TEXTDOMAIN );?></h2>
<ul class="sitemap_list"><?php wp_list_pages('depth=0&sort_column=menu_order&title_li=' );
?></ul>
<div class="divider top"><a href="#"><?php _e( 'Top', MISS_TEXTDOMAIN ); ?></a></div>
	
<h2><?php _e( 'Category Archives', MISS_TEXTDOMAIN ); ?></h2>
<ul class="sitemap_list"><?php wp_list_categories( array( 'exclude'=> miss_exclude_category_array( $minus = false ), 'feed' => __( 'RSS', MISS_TEXTDOMAIN ), 'show_count' => true, 'use_desc_for_title' => false, 'title_li' => false ) );
?></ul>
<div class="divider top"><a href="#"><?php _e( 'Top', MISS_TEXTDOMAIN ); ?></a></div>
	
<?php $archive_query = new WP_Query( array( 'showposts' => 1000, 'category__not_in' => array( miss_exclude_category_array( $minus = false ) ) ) );
?><h2><?php _e( 'Blog Posts', MISS_TEXTDOMAIN ); ?></h2>
<ul class="sitemap_list"><?php while ( $archive_query->have_posts() ) : $archive_query->the_post();
?><li><a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark" title="<?php printf( __( "Permanent Link to %s", MISS_TEXTDOMAIN ), esc_attr( get_the_title() ) ); ?>"><?php the_title(); ?></a> (<?php comments_number('0', '1', '%'); ?>)</li>
<?php endwhile;
?></ul>
<div class="divider top"><a href="#"><?php _e( 'Top', MISS_TEXTDOMAIN ); ?></a></div>

<?php $portfolio_query = new WP_Query( array( 'post_type' => 'portfolio','showposts' => 1000 ) );
?><h2><?php _e( 'Portfolios', MISS_TEXTDOMAIN ); ?></h2>
<ul class="sitemap_list"><?php while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post();
?><li><a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark" title="<?php printf( __( "Permanent Link to %s", MISS_TEXTDOMAIN ), esc_attr( get_the_title() ) ); ?>"><?php the_title(); ?></a> (<?php comments_number('0', '1', '%'); ?>)</li>
<?php endwhile;
?></ul>
<div class="divider top"><a href="#"><?php _e( 'Top', MISS_TEXTDOMAIN ); ?></a></div>

<h2><?php _e( 'Archives', MISS_TEXTDOMAIN ); ?></h2>
<ul class="sitemap_list"><?php wp_get_archives( 'type=monthly&show_post_count=true' );
?></ul>
<div class="divider top"><a href="#"><?php _e( 'Top', MISS_TEXTDOMAIN ); ?></a></div>

<?php	
}
endif;

if ( !function_exists( 'miss_password_form' ) ) :
/**
 *
 */
function miss_password_form() {
	global $post;
	$label = 'pwbox-'.(empty($post->ID) ? rand() : $post->ID);
	$output = '<form action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
	<p>' . __("This post is password protected. To view it please enter your password below:", MISS_TEXTDOMAIN) . '</p>
	<div class="password_protect_field"><label class="password_protect_label" for="' . $label . '">' . __("Password:", MISS_TEXTDOMAIN) . '</label> <input class="password" name="post_password" id="' . $label . '" type="password" size="20" /> <input class="styled_button password_protect_button" type="submit" name="Submit" value="' . esc_attr__("Submit") . '" /></div>
	</form>';
	
	return '[raw]' . $output . '[/raw]';
}
endif;


if (!function_exists("mb_str_replace")):
/**
 *
 */
function mb_str_replace($needle, $replacement, $haystack) {
    return implode($replacement, mb_split($needle, $haystack));
}
endif;

if ( !function_exists( 'miss_excerpt_by_id' ) ) :

/*
* Gets the excerpt of a specific post ID or object
* @param - $post - object/int - the ID or object of the post to get the excerpt of
* @param - $length - int - the length of the excerpt in words
* @param - $tags - string - the allowed HTML tags. These will not be stripped out
* @param - $extra - string - text to append to the end of the excerpt
*/
function miss_excerpt_by_id($post, $length = 10, $tags = '<a><em><strong>', $extra = '') {

    if(is_int($post)) {
        // get the post object of the passed ID
        $post = get_post($post);
    } elseif(!is_object($post)) {
        return false;
    }

    if(has_excerpt($post->ID)) {
        $the_excerpt = $post->post_excerpt;
        return apply_filters('the_content', $the_excerpt);
    } else {
        $the_excerpt = $post->post_content;
    }

    $the_excerpt = strip_shortcodes(strip_tags($the_excerpt), $tags);
    $the_excerpt = preg_split('/\b/', $the_excerpt, $length * 2+1);
    $excerpt_waste = array_pop($the_excerpt);
    $the_excerpt = implode($the_excerpt);
    $the_excerpt .= $extra;

    return apply_filters('the_content', $the_excerpt);
}
endif;



/* Vladimir code */
/* functions */
if ( !function_exists( 'miss_post_date_box' ) ) :
	function miss_post_date_box ( $echo = true )
		{
	    /*$meta_options = (miss_get_setting('disable_meta_options')) ? miss_get_setting('disable_meta_options') : array();

		$out = '';
		if( !in_array( 'date_meta', $meta_options ) ){
			$out .= '<div class="date_likes_holder">';
			$out .= '<a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '" title="' . sprintf( get_the_time( __( 'l, F jS, Y, g:i a', MISS_TEXTDOMAIN ) ) ) . '" class="month pull-left">';
			$out .= 	'<span class="day">';
			$out .= 		'<span>';
			$out .= 			get_the_time('M');
			$out .= 		'</span>';
			$out .= 		get_the_time('d');
			$out .= 	'</span>';
			$out .= '</a>';
			$out .= miss_likes( false );
			$out .= '</div>';
			if($echo == false){
				return $out;
			} else {
				echo $out;
			}
		}*/
	}
endif;

if ( !function_exists( 'miss_post_icon' ) ) :
	function miss_post_icon ( $args = array() )
		{
		
		$defaults = array(
			'ID' => false,
			'echo' => false
		);
		$args = wp_parse_args( $args, $defaults );
		extract( $args );

		$ID = ( $ID != false ) ? $ID : get_the_ID();
	    $post_icon = ( get_post_meta( $ID, '_icon', true ) ) ? get_post_meta( $ID, '_icon', true ) : 'im-icon-quill-2';

		$out = '';
		$out .= '<i class="marker ' . $post_icon . '"></i>';
		if($echo == false){
			return $out;
		} else {
			echo $out;
		}
	}
endif;

if ( !function_exists( 'miss_likes' ) ) :
	function miss_likes ( $echo = true ) {
		global $post;
		$uid = miss_get_basic_user_identification();
		$miss_likes_array = get_post_meta( get_the_ID(), 'miss_post_likes', true );
		$miss_likes_count = get_post_meta( get_the_ID(), 'miss_post_likes_total', true );
		$out = '';
		//$out .= $miss_likes_array[$uid];
		$out .= '<a href="' . get_permalink() . '" data-id="' . get_the_ID() . '" title="" class="miss_hearts pull-left active">';
		if ( isset( $miss_likes_array ) && isset( $uid ) && isset( $miss_likes_array[$uid] ) ) {
			$out .= 	'<i class="fa-icon-heart icon"></i>';
		} else {
			$out .= 	'<i class="fa-icon-heart-empty icon"></i>';
		}

		$out .= 	'<span class="text">';
		$out .= 		'<span class="number">';
		$out .= ( !empty( $miss_likes_count ) ) ? $miss_likes_count : '0';
		$out .= 		'</span>';
		$out .= 		' ' . __( 'LIKES', MISS_TEXTDOMAIN );
		$out .= 	'</span>';
		$out .= '</a>';

		if($echo == false){
			return $out;
		} else {
			echo $out;
		}
	}
endif;

if ( !function_exists( 'miss_post_meta_edit_author_comments' ) ) :
	function miss_post_meta_edit_author_comments( $args = array() ) {
		$defaults = array(
			'shortcode' => false,
			'echo' => true
		);
		
		$args = wp_parse_args( $args, $defaults );
		
		extract( $args );
		
		if( is_page() && !$shortcode ) return;
		
		global $irish_framework_params;
		
		$out = '';
		$meta_options = miss_get_setting( 'disable_meta_options' );
		$_meta = ( is_array( $meta_options ) ) ? $meta_options : array();
		$meta_output = '';

		// Display post meta

        if( is_user_logged_in() )
        $meta_output .= '<span class="meta_edit_post"><a class="edit_post_link" href="' . get_edit_post_link() . '" title="Edit Entry"><i class="im-icon-marker"></i></a></span>';

		if( !in_array( 'author_meta', $_meta ) )
		$meta_output .= '[post_author text="' . __( 'Posted by: ', MISS_TEXTDOMAIN ) . '"] ';

		if( !in_array( 'comments_meta', $_meta ) )
		$meta_output .= '[post_comments text="' . __( 'Comments: ', MISS_TEXTDOMAIN ) . '"] ';

		if( !empty( $meta_output ) )
			$out .='<div class="post_meta">' . $meta_output . '</div>';

		if( $echo )
			echo apply_atomic_shortcode( 'post_meta', $out );
		else
			return apply_atomic_shortcode( 'post_meta', $out );
	}
endif;

if ( !function_exists( 'miss_post_meta_taxonomy_tags' ) ) :
	function miss_post_meta_taxonomy_tags( $args = array() ) {
		$defaults = array(
			'shortcode' => false,
			'echo' => true
		);
		
		$args = wp_parse_args( $args, $defaults );
		
		extract( $args );
		
		if( is_page() && !$shortcode ) return;
		
		global $irish_framework_params;
		
		$out = '';
		$meta_options = miss_get_setting( 'disable_meta_options' );
		$_meta = ( is_array( $meta_options ) ) ? $meta_options : array();
		$meta_output = '';

		// Display post meta

		if( !in_array( 'categories_meta', $_meta ) )
			$meta_output .= '[post_terms taxonomy="category" separator=", " text="' . __( 'Categories: ', MISS_TEXTDOMAIN ) . '"] ';

		if( !in_array( 'tags_meta', $_meta ) )
			$meta_output .= '[post_terms separator=", " text=' . __( 'Tags: ', MISS_TEXTDOMAIN ) . '] ';

		if( !empty( $meta_output ) )
			$out .='<div class="post_meta after">' . $meta_output . '</div>';

		if( $echo )
			echo apply_atomic_shortcode( 'post_meta', $out );
		else
			return apply_atomic_shortcode( 'post_meta', $out );
	}
endif;

if ( !function_exists( 'miss_post_meta_short' ) ) :
	function miss_post_meta_short( $args = array() ) {
		$defaults = array(
			'shortcode' => false,
			'echo' => true
		);
		
		$args = wp_parse_args( $args, $defaults );
		
		extract( $args );
		
		if( is_page() && !$shortcode ) return;
		
		global $irish_framework_params;
		
		$out = '';
		$meta_options = miss_get_setting( 'disable_meta_options' );
		$_meta = ( is_array( $meta_options ) ) ? $meta_options : array();
		$meta_output = '';

		// Display post meta

        if( is_user_logged_in() )
        $meta_output .= '<span class="meta_edit_post"><a class="edit_post_link" href="' . get_edit_post_link() . '" title="Edit Entry"><i class="im-icon-marker"></i></a></span>';

		if( !in_array( 'author_meta', $_meta ) )
		$meta_output .= '[post_author text="' . __( 'Posted by: ', MISS_TEXTDOMAIN ) . '"] ';

		if( !in_array( 'comments_meta', $_meta ) )
		$meta_output .= '[post_comments text="' . __( 'Comments: ', MISS_TEXTDOMAIN ) . '"] ';

		if( !empty( $meta_output ) )
			$out .='<div class="post_meta">' . $meta_output . '</div>';

		if( $echo )
			echo apply_atomic_shortcode( 'post_meta', $out );
		else
			return apply_atomic_shortcode( 'post_meta', $out );
	}
endif;

if ( !function_exists( 'miss_post_meta_medium' ) ) :
	function miss_post_meta_medium( $args = array() ) {
		$defaults = array(
			'shortcode' => false,
			'echo' => true
		);
		
		$args = wp_parse_args( $args, $defaults );
		
		extract( $args );
		
		if( is_page() && !$shortcode ) return;
		
		global $irish_framework_params;
		
		$out = '';
		$meta_options = miss_get_setting( 'disable_meta_options' );
		$_meta = ( is_array( $meta_options ) ) ? $meta_options : array();
		$meta_output = '';

		// Display post meta
		//if( !in_array( 'date_meta', $_meta ) )
		//$meta_output .= '[post_date text="' . __( 'Posted on ', MISS_TEXTDOMAIN ) . '" format="M j Y"] ';
		//$temp = explode('-', get_the_time( 'd-M' ));

        if( is_user_logged_in() )
        $meta_output .= '<span class="meta_edit_post"><a class="edit_post_link" href="' . get_edit_post_link() . '" title="Edit Entry"><i class="im-icon-marker"></i></a></span>';

		if( !in_array( 'author_meta', $_meta ) )
		$meta_output .= '[post_author text="' . __( 'Posted by: ', MISS_TEXTDOMAIN ) . '"] ';

		if( !in_array( 'comments_meta', $_meta ) )
		$meta_output .= '[post_comments text="' . __( 'Comments: ', MISS_TEXTDOMAIN ) . '"] ';

		if( !in_array( 'tags_meta', $_meta ) )
			$meta_output .= '[post_terms separator=", " text=' . __( 'Tags: ', MISS_TEXTDOMAIN ) . '] ';

		if( !empty( $meta_output ) )
			$out .='<div class="post_meta">' . $meta_output . '</div>';

		if( $echo )
			echo apply_atomic_shortcode( 'post_meta', $out );
		else
			return apply_atomic_shortcode( 'post_meta', $out );
	}
endif;

if ( !function_exists( 'miss_post_meta_long' ) ) :
	function miss_post_meta_long( $args = array() ) {
		$defaults = array(
			'shortcode' => false,
			'echo' => true
		);
		
		$args = wp_parse_args( $args, $defaults );
		
		extract( $args );
		
		if( is_page() && !$shortcode ) return;
		
		global $irish_framework_params;
		
		$out = '';
		$meta_options = miss_get_setting( 'disable_meta_options' );
		$_meta = ( is_array( $meta_options ) ) ? $meta_options : array();
		$meta_output = '';

		// Display post meta
		//if( !in_array( 'date_meta', $_meta ) )
		//$meta_output .= '[post_date text="' . __( 'Posted on ', MISS_TEXTDOMAIN ) . '" format="M j Y"] ';
		//$temp = explode('-', get_the_time( 'd-M' ));

        //$meta_output .= edit_post_link( __( '<i class="im-icon-pencil-3"></i>', MISS_TEXTDOMAIN ), '<div class="edit_link">', '</div>' );
        if( is_user_logged_in() )
        $meta_output .= '<span class="meta_edit_post"><a class="edit_post_link" href="' . get_edit_post_link() . '" title="Edit Entry"><i class="im-icon-marker"></i></a></span>';

		if( !in_array( 'author_meta', $_meta ) )
		$meta_output .= '[post_author text="' . __( 'Posted by: ', MISS_TEXTDOMAIN ) . '"] ';

		if( !in_array( 'comments_meta', $_meta ) )
		$meta_output .= '[post_comments text="' . __( 'Comments: ', MISS_TEXTDOMAIN ) . '"] ';


			if( !in_array( 'categories_meta', $_meta ) )
			$meta_output .= '[post_terms separator=", " taxonomy="category" text="' . __( 'Categories: ', MISS_TEXTDOMAIN ) . '"] ';

		if( !in_array( 'tags_meta', $_meta ) )
			$meta_output .= '[post_terms separator=", " text=' . __( 'Tags: ', MISS_TEXTDOMAIN ) . '] ';

		if( !empty( $meta_output ) )
			$out .='<div class="post_meta">' . $meta_output . '</div>';

		if( $echo )
			echo apply_atomic_shortcode( 'post_meta', $out );
		else
			return apply_atomic_shortcode( 'post_meta', $out );
	}
endif;

if ( !function_exists( 'miss_post_meta_diferent' ) ) :
	function miss_post_meta_diferent( $args = array() ) {
		$defaults = array(
			'shortcode' => false,
			'echo' => true
		);
		
		$args = wp_parse_args( $args, $defaults );
		
		extract( $args );
		
		//if( is_page() && !$shortcode ) return;
		
		global $irish_framework_params;
		
		$out = '';
		$meta_options = miss_get_setting( 'disable_meta_options' );
		$_meta = ( is_array( $meta_options ) ) ? $meta_options : array();
		$meta_output = '';

		// Display post meta
		//if( !in_array( 'date_meta', $_meta ) )
		//$meta_output .= '[post_date text="' . __( 'Posted on ', MISS_TEXTDOMAIN ) . '" format="M j Y"] ';
		//$temp = explode('-', get_the_time( 'd-M' ));

        //$meta_output .= edit_post_link( __( '<i class="im-icon-pencil-3"></i>', MISS_TEXTDOMAIN ), '<div class="edit_link">', '</div>' );
        if( is_user_logged_in() )
        $meta_output .= '<span class="meta_edit_post"><a class="edit_post_link" href="' . get_edit_post_link() . '" title="Edit Entry"><i class="im-icon-marker"></i></a></span>';

		if( !in_array( 'author_meta', $_meta ) )
		$meta_output .= '[post_author text="' . __( 'Posted by: ', MISS_TEXTDOMAIN ) . '" before="<i class="im-icon-user-4"></i>"] ';

		if( !in_array( 'date_meta', $_meta ) )
		$meta_output .= '[post_date text="" format="M j, Y"] ';


		if( !empty( $meta_output ) )
			$out .='<div class="post_meta">' . $meta_output . '</div>';

		if( $echo )
			echo apply_atomic_shortcode( 'post_meta', $out );
		else
			return apply_atomic_shortcode( 'post_meta', $out );
	}
endif;

if(!function_exists('miss_blog_layout')):
/**
*
*/
	function miss_blog_layout(){
		$blog_layout = miss_get_setting('blog_layout') ? miss_get_setting('blog_layout') : 'blog_layout1';
		return $blog_layout;
	}
endif;

if ( !function_exists( 'miss_nav_search_box' ) ) :
/**
 * Navigation Search Box
 * @since 1.5
 */
function miss_nav_search_box($items, $args) {
	$disable_searchbox = apply_atomic( 'disable_searchbox', miss_get_setting( 'disable_searchbox' ) );
	if( !empty( $disable_searchbox ) ) {
		return $items;
	}
	
	if( $args->theme_location == 'primary-menu' ) {
		ob_start();
		get_search_form();
		$searchform = ob_get_contents();
		ob_end_clean();
		$items .= '<li class="nav-search-box"><a class="search-button inactive" data-state="inactive" href="#"><i class="im-icon-search-3 icosearch"></i></a>' . $searchform . '</li>';
	}
	return $items;
}
endif;
/* END functions */

/* miss_contact */
function miss_header_contacts( $args = array( 'echo' => 'true' ) ){
	$out = '';
	$out .= '				<div class="contacts">';
	if (miss_get_setting('extra_header_company_location') != ''){
		$out .= '					<div class="item_contact">';
		$out .= '						<i class="fa-icon-home"></i>';
		$out .=  							miss_get_setting('extra_header_company_location');
		$out .= '					</div>';
	};
	if (miss_get_setting('extra_header_phone') != ''){
		$out .= '					<div class="item_contact">';
		$out .= '						<i class="fa-icon-phone"></i>';
		$out .=  							miss_get_setting('extra_header_phone');
		$out .= '					</div>';
	};
	if (miss_get_setting('extra_header_email') != ''){
		$out .= '					<div class="item_contact">';
		$out .= '						<i class="fa-icon-envelope-alt"></i>';
		$out .=  							miss_get_setting('extra_header_email');
		$out .= '					</div>';
	};
	$out .= '				</div><!-- /.contact-->';
	if ( $args['echo'] == 'true' ) {
		echo apply_atomic_shortcode( 'miss_header_contacts', $out );
	} else {
		return $out;
	}
};

if ( !function_exists('miss_before_header') ) {

	/**
	 * Extra Header
	 * @since 1.8
	 */

	function miss_before_header( $args = array( 'echo' => 'true' ) ){
		$extra_header = ( miss_get_setting('extra_header', true) ) ? miss_get_setting('extra_header', true) : false;

		//Break output if extra header equal to false
		if ( $extra_header == false ) {
			return false;
		}

		// Initial output
		$out = '';
		
		// Build HTML4 section
		//$out .= '<div class="extra_header">';

		// Build HTML5 section
		$out .= '<section class="extra_header">';
		
		// Build Bootstrap Container
		$container_class='container';

		// Use full-width header
		if ( miss_get_setting( 'enable_fullwidth_header' ) ) {
			$container_class='container container-full';
		}
		$out .= '<div class="' . $container_class . '">';

		// Display extra text
		if ( in_array('text', $extra_header ) ) {
			$out .= '<div class="extra_item text pull-left">' . ( ( miss_get_setting('extra_header_text', true) ) ? miss_get_setting('extra_header_text', true) : '' ) . '</div>';
		} 

		// Display menu
		if ( in_array('menu', $extra_header ) ) {
			if ( has_nav_menu('top-menu') ) {
				$menu_args = array(
					'container' => 'span',
					'theme_location' => 'top-menu',
					'menu_class' => 'extra nav',
					'echo' => false, 
				);
				$out .= '<div class="extra_item menu pull-left">' . wp_nav_menu( $menu_args ) . '</div>';
			}
		} 
		
		// Display date
		if ( in_array('date', $extra_header ) ) {
			$out .= '<div class="extra_item date pull-left">' . date ( ( miss_get_setting('extra_date_format', true) ) ? miss_get_setting('extra_date_format', true) : '' ) . '</div>';
		} 

		// Display language switcher
		if ( in_array('lang', $extra_header ) ) {
			$out .= '<div class="extra_item langs pull-left">' . miss_langs_shortcuts() . '</div>';
		} 

		// Sociable
		if ( in_array('sociable', $extra_header ) ) {
			$out .= '<div class="extra_item sociable">' . miss_social_shortcuts() . '</div>';
		} 

		// Checkout
		if ( in_array('checkout', $extra_header ) && miss_get_setting('extra_checkout_title', true) ) {
			$out .= '<div class="extra_item checkout"><a href="' . ( ( miss_get_setting('extra_checkout_url', true) ) ? miss_get_setting('extra_checkout_url', true) : '' ) . '">' . ( ( miss_get_setting('extra_checkout_title', true) ) ? miss_get_setting('extra_checkout_title', true) : '' ) . '</a></div>';
		} 

		// Shop
		if ( in_array('store', $extra_header ) && miss_get_setting('extra_shop_title', true) ) {
			$out .= '<div class="extra_item shop"><a href="' . ( ( miss_get_setting('extra_shop_url', true) ) ? miss_get_setting('extra_shop_url', true) : '' ) . '">' . ( ( miss_get_setting('extra_shop_title', true) ) ? miss_get_setting('extra_shop_title', true) : '' ) . '</a></div>';
		} 

		// Subscribe
		if ( in_array('subscribe', $extra_header ) && miss_get_setting('extra_subscribe_title', true) ) {
			$out .= '<div class="extra_item subscribe"><a href="' . ( ( miss_get_setting('extra_subscribe_url', true) ) ? miss_get_setting('extra_subscribe_url', true) : '' ) . '">' . ( ( miss_get_setting('extra_subscribe_title', true) ) ? miss_get_setting('extra_subscribe_title', true) : '' ) . '</a></div>';
		}

		// Login/Logout
		if ( in_array('login', $extra_header ) && miss_get_setting('extra_login_title', true) ) {
			$out .= '<div class="extra_item login"><a href="' . ( ( miss_get_setting('extra_login_url', true) ) ? miss_get_setting('extra_login_url', true) : '' ) . '">' . ( ( miss_get_setting('extra_login_title', true) ) ? miss_get_setting('extra_login_title', true) : '' ) . '</a></div>';
		} 

		$out .= '</div><!-- /.container-->';
		//$out .= '</div><!-- /section.extra_header-->';
		$out .= '</section><!-- /section.extra_header HTML5 -->';

		//Return extra header
		if ( $args['echo'] == 'true' ) {
			echo apply_atomic_shortcode( 'miss_extra_header', $out );
		} else {
			return $out;
		}
	}
}


if ( !function_exists('miss_add_header') )
{
    function miss_add_header()
    {
        $site_menu = '';
        $out = '<header class="base-layout"><div class="container"><div class="row">';
        $out .= miss_logo();
        if ( has_nav_menu('primary-menu') ) {

			$menu_class = 'site-nav';
			if ( miss_get_setting( 'centered_menu' ) ) {
				$menu_class .= ' centered';
			}

			$menu_args = array(
				'theme_location' => 'primary-menu',
				'container' => 'nav', 
				'container_class' => $menu_class, 
				'menu_class' => 'nav primary',
                'items_wrap' => '%3$s',
				'walker' => new Megamenu_Walker_Nav_Menu, 
				'echo' => false
			);
			$site_menu .= str_replace('<li', '<div', str_replace('li>', 'div>', wp_nav_menu( $menu_args )));
		}
        
        $out .= $site_menu;
        $out .= '</div></div></header>';
        
        echo apply_atomic_shortcode( 'miss_header', $out );
    }
}

/*if ( !function_exists('miss_add_header') ) {

	/**
	 * Add Header
	 * @since 1.8
	 
	function miss_add_header( $args = array( 'echo' => 'true' ) ){

		$defaults = Array(
			'echo' => 'true',
			'fixed_menu' => miss_get_setting('enable_fixed_menu', true) ? miss_get_setting('enable_fixed_menu', true) : false,
			'opacity' => miss_get_setting('menu_opacity') ? miss_get_setting('menu_opacity') : '0.9',

		);
		$args = wp_parse_args( $args, $defaults );

		$logo_args = array(
			'echo' => false,
			'container_class' => 'company_logo',
			'site_title' => false
		);

		$class='header';
		if ( isset( $defaults['fixed_menu'] ) && $defaults['fixed_menu'][0] == true ) {
			$class .= ' sticky';
		}

		$container_class = 'container';

		// Use full-width header
		if ( miss_get_setting( 'enable_fullwidth_header' ) ) {
			$container_class='container container-full';
		}

		$site_menu = '';
		$site_menu .= '<header class="' . $class . '" data-opacity="' . $defaults['opacity'] . '">';
		$site_menu .= '<div class="' . $container_class . '">';
		$site_menu .= '<div class="row-fluid">';
		$site_menu .= '<div class="header-inner span12">';
		$site_menu .= '<div class="navbar navbar-relative-top">';

		// Add logo to menu
		if ( miss_get_setting( 'add_menu_logo' ) ) {
			$logo_args['container_class'] .= ' span3 menu-logo';
			$site_menu .= miss_logo($logo_args);
		}

		$site_menu_style = ' style="line-height:' . (miss_get_setting('header_height', true) ? miss_get_setting('header_height', true) : '43') . 'px;"';

		if ( !miss_get_setting( 'add_menu_logo' ) ) {
			$menu_logo_args['container_class'] = 'menu-logo mobile inline pull-left';
			$menu_logo_args['echo'] = false;
			$menu_logo_args['site_title'] = false;
			$menu_logo_args['container_style'] = $site_menu_style;
			$menu_logo_args['img_class'] = 'mobile-logo';

			//btn btn-navbar
			$site_menu .= miss_logo($menu_logo_args);
		}
		$site_menu .= '<button type="button" class="btn-menu pull-right collapsed" data-toggle="collapse" data-target=".nav-collapse"' . $site_menu_style . '><i class="fa-icon-reorder"></i></button>';
		if ( has_nav_menu('primary-menu') ) {

			$menu_class = 'site-menu';
			if ( miss_get_setting( 'centered_menu' ) ) {
				$menu_class .= ' centered';
			}

			$menu_args = array(
				'theme_location' => 'primary-menu',
				'container' => 'nav', 
				'container_class' => $menu_class, 
				'menu_class' => 'nav primary',
                'items_wrap' => '%3$s',
				'walker' => new Megamenu_Walker_Nav_Menu, 
				'echo' => false
			);
			$site_menu .= str_replace('li', 'div', wp_nav_menu( $menu_args ));
		}
		$site_menu .= '</div><!-- /.navbar-->';
		$site_menu .= '</div><!-- /.header-inner-->';
		$site_menu .= '</div><!-- /.row-fluid-->';
		$site_menu .= '</div><!-- /.container-->';
		$site_menu .= '</header><!-- /.region header-->';

		$site_info = '';
		$site_info .= '<section class="site_info">';

		$container_class = 'container';

		// Use full-width header
		if ( miss_get_setting( 'enable_fullwidth_header' ) ) {
			$container_class='container container-full';
		}

		$site_info .= '<div class="' . $container_class . '">';
		$site_info .= '<div class="row-fluid">';

		$header_layout = ( miss_get_setting('header_layout', true) ) ? miss_get_setting('header_layout', true) : 'logo_content_contacts';
		if ( $header_layout == 'logo_content_contacts' ) {
			if ( !miss_get_setting( 'add_menu_logo' ) ) {
				$logo_args['container_class'] .= ' span3';
				$site_info .= miss_logo($logo_args);
				$site_info .= '<div class="span6 site_description">';
			} else {
				$site_info .= '<div class="span9 site_description">';
			}
			$site_info .= '<div class="v_aligning">';
			$site_info .= apply_atomic_shortcode('the_content', stripcslashes(miss_get_setting('header_site_description')));
			$site_info .= '</div><!-- /.v_aligning -->';
			$site_info .= '</div><!-- /.span6.site_description -->';
			$site_info .= '<div class="span3 site_contacts">';
			$site_info .= miss_header_contacts( $contacts_args = array( 'echo' => 'false') );
			$site_info .= '</div><!-- /.span3.site_contacts -->';
		} elseif ( $header_layout == 'logo_content' ) {
			if ( !miss_get_setting( 'add_menu_logo' ) ) {
				$logo_args['container_class'] .= ' span3';
				$site_info .= miss_logo($logo_args);
				$site_info .= '<div class="span9 site_description">';

			} else {
				$site_info .= '<div class="span12 site_description">';
			}
			$site_info .= '<div class="v_aligning">';
			$site_info .= apply_atomic_shortcode('the_content', stripcslashes(miss_get_setting('header_site_description')));
			$site_info .= '</div><!-- /.v_aligning -->';
			$site_info .= '</div><!-- /.span9.site_description -->';
		} else {
			if ( !miss_get_setting( 'add_menu_logo' ) ) {
				$logo_args['container_class'] .= ' span12';
				$site_info .= miss_logo($logo_args);
			}
		}
		$site_info .= '</div><!-- /.row-fluid -->';
		$site_info .= '</div><!-- /.container -->';
		$site_info .= '</section><!-- /.region site_info-->';

		$header_order = ( miss_get_setting('header_order', true) ) ? miss_get_setting('header_order', true) : '';
		if ( $header_order == 'menu_header') {
			$out = $site_menu . $site_info;
		} else {
			$out = $site_info . $site_menu;
		}

		if ( $args['echo'] == 'true' ) {
			echo apply_atomic_shortcode( 'miss_header', $out );
		} else {
			return $out;
		}
	}
}*/

if ( !function_exists('miss_add_after_header') ) {

	/**
	 * After Header
	 * @since 1.8
	 */
	function miss_add_after_header( $args = array( 'echo' => 'true' ) ){
		global $wp_query;
		
		// Add default args
		$defaults = array(
			'echo' => 'true',
		);

		// Merge args
		$args = wp_parse_args( $args, $defaults );

		$post_obj = $wp_query->get_queried_object();

		// Initial output
		$out = '';

		if( is_front_page() || ( !miss_page_title() && !miss_breadcrumbs() ) || ( ( miss_get_setting( 'disable_page_caption' ) && in_array( 'true', miss_get_setting( 'disable_page_caption' ) ) ) && ( miss_get_setting( 'disable_breadcrumbs' ) && in_array( 'true', miss_get_setting( 'disable_breadcrumbs' ) ) ) ) ){
			// Reset output
			// $out = '';

			// Hide caption for front-page
			// return false; // only if header slider disabled
		} else {
			

			// Add page title
			/*if ( !miss_get_setting( 'disable_page_caption' ) ) {
				$out .= miss_page_title();
			}*/

			// Add breadcrumbs
			/*if ( function_exists( "miss_breadcrumbs" ) ) {
				$out .= miss_breadcrumbs();
			}*/
		}
		// Destroy slider region for non post types
		if ( !is_search() || !is_archive() || !is_tax() || !is_category() ) {
			if( isset($post_obj->ID) ){
				$slider_custom = get_post_meta( $post_obj->ID, 'slider_type', true);
				if( !empty( $slider_custom ) && $slider_custom != "no" ) {
					$out .= '<section class="after_header">';
					$out .= '<div class="row-fluid">';
					$out .= '<div class="span12">';
					$out .= miss_slider_module();
					//miss_get_slider_region();
					$out .= '</div><!-- /.span12 -->';
					$out .= '</div><!-- /.row-fluid -->';
					$out .= '</section><!-- /.region after_header-->';
				}
			}
		}
		// Return
		if ( $args['echo'] == 'true' ) {
			echo apply_atomic_shortcode( 'miss_after_header', $out );
		} else {
			return $out;
		}
	}
}
/* miss_main_content_start */
function miss_main_content_start( $args = array( 'echo' => 'true' ) ){
	$out = '';
	//$out .= '	<section class="main_content ' . get_post_type() . '">';
	//$out .= '		<div class="container">';
//	$out .= '			<div class="row-fluid">';
//	$out .= '				<div class="span12">';
    $out .= '<main>';
	if ( $args['echo'] == 'true' ) {
		echo apply_atomic_shortcode( 'miss_main_content_start', $out );
	} else {
		return $out;
	}
};
/* miss_main_content_end */
function miss_main_content_end( $args = array( 'echo' => 'true' ) ){
	$out = '';
//	$out .= '				</div><!-- /.span12-->';
//	$out .= '			</div>';
	//$out .= '		</div>';
	//$out .= '	</section><!-- /.region main_content-->';
    $out .= '</main>';
    
	if ( $args['echo'] == 'true' ) {
		echo apply_atomic_shortcode( 'miss_main_content_end', $out );
	} else {
		return $out;
	}
};
/* miss_after_main_content */
function miss_after_main_content( $args = array( 'echo' => 'true' ) ){
	global $wp_query;
	$post_obj = $wp_query->get_queried_object();
	// Empty store
	$values = array();
	// List of banner values
	$meta_keys = array(
		'footer_banner_disabled',
		'footer_height',
		'footer_caption',
		'footer_content',
		'footer_button_caption',
		'footer_button_link',
		'footer_button_position',
		'footer_disable_button',
		'footer_caption_color',
		'footer_caption_font_size',
		'footer_content_color',
		'footer_content_font_size',
		'footer_bg_color',
		'footer_bg_image',
		'footer_bg_gradient_top',
		'footer_bg_gradient_bottom',
	);
	foreach ($meta_keys as $value) {
		if ( isset( $post_obj->ID ) ) {
			//Adding values to store
			$values[ $value ] = ( get_post_meta( $post_obj->ID, $value, true) ) ? get_post_meta( $post_obj->ID, $value, true) : '';
		}
	}
	// Extracting Values from store
	extract( $values );

	//Working with values
	// Checkint is value is enabled
	$out = '';
	if ( isset( $footer_banner_disabled ) && !is_array($footer_banner_disabled) && $footer_banner_disabled == 'false' ) {
		//Building empty strings
		$section_style = '';
		$caption_style = '';
		$content_style = '';
		
		//Creating style
		$section_style .= ( $footer_height ) ? 'min-height:' . $footer_height . ';' : '';
		$section_style .= ( $footer_bg_color ) ? 'background-color:' . $footer_bg_color . ';' : '';
		$section_style .= ( $footer_bg_gradient_top != '' && $footer_bg_gradient_bottom != '' ) ? '
			background-image: linear-gradient(top, ' . $footer_bg_gradient_top . ' 0%, ' . $footer_bg_gradient_bottom . ' 100%);
			background-image: -o-linear-gradient(top, ' . $footer_bg_gradient_top . ' 0%, ' . $footer_bg_gradient_bottom . ' 100%);
			background-image: -moz-linear-gradient(top, ' . $footer_bg_gradient_top . ' 0%, ' . $footer_bg_gradient_bottom . ' 100%);
			background-image: -webkit-linear-gradient(top, ' . $footer_bg_gradient_top . ' 0%, ' . $footer_bg_gradient_bottom . ' 100%);
			background-image: -ms-linear-gradient(top, ' . $footer_bg_gradient_top . ' 0%, ' . $footer_bg_gradient_bottom . ' 100%);
			background-image: -webkit-gradient(
				linear,
				left top,
				left bottom,
				color-stop(0, ' . $footer_bg_gradient_top . '),
				color-stop(1, ' . $footer_bg_gradient_bottom . ')
			);
		' : '';
		$section_style .= ( $footer_bg_image ) ? 'background-image: url(' . $footer_bg_image . '); background-repeat: repeat; background-position: top center;' : '';

		$caption_style .= ( $footer_caption_color ) ? 'color:' . $footer_caption_color . ';' : '';
		$caption_style .= ( $footer_caption_font_size ) ? 'font-size:' . $footer_caption_font_size . ';' : '';
		$content_style .= ( $footer_content_color ) ? 'color:' . $footer_content_color . ';' : '';
		$content_style .= ( $footer_content_font_size ) ? 'font-size:' . $footer_content_font_size . ';' : '';

		$footer_button_position = ( $footer_button_position != '' ) ? $footer_button_position : 'right';
		
		// Generate output
		$out .= '	<section class="after_main_content" style="' . $section_style . '">';
			$out .= '		<div class="container footer_banner">';
			$out .= '			<div class="row-fluid">';
			$out .= '				<div class="span12">';
			if ( $footer_button_caption != '' && $footer_button_link != '' && !is_array($footer_disable_button) ) {
				$out .= '					<div class="btn_wrap pull-' . $footer_button_position . '">';
				$out .= '						<a href="' . $footer_button_link . '" class="btn2">' . $footer_button_caption . '</a>';
				$out .= '					</div>';
			}
			$out .= '					<div class="caption" style="' . $caption_style . '">';
			$out .=						$footer_caption;
			$out .= '					</div>';
			$out .= '					<div class="text" style="' . $content_style . '">';
			$out .=						$footer_content;
			$out .= '					</div>';

			$out .= '				</div>';
			$out .= '			</div>';
			$out .= '		</div><!-- /.footer_banner-->';

		$out .= '	</section><!-- /.region after_main_content-->';
	}
	if ( $args['echo'] == 'true' ) {
		echo apply_atomic_shortcode( 'miss_after_main_content', $out );
	} else {
		return $out;
	}
};
/* miss_partners */
if ( !function_exists('miss_partners') ):
function miss_partners( $args = array( 'echo' => 'true' ) ){
	$out = '';
	if ( ( miss_get_setting('disable_partners_section') == 'display_all' ) || ( miss_get_setting('disable_partners_section') == 'only_front_page' && is_front_page() ) ) {
		$out .= '	<section>';
			if( miss_partners_shortcuts() != false ){
				$out .= '		<div class="container">';
				$out .= '			<section class="row our-partners">';
                $out .= '               <header class="section-header span12">
                                            <h1 class="header">
                                                <span>'.miss_get_setting('partners_caption').'</span>
                                            </h1>
                                        </header>';
                $out .= '               <div class="inner-wrapp span12">';
                $out .= miss_partners_shortcuts();
                $out .= '               </div>';
                
				$out .= '			</section>';
				$out .= '		</div><!-- /.container-->';
			};
		$out .= '	</section><!-- /.region partners-->';
	}
	/*if ( $args['echo'] == 'true' ) {
		echo apply_atomic_shortcode( 'miss_partners', $out );
	} else {
		return $out;
	}*/
    return $out;
};
add_shortcode('miss_partners', 'miss_partners');

endif;
/* miss_before_footer */
function miss_before_footer( $args = array( 'echo' => 'true' ) ){
	$out = '';
	if( !miss_get_setting( 'footer_disable' ) ) {
        $out .= '<section class="main-section-15 widgets">
        <!--  - Start -->
        <div class="container">
          <section class="row widget-contacts">
            <div class="span6">
              <i class="marker im-icon-envelop-2"></i> <span class="text-label">E-mail:</span> <a href="mailto:'.stripcslashes(miss_get_setting('extra_header_email')).'">'.stripcslashes(miss_get_setting('extra_header_email')).'</a>
            </div>
            <div class="span6">
              <i class="marker im-icon-phone"></i> <span class="text-label">Phone:</span> '.stripcslashes(miss_get_setting('extra_header_phone')).'
            </div>
          </section>

          <div class="row"><div class="span12 separator"></div></div>
            '.miss_header_sociable(array('echo' => false, 'place' => 'footer')).'
          <div class="row"><div class="span12 separator"></div></div>
          <section class="row widget-copyright">
            <div class="span6">
              '.stripcslashes(miss_get_setting('footer_text')).'
            </div>
          </section>
          
        </div>
        <!--  - End -->
      </section>';
        /*
		echo '	<section class="before_footer">';
		echo '		<div class="container">';
		echo '			<div class="row-fluid">';
		echo			miss_main_footer(
			array(
				'echo' => false
			)
		);
		echo '			</div><!-- /.row-fluid-->';
		echo '		</div><!-- /.container-->';
		echo '	</section><!-- /.region before_footer-->';
        */
        echo $out;
	}
};
/* miss_footer */
function miss_footer( $args = array( 'echo' => 'true' ) ){
    if(!is_home() && !is_page()) return;
    
	$out = '<footer class="base-layout">
              <div class="container">
                <div class="row">
                  <div class="span12">
                    <div class="caption alig-center">
                      ' . stripcslashes(miss_get_setting('footer_contacts')) . '
                    </div>
                  </div>
                </div>
              </div>
            </footer>';
	/*$out .= '	<footer>';
	$out .= '		<div class="container">';
	$out .= '			<div class="row-fluid">';
	$out .= '				<div class="span6">';
	if ( has_nav_menu('footer-links') ) {
		$menu_args = array(
			'theme_location' => 'footer-links',
			'container' => 'nav', 
			'container_class' => 'navbar', 
			'menu_class' => 'nav', 
			'echo' => false, 
		);
		$out .= wp_nav_menu($menu_args);
	}
	$out .= '					<div class="clearboth"></div>';
	$out .= '					<div class="copyrights">';
	$out .=							stripcslashes(miss_get_setting('footer_text'));
	$out .= '					</div>';
	$out .= '				</div><!-- /.span6-->';
	$out .= '				<div class="span3">';
	$out .= miss_header_sociable( 
		array(
			'echo' => false,
			'container_class' => 'sociable'
		) 
	);
	$out .= '				</div><!-- /.span3-->';
	$out .= '				<div class="span3">';
	if( miss_get_setting('footer_contacts') != '' ){
		$out .= '<h4 class="footer_contact_info">' . miss_get_setting('footer_title') . '</h4>';
		$out .= '<pre class="contacts">' . stripcslashes(miss_get_setting('footer_contacts')) . '</pre>';
	}
	$out .= '				</div><!-- /.span3-->';
	$out .= '			</div><!-- /.row-fluid-->';
	$out .= '		</div><!-- /.container-->';
	$out .= '	</footer><!-- /.region footer-->';
    */
	if ( $args['echo'] == 'true' ) {
		echo apply_atomic_shortcode( 'miss_footer', $out );
	} else {
		return $out;
	}
};


/* END Vladimir code */
/* Jarod code */
/*
$modules = Array(
	'posttype',
	'taxonomy'
);
foreach ( $modules as $module ) {
	if (file_exists( __DIR__ . '/' . $module . '.php') ) {
		include_once( $module . '.php' );
	}
}
function modules_loader( $modules = Array( 'posttype' , 'taxonomy' ) ){
	foreach ( $modules as $module ) {
		if (file_exists( __DIR__ . '/' . $module . '.php') ) {
			include_once( $module . '.php' );
		}
	}
}
modules_loader();
*/
/* END Jarod code */

?>
