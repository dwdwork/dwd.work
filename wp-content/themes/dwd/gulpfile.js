/* Gulp Dependencies
 * See: 
 * https://www.notion.so/onecaremedia/Build-Tools-3ca5a857db794bbc9b01bbce7c9cee2b
 */
const gulp = require('gulp');
const { watch, series } = require('gulp');

/* CSS Pipeline Dependencies
 * See: 
 * https://www.notion.so/onecaremedia/Build-Tools-3ca5a857db794bbc9b01bbce7c9cee2b
 */
const sass = require('gulp-sass')(require('sass'));
const cleanCSS = require('gulp-clean-css');
const sourcemaps = require('gulp-sourcemaps');
const criticalCss = require('gulp-critical-css');

/* JS Pipeline Dependencies
 * See: 
 * https://www.notion.so/onecaremedia/Build-Tools-3ca5a857db794bbc9b01bbce7c9cee2b
 */
const babel = require('gulp-babel');
const minify = require('gulp-babel-minify');
const browserify = require('browserify');
const babelify = require('babelify');
const source = require('vinyl-source-stream');
const buffer = require('vinyl-buffer');

/* SVG Icon Pipeline Dependencies
 * See: 
 * https://www.notion.so/onecaremedia/Icons-65e47e7c7c0d4d258eb25ce7ac32c316#50b313bf4d4e4b5e97f2582ddc6aadbc
 */
const svgstore = require('gulp-svgstore');
const svgmin = require('gulp-svgmin');
const path = require('path');
const cheerio = require('gulp-cheerio');

// clean tasks
const del = require('del');

// paths object
const paths = {
    scripts: {
        file: `scripts.js`,
        src: `./assets/js/scripts.js`,
        dest: `./build/js/`,
        watch: `./js/**/*.js`,
    },
    styles: {
        src: `./assets/scss/**/*.scss`,
        dest: `./build/css`,
    },
    adminStyles: {
        src: `./admin/scss/**/*.scss`,
        dest: `./build/admin/css`,
    },
    icons: {
        baseDir: `../../build/icons/`,
        src: `./icons/*.svg`,
        dest: `./build/icons`,
        cssDest: `./build/css/`,
        cssSrc: `./build/css/**/*.css`,
        spriteSrc: `./build/icons/*.svg`,
        spriteDest: `./build/icons/symbol/`,
        viewDest: `./build/icons/`,
    },
}

// not minified, uses sourcemaps for development, and generates critical css 
function developStyles() {
    return gulp.src( paths.styles.src )
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(criticalCss())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest( paths.styles.dest ));
};

// minified for production, no sourcemaps, and generates critical css
function buildStyles() {
    return gulp.src( paths.styles.src )
        .pipe(sass().on('error', sass.logError))
        .pipe(criticalCss())
        .pipe(cleanCSS())
        .pipe(gulp.dest( paths.styles.dest ));
};

// WP Admin not minified, uses sourcemaps for development, and generates critical css 
function adminDevelopStyles() {
    return gulp.src( paths.adminStyles.src )
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(criticalCss())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest( paths.adminStyles.dest ));
};

// WP Admin minified for production, no sourcemaps, and generates critical css
function adminBuildStyles() {
    return gulp.src( paths.adminStyles.src )
        .pipe(sass().on('error', sass.logError))
        .pipe(cleanCSS())
        .pipe(gulp.dest( paths.adminStyles.dest ));
};

// not minified, uses sourcemaps for development
function developScripts() {
    return browserify( paths.scripts.src, { debug: true } )
        .transform('babelify', { presets: [ "@babel/preset-env" ] } )
        .bundle()
        .pipe(source( paths.scripts.file, ))
        .pipe(buffer())
        .pipe(gulp.dest( paths.scripts.dest ));
}

// minified for production, no sourcemaps
function buildScripts() {
    return browserify( paths.scripts.src )
        .transform('babelify', { presets: [ "@babel/preset-env" ] } )
        .bundle()
        .pipe(source( paths.scripts.file ))
        .pipe(buffer())
        .pipe(minify())
        .pipe(gulp.dest( paths.scripts.dest ));
}


// minifies all svgs and adds an aspect ratio attribute for better resizing
function minifySvgs() {
    return gulp
        .src( paths.icons.src )
        .pipe(cheerio({
            run: function ($) {
                $('svg').attr( 'preserveAspectRatio', 'xMinYMin meet' );
            },
            parserOptions: { xmlMode: true }
        }))
        .pipe(svgmin((file) => {
            const prefix = path.basename(file.relative, path.extname(file.relative));
            return {
                plugins: [{
                    cleanupIDs: {
                        prefix: prefix + '-',
                        minify: true
                    },
                    removeViewBox: false
                }]
            }
        }))
        .pipe(gulp.dest( paths.icons.dest ));
}

// creates svg sprite for template icon usage, changes fill to currentColor for easy coloring
function createSvgSprite() {
    return gulp
        .src( paths.icons.spriteSrc )
        .pipe(cheerio({
            run: function ($) {
                $('[fill]').attr( 'fill', 'currentColor' );
            },
            parserOptions: { xmlMode: true }
        }))
        .pipe(svgstore())
        .pipe(gulp.dest( paths.icons.spriteDest ));
}

// remove entire build folder
function cleanAll() {
    return del([
        'build',
      ]);
}

// remove just the icons folder
function cleanIcons() {
    return del([
        'build/icons',
      ]);
}

// export command: gulp clean
exports.clean = cleanAll;

// export command: gulp build
exports.build = series( 
    // cleanAll,
    buildStyles, 
    adminBuildStyles, 
    buildScripts, 
    minifySvgs,
    createSvgSprite, 
);

// export command: gulp icons
exports.icons = series( 
    cleanIcons,
    minifySvgs,
    createSvgSprite, 
);

// export command: gulp develop
exports.develop = function () {
    watch([ 
        paths.styles.src, 
        paths.adminStyles.src, 
        paths.scripts.watch, 
    ], series( 
        developStyles, 
        adminDevelopStyles, 
        developScripts, 
    ));
};

// export command: gulp developstyles
exports.developstyles = function () {
    watch([ 
        paths.styles.src, 
    ], series( 
        developStyles,
        adminDevelopStyles,
    ));
};

// export command: gulp developscripts
exports.developstyles = function () {
    watch([ 
        paths.scripts.watch, 
    ], series( 
        developScripts, 
    ));
};