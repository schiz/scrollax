<div class="price-columns">
	<div id="column-skeleton" style="display:none">
		
		<span class="ui-icon ui-icon-carat-2-e-w column-handle"></span>
		<a href="#" class="ui-icon ui-icon-trash submitdelete deletion"></a>
		
		<div class="type">
			<input type="radio" value="recommend" name="price_recommend" />
			<label><?php _e('Recommend', 'pricetable') ?></label>
		</div>
		
		<input type="text" class="column-title" name="" placeholder="<?php _e('Title', 'pricetable') ?>" />
		<input type="text" class="column-price" name="" placeholder="<?php _e('Price', 'pricetable') ?>" />
		<input type="text" class="column-detail" name="" placeholder="<?php _e('Detail', 'pricetable') ?>" />
		<input type="text" class="column-url" name="" placeholder="<?php _e('Button URL', 'pricetable') ?>" />
		<input type="text" class="column-button" name="" placeholder="<?php _e('Button Text', 'pricetable') ?>" />
		
		<h4><a href="#" class="addfeature"><?php _e('Add', 'pricetable') ?></a><?php _e('Features', 'pricetable') ?></h4>
		<div class="feautres">
			<div class="feature">
				<span class="ui-icon ui-icon-carat-2-n-s feature-handle"></span>
				<a href="#" class="ui-icon ui-icon-trash submitdelete deletion"></a>
				
				<div><input type="text" class="feature-title" placeholder="<?php _e('Title', 'pricetable') ?>"/></div>
				<div><input type="text" class="feature-sub" placeholder="<?php _e('Sub title', 'pricetable') ?>" /></div>
			</div>
		</div>
	</div>
	
	<?php // Existing columns of the price table ?>
	<?php foreach($table as $i => $column) : ?>
		<div class="column">
			<span class="ui-icon ui-icon-carat-2-e-w column-handle"></span>
			<a href="#" class="ui-icon ui-icon-trash submitdelete deletion"></a>
			
			<div class="type">
				<input type="radio" name="price_recommend" id="price_recommend_<?php print $i ?>" value="<?php print $i ?>" <?php if(isset($column['featured']) && $column['featured'] === 'true') print 'checked="true"'; ?> />
				<label for="price_recommend_<?php print $i ?>"><?php _e('Recommend', 'pricetable') ?></label>
			</div>
			
			<input type="text" class="column-title" name="price_<?php print $i ?>_title" value="<?php @esc_attr_e($column['title']) ?>" placeholder="<?php _e('Title', 'pricetable') ?>" />
			<input type="text" class="column-price" name="price_<?php print $i ?>_price" value="<?php @esc_attr_e($column['price']) ?>" placeholder="<?php _e('Price', 'pricetable') ?>" />
			<input type="text" class="column-detail" name="price_<?php print $i ?>_detail" value="<?php @esc_attr_e($column['detail']) ?>" placeholder="<?php _e('Detail', 'pricetable') ?>" />
			<input type="text" class="column-url" name="price_<?php print $i ?>_url" value="<?php @esc_attr_e($column['url']) ?>" placeholder="<?php _e('Button URL', 'pricetable') ?>" />
			<input type="text" class="column-button" name="price_<?php print $i ?>_button" value="<?php @esc_attr_e($column['button']) ?>" placeholder="<?php _e('Button Text', 'pricetable') ?>" />
			
			<h4><a href="#" class="addfeature"><?php _e('Add', 'pricetable') ?></a><?php _e('Features', 'pricetable') ?></h4>
			<div class="feautres">
				<?php if(isset($column['features'])) : foreach($column['features'] as $j => $feature) : ?>
					<div class="feature">
						<span class="ui-icon ui-icon-carat-2-n-s feature-handle"></span>
						<a href="#" class="ui-icon ui-icon-trash submitdelete deletion"></a>
						
						<div><input type="text" class="feature-title" name="price_<?php print $i ?>_feature_<?php print $j ?>_title" value="<?php esc_attr_e($feature['title']) ?>" placeholder="<?php _e('Title', 'pricetable') ?>"/></div>
						<div><input type="text" class="feature-sub" name="price_<?php print $i ?>_feature_<?php print $j ?>_sub" value="<?php esc_attr_e($feature['sub']) ?>" placeholder="<?php _e('Sub title', 'pricetable') ?>" /></div>
					</div>
				<?php endforeach; endif; ?>
			</div>
		</div>
	<?php endforeach ?>
	
	<div class="column addnew"><?php _e('Add Column', 'pricetable') ?></div>
	<div class="clear"></div>
</div>