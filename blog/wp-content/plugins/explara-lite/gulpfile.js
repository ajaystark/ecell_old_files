var gulp = require('gulp');
var watch = require('gulp-watch');
var sass = require('gulp-ruby-sass');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');

var cssDir = 'public/scss';
var jsDir = 'public/js';


var jsListAdmin =
  [
    'public/js/admin.js',
  ];

gulp.task('watch', function() {
  gulp.watch(cssDir + '/**/*.scss', ['css', 'css-admin']);
  gulp.watch(jsDir + '/**/*.js', ['js']);
});

gulp.task('css-admin', function() {
  return sass('public/scss/admin.scss')
    .pipe(gulp.dest('./public/css'));
});

gulp.task('css', function() {
  return sass('public/scss/member.scss')
    .pipe(gulp.dest('./public/css'));
});

gulp.task('js', function() {

  gulp.src(jsListAdmin)
    .pipe(concat('admin-min.js'))
    //.pipe(uglify())
    .pipe(gulp.dest('./public/js/min/'));

});


gulp.task('default', ['css', 'js']);
