$('document').ready(function() {
    var $grid = $('.posts.masonry').masonry({
      // options
      itemSelector: '.post-outer',
      columnWidth: '.post-outer',
      gutter: 0,
      percentPosition: true

    });

    $grid.imagesLoaded().progress( function() {
      $grid.masonry('layout');
    });
});