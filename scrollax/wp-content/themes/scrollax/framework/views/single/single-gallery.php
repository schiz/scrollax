<?php miss_before_entry(); ?>
<?php
if ( have_posts() ) while ( have_posts() ) : the_post(); 
	$placeholder = array(
		'color' => get_post_meta( get_the_ID(), '_gallery_placeholder_color', true ) ? get_post_meta( get_the_ID(), '_gallery_placeholder_color', true ) : '',
		'arrow' => get_post_meta( get_the_ID(), '_gallery_placeholder_arrow', true ) ? get_post_meta( get_the_ID(), '_gallery_placeholder_arrow', true ) : '',
		'position' => get_post_meta( get_the_ID(), '_gallery_placeholder_position', true ) ? get_post_meta( get_the_ID(), '_gallery_placeholder_position', true ) : 'left',
		'bg' => get_post_meta( get_the_ID(), '_gallery_placeholder_bg', true ) ? get_post_meta( get_the_ID(), '_gallery_placeholder_bg', true ) : '',
		'radius' => get_post_meta( get_the_ID(), '_gallery_placeholder_radius', true ) ? get_post_meta( get_the_ID(), '_gallery_placeholder_radius', true ) : '',
		'height' => get_post_meta( get_the_ID(), '_gallery_placeholder_height', true ) ? get_post_meta( get_the_ID(), '_gallery_placeholder_height', true ) : '',
	);
	$labels = array(
		'header' => ( get_post_meta( get_the_ID(), '_gallery_field_header', true ) ) ? ( get_post_meta( get_the_ID(), '_gallery_field_header', true ) ) : __('Gallery info', MISS_TEXTDOMAIN ),
		'project' => ( get_post_meta( get_the_ID(), '_gallery_field_project', true ) ) ? ( get_post_meta( get_the_ID(), '_gallery_field_project', true ) ) : __('Project', MISS_TEXTDOMAIN ),
		'web' => ( get_post_meta( get_the_ID(), '_gallery_field_web', true ) ) ? ( get_post_meta( get_the_ID(), '_gallery_field_web', true ) ) : __('Web', MISS_TEXTDOMAIN ),
		'exp' => ( get_post_meta( get_the_ID(), '_gallery_field_exp', true ) ) ? ( get_post_meta( get_the_ID(), '_gallery_field_exp', true ) ) : __('Experience', MISS_TEXTDOMAIN ),
		'details' => ( get_post_meta( get_the_ID(), '_gallery_field_details', true ) ) ? ( get_post_meta( get_the_ID(), '_gallery_field_details', true ) ) : __('Details', MISS_TEXTDOMAIN ),
	);
	$fields = Array(
		'field1' => Array(
			'label' => $labels['project'],
			'value' => get_post_meta( get_the_ID(), '_gallery_customer', true ) ? get_post_meta( get_the_ID(), '_gallery_customer', true ) : false
		),
		'field2' => Array(
			'label' => $labels['exp'],
			'value' => get_post_meta( get_the_ID(), '_gallery_exp', true ) ? get_post_meta( get_the_ID(), '_gallery_exp', true ) : false
		),
		'field3' => Array(
			'label' => $labels['web'],
			'value' => get_post_meta( get_the_ID(), '_gallery_uri', true ) ? get_post_meta( get_the_ID(), '_gallery_uri', true ) : false
		),
		'field4' => Array(
			'label' => $labels['details'],
			'value' => get_post_meta( get_the_ID(), '_gallery_descr', true ) ? get_post_meta( get_the_ID(), '_gallery_descr', true ) : false
		),
	);
	$miss_flags = Array();
	foreach( $fields as $miss_flag_key => $field ) {
		$miss_flags[ $miss_flag_key ] = ( $field['value'] ) ? true : false;
	}

