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
    // Set the height of the news & jobs block by calculating the height
    // of the first three items of the higher block
    Drupal.behaviors.homepageBlockHeight = {
        attach: function(context, settings) {

            // adding a debounce function in order to prevent the resize
            // code from being called too often.
            // @see http://stackoverflow.com/a/9828919
            // @see https://davidwalsh.name/javascript-debounce-function
            // Returns a function, that, as long as it continues to be invoked, will not
            // be triggered. The function will be called after it stops being called for
            // N milliseconds. If `immediate` is passed, trigger the function on the
            // leading edge, instead of the trailing.
            var debounce = function (func, wait, immediate) {
                var timeout;
                return function() {
                    var context = this, args = arguments;
                    var later = function() {
                        timeout = null;
                        if (!immediate) func.apply(context, args);
                    };
                    var callNow = immediate && !timeout;
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                    if (callNow) func.apply(context, args);
                };
            };

            // set the height
            var setBlocksHeight = debounce(function() {
                var $blocks = $('#block-views-latest-news-block-1, #block-views-job-listing-block');
                var $blocksContentBlocks = $blocks.find('.view-content');
                if ($(window).width() >= 720) {
                    var $newsBlock = $('#block-views-latest-news-block-1');
                    var $jobsBlock = $('#block-views-job-listing-block');
                    var newsBlockHeight = $newsBlock.height();
                    var jobsBlockHeight = $jobsBlock.height();
                    var $higherBlock = $newsBlock;
                    var $higherBlockcontentBlock;
                    var $rows;
                    var calculatedHeight = 0;

                    // determine the higher block
                    if (jobsBlockHeight > newsBlockHeight) {
                        $higherBlock = $jobsBlock;
                    }

                    $higherBlockcontentBlock = $higherBlock.find('.view-content');
                    $rows = $higherBlockcontentBlock.find('> .views-row');
                    $rows.each(function (index) {
                        if (index <= 2) {
                            calculatedHeight += this.scrollHeight;
                        }
                    });
                    $blocksContentBlocks.height(calculatedHeight + 20);
                    $blocks.height(calculatedHeight + 131);
                }
                else {
                    $blocks.height('auto');
                    $blocksContentBlocks.height('auto');
                }
            }, 250);

            // first call
            setBlocksHeight();

            // on resize
            $(window).resize(function () {
                setBlocksHeight();
            });
	    
	    $(window).ready(function() {
	        setBlocksHeight();
	    });

        }
    };

})(jQuery, Drupal, this, this.document);
