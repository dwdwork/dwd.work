import $ from 'jquery';

export default class Utils {
    hideOnScrollIntoView(elemInView, elemToHide) {
        const $elemInView = $(elemInView);
        const $elemToHide = $(elemToHide);
        if($elemInView.length === 0 && $elemToHide.length === 0 ) {
            return;
        }

        // inView returns a falsy value of true if $elemInView is visible on scroll
        // OR value of false if $elemInView isn't visible on scroll 
        let inView = $(elemInView).offset().top - $(window).scrollTop() < $(elemInView).height();

        if(inView) {
            $elemToHide.css('visibility', 'hidden');
            return;
        }

        $elemToHide.css('visibility', 'visible');
        return;
    }
}