endwhile;
?>
<?php miss_after_entry(); ?>
</div><!-- /.container -->
<style>
#ascrail2000-hr div:after {
	position: absolute;
	top: -<?php echo ( !empty( $placeholder['arrow'] ) ) ? $placeholder['arrow'] : '6'; ?>px;
	<?php if ( $placeholder['position'] == 'center' ) : ?>
	left: 50%;
	margin-left: -<?php echo ( !empty( $placeholder['arrow'] ) ) ? ( $placeholder['arrow'] / 2 ) : '3'; ?>px;
	<?php elseif ( $placeholder['position'] == 'right' ) : ?>
	right: <?php echo ( !empty( $placeholder['arrow'] ) ) ? $placeholder['arrow'] : '6'; ?>px;
	margin-right: <?php echo ( !empty( $placeholder['arrow'] ) ) ? ( $placeholder['arrow'] / 2 ) : '3'; ?>px;
	<?php else : ?>
	left: <?php echo ( !empty( $placeholder['arrow'] ) ) ? $placeholder['arrow'] : '6'; ?>px;
	margin-left: <?php echo ( !empty( $placeholder['arrow'] ) ) ? ( $placeholder['arrow'] / 2 ) : '3'; ?>px;
	<?php endif; ?>
	z-index: 9999;
	display: inline-block;
	border-right: <?php echo ( !empty( $placeholder['arrow'] ) ) ? $placeholder['arrow'] : '6'; ?>px solid transparent;
	border-bottom: <?php echo ( !empty( $placeholder['arrow'] ) ) ? $placeholder['arrow'] : '6'; ?>px solid <?php echo ( !empty( $placeholder['color'] ) ) ? $placeholder['color'] : '#dddddd'; ?>;
	border-left: <?php echo ( !empty( $placeholder['arrow'] ) ) ? $placeholder['arrow'] : '6'; ?>px solid transparent;
	content: '';
}
</style>
<script>
var miss_gallery_placeholder = {
	'bg': '<?php echo ( !empty( $placeholder['bg'] ) ) ? $placeholder['bg'] : '#f0f3f4'; ?>',
	'color': '<?php echo ( !empty( $placeholder['color'] ) ) ? $placeholder['color'] : '#dddddd'; ?>',
	'radius': <?php echo ( !empty( $placeholder['radius'] ) ) ? $placeholder['radius'] : '5'; ?>,
	'height': <?php echo ( !empty( $placeholder['radius'] ) ) ? $placeholder['height'] : '6'; ?>
};
</script>
<!-- Content Area -->
								<?php
									$out = '';
									$out_pre = '';
									$columns = 3;
									$column_in_row = 1;
									$span = 12 / $columns;
									$images = new miss_gallery_attachments( $limit = 999, $order = 'ASC', $post_id = get_the_ID() );
									$initial_width = 0;
									$region_width = 650;
									$minimal_height = 715;
									$itmes = Array();

									$out_item = '';

									$template = '<div class="gallery-single-item" style="overflow: hidden; height: {{ div.height }}px; float: left;max-width: ' . $region_width . 'px"><a rel="prettyPhoto[group1]" href="{{ link.href }}" class="{{ link.class }} has_preview" title="{{ link.title }}"><img src="{{ img.src }}" alt="{{ img.alt }}" class="fit width" /><div class="preview_info_wrap"></div></a></div>';
									if ( count( $images->get_media() ) > 0 ) {
										foreach ( $images->get_media() as $image ) {
											$thumb = miss_wp_image( $image->guid, $region_width, '715' );
											$image_path = explode( $_SERVER['SERVER_NAME'], $thumb );
											if( !empty( $image_path[1] ) ) {
												$image_path = $_SERVER['DOCUMENT_ROOT'] . $image_path[1];
												$image_size = @getimagesize( $image_path );
											} else {
												@getimagesize( $thumb );
											}
											//$image_size = getimagesize( $thumb );
											if ( $image_size[1] < $minimal_height && $image_size[1] > 1 ) {
												$minimal_height = $image_size[1];
											}

						$items[] = Array(
							'src' => $thumb,
							'alt' => $image->post_name,
							'href'=> $image->guid,
							'size'=> $image_size
						);											
											$column_in_row++;
										}
										foreach( $items as $item ) {
										$initial_width = $region_width + $initial_width + 10;
											$thumb = str_replace(
												Array(
													'{{ link.href }}',
													'{{ link.class }}',
													'{{ link.title }}',
													'{{ img.src }}',
													'{{ img.alt }}',
													'{{ div.height }}'
												),
												Array(
													$item['href'],
													'',
													$item['alt'],
													$item['src'],
													$item['alt'],
													$minimal_height
												),
												$template
											);

											$out_item .= '<div class="gallery item gallery-column-' . $span . '"><div class="singleAlbumItem">';
											$out_item .= $thumb;
											$out_item .= '</div></div><!-- /.portfolioItem /.span' . $span . ' -->';

										}

										$out_pre .= '<div class="single_module ' . get_post_type() . '" style="height: ' . ( $minimal_height + 10 ) . 'px;">';
										$out_pre .= '<div id="page-' . get_the_ID() . '" class="row-fluid relative">';

										if ( $miss_flags ) {
											$out_pre .= '<div class="gallery text inner relative">';
											$out_pre .= '<div class="air-outset" style="height: ' . ( $minimal_height + 10 ) . 'px;">';
											$out_pre .= '<?php get_the_content(); ?>';
											$out_pre .= '<div class="gallery air sidebar" style="height: ' . ( $minimal_height + 10 ) . 'px; width: 0; overflow: hidden; opacity: 0; -moz-opacity: 0;">';
											$out_pre .= '<div class="widget miss_contact_widget gallery_info">';
											$out_pre .= '<div class="widgettitle">';
											$out_pre .= $labels['header'];
											$out_pre .= '</div>';
											$out_pre .= '<ul>';
											foreach( $fields as $field ) {
												if ( $field['value'] ) {
													$out_pre .= '<li><strong>' . $field['label'] . '</strong>:<p>' . $field['value'] . '</p></li>';
												}
											}
											$out_pre .= '</ul>';
											$out_pre .= '</div>';
											$out_pre .= '</div>';
											$out_pre .= '<div class="details"><div class="widget gallery_info"><div class="btn2" data-hidden="im-icon-arrow-left" data-visible="im-icon-arrow-right"><i class="im-icon-arrow-left"></i></div></div></div>';
											$out_pre .= '</div>';
											$out_pre .= '</div>';
										}

										echo $out_pre;

										echo '<div class="span12 gallery scroll-box" style="margin-left:0; margin-right: 0; height: ' . ( $minimal_height + 10 ) . 'px">';

										echo '<div class="grid" style="margin: 0; padding: 0; width: ' . ( $initial_width - 10 ) . 'px; height: ' . $minimal_height . 'px">' . $out_item . '</div>';
										
										echo '</div>';

									}
								?>
					</div><!-- .entry -->
				 <div class="clearboth"></div>
	</div><!-- .single_page_module -->
<!-- / Content Area -->
<div class="container">