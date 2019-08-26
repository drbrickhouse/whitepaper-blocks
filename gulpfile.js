const { src, dest, series, parallel, watch } = require('gulp');
const browserify = require('browserify');
const babel = require('babelify');
const source = require('vinyl-source-stream');
const buffer = require('vinyl-buffer');
const uglify = require('gulp-uglify');
const sass = require('gulp-sass');
const sourcemaps = require('gulp-sourcemaps');
const zip = require('gulp-zip');

const processBlocks = () => {
  return browserify({
    entries: ['src/blocks/loop-block.js', 'src/blocks/carousel-block.js', 'src/blocks/wrapper-block.js', 'src/blocks/hero-block.js'],
    debug: true
  })
  .transform('babelify', {presets: ['@babel/preset-react', '@babel/env'], sourceMaps: false})
  .bundle()
  .pipe(source('blocks.js'))
  .pipe(buffer())
  .pipe(uglify())
  .pipe(sourcemaps.init())
  .pipe(sourcemaps.write('maps'))
  .pipe(dest('build'));
}

const processSass = () => {
  return src('src/styles/*.scss')
    .pipe(sass())
    .pipe(dest('build/styles'));
}

const zipFiles = () => {
  return src(['build/**/*', 'templates/*', 'index.php', 'whitepaper-blocks-functions.php'], {base: './'})
    .pipe(zip('whitepaper-blocks.zip'))
    .pipe(dest('./'));
}

const watchSass = () => {
  watch('src/styles/*.scss', series(processSass, zipfiles));
}

const watchJS = () => {
  watch('src/**/*.js', series(processBlocks, zipFiles));
}

const watchPHP = () => {
  watch(['index.php', 'whitepaper-blocks-functions.php'], zipFiles);
}

const watchTemplates = () => {
  watch('templates/*.php', zipFiles);
}

const watchTask = () => {
  watch('src/**/*.js', series(processBlocks, zipFiles));
  watch('src/styles/*.scss', series(processSass, zipFiles));
  watch(['index.php', 'whitepaper-blocks-functions.php'], zipFiles);
  watch('templates/*.php', zipFiles);
}

exports.processBlocks = processBlocks;
exports.processSass = processSass;
exports.zipFiles = zipFiles;
exports.watchBlocks = watchJS;
exports.watchSass = watchSass;
exports.watchPHP = watchPHP;
exports.watchTemplates = watchTemplates;
exports.build = series(parallel(processBlocks, processSass), zipFiles);
exports.watch = watchTask;
exports.default = series(parallel(processBlocks, processSass), zipFiles, watchTask);
