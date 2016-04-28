(function() {
    function IntroSlider(options) {
        this.$container = options.$container;
        this.$items = options.$container.find('.b-intro-slide');
        this.$prev = options.$container.find('.nav.prev');
        this.$next = options.$container.find('.nav.next');
        this.$dots = options.$container.find('.dot');
        this.timeInterval = 10000;
        this.idInterval;
        this.step = 0;
        this.init();
    };
    IntroSlider.prototype.init = function() {
    	this.setActiveItem(this.step);
    	this.attachEvents();
    	this.run();
    };
    IntroSlider.prototype.clearActiveItems = function() {
        this.$items.removeClass('active');
        this.animationClear();
    };
    IntroSlider.prototype.refreshDots = function() {
        this.$dots.removeClass('active');
        this.$dots.eq(this.step).addClass('active');
    };
    IntroSlider.prototype.setActiveItem = function(itemNumber) {
    	this.clearActiveItems();
        this.$items.eq(itemNumber).addClass('active');
        this.refreshDots();
        this.animationStart();
    };
    IntroSlider.prototype.animationStart = function() {
        this.$items.eq(this.step).find('.animated').each(function(){
            $(this).addClass($(this).attr('data-animation'));
        });
    };
    IntroSlider.prototype.animationClear = function() {
        this.$items.find('.animated').each(function(){
            $(this).removeClass($(this).attr('data-animation'));
        });        
    };
    IntroSlider.prototype.checkOnLastItem = function() {
    	if ( this.step === this.$items.length ) {
    		this.step = 0;
    	}
    };
    IntroSlider.prototype.checkOnFirstItem = function() {
        if ( this.step < 0 ) {
            this.step = this.$items.length - 1;
        }
    };
    IntroSlider.prototype.goToNext = function() {
        this.step = this.step + 1;
        this.checkOnLastItem();
        this.setActiveItem(this.step);
    };

    IntroSlider.prototype.goToPrev = function() {
        this.step = this.step - 1;
        this.checkOnFirstItem();
        this.setActiveItem(this.step);
        console.log(this.step);
    };

    IntroSlider.prototype.run = function() {
    	var that = this;
    	this.idInterval = window.setInterval(function(){
            that.goToNext();
    	},this.timeInterval); 
    };

    IntroSlider.prototype.stop = function() {
    	window.clearInterval(this.idInterval); 
    };
    IntroSlider.prototype.attachEvents = function() {
        var that = this;
        this.$prev.on('click', function(e) {
            e.preventDefault();
            that.stop();
            that.goToPrev();
            that.run();
        }); 
        this.$next.on('click', function(e) {
            e.preventDefault();
            that.stop();
            that.goToNext();
            that.run();
        }); 
        this.$dots.on('click', function(e) {
            e.preventDefault();
            that.stop();
            that.step = $(this).index();
            that.setActiveItem(that.step);
            that.run();
        });      
    };
    window.IntroSlider = IntroSlider;
})();

$(function() {
    var intro_slider = new IntroSlider({
        $container: $('.b-intro-slider')
    });
});