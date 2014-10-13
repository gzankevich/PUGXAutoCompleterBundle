(function($) {
    $.fn.autocompleter = function (options) {
        var settings = {
            url_list: '',
            url_get:  ''
        };
        return this.each(function () {
            if (options) {
                $.extend(settings, options);
            }
            var $this = $(this);

            var $fakeInput = $('<input type="text" id="fake' + $this.attr('name') + '" placeholder="' + $this.attr('placeholder') + '" name="fake' + $this.attr('name') + '">');
            $this.hide().after($fakeInput);

            $fakeInput.autocomplete({
                source: settings.url_list,
                select: function (event, ui) {
                    $this.val(ui.item.id);
                }            
            });

            // autocomplete handles cases where an existing record is selected by setting the ID of the record in the original input's val attribute
            // this handles the case where a new record must be created by setting the string value of the record to be created in the original input's val attribute
            $fakeInput.keyup(function () {
                $this.val($fakeInput.val());
            });
        });
    };
})(jQuery);
