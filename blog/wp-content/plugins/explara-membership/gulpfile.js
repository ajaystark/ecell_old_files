var gulp = require('gulp');
var watch = require('gulp-watch');
var sass = require('gulp-ruby-sass');
var uglify = require('gulp-uglifyjs');

var cssDir = 'public/scss';
var jsDir = 'public/js';


var jsListUser =
  [
    'public/js/vendor/flatpicker.js',
    'public/js/vendor/toast.js',
    'public/js/vendor/carousel.js',
    'public/js/vendor/swipe.js',
    'public/js/vendor/swipedefault.js',
    'public/js/think201-validator.js',
    'public/js/member.js',
    'public/js/member-account.js',
    'public/js/member-group.js',
    'public/js/member-discussion.js',
    'public/js/checkout.js',
  ];

var jsListAdmin =
  [
    'public/js/think201-validator.js',
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
  gulp.src(jsListUser)
    .pipe(uglify('min/member-min.js'))
    .pipe(gulp.dest('./public/js'));

  gulp.src(jsListAdmin)
    .pipe(uglify('min/admin-min.js'))
    .pipe(gulp.dest('./public/js'));

});


gulp.task('default', ['css', 'js']);