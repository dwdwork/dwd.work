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
        const menu = $('nav.site-nav').parent();
        const overlay = $('.overlay');
        const close = $('.hamburger-close');
        const header = $('#site-header');
        const body = $('body');

        menu.find('.mobile-toggle').height(header.height());

        hamburger.on('click', function() {
            menu.toggleClass('mobile-nav');
            menu.siblings().toggleClass('under');
            body.toggleClass('mobile-menu-visible');
            menu.find('.site-nav').toggleClass('hide');
            overlay.toggleClass('hide');
        });

        overlay.on('click', function() {
            menu.toggleClass('mobile-nav');
            menu.siblings().toggleClass('under');
            body.toggleClass('mobile-menu-visible');
            menu.find('.site-nav').toggleClass('hide');
            overlay.toggleClass('hide');
        });

        close.on('click', function() {
            menu.toggleClass('mobile-nav');
            overlay.addClass('hide');
        });
    }

}