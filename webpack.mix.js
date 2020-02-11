let mix = require('laravel-mix')

mix.options({processCssUrls: false})

mix.sass('src/scss/main.scss', 'assets/css/')

mix.scripts([
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/popper.js/dist/umd/popper.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.min.js',
    'node_modules/owl.carousel/dist/owl.carousel.min.js',
    'node_modules/jquery.inputmask/dist/jquery.inputmask.bundle.js',
    'node_modules/waypoints/lib/noframework.waypoints.js',
    'node_modules/@fancyapps/fancybox/dist/jquery.fancybox.min.js',

    'node_modules/jquery-ui/ui/widgets/datepicker.js',
    'node_modules/jquery-ui/ui/i18n/datepicker-ru.js',
    'node_modules/jquery-ui/ui/i18n/datepicker-uk.js',

    'src/js/main.js'
], 'assets/js/main.js')

mix.copy('src/img', 'assets/img')
