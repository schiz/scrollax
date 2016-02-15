<?php
if ( !ABSPATH ) {
    header('HTTP/1.1 403 Forbidden');
    die( __('Accedd Denied', MISS_TEXTDOMAIN) );
}

/**
 * Flexible Layout Build
 * package miss
 *
 * @since 1.6
 */
class miss_page_layout {
	protected $layout;
	protected $location;
	protected $type;
	protected $row_class;
	protected $template;
	protected $template_part;
	function __construct( $layout = 'right_sidebar', $location = 'views/containers', $type = 'content', $template = 'single' ) {
		$this->layout = $layout;
		$this->location = $location;
		$this->type = $type;
		$this->template = $template;
		$this->row_class = "";
		$this->template_part = FRAMEWORK_DIRECTORY . '/' . $this->location . '/' . $this->type;
		if ( !file_exists( THEME_DIR . '/' . $this->template_part . '-' . $this->template . '.php' ) ) {
				$this->template = 'default';
		}
	}
	private function local_content() {
		get_template_part( $this->template_part, $this->template, $this->template );
	}
	private function local_sidebar() {
		echo '<div class="span4 right-column'. ( miss_get_setting( 'enable_fixed_sidebar' ) ? ' sticky' : '' ) .'">';
		get_sidebar();
		echo '</div>';
	}
	function set_row_class( $class = 'row-fluid' ) {
		$this->row_class = $class;
	}
	function miss_render_page_layout() {
		if ( $this->layout == 'full_width' ) {
			echo '<div class="primary_content '. miss_get_setting('blog_layout') .'">';
			get_template_part( $this->template_part, $this->template, $this->template );
			echo'</div>';
		} else {
			if ( $this->layout == 'left_sidebar' ) {
                /*echo '<div class="blog-section '. miss_get_setting('blog_layout') .'">';
                echo '<div class="container">';
                echo '<div class="row">';
                echo '<header class="section-header span12">
                          <h1 class="header">
                            <span>'.single_cat_title('', 0).'</span>
                          </h1>
                     </header>';
                echo '<div class="span12"><div class="row">';*/
                //$this->local_sidebar();
        		$this->local_content();
                /*echo '</div></div>';
        		echo'</div>';
        		echo'</div>';
        		echo'</div>';*/
			} else {
                /*echo '<div class="blog-section '. miss_get_setting('blog_layout') .'">';
                echo '<div class="container">';
                echo '<div class="row">';
                if(is_category())
                {
                    echo '<header class="section-header span12">
                          <h1 class="header">
                            <span>';
                    echo single_cat_title('', 0);
                    echo '</span>
                          </h1>
                     </header>';
                }
                elseif(is_archive())
                {
                    echo '<div class="span12"><div class="bread-container">
                            <div class="bread-wrapper">
                            <div class="blog-title">'.post_type_archive_title('', false).'</div>';
                            dimox_breadcrumbs();
                                                   
                    echo '</div>
                        </div></div>';
                }
                else
                {
                    echo '<div class="span12"><div class="bread-container">
                            <div class="bread-wrapper">
                            <div class="blog-title">'.get_the_title().'</div>';
                            dimox_breadcrumbs();
                                                   
                    echo '</div>
                        </div></div>';
                }
                
                echo '<div class="span12"><div class="row">';*/
                $this->local_content();
        		//$this->local_sidebar();
                /*echo '</div></div>';
        		echo'</div>';
        		echo'</div>';
        		echo'</div>';*/
			}
		}
	}
}
?>
