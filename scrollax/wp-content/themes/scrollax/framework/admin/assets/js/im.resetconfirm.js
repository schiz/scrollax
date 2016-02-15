missAdmin.resetConfirm = function () {
		jQuery('.miss_reset_button').click(function(e){
			if (missFramework.unlock == false) {
			}
			if (missFramework.unlock == true) {
				if (confirm(objectL10n.resetConfirm)){
					jQuery('#miss_full_submit').val(1);
				} else {
					e.preventDefault();
				}
			}
		});
};