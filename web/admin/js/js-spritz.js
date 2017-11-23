$(document).ready(function(){
    
        $("#myModal").modal('show');
    
});

$(document).on('click', '.number-spinner button', function () {    
	var btn = $(this),
		oldValue = btn.closest('.number-spinner').find('input').val().trim(),
		newVal = 0;
	
	if (btn.attr('data-dir') == 'up') {
		newVal = parseInt(oldValue) + 1;
	} else {
		if (oldValue > 1) {
			newVal = parseInt(oldValue) - 1;
		} else {
			newVal = 1;
		}
	}
	btn.closest('.number-spinner').find('input').val(newVal);
});

// Système de notification, messages d'alerte
var handleGritterNotification = function() {
	
	$('#add-without-image').click(function(){
		$.gritter.add({
			title: 'Message de notification, à personnaliser dans js-spritz',
			text: 'This will fade out after a certain amount of time.'
		});
		$("#myModal").modal('hide');
		return false;
	});
	
	$("#remove-all").click(function(){
		$.gritter.removeAll();
		return false;
	});
	
};


var Notification = function () {
	"use strict";
    return {
        //main function
        init: function () {
            handleGritterNotification();
        }
    };
}();