<?php
/**
 * Get Post Media
 *
 * @since 1.0
 */
class miss_gallery_attachments {
	protected $query = Array(
		'numberposts'		=>	1,
		'order'				=>	'ASC',
		'post_mime_type'	=>	'image',
		'post_parent'		=>	null,
		'post_status'		=>	null,
		'post_type'			=>	'attachment'
	);

	function __construct( $limit, $order = 'ASC', $post_id ) {
		$this->query['numberposts'] = $limit;
		$this->query['order'] = $order;
		$this->query['post_parent'] = $post_id;
	}
	function get_media() {
		$attachments = get_children( $this->query );
		return $attachments;
	}
}
?>
