const Encore = require('@symfony/webpack-encore');

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('public/build/') // Directorio donde Webpack colocará los archivos generados
    .setPublicPath('/build') // URL pública para acceder a los archivos generados
    .addEntry('app', './assets/js/app.js') // Entrada principal de tu aplicación
    .addEntry('DetallesProducto', './assets/js/DetallesProducto.js') // Entrada adicional para DetallesProducto
    .addEntry('price-range', './assets/js/price-range.js') // Entrada para el rango de precios
    .copyFiles({
        from: './assets/images', // Copia de imágenes desde assets
        to: 'images/[path][name].[ext]', // Se mantendrá la estructura y no se generará hash en el nombre del archivo
    })
    
    .splitEntryChunks() // Habilita la división de chunks para la carga dinámica
    .enableSingleRuntimeChunk() // Habilita un solo chunk para las dependencias comunes
    .cleanupOutputBeforeBuild() // Limpia la carpeta de salida antes de construir
    .enableBuildNotifications() // Habilita notificaciones de construcción
    .enableSourceMaps(!Encore.isProduction()) // Habilita Source Maps solo en desarrollo
    .enableVersioning(Encore.isProduction()) // Habilita la version de archivos para cacheo en producción
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage'; // Solo incluye los polyfills necesarios para el código que uses
        config.corejs = '3.38'; // Usar la versión 3.38 de core-js
    })
    .enableSassLoader() // Habilita el cargador de SASS para procesar archivos .scss
    // Uncomment si usas TypeScript
    //.enableTypeScriptLoader()
    // Uncomment si usas React
    //.enableReactPreset()
    // Uncomment para integridad de los hashes
    //.enableIntegrityHashes(Encore.isProduction())
    //.autoProvidejQuery(); // Habilita jQuery global si lo necesitas

module.exports = Encore.getWebpackConfig(); // Exporta la configuración final de Webpack
