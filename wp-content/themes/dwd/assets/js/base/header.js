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

}