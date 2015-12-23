/**
 * @file
 * A JavaScript file for handling clicking on external links.
 */
(function ($, Drupal, window, document, undefined) {
    Drupal.behaviors.externalLinks = {
        clickedExternal: false,
        attach: function(context, settings) {
            var self = this;

            // detect if external link
            $('a').click(function (event) {
                if (this.host != location.host) {
                    self.clickedExternal = true;
                }
            });

            window.onbeforeunload = function(e) {
                // if an external link was clicked, confirm before leaving
                if (self.clickedExternal) {
                    self.clickedExternal = false;
                    return 'Following this link will make you leave the CrimTrac website.';
                }
                else {
                    return;
                }
            };
        }
    };
})(jQuery, Drupal, this, this.document);