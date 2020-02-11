

jQuery(document).ready(function($) {

	var feedbackSlider = $('.feedback-slider');
	feedbackSlider.owlCarousel({
		items: 1,
		nav: true,
		
		mouseScroll:'on',
		dots:false,
		autoplay: false,
		loop: true,
		mouseDrag: true,
		touchDrag: true,
		navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
		responsive:{

			// breakpoint from 767 up
			767:{
				nav: true,
				dots: false
			}
		}
	});
	function handleKeyboardNav(e) {
        if (!e) e = window.event;
        var kc = e.keyCode;
        if (kc == 37) feedbackSlider.trigger('prev.owl.carousel', [300]);;
        if (kc == 39) feedbackSlider.trigger('next.owl.carousel', [300]);
    }

    function bindKeyDownListener() {
        if (document.addEventListener)
            document.addEventListener("keydown", handleKeyboardNav, false);
        else if (document.attachEvent)
            el.attachEvent("onkeydown", handleKeyboardNav);
    }

    //start the binding
    bindKeyDownListener();

	feedbackSlider.on("translate.owl.carousel", function(){
		$(".feedback-slider-item h3").removeClass("animated fadeIn").css("opacity", "0");
		$(".feedback-slider-item img, .feedback-slider-thumb img, .customer-rating").removeClass("animated zoomIn").css("opacity", "0");
	});

	feedbackSlider.on("translated.owl.carousel", function(){
		$(".feedback-slider-item h3").addClass("animated fadeIn").css("opacity", "1");
		$(".feedback-slider-item img, .feedback-slider-thumb img, .customer-rating").addClass("animated zoomIn").css("opacity", "1");
	});
	feedbackSlider.on('changed.owl.carousel', function(property) {
		var current = property.item.index;
		var prevThumb = $(property.target).find(".owl-item").eq(current).prev().find("img").attr('src');
		var nextThumb = $(property.target).find(".owl-item").eq(current).next().find("img").attr('src');
		var prevRating = $(property.target).find(".owl-item").eq(current).prev().find('span').attr('data-rating');
		var nextRating = $(property.target).find(".owl-item").eq(current).next().find('span').attr('data-rating');
		$('.thumb-prev').find('img').attr('src', prevThumb);
		$('.thumb-next').find('img').attr('src', nextThumb);
		$('.thumb-prev').find('span').next().html(prevRating + '<i class="fa fa-star"></i>');
		$('.thumb-next').find('span').next().html(nextRating + '<i class="fa fa-star"></i>');
	});
	$('.thumb-next').on('click', function() {
		feedbackSlider.trigger('next.owl.carousel', [300]);
		return false;
	});
	$('.thumb-prev').on('click', function() {
		feedbackSlider.trigger('prev.owl.carousel', [300]);
		return false;
	});
	
$(".toggleMenu").on('click', function() {
    $("#mainMenu").toggleClass('open');
});
}); //end ready
