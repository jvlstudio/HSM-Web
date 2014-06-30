/* JQuery - isLoaded */

jQuery.fn.isLoaded = function() {
    return this
             .filter("img")
             .filter(function() { return this.complete; }).length > 0;
};