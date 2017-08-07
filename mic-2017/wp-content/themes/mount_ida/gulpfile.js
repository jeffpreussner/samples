
// NOTE: STEVE & JEFF - LET'S TALK ABOUT HOW WE WANT TO SET UP THE TASK RUNNER

// Gulp packages
var gulp                   = require('gulp');
var filter                 = require('gulp-filter');
var uglify                 = require('gulp-uglify');
var concat                 = require('gulp-concat');
var cleanCSS               = require('gulp-clean-css');
var plumber                = require('gulp-plumber');
var sourcemaps             = require('gulp-sourcemaps');
var sass                   = require('gulp-sass');
var notify                 = require('gulp-notify');
var rename                 = require('gulp-rename');
var clean                  = require('gulp-clean');
var gutil                  = require('gulp-util');
var postcss                = require('gulp-postcss');
var merge                  = require('merge-stream');
var autoprefixer           = require('autoprefixer');
var flexibil
// Image plugins
var imagemin               = require('gulp-imagemin');
var imageminPngquant       = require('imagemin-pngquant');
var imageminJpegRecompress = require('imagemin-jpeg-recompress');

// Filepaths
var JS_PATH           = './src/js/**/*.js';
var JS_PAGES          = './src/js/pages/**/*.js';
var SCSS_PATH         = './src/scss/**/*.scss';
var IMG_PATH          = './src/img/**/*.{gif,jpg,jpeg,png,svg}';
var FONTS_PATH        = './src/fonts/**/*';
var PAGES_PATH        = './src/pages/**/*';

// Compiled CSS or SCSS paths
var CSS_COMPILE_DIR   = './src/stylesheets/';
var CSS_COMPILED      = './src/stylesheets/*.css';
var CSS_COMPILED_VEND = './src/stylesheets/**/*';

// Distribution filepaths
var CSS_DIST          = './dist/stylesheets/';
var JS_DIST           = './dist/js/';
var JS_PAGES_DIST     = './dist/js/pages';
var JS_VENDORS_DIST   = './dist/js/vendor';
var IMG_DIST          = './dist/img/';
var FONTS_DIST        = './dist/fonts/';
var PAGES_DIST        = './dist/pages/';


/*
|-----------------------------------------------------
| Error function for plumber
|-----------------------------------------------------
*/
var onError = function (err) {
    console.log("=================================");
    gutil.beep();
    console.log(err);
    this.emit('end');
};

/*
|-----------------------------------------------------------------------------------
| NOTE: This is a two part task (using merge-stream)
|
| SCSS task 1 -> CREATE -> './src/stylesheets/main.css'
| SCSS task 2 -> CREATE -> './src/stylesheets/*.all of the vendor files'
|
| NOTE: Certain css/scss libraries include fonts, icons, and other static assets
| that can not be compiled.  These assets must be excluded from the scss task.
|
| This task splits up the scss directory into scss assets, and non scss assets.
| Part 1 processes the scss while Part 2 moves the non scss assets.
|
| E.g. 'slick-theme.scss' includes '/fonts' and 'ajax-loader.gif'.  'slick-theme.scss'
| gets compiled with the other .scss files into './src/stylesheets/main.css'.
| The 'fonts' directory and the 'ajax-loader.gif' get moved into './src/stylesheets'
|
| slick-theme.scss that got compiled into 'main.css' references
| associated vendor files in the './src/stylesheets' directory.  Be sure to update
| filepaths accordingly.
|-----------------------------------------------------------------------------------
*/
gulp.task('scss', function(cb) {
    console.log('Starting scss task. Compiling SCSS to ' + CSS_COMPILE_DIR);

    // Part 1: Process scss -> './src/stylesheets/main.css'
    var compile = gulp.src([SCSS_PATH])
      .pipe(plumber({ errorHandler: onError }))
      .pipe(sourcemaps.init())
      .pipe(sass({
        includePaths: require('node-normalize-scss').includePaths
      }))
      .pipe(postcss([ autoprefixer({ browsers: ["> 0%"] }) ]))
      .pipe(postcss([ require('postcss-flexibility') ]))
      .pipe(sourcemaps.write())
      .pipe(gulp.dest(CSS_COMPILE_DIR))
      .pipe(notify({
        message: 'SCSS task complete.',
        onLast: true
      }));

    // Part 2: Move static assets -> './src/stylesheets/*.all of the vendor files (fonts, gifs, etc.)'

    // remove the assets that are compiled
    var removeSassFiles = filter(['**', '!src/scss/**/*.scss' ]);

    // specify directories with static assets using a glob pattern
    var files = [
      './src/scss/slick/**',
    ];

    var vendor = gulp.src(files)
      .pipe(plumber({ errorHandler: onError }))
      .pipe(removeSassFiles)
      .pipe(gulp.dest(CSS_COMPILE_DIR))
      .pipe(notify({
        message: 'SCSS Vendors - task complete.',
        onLast: true
      }));

    return merge(compile, vendor);
      cb(err); // the callback is used to make sure this task runs before the 'compile' task
});

