$(document).ready(function() {
    // Next button click event
    $('.carousel-control-next').click(function() {
        $('#projectCarousel').carousel('next');
    });

    // Previous button click event
    $('.carousel-control-prev').click(function() {
        $('#projectCarousel').carousel('prev');
    });

    // Carousel slide event
    $('#projectCarousel').on('slide.bs.carousel', function(e) {
        let $nextItem = $(e.relatedTarget);
        let index = $nextItem.index();
        let numItems = $nextItem.siblings().length + 1;
        let newSlidePosition = Math.floor(index / 3);

        // Scroll to the new slide position
        $('#projectCarousel').carousel(newSlidePosition);
    });
});
