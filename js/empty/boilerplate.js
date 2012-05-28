// the semi-colon before function invocation is a safety net against concatenated
// scripts and/or other plugins which may not be closed properly.
;(function ( $, window, undefined ) {

  // undefined is used here as the undefined global variable in ECMAScript 3 is
  // mutable (ie. it can be changed by someone else). undefined isn't really being
  // passed in so we can ensure the value of it is truly undefined. In ES5, undefined
  // can no longer be modified.

  // window and document are passed through as local variables rather than globals
  // as this (slightly) quickens the resolution process and can be more efficiently
  // minified (especially when both are regularly referenced in your plugin).

  // Create the defaults once
  var pluginName = 'defaultPluginName',
      document = window.document,
      defaults = {
        propertyName: "value"
      };

  // The actual plugin constructor
  function Plugin( element, options ) {
    this.element = element;

    // jQuery has an extend method which merges the contents of two or
    // more objects, storing the result in the first object. The first object
    // is generally empty as we don't want to alter the default options for
    // future instances of the plugin
    this.options = $.extend( {}, defaults, options) ;

    this._defaults = defaults;
    this._name = pluginName;

    this.init();
  }

  Plugin.prototype.init = function () {
    // Place initialization logic here
    // You already have access to the DOM element and the options via the instance,
    // e.g., this.element and this.options
  };

  // A really lightweight plugin wrapper around the constructor,
  // preventing against multiple instantiations
  $.fn[pluginName] = function ( options ) {
    return this.each(function () {
      if (!$.data(this, 'plugin_' + pluginName)) {
        $.data(this, 'plugin_' + pluginName, new Plugin( this, options ));
      }
    });
  }

}(jQuery, window));
$('#elem').defaultPluginName({
  propertyName: 'a custom value'
});

////////////////
/**
 * Create an anonymous function to avoid library conflicts
 */
(function($) {
    /**
     * Add our plugin to the jQuery.fn object
     */
    $.fn.explainify = function(options) {
        /**
         * Define some default settings
         */
        var defaults = {
            "color": "#F00",
            "font-weight": "bold"
        };
        /**
         * Merge the runtime options with the default settings
         */
        var options = $.extend({}, defaults, options);
        /**
         * Iterate through the collection of elements and
         * return the object to preserve method chaining
         */
        return this.each(function(i) {
            /**
             * Wrap the current element in an instance of jQuery
             */
            var $this = $(this);
            /**
             * Do our kick-ass thing
             */
            $this.css("color", options.color);
        });
    };
})(jQuery);

    $(function() {
        $("h2").explainify({
            "color": "blue",
            "font-weight": "bold"
        });
    });