'use strict';

var gulp = require('gulp');

gulp.task('default', function() {
  gulp.src('./bower_components/bootstrap/dist/css/*.min.css')
    .pipe(gulp.dest('./css'));

  gulp.src([
    './bower_components/bootstrap/dist/js/*.min.js',
    './bower_components/jquery/dist/*.min.{js,map}'
  ])
    .pipe(gulp.dest('./js'));

  gulp.src('./bower_components/bootstrap/dist/fonts/*')
    .pipe(gulp.dest('./fonts'))
});
