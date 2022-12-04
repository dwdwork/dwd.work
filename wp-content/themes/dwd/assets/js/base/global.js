import $ from 'jquery';
import Utils from './utils';
const utils = new Utils();

export default class GlobalFunctions {
 
    /**
     * Define global variables
     */
    // keyboard keys used for accessibility
    keys = {
        tab:     9,
        enter:  13,
        esc:    27,
        space:  32,
        left:   37,
        up:     38,
        right:  39,
        down:   40
    };
    // screen sizes used for responsibility
    screens = {
        mobile:     425,
        tablet:     768,
        desktop:    992,
        desktopLG:  1200         
    };

    convertSvgImgToSvgInline() {
        $('img.inline-svg').each(function () {
            const $img = $(this);
            const imgID = $img.attr('id');
            const imgClass = $img.attr('class');
            const imgURL = $img.attr('src');
            const imgFill = $img.attr('fill');
            const imgWidth = $img.attr('width');
            const imgHeight = $img.attr('height');

            $.get(imgURL, function (data) {
                // Get the SVG tag, ignore the rest
                let $svg = $(data).find('svg');

                // Add replaced image's ID to the new SVG
                if (typeof imgID !== 'undefined') {
                    $svg = $svg.attr('id', imgID);
                }

                // Add replaced image's classes to the new SVG
                if (typeof imgClass !== 'undefined') {
                    $svg = $svg.attr('class', imgClass + ' replaced-svg');
                }

                // Add the fill if denoted
                if (typeof imgFill !== 'undefined') {
                    $svg = $svg.attr('fill', imgFill);
                }

                // replace all fills with currentColor
                $svg.find('[fill]').attr('fill', 'currentColor');

                // moves width over
                if (typeof imgWidth !== 'undefined') {
                    $svg = $svg.attr('width', imgWidth);
                }

                // moves height over
                if (typeof imgHeight !== 'undefined') {
                    $svg = $svg.attr('height', imgHeight);
                }

                // Remove any invalid XML tags as per http://validator.w3.org
                $svg = $svg.removeAttr('xmlns:a');

                // Replace image with new SVG
                $img.replaceWith($svg);

            }, 'xml');

        });
    }

    smoothScroll() {
        $('a[href^="#"].smooth-scroll, .smooth-scroll a[href^="#"]').on('click', function (e) {
            e.preventDefault();
            const hash = this.hash;
            const $target = $(hash);
            const offset = 150;

            if( history.pushState ) {
                history.pushState( null, null, hash );
            }
            else {
                location.hash = hash;
            }

            $('html, body').stop().animate({
                'scrollTop': $target.offset().top - offset
            }, 900, 'swing' );
        });
    }

    modal() {
        const modalTrigger = $('.modal-trigger');
        const modalClose = $('.modal-bg, .modal-close');

        $(modalTrigger).on('click', function (e) {
            e.preventDefault();
            $('body').addClass('has-modal');
            $(this).next('.modal').addClass('modal-show');
        });

        $(modalClose).on('click', function (e) {
            e.preventDefault();
            $('body').removeClass('has-modal');
            $(this).closest('.modal').removeClass('modal-show');
        });
    }

    toggleOpen() {
        $('.toggle-open').each( function() {
            const trigger = $(this).find('.toggle-trigger');

            $(trigger).on('click', function() {
                console.log('hi')
                const content = $(this).next('.toggle-content');
                $(this).toggleClass('toggle-trigger-closed')
                $('.toggle-content').not(content).slideToggle();
                $(content).slideToggle();
            });
        });
    }
    
    lazyLoadVideo() {
        const youtube = document.querySelectorAll( ".youtube" );
        
        for (var i = 0; i < youtube.length; i++) {
            const source = "https://img.youtube.com/vi/"+ youtube[i].dataset.embed +"/sddefault.jpg";
            const playlist = youtube[i].dataset.playlist;
            const isIos = /iPad|iPhone|iPod/.test(navigator.userAgent) ? true : false;
            const image = new Image();

            image.src = source;
            image.addEventListener( "load", function() {
                youtube[ i ].appendChild( image );
            }( i ) );

            const loadVideo = (youtubeVideo) => {
                const iframe = document.createElement( "iframe" );
                if( playlist ) {
                    iframe.setAttribute( "src", "https://www.youtube.com/embed/"+ youtubeVideo.dataset.embed +"?rel=0&showinfo=0?playsinline=1&autoplay=1&mute=1&cc_load_policy=1?version=3&enablejsapi=1" + "&amp;" + playlist );
                } else {
                    iframe.setAttribute( "src", "https://www.youtube.com/embed/"+ youtubeVideo.dataset.embed +"?rel=0&showinfo=0?playsinline=1&autoplay=1&mute=1&cc_load_policy=1&mute=1?version=3&enablejsapi=1" );
                }
                iframe.setAttribute( "frameborder", "0" );
                iframe.setAttribute( "allowfullscreen", "" );
                iframe.setAttribute( "allow", "autoplay" );
                // unmutes video incase users muted a previouse video or is muted by default
                iframe.onload = function() {
                    iframe.contentWindow.postMessage('{"event":"command","func":"playVideo","args":""}', '*');
                    iframe.contentWindow.postMessage('{"event":"command","func":"unMute","args":""}', '*');
                };
                youtubeVideo.innerHTML = "";
                youtubeVideo.appendChild( iframe );
            };

            if(isIos) {
                let youtubeVideo = youtube[i];
                let screenHeight = window.innerHeight;
                const isInView = () => {
                    if(youtubeVideo.getBoundingClientRect().top - screenHeight <= 0) {
                        document.removeEventListener('scroll', isInView);
                        loadVideo(youtubeVideo);
                    }
                }
                document.addEventListener('scroll', isInView)
                
            } else {
                youtube[i].addEventListener( "click", function() {
                    loadVideo(this);
                });
            };
        };
    }

