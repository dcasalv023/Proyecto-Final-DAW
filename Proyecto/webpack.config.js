const Encore = require('@symfony/webpack-encore');

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('app', './assets/js/app.js')
    .addEntry('DetallesProducto', './assets/js/DetallesProducto.js')
    .addEntry('price-range', './assets/js/price-range.js')
    .copyFiles({
        from: './assets/images',
        to: 'images/[path][name].[hash:8].[ext]',
    })
    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = '3.38';
    })
    .enableSassLoader()
    // Uncomment if you use TypeScript
    //.enableTypeScriptLoader()
    // Uncomment if you use React
    //.enableReactPreset()
    // Uncomment for integrity hashes
    //.enableIntegrityHashes(Encore.isProduction())
    //.autoProvidejQuery();

module.exports = Encore.getWebpackConfig();
