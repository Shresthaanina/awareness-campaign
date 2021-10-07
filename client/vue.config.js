const webpack = require('webpack')
module.exports = {
    devServer: {
    
    },
    chainWebpack: config => {
      config.module.rules.delete('eslint');
    },
    configureWebpack: {
      plugins: [
        new webpack.ProvidePlugin({
          $: 'jquery',
          jquery: 'jquery',
          'window.jQuery': 'jquery',
          jQuery: 'jquery'
        })
      ]
    }
  }