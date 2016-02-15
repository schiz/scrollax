<?php
	if ( !class_exists( 'miss_buddypress' ) ) {
		class MissBuddypress {
		}
	}
/**
 * is_buddypress
 * 
 * @return boolean true if buddypress is installed, false if not.
 */ 
function miss_is_buddypress(){
	if ( defined( 'BP_VERSION' ) ){ return true; }else{ return false; }
}

?>
