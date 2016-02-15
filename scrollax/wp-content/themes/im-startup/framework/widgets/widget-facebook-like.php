<?php
add_action('widgets_init', 'facebook_like_load_widgets');

function facebook_like_load_widgets()
{
	register_widget('Facebook_Like_Widget');
}

class Facebook_Like_Widget extends WP_Widget {
	
	function Facebook_Like_Widget()
	{
		$widget_ops = array('classname' => 'facebook_like', 'description' => 'Adds support for Facebook Like Box.');

		$control_ops = array('id_base' => 'widget-facebook-like');

		$this->WP_Widget('widget-facebook-like', sprintf( __( '%1$s - Facebook Likes', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ), $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		$page_url = $instance['page_url'];
		//$width = $instance['width'];
		//$color_scheme = $instance['color_scheme'];
		$show_faces = isset($instance['show_faces']) ? 'true' : 'false';
		$show_stream = isset($instance['show_stream']) ? 'true' : 'false';
		$show_header = isset($instance['show_header']) ? 'true' : 'false';
		
		echo $before_widget;

		if($title) {
			echo $before_title.$title.$after_title;
		}
		
		if($page_url): ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-like-box" data-href="<?php echo $page_url; ?>"data-show-faces="<?php echo $show_faces; ?>" data-header="<?php echo $show_header; ?>" data-stream="<?php echo $show_stream; ?>" data-show-border="false" style="width:100%;"></div>
<style>
.fb-like-box * {width: 100% !important;}
</style>


		<?php endif;
		
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['page_url'] = $new_instance['page_url'];
		//$instance['width'] = $new_instance['width'];
		//$instance['color_scheme'] = $new_instance['color_scheme'];
		$instance['show_faces'] = $new_instance['show_faces'];
		$instance['show_stream'] = $new_instance['show_stream'];
		$instance['show_header'] = $new_instance['show_header'];
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Find us on Facebook', 'page_url' => 'facebook.com/envato', 'width' => '100%', 'color_scheme' => 'light', 'show_faces' => 'on', 'show_stream' => false, 'show_header' => false);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('page_url'); ?>">Facebook Page URL:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('page_url'); ?>" name="<?php echo $this->get_field_name('page_url'); ?>" value="<?php echo $instance['page_url']; ?>" />
			<em>You should create Facebook page first. For more details please read <a href="http://developers.facebook.com/docs/reference/plugins/like-box/" target="_BLANK">Like Box reference</a>.</em>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_faces'], 'on'); ?> id="<?php echo $this->get_field_id('show_faces'); ?>" name="<?php echo $this->get_field_name('show_faces'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_faces'); ?>">Show faces</label>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_stream'], 'on'); ?> id="<?php echo $this->get_field_id('show_stream'); ?>" name="<?php echo $this->get_field_name('show_stream'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_stream'); ?>">Show stream</label>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_header'], 'on'); ?> id="<?php echo $this->get_field_id('show_header'); ?>" name="<?php echo $this->get_field_name('show_header'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_header'); ?>">Show facebook header</label>
		</p>
	<?php
	}
}
?>
