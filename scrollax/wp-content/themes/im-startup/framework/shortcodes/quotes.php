<?php
/**
 *
 */
class missQuotes {
	
	/**
	 *
	 */
	public static function pullquote( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Pullquote', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'pullquote',
				'options' => array(
					array(
						'name' => __( 'Pullquote Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the text that you wish to display with your quote.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Quotes <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Check if you wish to have icons displayed with your quote.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'quotes',
						'options' => array( 'true' => __( 'Display quote icon', MISS_ADMIN_TEXTDOMAIN ) ),  
						'default' => '',
						'type' => 'checkbox',
					),
					array(
						'name' => __( 'Align <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Set the alignment for your quote here.<br /><br />Your quote will float along the center, left or right hand sides depending on your choice.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'align',
						'default' => '',
						'options' => array(
							'left' => __( 'left', MISS_ADMIN_TEXTDOMAIN ),
							'right' => __( 'right', MISS_ADMIN_TEXTDOMAIN ),
							'center' => __( 'center', MISS_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select',
					),
					array(
						'name' => __( 'Quotes Colour <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Specify custom quote colour.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'color',
						'default' => '',
						'type' => 'color',
					),
					array(
						'name' => __( 'Text Colour <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Specify custom text colour.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'textColor',
						'type' => 'color',
					),
					array(
						'name' => __( 'Background Colour <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Specify custom background colour.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'bgColor',
						'type' => 'color',
					),
					array(
						'name' => __( 'Cite Name <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This is the name of the author.  It will display at the end of the quote.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'cite',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Cite Link <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'If you found your quote online then paste the URL here.  It will display after the author.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'citeLink',
						'default' => '',
						'type' => 'text',
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'quotes'	=> '',
			'align'		=> '',
			'color'	=> '',
			'textcolor'	=> '',
			'bgcolor'	=> '',
			'cite'		=> '',
			'citelink'	=> ''
	    ), $atts));
	
		$class = array();
		
		if( trim( $quotes ) == 'true' )
			$class[] = ' quotes';
			
		if( preg_match( '/left|right|center/', trim( $align ) ) )
			$class[] = ' align' . $align;
			
		$citelink = ( $citelink ) ? ' ,<a href="' . esc_url( $citelink ) . '" class="target_blank">' . $citelink . '</a>' : '';
		
		$cite = ( $cite ) ? ' <cite>&ndash; ' . $cite . $citelink . '</cite>' : '' ;

		$color = ( $color ) ? 'color:' . $color . ';' : '';
		$bgcolor = ( $bgcolor ) ? 'background-color:' . $bgcolor . ';' : '';	
		$style_qute = ( $color || $bgcolor ) ? ' style="' . $color . $bgcolor . '"' : '';
		$style_text = ( $textcolor ) ? ' style="color:' . $textcolor . ';"' : '';
			
		$class = join( '', array_unique( $class ) );
	
		return '<span class="pullquote' . $class . '"' . $style_qute . '><span class="text"' . $style_text . '>' . miss_content_group( $content ) . $cite . '</span></span>';
	}
	
	/**
	 *
	 */
/*
	public static function pullquote2( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Pullquote 2', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'pullquote2',
				'options' => array(
					array(
						'name' => __( 'Pullquote Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the text that you wish to display with your quote.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Quotes <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Check if you wish to have icons displayed with your quote.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'quotes',
						'options' => array( 'true' => 'Display quote icon' ),
						'default' => '',
						'type' => 'checkbox',
					),
					array(
						'name' => __( 'Align <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Set the alignment for your quote here.<br /><br />Your quote will float along the center, left or right hand sides depending on your choice.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'align',
						'default' => '',
						'options' => array(
							'left' => __( 'left', MISS_ADMIN_TEXTDOMAIN ),
							'right' => __( 'right', MISS_ADMIN_TEXTDOMAIN ),
							'center' => __( 'center', MISS_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select',
					),
					array(
						'name' => __('Custom Text Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change the color of the text that appears on your quote.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'textColor',
						'type' => 'color',
					),
					array(
						'name' => __( 'Cite Name <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This is the name of the author.  It will display at the end of the quote.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'cite',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Cite Link <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'If you found your quote online then paste the URL here.  It will display after the author.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'citeLink',
						'default' => '',
						'type' => 'text',
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'quotes'	=> '',
			'align'		=> '',
			'textcolor'	=> '',
			'cite'		=> '',
			'citelink'	=> ''
	    ), $atts));
	
		$class = array();
		
		if( trim( $quotes ) == 'true' )
			$class[] = ' quotes';
			
		if( preg_match( '/left|right|center/', trim( $align ) ) )
			$class[] = ' align' . $align;
			
		$citelink = ( $citelink ) ? ' ,<a href="' . esc_url( $citelink ) . '" class="target_blank">' . $citelink . '</a>' : '';
		
		$cite = ( $cite ) ? ' <cite>&ndash; ' . $cite . $citelink . '</cite>' : '' ;
		
		$style = ( $textcolor ) ? ' style="color:' . $textcolor . ';"' : '';
			
		$class = join( '', array_unique( $class ) );
	
		return '<span class="pullquote2' . $class . '"' . $style . '>' . miss_content_group( $content ) . $cite . '</span>';
	}
*/	
	/**
	 *
	 */
/*
	public static function pullquote3( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Pullquote 3', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'pullquote3',
				'options' => array(
					array(
						'name' => __( 'Pullquote Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the text that you wish to display with your quote.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Quotes <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Check if you wish to have icons displayed with your quote.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'quotes',
						'options' => array( 'true' => __('Display quote icon', MISS_ADMIN_TEXTDOMAIN )),
						'default' => '',
						'type' => 'checkbox',
					),
					array(
						'name' => __( 'Align <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Set the alignment for your quote here.<br /><br />Your quote will float along the center, left or right hand sides depending on your choice.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'align',
						'default' => '',
						'options' => array(
							'left' => __( 'left', MISS_ADMIN_TEXTDOMAIN ),
							'right' => __( 'right', MISS_ADMIN_TEXTDOMAIN ),
							'center' => __( 'center', MISS_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select',
					),
					array(
						'name' => __( 'Custom Text Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change the color of the text that appears on your quote.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'textColor',
						'type' => 'color',
					),
					array(
						'name' => __( 'Cite Name <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This is the name of the author.  It will display at the end of the quote.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'cite',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Cite Link <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'If you found your quote online then paste the URL here.  It will display after the author.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'citeLink',
						'default' => '',
						'type' => 'text',
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'quotes'	=> '',
			'align'		=> '',
			'textcolor'	=> '',
			'cite'		=> '',
			'citelink'	=> ''
	    ), $atts));
	
		$class = array();
		
		if( trim( $quotes ) == 'true' )
			$class[] = ' quotes';
			
		if( preg_match( '/left|right|center/', trim( $align ) ) )
			$class[] = ' align' . $align;
			
		$citelink = ( $citelink ) ? ' ,<a href="' . esc_url( $citelink ) . '" class="target_blank">' . $citelink . '</a>' : '';
		
		$cite = ( $cite ) ? ' <cite>&ndash; ' . $cite . $citelink . '</cite>' : '' ;
		
		$style = ( $textcolor ) ? ' style="color:' . $textcolor . ';"' : '';
			
		$class = join( '', array_unique( $class ) );
	
		return '<span class="pullquote3' . $class . '"' . $style . '>' . miss_content_group( $content ) . $cite . '</span>';
	}
*/	
	/**
	 *
	 */
/*
	public static function pullquote4( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Pullquote 4', MISS_ADMIN_TEXTDOMAIN ),
				'value' => 'pullquote4',
				'options' => array(
					array(
						'name' => __( 'Pullquote Content', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the text that you wish to display with your quote.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Quotes <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Check if you wish to have icons displayed with your quote.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'quotes',
						'options' => array( 'true' => __('Display quote icon', MISS_ADMIN_TEXTDOMAIN )),
						'default' => '',
						'type' => 'checkbox',
					),
					array(
						'name' => __( 'Align <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Set the alignment for your quote here.<br /><br />Your quote will float along the center, left or right hand sides depending on your choice.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'align',
						'default' => '',
						'options' => array(
							'left' => __( 'left', MISS_ADMIN_TEXTDOMAIN ),
							'right' => __( 'right', MISS_ADMIN_TEXTDOMAIN ),
							'center' => __( 'center', MISS_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select',
					),
					array(
						'name' => __( 'Custom BG Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Or you can also choose your own color to use as the background for your quote.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'bgColor',
						'type' => 'color',
					),
					array(
						'name' => __( 'Custom Text Color <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change the color of the text that appears on your quote.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'textColor',
						'type' => 'color',
					),
					array(
						'name' => __( 'Cite Name <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This is the name of the author.  It will display at the end of the quote.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'cite',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Cite Link <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'If you found your quote online then paste the URL here.  It will display after the author.', MISS_ADMIN_TEXTDOMAIN ),
						'id' => 'citeLink',
						'default' => '',
						'type' => 'text',
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'quotes'	=> '',
			'align'		=> '',
			'bgcolor'	=> '',
			'textcolor'	=> '',
			'cite'		=> '',
			'citelink'	=> ''
	    ), $atts));
	
		$class = array();
		$styles = array();
		
		$quotes = ( trim( $quotes ) == 'true' ) ? ' class="quotes"' : '';
			
		if( preg_match( '/left|right|center/', trim( $align ) ) )
			$class[] = ' align' . $align;
			
		$citelink = ( $citelink ) ? ' ,<a href="' . esc_url( $citelink ) . '" class="target_blank">' . $citelink . '</a>' : '';
		
		$cite = ( $cite ) ? ' <cite>&ndash; ' . $cite . $citelink . '</cite>' : '' ;
		
		if( $bgcolor )
			$styles[] = 'background-color:' . $bgcolor . ';border-color:' . $bgcolor . ';';
			
		if( $textcolor )
			$styles[] = 'color:' . $textcolor . ';';
			
		$class = join( '', array_unique( $class ) );
		$style = join( '', array_unique( $styles ) );
		
		$style = ( !empty( $style ) ) ? ' style="' . $style . '"': '' ;
	
		return '<span class="pullquote4' . $class . '"' . $style . '><span' . $quotes . '>' . miss_content_group( $content ) . $cite . '</span></span>';
	}
*/	
	/**
	 *
	 */
	public static function blockquote( $atts = null, $content = null ) {
		$option = array( 
			'name' => __( 'Blockquotes', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'blockquote',
			'options' => array(
				array(
					'name' => __( 'Blockquote Content', MISS_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Type out the text that you wish to display with your quote.', MISS_ADMIN_TEXTDOMAIN ),
					'id' => 'content',
					'default' => '',
					'type' => 'textarea',
				),
				array(
					'name' => __( 'Align <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Set the alignment for your quote here.<br /><br />Your quote will float along the center, left or right hand sides depending on your choice.', MISS_ADMIN_TEXTDOMAIN ),
					'id' => 'align',
					'default' => '',
					'options' => array(
						'left' => __( 'left', MISS_ADMIN_TEXTDOMAIN ),
						'right' => __( 'right', MISS_ADMIN_TEXTDOMAIN ),
						'center' => __( 'center', MISS_ADMIN_TEXTDOMAIN ),
					),
					'type' => 'select',
				),
				array(
					'name' => __( 'Cite Name <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'This is the name of the author.  It will display at the end of the quote.', MISS_ADMIN_TEXTDOMAIN ),
					'id' => 'cite',
					'default' => '',
					'type' => 'text',
				),
				array(
					'name' => __( 'Cite Link <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'If you found your quote online then paste the URL here.  It will display after the author.', MISS_ADMIN_TEXTDOMAIN ),
					'id' => 'citeLink',
					'default' => '',
					'type' => 'text',
				),
				array(
					'name' => __( 'Quotes Colour <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Specify custom colour.', MISS_ADMIN_TEXTDOMAIN ),
					'id' => 'color',
					'default' => '',
					'type' => 'color',
				),
				array(
					'name' => __( 'Text Colour <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Specify custom text colour.', MISS_ADMIN_TEXTDOMAIN ),
					'id' => 'textColor',
					'type' => 'color',
				),
				array(
					'name' => __( 'Background Colour <small>(optional)</small>', MISS_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Specify custom background colour.', MISS_ADMIN_TEXTDOMAIN ),
					'id' => 'bgColor',
					'type' => 'color',
				),
			'shortcode_has_atts' => true,
			)
		);
		
		if( $atts == 'generator' )
			return $option;
			
		extract(shortcode_atts(array(
			'align'	=> '',
			'cite'		=> '',
			'citelink'	=> '',
			'color'	=> '',
			'textcolor'	=> '',
			'bgcolor'	=> '',
		), $atts));
				
		$color = ( $color ) ? 'color:' . $color . ';' : '';
		$bgcolor = ( $bgcolor ) ? 'background-color:' . $bgcolor . ';' : '';	
		$style_qute = ( $color ) ? ' style="' . $color . '"' : '';
		$style_bg = ( $bgcolor  ) ? ' style="' . $bgcolor . '"' : '';
		$style_text = ( $textcolor ) ? ' style="color:' . $textcolor . ';"' : '';

		$citelink = ( $citelink ) ? ' ,<a href="' . esc_url( $citelink ) . '" class="target_blank">' . $citelink . '</a>' : '';
		
		$cite = ( $cite ) ? ' <cite>&ndash; ' . $cite . $citelink . '</cite>' : '' ;

 		return '<blockquote' . $style_bg . '><i class="fa-icon-quote-left"' . $style_qute . '></i><span class="text"' . $style_text . '>' . $content . '</span>' . $cite . '</blockquote>';
	}
		
	/**
	 *
	 */
	public static function _options( $class ) {
		$shortcode = array();
		
		$class_methods = get_class_methods( $class );
		
		foreach( $class_methods as $method ) {
			if( $method[0] != '_' ) {
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
			}
		}
		
		$options = array(
			'name' => __( 'Pullquotes & Blockquote', MISS_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of quote you wish to use.', MISS_ADMIN_TEXTDOMAIN ),
			'value' => 'quotes',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>
