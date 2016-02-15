<?php
/**
 * Partners
 * @since 1.5
 */

$option_tabs['miss_footer_tab'] = array('class' => 'footer', 'title' => __( 'Footer', MISS_ADMIN_TEXTDOMAIN ));
$option_store = Array(
	array(
		'name' => array( 'miss_footer_tab' => $option_tabs ),
		'class'=> 'footer',
		'icon' => 'icon-footer.png',
		'type' => 'tab_start'
	),
		array(
			'name' => __( 'Footer phone', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'This option will add phone number in site footer. Leave blank to remove.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'extra_header_phone',
			'htmlspecialchars' => true,
			'type' => 'text'
		),	
        
		array(
			'name' => __( 'Footer email', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'This option will add email address in site footer. Leave blank to remove.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'extra_header_email',

			'htmlspecialchars' => true,
			'type' => 'text'
		),	
	
		array(
			'name' => __( 'Footer contacts text', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter contact information here. Contacts will be displayed bottom left your website footer.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'footer_contacts',
			'default' => '5 Cromac Avenue, Belfast, Northern Ireland<br />Phone: (305) 555-4446   Fax: (305) 555-4447<br />E-Mail: johndoe@yourdomain.com Web: http://www.yourdomain.com',
			'htmlspecialchars' => false,
			'type' => 'textarea'
		),
		
		array(
			'name' => __( 'Copyrights', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter copyrights for footer right.', MISS_ADMIN_TEXTDOMAIN ),
			'id' => 'footer_text',
			'default' => '',
			'htmlspecialchars' => true,
			'type' => 'text'
		),
	
	array(
		'type' => 'tab_end'
	),
);
