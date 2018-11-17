(function ($) {
    'use strict';
    var NHNUser = function (element, options, cb) {
        this.element = element;
        this.$element = $(element);
        this.imagePreviewWrapperSelector = '.image-preview-wrapper';
    };

    NHNUser.prototype = {
        _init: function () {
            this.addImage();
            this.iCheck();
        },
        addImage: function () {
            $(this.imagePreviewWrapperSelector).uploadPreview();
        },
        iCheck: function() {
            $('input[type="checkbox"]').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
        }
    };
    /* Execute main function */
    $.fn.nhnuser = function (options, cb) {
        this.each(function () {
            var el = $(this);
            if (!el.data('nhnuser')) {
                var nhnUser = new NHNUser(el, options, cb);
                el.data('nhnuser', nhnUser);
                nhnUser._init();
            }
        });
        return this;
    };
})(jQuery);

$(function () {
    $('#user-wrap').nhnuser();
});
