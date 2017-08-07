'use strict';

// Load plugins
var gulp = require('gulp');
var sass = require('gulp-ruby-sass');
var jshint = require('gulp-jshint');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var concat = require('gulp-concat');
var filter = require('gulp-filter');
var notify = require('gulp-notify');
var minifycss = require('gulp-minify-css');
var plumber = require('gulp-plumber');
var debug = require('gulp-debug');
var gutil = require('gulp-util');
var base64 = require('gulp-base64');
var imagemin = require('gulp-imagemin');
var clean = require('gulp-clean');
var htmlreplace = require('gulp-html-replace');


// error function for plumber
var onError = function (err) {
  console.log("======================================");
  gutil.beep();
  console.log(err);
  this.emit('end');
};

gulp.task('purge', function () {
	return gulp.src('./dist', {read: false})
		.pipe(clean())
    .pipe(notify({ message: 'Dist folder purged.' }));
});

// Optimize Images task
gulp.task('img', function() {
  var svgFilter = filter(['**', '!img/**/*.svg'], {restore: true});
  return gulp.src('./src/img/**/*.{gif,jpg,png,svg}')
    .pipe(plumber({ errorHandler: onError }))
    .pipe(debug({title: 'packing image:'}))
    .pipe(imagemin({
        //progressive: true,
        //interlaced: true,
        svgoPlugins: [ {removeViewBox:false}, {removeUselessStrokeAndFill:false} ]
    }))
    .pipe(gulp.dest('./dist/img/'))
});

// Optimize Images task
gulp.task('uploads', function() {
  var svgFilter = filter(['**', '!img/**/*.svg'], {restore: true});
  return gulp.src('../../uploads/**/*.{gif,jpg,png,svg}')
    .pipe(plumber({ errorHandler: onError }))
    .pipe(debug({title: 'packing image:'}))
    .pipe(imagemin({
        //progressive: true,
        //interlaced: true,
        svgoPlugins: [ {removeViewBox:false}, {removeUselessStrokeAndFill:false} ]
    }))
    .pipe(gulp.dest('../../compressed-uploads'))
});

// move and update html assets to have the new document paths.
gulp.task('fonts', function() {
  return gulp.src(['./src/fonts/**/*'])
    .pipe(plumber({ errorHandler: onError }))
    .pipe(debug({title: 'Deploying '}))
    .pipe(gulp.dest('./dist/fonts'));
});

// SCSS task
gulp.task('scss', function() {
  return sass('./src/scss/main.scss')
    .on('error', sass.logError)
    .pipe(plumber({ errorHandler: onError }))
    .pipe(base64({ extensions:['svg'] }))
    .pipe(gulp.dest('./src/stylesheets/'))
    .pipe(notify({ message: 'SCSS Task Complete.' }));
});

// CSS task
gulp.task('css', function() {
  return gulp.src('src/stylesheets/**/*')
    .pipe(plumber({ errorHandler: onError }))
    .pipe(concat('stylesheets.css'))
    .pipe(rename({ suffix: '.min' }))
    .pipe(minifycss())
    .pipe(gulp.dest('./dist/stylesheets/'));
});

// Lint JS task
gulp.task('jslint', function() {
  var removeVendorFiles = filter(['**', '!src/js/vendor/**']);
  return gulp.src(['./src/js/**/*.js'])
    .pipe(removeVendorFiles)
    .pipe(jshint())
    .pipe(jshint.reporter('default'))
    .pipe(jshint.reporter('fail'));
});

// if you need a specific order, use an array rather than the wildcard selector
gulp.task('javascript', function() {
  var removeVendorFiles = filter(['**', '!src/js/vendor/**', '!src/js/pages/**']);
  return gulp.src(['./src/js/**/*.js'])
    .pipe(plumber({ errorHandler: onError }))
    .pipe(debug({title:'input'}))
    .pipe(removeVendorFiles)
    .pipe(gulp.dest('./dist/js'))
    .pipe(concat('scripts.js'))
    .pipe(uglify())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('./dist/js'));
});

gulp.task('js-vendors', function() {
  var files = [
    './src/js/vendor/scrollmagic/scrollmagic/minified/ScrollMagic.min.js', //17
    './src/js/vendor/scrollmagic/scrollmagic/minified/plugins/animation.gsap.min.js', //2
    './src/js/vendor/gsap/minified/plugins/CSSPlugin.min.js', //41
    './src/js/vendor/gsap/minified/plugins/ScrollToPlugin.min.js', //4
    './src/js/vendor/responsiveslides/responsiveslides.min.js', //4
    './src/js/vendor/touchswipe/jquery.touchSwipe.min.js', //20
    './src/js/vendor/slick/slick.min.js' //41
  ]
  return gulp.src(files)//"./src/js/vendor/**/*.js")
    .pipe(plumber({ errorHandler: onError }))
    .pipe(concat('vendor.js'))
    //.pipe(uglify())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('./dist/js/vendor'));
});

gulp.task('js-pages', function() {
  return gulp.src("./src/js/pages/**/*.js")
    .pipe(plumber({ errorHandler: onError }))
    .pipe(uglify())
    //.pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('./dist/js/pages'));
})

// move and update html assets to have the new document paths.
gulp.task('app', function() {
  var removeJsFiles = filter(['**', '!src/js/**']);
  var removeScssFiles = filter(['**', '!src/scss/**']);
  var removeCssFiles = filter(['**', '!src/stylesheets/**']);
  var removeImgFiles = filter(['**', '!src/img/**']);
  var removeFontFiles = filter(['**', '!src/fonts/**']);

  return gulp.src(['./src/**/*.*', './src/.htaccess'])
    .pipe(plumber({ errorHandler: onError }))
    .pipe(removeJsFiles)
    .pipe(removeScssFiles)
    .pipe(removeCssFiles)
    .pipe(removeImgFiles)
    .pipe(removeFontFiles)
    .pipe(debug({title: 'Deploying '}))
    .pipe(htmlreplace({js:['/wp-content/themes/mount_ida/dist/js/scripts.min.js', '/wp-content/themes/mount_ida/dist/js/vendor/vendor.min.js'], css:['/wp-content/themes/mount_ida/dist/stylesheets/stylesheets.min.css']}))
    .pipe(gulp.dest('./dist'));
});

gulp.task('watchdev', function() {
  gulp.watch('./src/scss/**/*', ['scss']);
});

// Watch task
gulp.task('watch', function () {
  gulp.watch('./src/scss/**/*', ['scss']);
  gulp.watch('./src/stylesheets/**/*', ['css']);
  gulp.watch('./src/js/**/*', ['jslint', 'javascript']);
});

//tasks
gulp.task('default', ['scss', 'css', 'img', 'fonts', 'jslint', 'javascript', 'js-vendors', 'js-pages', 'app' ]); //'watch'
gulp.task('clean', ['purge']);
gulp.task('images', ['img']);
