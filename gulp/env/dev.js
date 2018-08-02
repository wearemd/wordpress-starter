var gulp        = require('gulp');
var browserSync = require('browser-sync');

gulp.task('browser-sync', function(done) {
  browserSync({
    proxy: "http://localhost:3010",
    open: false
  });

  done()
});

gulp.task('watch', function() {
  gulp.watch(["sass/**/*.sass", "sass/**/*.scss"], gulp.parallel('sass-stream'));

  // If changes happen in app directory then reload the browser.
  gulp.watch("app/**/*").on('change', browserSync.reload)

  // JS are compiled using webpack-stream with option watch set to true for performances reason.
  // So the script task never ends and we need to watch manually for changes on generated JS.
  // gulp.watch("site/js/*.js").on('change', browserSync.reload)
})

gulp.task('default', gulp.parallel('browser-sync', 'watch', 'sass', 'script'));