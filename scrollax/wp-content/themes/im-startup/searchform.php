<form method="get" class="search-form" action="<?php echo home_url(); ?>/">
	<div class="row-fluid relative">
		<fieldset>
			<input type="text" name="s" class="span12 search-input" onfocus="if(this.value=='<?php _e( 'To search type and hit enter', MISS_TEXTDOMAIN ); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e( 'To search type and hit enter', MISS_TEXTDOMAIN ); ?>';" value="<?php _e( 'To search type and hit enter', MISS_TEXTDOMAIN ); ?>" speech x-webkit-speech />
			<i class="fa-icon-search add_to_last textfield im-has_icon_colour"></i>
	<!-- 		<input type="submit" name="s_submit" class="search-submit" value="<?php _e( 'Search', MISS_TEXTDOMAIN ); ?>" /> -->
		</fieldset>
	</div>
</form>
