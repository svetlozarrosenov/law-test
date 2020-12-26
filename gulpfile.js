var gulp = require('gulp');
var rename = require('gulp-rename');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var csso = require('gulp-csso');
var uglify = require('gulp-uglify');
var uglifyCss = require('gulp-uglifycss');
var concat = require('gulp-concat');
var webpack = require('webpack');
var webpackStream = require('webpack-stream');
var webpackConfig = require('./webpack.config.js');

var styleSRC = 'assets/src/css/*';
var styleDIST = './assets/dist/css/';
var jsSRC = 'assets/src/js/main.js';
var jsDIST = './assets/dist/js/';

var styleWatch = 'assets/src/css/**/*.css';
var jsWatch = 'assets/src/js/**/*.js';

gulp.task('styles', async function() {
	gulp.src(styleSRC)
		.pipe(sourcemaps.init())
		.pipe(autoprefixer())
		.pipe(uglifyCss())
		.pipe(sourcemaps.write('./'))
		.pipe(concat('all.min.css'))
		.pipe(gulp.dest(styleDIST));
});

gulp.task('js', async function() {
	gulp.src(jsSRC)
		.pipe(webpackStream(webpackConfig), webpack)
		.pipe(uglify())
		.pipe(gulp.dest(jsDIST));
});

gulp.task('default', gulp.series('styles', 'js'));

gulp.task('watch', async function() {
	gulp.watch(styleWatch, gulp.series('styles'));
	gulp.watch(jsWatch, gulp.series('js'));
});
