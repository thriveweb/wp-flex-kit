var gulp = require('gulp');
var bs = require('browser-sync').create();
var sass = require('gulp-sass');
var rucksack = require('gulp-rucksack');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var gutil = require('gulp-util');

// js
var browserify = require('browserify');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var buffer = require('vinyl-buffer');
var tap = require('gulp-tap');

var src = {
  scss: 'sources/scss/**/*.scss',
  css: './',
  php: '**/**/*.php',
  js: '**/**/*.js',
  cp_scss: '_components/**/*.scss',
  cp_js: '_components/**/*.js'
};

var ignore = '!node_modules/**';

// Static Server + watching scss/php files
gulp.task('serve', ['sass', 'scripts'], function () {
  bs.init({
    proxy: '192.168.33.15', // use localhost:8888 for MAMP
    open: false,
    port: 7777,
    plugins: ['bs-fullscreen-message'],
    notify: false
  });

  gulp.watch(src.scss, ['sass']);
  gulp.watch(src.cp_scss, ['cp_scss']);
  gulp.watch([src.js, src.cp_js, ignore, '!**/**.min.js'], ['scripts-watch']);
  gulp.watch([src.php, ignore]).on('change', bs.reload);
});

// Compile sass into CSS
gulp.task('sass', function () {
  return gulp.src(src.scss)
    .pipe(sourcemaps.init())
    .pipe(sass({
      outputStyle: 'compact'
    })
    .on('data', function () {
      bs.sockets.emit('fullscreen:message:clear');
    })
    .on('error', function (err) {
      bs.sockets.emit('fullscreen:message', {
        title: err.relativePath,
        body: err.message,
        timeout: 100000
      });
      gutil.log(err.message);
      this.emit('end');
    }))
    .pipe(autoprefixer())
    .pipe(rucksack())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(src.css))
    .pipe(bs.stream({
      match: '**/*.css'
    }));
});

// Compile sass into CSS
gulp.task('cp_scss', function () {
  return gulp.src(src.cp_scss)
    .pipe(sass({
      outputStyle: 'compressed'
    })
    .on('data', function () {
      bs.sockets.emit('fullscreen:message:clear');
    })
    .on('error', function (err) {
      bs.sockets.emit('fullscreen:message', {
        title: err.relativePath,
        body: err.message,
        timeout: 100000
      });
      gutil.log(err.message);
      this.emit('end');
    }))
    .pipe(autoprefixer())
    .pipe(rucksack())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('_components/.'));
});

gulp.task('cp_scripts', function () {
  return gulp.src([src.cp_js, '!**/**.min.js'], {read: false}) // no need of reading file because browserify does.
    .pipe(tap(function (file) {
      gutil.log('bundling ' + file.path);
      // replace file contents with browserify's bundle stream
      file.contents = browserify(file.path, {debug: true}).transform('babelify').bundle();
    }))
    // transform streaming contents into buffer contents (because gulp-sourcemaps does not support streaming contents)
    .pipe(buffer())
    // load and init sourcemaps
    .pipe(rename({suffix: '.min'}))
    .pipe(sourcemaps.init({loadMaps: true}))
    .pipe(uglify())
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('_components/.'));
});

gulp.task('scripts', function () {
  return gulp.src('./sources/js/main.js', {read: false}) // no need of reading file because browserify does.
    .pipe(tap(function (file) {
      gutil.log('bundling ' + file.path);
      // replace file contents with browserify's bundle stream
      file.contents = browserify(file.path, {debug: true}).transform('babelify').bundle();
    }))
    // transform streaming contents into buffer contents (because gulp-sourcemaps does not support streaming contents)
    .pipe(buffer())
    // load and init sourcemaps
    .pipe(rename({suffix: '.min'}))
    .pipe(sourcemaps.init({loadMaps: true}))
    .pipe(uglify())
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('js/.'));
});

gulp.task('scripts-watch', ['scripts', 'cp_scripts'], function (done) {
  done();
});

gulp.task('default', ['serve', 'cp_scss', 'cp_scripts']);
