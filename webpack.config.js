const path = require('path');

module.exports = {
  mode: process.env.NODE_ENV || 'development',
  entry: {
    main: './assets/js/main.js',
  },
  output: {
    path: path.resolve(__dirname, 'assets/js'),
    filename: '[name].bundle.js',
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: [
              '@wordpress/babel-preset-default',
            ],
          },
        },
      },
      {
        test: /\.s?css$/,
        use: ['style-loader', 'css-loader', 'sass-loader'],
      },
    ],
  },
  devtool: process.env.NODE_ENV === 'production' ? false : 'source-map',
  performance: {
    maxEntrypointSize: 512000,
    maxAssetSize: 512000,
  },
};
