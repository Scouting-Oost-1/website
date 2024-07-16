// Include gulp
import gulp from 'gulp';

// Include plugins
import log from 'fancy-log';
import colors from 'ansi-colors';

import concat from 'gulp-concat';
import terser from 'gulp-terser';

import plumber from 'gulp-plumber';
import * as sass from 'sass';
import gulpSass from 'gulp-sass';
const usingSass = gulpSass(sass);
import sourcemaps from 'gulp-sourcemaps';
import prefix from 'gulp-autoprefixer';
import rename from 'gulp-rename';

import imagemin from 'gulp-imagemin';
import cache from 'gulp-cache';

// Include browsersync
import browserSyncImport from 'browser-sync'
var browserSync = browserSyncImport.create();


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
			.pipe(terser())
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
			.pipe(gulp.dest(dest + 'js'))
});

gulp.task('sass', function() {
	return gulp.src(src + 'scss/base.scss')
			.pipe(plumber(function(error) {
					log(colors.red(error.message));
					this.emit('end');
			}))
			.pipe(usingSass({outputStyle: 'compressed'}).on('error', usingSass.logError))
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
			.pipe(usingSass().on('error', usingSass.logError))
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
        proxy: 'https://so1.local'
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
gulp.task('build', gulp.parallel('scripts', 'sass', 'images'));

gulp.task('clear', function() {
	// Still pass the files to clear cache for
	gulp.src('images/**')
		.pipe(cache.clear());
});
