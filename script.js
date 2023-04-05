
$(document).click(function(event) { 
    var $target = $(event.target);
    if(!$target.closest('#menucontainer').length && $('#accountLogin').is(":visible") && !($(event.target).hasClass('open-button'))) {
        $('#accountLogin').hide();
    }        
});

function openLogin(){
    $('#accountLogin').show();
}

function closeLogin(){
    $('#accountLogin').hide();
}