// Include gulp
var gulp = require("gulp");

// Include Our Plugins
var jshint = require("gulp-jshint");
var sass = require("gulp-sass");
var concat = require("gulp-concat");
var uglify = require("gulp-uglify");
var rename = require("gulp-rename");
var moreCSS = require("gulp-more-css");
var cssnano = require("gulp-cssnano");
var jade = require("gulp-jade");

var babel = require('gulp-babel');

var spritesmith = require('gulp.spritesmith');

var autoprefixer = require("gulp-autoprefixer");
 
// Compile Our Sass
gulp.task("sass", function() {
  return gulp.src("devResources/css/all.sass")
    .pipe(sass())
    .pipe(cssnano())
    .pipe(gulp.dest("kids/css"));
});
gulp.task("sass2", function() {
  return gulp.src("devResources/css/admin/admin.sass")
    .pipe(sass())
    .pipe(cssnano())
    .pipe(gulp.dest("kids/css"));
});
// Concatenate & Minify JS
gulp.task("scripts", function() {
  return gulp.src("devResources/js/*.js")
    .pipe(concat('all.js'))
    .pipe(uglify())
    .pipe(gulp.dest("kids/js/"));
});
gulp.task("scripts-admin", function() {
  return gulp.src("devResources/js/admin/*.js")
    .pipe(uglify())
    .pipe(gulp.dest("kids/js/admin"));
});
// Watch Files For Changes
gulp.task("watch", function() {
  gulp.watch(["devResources/js/*.js","devResources/js/admin/*.js"], [ "scripts", "scripts-admin"]);
  gulp.watch(["devResources/css/*.sass","devResources/css/helpers/*.sass","devResources/css/admin/*.sass"], ["sass", "sass2"]);
});

var imageop = require('gulp-image-optimization');
 
gulp.task('images', function(cb) {
    gulp.src(['devResources/img/*.png','devResources/img/*.jpg','devResources/img/*.gif','devResources/img/*.jpeg']).pipe(imageop({
        optimizationLevel: 10,
        progressive: true,
        interlaced: true
    })).pipe(gulp.dest('kids/img')).on('end', cb).on('error', cb);
});


gulp.task('images_icons', function(cb) {
    gulp.src(['devResources/img/icons/*.png','devResources/img/icons/*.jpg','devResources/img/icons/*.gif','devResources/img/icons/*.jpeg']).pipe(imageop({
        optimizationLevel: 8,
        progressive: true,
        interlaced: true
    })).pipe(gulp.dest('kids/img/icons')).on('end', cb).on('error', cb);
});

gulp.task('sprite', function() {
    var spriteData = 
        gulp.src('devResources/img/sprites/*.*') // путь, откуда берем картинки для спрайта
            .pipe(spritesmith({
                imgName: 'sprite.png',
                cssName: 'sprite.css',
                cssFormat: 'sass'
            }));

    spriteData.img.pipe(gulp.dest('devResources/img')); // путь, куда сохраняем картинку
    spriteData.css.pipe(gulp.dest('devResources/img')); // путь, куда сохраняем стили
});

gulp.task('sprite_p', function() {
    var spriteData = 
        gulp.src('devResources/img/sprites_p/*.*') // путь, откуда берем картинки для спрайта
            .pipe(spritesmith({
                imgName: 'sprite_p.png',
                cssName: 'sprite_p.css',
                cssFormat: 'sass'
            }));

    spriteData.img.pipe(gulp.dest('devResources/css')); // путь, куда сохраняем картинку
    spriteData.css.pipe(gulp.dest('devResources/css')); // путь, куда сохраняем стили
});

var concat = require('gulp-concat');
 
gulp.task('concat', function() {
  return gulp.src('kids/js/dist/*.js')
    .pipe(concat('all.js'))
    .pipe(uglify())
    .pipe(gulp.dest('kids/js/'));
});

// Default Task
//gulp.task("default", ["sass", "scripts","concat",  "watch"]);
gulp.task("default", ["sass", "sass2", "scripts","scripts-admin", "watch"]);


//2.0
gulp.task('scripts2', function(){
  return gulp.src('devResources/js/js2.0/*.js')
    .pipe(concat("all2.js"))
    .pipe(babel())
    .pipe(uglify())
    .pipe(gulp.dest('kids/js'))
});
gulp.task('scripts-test', function(){
  return gulp.src('devResources/js/test/*.js')
    .pipe(concat("test.js"))
    .pipe(babel())
    //.pipe(uglify())
    .pipe(gulp.dest('kids/js/test'))
});
gulp.task('sass2', function(){
  return gulp.src(['devResources/css/sass2.0/all.sass', 'devResources/js/test/*.sass'])
    .pipe(sass()) // Using gulp-sass
    .pipe(autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
    }))
    .pipe(concat("all.css"))
    .pipe(cssnano())
    .pipe(gulp.dest('kids/css'))
});
gulp.task('sass3', function(){
  return gulp.src('devResources/js/test/*.sass')
    .pipe(sass()) // Using gulp-sass
    .pipe(autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
    }))
    .pipe(concat("test.css"))
    .pipe(cssnano())
    .pipe(gulp.dest('devResources/js/test'))
});


gulp.task('watch2', function(){
  gulp.watch('devResources/css/sass2.0/*.sass', ['sass2']);
  gulp.watch('devResources/js/test/*.sass', ['sass2']);
  gulp.watch('devResources/js/js2.0/*.js', ['scripts2']); 
  gulp.watch('devResources/js/test/*.js', ['scripts-test']); 
  // Other watchers
});
gulp.task('watch3', function(){
  gulp.watch('devResources/js/test/*.sass', ['sass3']);
});
gulp.task("site", ["sass2", "sass3", "scripts2", "scripts-test", "watch2", "watch3"]);
