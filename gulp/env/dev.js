var gulp        = require('gulp');
var browserSync = require('browser-sync');

gulp.task('browser-sync', function(done) {
  browserSync({
    proxy: "http://localhost:3010",
    open: false,
    middleware: [
      // Redirect http://localhost:3000/wp-login to http://localhost:3010/wp-login 
      // to prevent errors while editing WP settings (WP_SITEURL or WP_HOME) - @awea 20191023
      function(req, res, next) {
        if (req.url.includes('wp-login')) {
          res.writeHead(302, {
            'Location': 'http://localhost:3010/wp-login.php'
          })
          res.end()
        } else {
          next()
        }
      }
    ]
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