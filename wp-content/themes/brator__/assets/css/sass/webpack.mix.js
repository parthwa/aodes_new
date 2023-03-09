let mix = require('laravel-mix')
require('laravel-mix-serve')
mix.sass('./electronics/electronics-theme.sass', './electronics/electronics-theme.css')
.sourceMaps()