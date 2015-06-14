/**
 * @file
 * A JavaScript file for the theme.
 *
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - https://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
(function ($, Drupal, window, document, undefined) {


// To understand behaviors, see https://drupal.org/node/756722#behaviors
Drupal.behaviors.sideMenu = {
  attach: function(context, settings) {

    var $menuItem = $('#block-menu-block-govcms-menu-block-sidebar .menu__item');
    $menuItem.each(function(){
      $this = $(this);
      $this.removeClass('is-expanded');
    });

    $menuItem.click(function() {
      var $this = $(this);
      if(($this).children('.menu').length && ($this).hasClass('is-expanded')) {
        $this.children('.menu').slideUp('slow');
        $this.removeClass('is-expanded');
        return false;
      } else {
        $this.children('.menu').slideDown('slow');
        $this.addClass('is-expanded');
        return false;
      }
    });
  }
};


})(jQuery, Drupal, this, this.document);