/*
|------------------------------------------------------------------------------------
| Compile task (for distribution) -> CREATE -> './dist/stylesheets/main.min.css'
| NOTE: sourcemaps won't work for distribution css
|------------------------------------------------------------------------------------
*/
gulp.task('compile', ['scss'], function(cb) {
    console.log('Starting compile task. Compiling CSS to ' + CSS_DIST);

    return gulp.src(CSS_COMPILED)
      .pipe(plumber({ errorHandler: onError }))
      .pipe(concat('main.css'))
      .pipe(cleanCSS())
      .pipe(rename({ suffix: '.min' }))
      .pipe(gulp.dest(CSS_DIST))
      .pipe(notify({
        message: 'Compile task complete.',
        onLast: true
      }))
       cb(err); // the callback is used to make sure this task runs before the 'scss-vendors' task
});

/*
|------------------------------------------------------------------------------------
| SCSS vendors task (for distribution)
| CREATE -> './dist/stylesheets/*.all of the vendor files'
|------------------------------------------------------------------------------------
*/
gulp.task('scss-vendors', ['compile'], function() {
    console.log('Starting SCSS vendors task. Compiling vendor files to ' + CSS_DIST);

    // remove the compiled stylesheet; the rest of the assets will be moved
    var removeCssCompiled = filter(['**', '!src/stylesheets/*.css' ]);

    return gulp.src(CSS_COMPILED_VEND)
      .pipe(plumber({ errorHandler: onError }))
      .pipe(removeCssCompiled)
      .pipe(gulp.dest(CSS_DIST))
      .pipe(notify({
        message: 'SCSS vendors - distribution task complete.',
        onLast: true
      }));
});

/*
|-----------------------------------------------------------
| Javascript task -> CREATE -> './dist/js/main.min.js'
|-----------------------------------------------------------
*/
gulp.task('javascript', function() {
    console.log('Starting javascript task. Compiling JS to ' + JS_DIST);

    var removeVendorAndPageFiles = filter(['**', '!src/js/vendor/**', '!src/js/pages/**']);

    return gulp.src(JS_PATH)
      .pipe(plumber({ errorHandler: onError }))
      .pipe(removeVendorAndPageFiles)
      .pipe(sourcemaps.init())
      .pipe(uglify())
      .pipe(concat('main.js'))
      .pipe(sourcemaps.write())
      .pipe(rename({suffix: '.min'}))
      .pipe(gulp.dest(JS_DIST))
      .pipe(notify({
        message: 'JS task complete.',
        onLast: true
      }));
});

/*
|-------------------------------------------------------------
| Javascript pages task -> CREATE -> './dist/js/pages/*.js
| e.g. './dist/js/home.js'
|-------------------------------------------------------------
*/
gulp.task('js-pages', function() {
    console.log('Starting javascript pages task. Compiling JS pages to ' + JS_PAGES_DIST);

    return gulp.src(JS_PAGES)
      .pipe(plumber({ errorHandler: onError }))
      .pipe(uglify())
      .pipe(gulp.dest(JS_PAGES_DIST))
      .pipe(notify({
        message: 'JS pages task complete.',
        onLast: true
      }));
})

