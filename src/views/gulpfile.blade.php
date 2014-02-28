var gulp = require('gulp');
var rename = require('gulp-rename');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var minifyCss = require('gulp-minify-css')
var coffee = require('gulp-coffee');
var less = require('gulp-less');
var sass = require('gulp-sass');

var assets = {{ $assets }};

gulp.task("coffee",function(){
	
	assets.coffee.order.push(assets.coffee.source+"/**/*.coffee");
	
	return gulp.src(assets.coffee.order)
						 .pipe(coffee())
						 .pipe(gulp.dest(assets.coffee.target));
});

gulp.task("less",function(){
	return gulp.src(assets.less.source+"/**/*.less")
						 .pipe(less())
						 .pipe(gulp.dest(assets.less.target));
});

gulp.task("scss",function(){
	return gulp.src(assets.scss.source+"/**/*.scss")
						 .pipe(sass())
						 .pipe(gulp.dest(assets.scss.target));
});

gulp.task("js",["coffee"],function(){
	
	assets.js.order.push(assets.js.source+"/**/*.js");
	
	return gulp.src(assets.js.order)
						 .pipe(concat("boom.js"))
						 .pipe(gulp.dest(assets.js.target))
						 .pipe(rename("boom.min.js"))
						 .pipe(uglify({outSourceMap:true}))
						 .pipe(gulp.dest(assets.js.target));
});

gulp.task("css",["scss","less"],function(){
	return gulp.src(assets.css.source+"/**/*.css")
						 .pipe(concat("boom.css"))
						 .pipe(gulp.dest(assets.css.target))
						 .pipe(rename("boom.min.css"))
						 .pipe(minifyCss({sourceMap:true}))
						 .pipe(gulp.dest(assets.css.target));
});

gulp.task("watch", function () {
  gulp.watch(assets.js.source+"/**/*.js",["js"]);
	gulp.watch(assets.coffee.source+"/**/*.coffee",["coffee","js"]);
	gulp.watch(assets.css.source+"/**/*.css",["css"]);
	gulp.watch(assets.scss.source+"/**/*.scss",["scss","css"]);
	gulp.watch(assets.less.source+"/**/*.less",["less","css"]);
});

gulp.task("default",["less","scss","css","coffee","js"]);