const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const postcssPresetEnv = require("postcss-preset-env");
// We are getting 'process.env.NODE_ENV' from the NPM scripts
// Remember the 'dev' script?
const devMode = process.env.NODE_ENV !== "production";
module.exports = {
  // Tells Webpack which built-in optimizations to use
  // If you leave this out, Webpack will default to 'production'
  mode: devMode ? "development" : "production",
  // Webpack needs to know where to start the bundling process,
  // so we define the Sass file under './Styles' directory
  entry: ["./wp-content/themes/com6-theme/scss/_style.scss"],
  // This is where we define the path where Webpack will place
  // a bundled JS file. Webpack needs to produce this file,
  // but for our purposes you can ignore it
  output: {
    path: path.resolve(__dirname, "dist"),
    // Specify the base path for all the styles within your
    // application. This is relative to the output path, so in
    // our case it will be './wwwroot/css'
    // publicPath: "/css",

    // The name of the output bundle. Path is also relative
    // to the output path, so './wwwroot/js'
    filename: "com6-theme.js",
  },
  module: {
    // Array of rules that tells Webpack how the modules (output)
    // will be created
    rules: [
      {
        // Look for Sass files and process them according to the
        // rules specified in the different loaders
        test: /\.(sa|sc)ss$/,
        // Use the following loaders from right-to-left, so it will
        // use sass-loader first and ending with MiniCssExtractPlugin
        use: [
          {
            // Extracts the CSS into a separate file and uses the
            // defined configurations in the 'plugins' section
            loader: MiniCssExtractPlugin.loader,
          },
          {
            // Interprets CSS
            loader: "css-loader",
            options: {
              importLoaders: 2,
            },
          },
          {
            // Use PostCSS to minify and autoprefix with vendor rules
            // for older browser compatibility
            loader: "postcss-loader",
            options: {
              ident: "postcss",
              // We instruct PostCSS to autoprefix and minimize our
              // CSS when in production mode, otherwise don't do
              // anything.
              plugins: () => [
                postcssPresetEnv({
                  // Compile our CSS code to support browsers
                  // that are used in more than 1% of the
                  // global market browser share. You can modify
                  // the target browsers according to your needs
                  // by using supported queries.
                  // https://github.com/browserslist/browserslist#queries
                  browsers: [">1%"],
                  autoprefixer: {
                    flexbox: true
                  }
                }),
                require("cssnano")(),
              ],
            },
          },
          {
            // Adds support for Sass files, if using Less, then
            // use the less-loader
            loader: "sass-loader",
          },
        ],
      },
      {
        test: /\.(png|jpg|jpeg|gif|svg)$/i,
        use: [
          {
            loader: 'url-loader',
            options: {
              limit: 8192,
            },
          },
        ],
      },
    ],
  },
  plugins: [
    // Configuration options for MiniCssExtractPlugin. Here I'm only
    // indicating what the CSS output file name should be and
    // the location
    new MiniCssExtractPlugin({
      filename: devMode ? "[name].css" : "[name].min.css",
    }),
  ],
};