    carouselFunction() {
        var screens = this.screens;
        
        function carousel() {

            if($(window).width() >= screens.tablet) {
                if( $('#carousel ').length ) {
                    const carouselContainer = document.querySelectorAll('#carousel');
        
                    Array.from(carouselContainer).forEach((container) => {
                        let position = 0;
                        const imageContainer = container.querySelector('#carousel-image-container');
                        const carouselList = imageContainer.querySelectorAll('#carousel-elements');
                        const carouselIndicator = container.querySelector('#carousel-indicator');
                        const carouselElement = carouselIndicator.querySelectorAll('#carousel-elements');
        
                        const stopVideos = () => {
                            const allVideos = document.querySelectorAll('iframe.iframe-videos')
                            if( allVideos.length ) {
                                allVideos.forEach(video => video.contentWindow.postMessage('{"event":"command","func":"stopVideo"}', '*'));
                            }
                        };
             
                        $(carouselElement).on('click', function(e) {
                            position = e.currentTarget.value;
                            const currentImage = imageContainer.querySelector('.selected');
                            const currentIndicator = carouselIndicator.querySelector('.selected');
        
                            stopVideos();
                            
                            currentImage.classList.toggle('selected');
                            carouselList[position].classList = 'selected';
                            currentIndicator.classList.toggle('selected');
                            carouselElement[position].classList.add('selected');
                        });
        
                        $(container.querySelectorAll('#carousel-btn')).on('click', function(e) {
                            const currentImage = imageContainer.querySelector('.selected');
                            const currentIndicator = carouselIndicator.querySelector('.selected');
        
                            if( e.currentTarget.getAttribute('data-value') === 'right' ) {
                                if(position === (carouselList.length - 1)) {
                                    position = 0;
                                } else position += 1;
                            } else {
                                if(position === 0) {
                                    position = (carouselList.length - 1)
                                } else position -= 1;
                            }
        
                            stopVideos();
        
                            currentImage.classList.toggle('selected');
                            carouselList[position].classList = 'selected';
                            currentIndicator.classList.toggle('selected');
                            carouselElement[position].classList.add('selected');
                        });
                    });
                };   
            }
        }

        $(window).on({
            load: function() {
                carousel();
            },
            resize: function() {
                carousel();
            }
        });
    }

    /**
     * Collapsable Accordian block
     */
    collapsableAccordion() {
        const accordionTrigger = $('button.collapsable-accordion-trigger');
        var keys = this.keys;

        function toggleAccordian(triggerTarget, triggerParent) {
            triggerTarget.slideToggle();

            if (!triggerParent.hasClass('open')) {
                triggerParent.addClass('open');
                accordionTrigger.attr('aria-expanded', 'true');
            } else {
                triggerParent.removeClass('open');
                accordionTrigger.attr('aria-expanded', 'false');
            }
        }

        accordionTrigger.on('click', function(e) {
            e.preventDefault();
            let accordionContent = $(this).siblings('.collapsable-accordion-content');
            let parent = $(this).parent();
            toggleAccordian(accordionContent, parent);
        });

        accordionTrigger.on('keydown', function(e) {
            switch (e.keyCode) {
                case keys.right:
                    $(this).parent().next().find('button').focus();
                break;
                case keys.left:
                    $(this).parent().prev().find('button').focus();
                break;
                case keys.down:
                    if (!$(this).parent().hasClass('open')) {
                        $(this).click();
                    } else {
                        $(this).parent().next().find('button').focus();
                    }
                break;
                case keys.up:
                    if ($(this).parent().hasClass('open')) {
                        $(this).click();
                    } else {
                        $(this).parent().prev().find('button').focus();
                    }
                break;
                case keys.esc:
                    $(this).blur();
                break;
            } 
            e.stopPropagation();
        });
    }

    slickSlider() {

        $('.slider').each(function() {

            let totalSlides = parseInt($(this).attr('total-slides'));
            let thisIsAnImageSlider = $(this).parent().hasClass('image-slider');
            let thisIsAnImageSliderNav = $(this).parent().hasClass('image-slider-nav');

            // Make an image slider
            if(thisIsAnImageSlider) {

                $(this).slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    infinite: true,
                    focusOnSelect: true,
                    asNavFor: '.image-slider-nav .slider',
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                arrows: false,
                                dots: false,
                                centerMode: true,
                                asNavFor: '.image-slider-nav .slider',
                                focusOnSelect: true,
                            }
                        }
                    ]
                });
            }

            // Make an image slider's nav with images
            if(thisIsAnImageSliderNav) {

                $(this).slick({
                    slidesToShow: totalSlides,
                    slidesToScroll: 1,
                    asNavFor: '.image-slider .slider',
                    arrows: false,
                    dots: false,
                    focusOnSelect: true
                });
            }

            // Make a regular slider
            if(!thisIsAnImageSlider && !thisIsAnImageSliderNav) {
                $(this).slick();
            }
        });
    }
}