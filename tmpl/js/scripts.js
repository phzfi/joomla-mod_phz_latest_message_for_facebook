jQuery("div.facebook-post").ready(function(){
    jQuery('div.facebook-post p.message').each(function() {
        var fmessage = jQuery(this);
        if(fmessage.length != 0) {
            fmessage.html( Autolinker.link( fmessage.html() ) );
        }
    });
});

