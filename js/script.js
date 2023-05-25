// Get hovered element
const isHover = e => e.parentElement.querySelector(':hover') === e;    

// Add search-active class on searchbar
function searchActive(){
    $('#searchbar').addClass('search-active');
    $('.search_icon').addClass('search-active');
};

// Return search bar to normal when clicking outside
$(window).click(function(e) {
    if (!($(e.target).is('#searchbar'))) {
        $('#searchbar').removeClass('search-active');
        $('.search_icon').removeClass('search-active');
    }
});

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  var buttons = $('div').filter('#subnav');
  if ($(document).scrollTop() > 120) {
    buttons.removeClass('p-1');
    buttons.addClass('px-1');
    $('#header').addClass('scrolled');
    $('.top-content').addClass('scrolled');
  } else {
    buttons.removeClass('px-1');
    buttons.addClass('p-1');
    $('#header').removeClass('scrolled');
    $('.top-content').removeClass('scrolled');
  }
} 


AOS.init();