<?php 
$params['class'] = ( isset( $params['class'] ) && $params['class'] !='' ) ? $params['class'] : 'union';
?>
<div class="pricing-table <?php echo $params['class']; ?>"><div class="pricetable-inner">
	<?php foreach((array) $table as $i => $column) : ?>
		<?php 
		$params['custom'] = ( isset( $params['custom'] ) ) ? $params['custom'] : 'false';
		if ( is_array( $params['custom'] ) && in_array( 'true', $params['custom'] ) ){
			if( in_array( 'pricetable-featured', $column['classes'] ) ){
				$color_first = $params['price_color'];
				$color_second = $params['price_bg'];
				$color_third = '#000000';

				$column_inner_stule = 'background-color: ' . $params['button_bg_second'] . ';';
				$text_stule = 'color: #333333;';
				$caption_stule = 'color: ' . $params['price_color']. ';';
				if ( isset( $params['price_bg'] ) ) {
					$price_after_style = 'color: ' . $params['price_bg'] . ';';
				}
			} else {
				$color_first = '#FFFFFF';
				$color_second = $params['price_color'];
				$color_third = $params['price_bg'];

				$column_inner_stule = 'background-color: #d5dddf;';
				$text_stule = 'color: #333333;';
				$caption_stule = 'color: ' . $params['price_color']. ';';
				$price_after_style = 'color: #333333;';
			}
		} else {
			$color_first = '';
			$color_second = '';
			$color_third = '';

			$column_inner_stule = '';
			$text_stule = '';
			$caption_stule = '';
			$price_after_style = '';

			$params['button_bg_second'] = '';
			$params['button_bg_first'] = '';
			$params['header_bg'] = '';
			$params['header_color'] = '';
		}

		$button_stule = '
			background-image: linear-gradient(bottom, ' . $params['button_bg_second'] . ' 20%, ' . $params['button_bg_first'] . ' 100%);
			background-image: -o-linear-gradient(bottom, ' . $params['button_bg_second'] . ' 20%, ' . $params['button_bg_first'] . ' 100%);
			background-image: -moz-linear-gradient(bottom, ' . $params['button_bg_second'] . ' 20%, ' . $params['button_bg_first'] . ' 100%);
			background-image: -webkit-linear-gradient(bottom, ' . $params['button_bg_second'] . ' 20%, ' . $params['button_bg_first'] . ' 100%);
			background-image: -ms-linear-gradient(bottom, ' . $params['button_bg_second'] . ' 20%, ' . $params['button_bg_first'] . ' 100%);
			background-image: -webkit-gradient(
				linear,
				left bottom,
				left top,
				color-stop(0.2, ' . $params['button_bg_second'] . '),
				color-stop(1, ' . $params['button_bg_first'] . ')
			);
			color: ' . $params['header_bg'] . ';
		';

		$price_style = '
			background-image: linear-gradient(bottom, ' . $color_first . ' 20%, ' . $color_third . ' 100%);
			background-image: -o-linear-gradient(bottom, ' . $color_first . ' 20%, ' . $color_third . ' 100%);
			background-image: -moz-linear-gradient(bottom, ' . $color_first . ' 20%, ' . $color_third . ' 100%);
			background-image: -webkit-linear-gradient(bottom, ' . $color_first . ' 20%, ' . $color_third . ' 100%);
			background-image: -ms-linear-gradient(bottom, ' . $color_first . ' 20%, ' . $color_third . ' 100%);
			background-image: -webkit-gradient(
				linear,
				left bottom,
				left top,
				color-stop(0.2, ' . $color_first . '),
				color-stop(1, ' . $color_third . ')
			);
			color: ' . $color_second . ';
		';

		?>
		<div class="table-column <?php print implode(' ', $column['classes']) ?>" style="width:<?php print $column['width'] ?>%; float: left;">
			<div class="pricetable-column-inner" style="<?php print $column_inner_stule; ?>">
				<div class="table-head">
					<h3 class="pricetable-name" style="background-color: <?php print $params['header_bg']; ?>;color: <?php print $params['header_color']; ?>"><?php print $column['title'] ?></h3>
					<div class="price" style="<?php print $price_style; ?>">
						<div class="holder">
							<span class="currency" style="<?php print $price_after_style; ?>"><?php print $params['currency']; ?></span>
							<?php $price = explode( '.', $column['price'] ); ?>
							<?php $price[1] = isset($price[1]) ? $price[1] : ''; ?>
							<span class="before_dot"><?php print $price[0].'.' ?></span>
							<span class="sup_sub">
								<span class="after_dot"><?php print $price[1] ?></span>
								<span class="after" style="<?php print $price_after_style; ?>"><?php print $params['after']; ?></span>
							</span>
						</div>
					</div>
				</div>
				
				<ul class="features">
					<?php if( !empty($column['detail']) ) { ?>
						<li class="details">
						<?php print $column['detail'] ?>
						</li>
					<?php }; ?>
					<?php if(!empty($column['features'])) : ?>
						<?php foreach($column['features'] as $j => $feature) : ?>
							<?php if( empty($feature['sub']) and ( $feature['title'] != '&nbsp;' ) )  { ?>
								<li class="pricetable-feature <?php print $j == 0 ? 'pricetable-first' : '' ?>">
									<span style="<?php print $caption_stule; ?>"><?php print $feature['title'] ?></span>
									<div class="clearboth"></div>
								</li>
							<?php } elseif( $feature['title'] != '&nbsp;' ) { ?>
								<li class="pricetable-feature <?php print $j == 0 ? 'pricetable-first' : '' ?>">
									<span style="<?php print $caption_stule; ?>"><?php print $feature['title'] ?></span>
									<span class="sub" style="<?php print $text_stule; ?>"><?php print $feature['sub'] ?></span>
									<div class="clearboth"></div>
								</li>
							<?php }; ?>
						<?php endforeach ?>
					<?php endif; ?>
					<li class="pricetable-button-container">
                        <a href="<?php print empty($column['url']) ? '#' : $column['url'] ?>" class="pricetable-button"><?php print empty($column['button']) ? __('Sign Up', 'pricetable') : $column['button'] ?></a>
					</li>
				</ul>
				
				
			</div>
		</div>
	<?php endforeach ?>
	
</div></div>