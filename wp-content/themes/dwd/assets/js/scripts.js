import GlobalFunctions from './base/global';
import BlockFunctions from './base/blocks';
import HeaderFunctions from './base/header';
import PageFunctions from './pages/old-site';
import ServerFunctions from './server/server';

const breakpoints = {
    sm: '( min-width: 576px )',
    md: '( min-width: 768px )',
    lg: '( min-width: 992px )',
    xl: '( min-width: 1200px )',
    xxl: '( min-width: 1400px )',
};

const breakpointsMax = {
    sm: '( max-width: 576px )',
    md: '( max-width: 768px )',
    lg: '( max-width: 992px )',
    xl: '( max-width: 1200px )',
    xxl: '( max-width: 1400px )',
};

const globalFunctions = new GlobalFunctions();
const blockFunctions = new BlockFunctions();
const headerFunctions = new HeaderFunctions(breakpoints);
const pageFunctions = new PageFunctions();
const serverFunctions = new ServerFunctions();

/** Global Functions */
globalFunctions.convertSvgImgToSvgInline();
globalFunctions.smoothScroll();
globalFunctions.modal();
globalFunctions.lazyLoadVideo();
globalFunctions.toggleOpen();
globalFunctions.carouselFunction();
globalFunctions.collapsableAccordion();
globalFunctions.slickSlider();

/**Block Functions */
// blockFunctions.exampleFunction();

/** Header Functions */
headerFunctions.toggleMobile();
// headerFunctions.toggleMobileMenu(breakpoints);

/** Page Specific Functions */
pageFunctions.mobileNav();
pageFunctions.modalFunctions();

/** Server Specific Functions */
serverFunctions.logs();