/*
|------------------------------------------------------------------------
| Javascript vendors task -> CREATE -> './dist/js/vendors/vendors.min.js
|------------------------------------------------------------------------
*/
gulp.task('js-vendors', function() {
    console.log('Starting javascript vendors task. Compiling JS pages to ' + JS_VENDORS_DIST);

    // specify order of concatination with an array
    var files = [
      './src/js/vendor/slick/slick.js',
      './src/js/vendor/isotope/isotope.pkgd.js',
      './src/js/vendor/retinajs/retina.min.js',
      './src/js/vendor/isotope/fit-columns.js',
      './src/js/vendor/responsify/responsify.js',
      './src/js/vendor/modernizr/modernizr.js',
      './src/js/vendor/flexibility/flexibility.js',
      './src/js/vendor/scrollmagic/scrollmagic/minified/ScrollMagic.min.js',
      './src/js/vendor/scrollmagic/scrollmagic/minified/plugins/animation.gsap.min.js',
      './src/js/vendor/scrollmagic/scrollmagic/minified/plugins/TweenMax.min.js',
      './src/js/vendor/scrollmagic/scrollmagic/minified/plugins/debug.addIndicators.min.js',
      './src/js/vendor/gsap/uncompressed/CSSPlugin.js' ,
      './src/js/vendor/gsap/uncompressed/ScrollToPlugin.js',
      './src/js/vendor/lethargy/lethargy.min.js'
      // './src/js/vendor/datatables/jquery.dataTables.min.js',
      // './src/js/vendor/datatables/dataTables.responsive.min.js'
    ];

    return gulp.src(files)
      .pipe(plumber({ errorHandler: onError }))
      .pipe(uglify())
      .pipe(concat('vendor.js'))
      .pipe(rename({suffix: '.min'}))
      .pipe(gulp.dest(JS_VENDORS_DIST))
      .pipe(notify({
        message: 'JS vendors task complete.',
        onLast: true
      }));
});

/*
|-----------------------------------------------------
| Images task -> Compress (lossy) images.
|-----------------------------------------------------
*/
gulp.task('images', function() {
    console.log('Starting images task. Compressing images to ' + IMG_DIST);

    return gulp.src(IMG_PATH)
      .pipe(plumber({ errorHandler: onError }))
      // NOTE: Don't need this until later
      // .pipe(imagemin(
  		// 	[
  		// 		imagemin.gifsicle(),
  		// 		imagemin.jpegtran(),
  		// 		imagemin.optipng(),
  		// 		imagemin.svgo(),
  		// 		imageminPngquant(),
  		// 		imageminJpegRecompress()
  		// 	]
  		// ))
      .pipe(gulp.dest(IMG_DIST))
      .pipe(notify({
        message: 'Images task complete.',
        onLast: true
      }));
});

/*
|-----------------------------------------------------
| Fonts task -> CREATE -> './dist/fonts/'
|-----------------------------------------------------
*/
gulp.task('fonts', function() {
    console.log('Starting fonts task. Moving fonts to ' + FONTS_DIST);

    return gulp.src(FONTS_PATH)
      .pipe(plumber({ errorHandler: onError }))
      .pipe(gulp.dest(FONTS_DIST))
      .pipe(notify({
        message: 'Fonts task complete.',
        onLast: true
      }));
});

/*
|-----------------------------------------------------
| Pages task -> CREATE -> './dist/pages'
|-----------------------------------------------------
*/
gulp.task('pages', function() {
    console.log('Starting pages task. Moving pages to ' + PAGES_DIST);

    return gulp.src(PAGES_PATH)
      .pipe(plumber({ errorHandler: onError }))
      .pipe(gulp.dest(PAGES_DIST))
      .pipe(notify({
        message: 'Pages task complete.',
        onLast: true
      }));
});

/*
|-------------------------------------------------------
| Watch task
|--------------------------------------------------------
*/
gulp.task('watch', function() {
    gulp.watch(SCSS_PATH, ['scss']);
});

/*
|----------------------------------------------------------------------
| Cleaning task -> DELETE './dist' and './src/stylesheets' directories
|----------------------------------------------------------------------
*/
gulp.task('clean', function () {
  	return gulp.src(['./dist', CSS_COMPILE_DIR], {read: false})
  		.pipe(clean())
      .pipe(notify({
        message: 'Dist & stylesheets directories purged.',
        onLast: true
      }));
});

/*
|-------------------------------------------------------------
| Default task
|-------------------------------------------------------------
*/
var defaultTasks = [
    'scss',
    'compile',
    'scss-vendors',
    'javascript',
    'js-pages',
    'js-vendors',
    'images',
    'fonts',
    'pages'
];

gulp.task('default', defaultTasks , function() {
    console.log('Starting DEFAULT task.');
});
