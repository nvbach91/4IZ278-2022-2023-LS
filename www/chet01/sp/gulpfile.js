var gulp = require("gulp"),
  sass = require("gulp-sass")(require("sass")),
  postcss = require("gulp-postcss"),
  autoprefixer = require("autoprefixer"),
  cssnano = require("cssnano"),
  plumber = require("gulp-plumber"),
  browserSync = require("browser-sync").create();

var paths = {
  styles: {
    src: "./scss/**/*.scss",
    dest: "./styles",
  },
};

function style() {
  return gulp
    .src(paths.styles.src)
    .pipe(sass())
    .on("error", sass.logError)
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(plumber())
    .pipe(gulp.dest(paths.styles.dest))
    .pipe(browserSync.stream());
}

function reload() {
  browserSync.reload();
}

function watch() {
  browserSync.init({
    injectChanges: true,
    proxy: "http://localhost/semestralka/index.php",
    port: 8080,
  });

  gulp.watch(paths.styles.src, style);

  gulp.watch("./*.php", reload);
  gulp.watch("./*.php").on("change", browserSync.reload);

  gulp.watch("./*.html", reload);
  gulp.watch("./*.html").on("change", browserSync.reload);

  gulp.watch("./*/*.php", reload);
  gulp.watch("./*/*.php").on("change", browserSync.reload);

  gulp.watch("./scss/**/*.scss", reload);
  gulp.watch("./scss/**/*.scss").on("change", browserSync.reload);
}

exports.watch = watch;

exports.style = style;

/*
 * Specify if tasks run in series or parallel using `gulp.series` and `gulp.parallel`
 */
var build = gulp.parallel(style, watch);

/*
 * You can still use `gulp.task` to expose tasks
 */
//gulp.task('build', build);

/*
 * Define default task that can be called by just running `gulp` from cli
 */
gulp.task("default", build);
