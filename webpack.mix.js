const mix = require('laravel-mix');
const {exec} = require('child_process')
const chokidar = require('chokidar');
const path = require('path')
const webpackConfig = require('./webpack.config')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.extend('ziggy', new class {
    register(config = {}) {
        this.watch = config.watch ?? ['routes/**/*.php'];
        this.path = config.path ?? '';
        this.enabled = config.enabled ?? !Mix.inProduction();
    }

    boot() {
        console.log("boot ziggy")

        if (!this.enabled) return;

        const command = () => exec(
            `php artisan ziggy:generate ${this.path}`,
            (error, stdout, stderr) => console.log(stdout)
        );
        console.log("exec ziggy")
        command();
        console.log("exec end ziggy")
        if (Mix.isWatching() && this.watch) {
            (chokidar.watch(this.watch))
                .on('change', (path) => {
                    console.log(`${path} changed...`);
                    command();
                });
        };
    }
}());

mix.webpackConfig(webpackConfig)

mix.ts('resources/js/app.ts', 'public/js')
    .vue({ version: 3 })
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),

    ])
    .ziggy({
        watch: ['routes/**/*.php'],
        path: "./resources/js/ziggy.generated.js",
        enabled: true,
    })
    .sourceMaps()
    .version()


