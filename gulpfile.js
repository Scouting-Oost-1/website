// Include gulp
var gulp = require('gulp');

// Include plugins
var log = require('fancy-log');
var colors = require('ansi-colors');

var concat = require('gulp-concat');
var uglify = require('gulp-uglify');

var plumber = require('gulp-plumber');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var prefix = require('gulp-autoprefixer');
var rename = require('gulp-rename');

var imagemin = require('gulp-imagemin');
var cache = require('gulp-cache');

// Include browsersync
var browserSync = require('browser-sync').create();


// Paths
var src = 'src/';
var dest = 'static/';

 // Concatenate & Minify JS
gulp.task('scripts', function() {
		return gulp.src(src + 'js/*.js')
				.pipe(plumber(function(error) {
						log(colors.red(error.message));
						this.emit('end');
				}))
				.pipe(concat('main.js'))
				.pipe(uglify())
				.pipe(gulp.dest(dest + 'js'));
});

gulp.task('scriptsDev', function() {
		return gulp.src(src + 'js/*.js')
				.pipe(plumber(function(error) {
						log(colors.red(error.message));
						this.emit('end');
				}))
				.pipe(sourcemaps.init())
				.pipe(concat('main.js'))
				.pipe(sourcemaps.write())
				.pipe(gulp.dest(dest + 'js'));
});

gulp.task('sass', function() {
		return gulp.src(src + 'scss/base.scss')
				.pipe(plumber(function(error) {
						log(colors.red(error.message));
						this.emit('end');
				}))
				.pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
				.pipe(prefix())
				.pipe(rename('main.css'))
				.pipe(gulp.dest(dest + 'css'));
});

gulp.task('sassDev', function() {
		return gulp.src(src + 'scss/base.scss')
				.pipe(plumber(function(error) {
						log(colors.red(error.message));
						this.emit('end');
				}))
				.pipe(sourcemaps.init())
				.pipe(sass().on('error', sass.logError))
				.pipe(sourcemaps.write())
				.pipe(rename('main.css'))
				.pipe(gulp.dest(dest + 'css'))
        .pipe(browserSync.stream());
});

gulp.task('copy-scss', function() {
		return gulp.src(src + 'scss/*.scss')
				.pipe(gulp.dest(dest + 'css'));
});

gulp.task('images', function() {
	return gulp.src(src + 'images/**/*')
		.pipe(cache(imagemin({ optimizationLevel: 5, progressive: true, interlaced: true })))
		.pipe(gulp.dest(dest + 'img'));
});

gulp.task('copy-fonts', function() {
		return gulp.src(src + 'fonts/*')
				.pipe(gulp.dest(dest + 'fonts'));
});



// Static Server + watching scss/html/js files
gulp.task('serve', function() {

    browserSync.init({
        files: ['_site/**'],
        port: 3000,
        proxy: '127.0.0.1:8080'
    });

    gulp.watch("src/scss/*.scss", gulp.series('sassDev'));
    gulp.watch("*.php").on('change', browserSync.reload);
    gulp.watch("src/js/*.js", gulp.series('scriptsDev'));
});


// Default task: serve with browserSync
gulp.task('default',
    gulp.series(
        'serve',
				gulp.parallel('sassDev', 'scriptsDev', 'copy-scss', 'images', 'copy-fonts')
    )
);

// Build task: everything minified only
gulp.task('build', gulp.parallel('scripts', 'sass', 'images', 'copy-fonts'));

gulp.task('clear', function() {
	// Still pass the files to clear cache for
	gulp.src('images/**')
		.pipe(cache.clear());
});
