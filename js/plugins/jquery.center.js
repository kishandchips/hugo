jQuery.fn.centerfill = function () {
    return this.each(function () {
        var iWidth = jQuery(this).width();
        var iHeight = jQuery(this).height();

        var parent = jQuery(this).parent();
        parent.css('position', 'relative');
        var pWidth = jQuery(parent).width();
        var pHeight = jQuery(parent).height();
        var scaleW = iWidth / pWidth;
        var scaleH = iHeight / pHeight;
        var scale = Math.min(scaleW, scaleH);
        var rWidth = iWidth / scale;
        var rHeight = iHeight / scale;
        jQuery(this).width(rWidth).height(rHeight).css({
            'position': 'absolute',
            'left': (rWidth - pWidth) / -2,
            'top': (rHeight - pHeight) / -2
        });
    });
};