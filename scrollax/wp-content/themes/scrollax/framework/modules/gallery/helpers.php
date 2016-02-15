<?php

function miss_m_optset_order( $opts ) {

	/* order checkboxes */
	// ASC
	$asc = miss_melement( 'radio', array(
		'name'          => $opts['box_name'] . '_order',
		'checked'       => 'ASC' == $opts['current']?true:false,
		'description'   => ' Ascending',
		'value'         => 'ASC'
	) );
	$asc->generate_id('asc');
	
	// DESC
	$desc = miss_melement( 'radio', array(
		'name'          => $opts['box_name'] . '_order',
		'checked'       => 'DESC' == $opts['current']?true:false,
		'description'   => ' Descending',
		'value'         => 'DESC'
	) );
	$desc->generate_id('desc');
	
	echo '<p>';
	echo $asc . ' ' . $desc;
	echo '</p>';
}

function miss_m_optset_hide_thumb( $opts ) {

	// checkbox for hiding featured image when album shown
	$hide_thumb = miss_melement( 'checkbox', array(
		'name'          => $opts['box_name'] . '_hide_thumb',
		'checked'       => $opts['hide_thumbnail'],
		'description'   => ' Hide featured image inside the album'
	) );
	$hide_thumb->generate_id('hide_thumb');
	
	echo '<p>';
	echo $hide_thumb;
	echo '</p>';
}

function miss_m_optset_orderby( $opts ) {
	
	/* orderby chapter */
	$p_orderby = array(
		'ID'        => _x( 'Order by ID', 'backend orderby', MISS_ADMIN_TEXTDOMAIN ),
		'author'    => _x( 'Order by author', 'backend orderby', MISS_ADMIN_TEXTDOMAIN ),
		'title'     => _x( 'Order by title', 'backend orderby', MISS_ADMIN_TEXTDOMAIN ),
		'date'      => _x( 'Order by date', 'backend orderby', MISS_ADMIN_TEXTDOMAIN ),
		'modified'  => _x( 'Order by modified', 'backend orderby', MISS_ADMIN_TEXTDOMAIN ),
		'rand'      => _x( 'Order by rand', 'backend orderby', MISS_ADMIN_TEXTDOMAIN ),
		'menu_order'=> _x( 'Order by menu', 'backend orderby', MISS_ADMIN_TEXTDOMAIN )
	);
	
	$orderby = miss_melement( 'select', array(
		'name'          => $opts['box_name'] . '_orderby',
		'selected'      => $opts['current'],
		'description'   => '',
		'options'       => $p_orderby,
		'wrap'          => '%2$s%1$s'
	) );
	$orderby->generate_id('orderby');
	
	echo '<p>';
	echo $orderby;
	echo '</p>';
}

?>
