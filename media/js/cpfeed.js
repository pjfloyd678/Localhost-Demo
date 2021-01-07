var cpFeed;
cpFeed = (function($) {
    var self = {
        feeds: [],
        count: 0,
        feeds_count: 0
    }
    self.run = function() {
        self.log(self.count);
    };
    self.log = function(text, type = 'normal') {
        if ( type !== 'error' && type !== 'success' ) {
            type = 'normal';
        }
        $('#cp-feeds-importer-results').append('<p class="'+ type +'">' + text + '</p>');
    };

} (jQuery));
