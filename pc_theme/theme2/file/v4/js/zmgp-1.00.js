zmgp = {
    init: function() {
        if (zmConfig.pageName === "home") {
            zmgp.getPlayingW();
        }
        if (zmConfig.pageName === "profile") {
            zmgp.getBookmarkW();
        }
    },
    getPlayingW: function() {
        var url = "/zaw/fpw";
        var success = function(data) {
            var rs = JSON.parse(data);
            if (rs.err === 0) {
                zm(".cont_frdgameplaying").html(rs.data);
                zm(".cont_frdgameplaying").css("display", "block");
                zmEvent.fire("onRenderPlayingWidget");
            } else {
                zm(".cont_frdgameplaying").css("display", "none");
            }
        }
        zmCore.get(url, success);
    },
    getBookmarkW: function() {
        var url = "/zaw/bmw";
        var data = {
            ownerid: zmConfig.ownerId
        }
        var success = function(data) {
            var rs = JSON.parse(data);
            if (rs.err === 0) {
                zm(".cont_bookmarkapp").html(rs.data);
                zm(".cont_bookmarkapp").css("display", "block");
                zmEvent.fire("onRenderBookmarkAppWidget");
            } else {
                zm(".cont_bookmarkapp").css("display", "none");
            }
        }
        zmCore.get(url, data, success);
    },
    nextBookmark: function() {
        if (zm(".bmrkappthumb.hidden").get(0)) {
            var first = zm(".bmrkappthumb").get(0);
            first.addClass("hidden");
            zm(".bmrkapp_slider .slider_inner").append(first);
            zm(".bmrkappthumb.hidden").get(0).removeClass("hidden");
        }
    },
    prevBookmark: function() {
        if (zm(".bmrkappthumb.hidden").get(0)) {
            var last = zm(".bmrkappthumb.hidden").get(zm(".bmrkappthumb.hidden").length-1);
            last.removeClass("hidden");
            zm(".bmrkapp_slider .slider_inner").prepend(last);
            zm(".bmrkappthumb").get(3).addClass("hidden");
        }
    }
}
zm.ready(zmgp.init);


