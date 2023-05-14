// Get hovered element
const isHover = e => e.parentElement.querySelector(':hover') === e;    

// Add search-active class on searchbar
function searchActive(){
    $('#searchbar').addClass('search-active');
};

// Return search bar to normal when clicking outside
$(window).click(function(e) {
    if (!($(e.target).is('#searchbar'))) {
        $('#searchbar').removeClass('search-active');
    }
});

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if ($(document).scrollTop() > 120) {
    $('#header-wrap').addClass('h-20');
    $('#navbar').addClass('h-20');
  } else {
    $('#header-wrap').removeClass('h-20');
    $('#navbar').removeClass('h-20');
  }
} 