const path = require('path')
const webpack = require('webpack')
const VueLoaderPlugin  = require('vue-loader/lib/plugin')

module.exports = {
  entry: path.resolve(__dirname, 'src/app.js'),
  mode: 'development',
  devServer: {
    hot: true,
    headers: { 'Access-Control-Allow-Origin': '*' }
  },
  output: {
    path: path.resolve(__dirname, 'dist'),
    publicPath: 'http://localhost:8080/',
    filename: 'hybrid-vue-wp.js'
  },
  module: {
    rules: [
      {
        test: /\.vue$/,
        loader: 'vue-loader'
      },
      {
        test: /\.js$/,
        loader: 'babel-loader',
        exclude: /node_modules/
      },
      {
        test: /\.css$/,
        use: [
          'vue-style-loader',
          'css-loader'
        ]
      }
    ]
  },
  plugins: [
    new VueLoaderPlugin(),
    new webpack.HotModuleReplacementPlugin()
  ],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'src')
    }
  }
}
