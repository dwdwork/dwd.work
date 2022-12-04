import $, { timers } from 'jquery';

export default class HeaderFunctions {
    constructor(breakpoints){
        this.breakpoints = breakpoints;
    }
    
    keys = {
        tab:    9,
        enter:  13,
        esc:    27,
        space:  32,
        left:   37,
        up:     38,
        right:  39,
        down:   40
    };

    toggleMobile() {
        const hamburger = $('.hamburger');
        const menu = $('nav.site-nav');
        const overlay = $('.overlay');
        const close = $('.hamburger-close');

        hamburger.on('click', function() {
            menu.removeClass('hide');
            overlay.removeClass('hide');
        });

        close.on('click', function() {
            menu.addClass('hide');
            overlay.addClass('hide');
        });
    }

}