<?php 

	$rev = Array();
	$criteria = miss_get_setting('criteria');
	if ( $criteria['keys'] != '#' ) {
		$criteria_keys = explode(',',$criteria['keys']);
		foreach ($criteria_keys as $ckey) {
			if ( $ckey != '#') {
				$criteria_name = ( !empty( $criteria[$ckey]['link'] ) ) ? $criteria[$ckey]['link'] : '#';

				$rev[$ckey] = array(
					'name' => $criteria_name.' score: ',
					'id' => '_review_'.$ckey,
					'type' => 'select',
					'options' => array(
						'0.5' => '0.5',
						'1' => '1',
						'1.5' => '1.5',
						'2' => '2',
						'2.5' => '2.5',
						'3' => '3',
						'3.5' => '3.5',
						'4' => '4',
						'4.5' => '4.5',
						'5' => '5'
					),
				);
			}
		}
	}

	$meta_boxes = array(
		'title' => sprintf( __( '%1$s Review', MISS_ADMIN_TEXTDOMAIN ), THEME_NAME ),
		'id' => 'miss_review',
		'pages' => array('post', 'portfolio'),
		'callback' => '',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => $rev
	);




	return array(
		'load' => true,
		'options' => $meta_boxes
	);


?>
