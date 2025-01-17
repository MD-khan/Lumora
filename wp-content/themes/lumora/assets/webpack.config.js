/**
 * Webpack configuration for Lumora theme assets with Sass support.
 */

const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const { CleanWebpackPlugin } = require("clean-webpack-plugin");
const TerserPlugin = require("terser-webpack-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const CopyPlugin = require("copy-webpack-plugin");

const isProduction = process.env.NODE_ENV === "production";

// Paths
const JS_DIR = path.resolve(__dirname, "src/js");
const IMG_DIR = path.resolve(__dirname, "src/img");
const SASS_DIR = path.resolve(__dirname, "src/scss");
const BUILD_DIR = path.resolve(__dirname, "build");

module.exports = {
  // Entry points for JavaScript and Sass
  entry: {
    main: [JS_DIR + "/main.js", SASS_DIR + "/main.scss"], // Include SASS as part of the main entry
    editor: JS_DIR + "/editor.js",
  },

  // Output configuration
  output: {
    path: BUILD_DIR,
    filename: "js/[name].js",
  },

  // Source maps
  devtool: isProduction ? false : "inline-source-map",

  // Optimization settings
  optimization: {
    minimize: isProduction,
    minimizer: [
      new TerserPlugin({
        parallel: true,
        terserOptions: {
          format: {
            comments: false,
          },
        },
        extractComments: false,
      }),
      new CssMinimizerPlugin(),
    ],
  },

  // Loaders
  module: {
    rules: [
      {
        test: /\.js$/,
        include: [JS_DIR],
        exclude: /node_modules/,
        use: {
          loader: "babel-loader",
          options: {
            presets: ["@babel/preset-env"],
          },
        },
      },
      {
        test: /\.(scss|css)$/,
        include: [SASS_DIR],
        use: [
          MiniCssExtractPlugin.loader,
          "css-loader",
          {
            loader: "postcss-loader",
            options: {
              postcssOptions: {
                plugins: [
                  require("autoprefixer"),
                  // Add additional PostCSS plugins if needed
                ],
              },
            },
          },
          "sass-loader",
        ],
      },
      {
        test: /\.(png|jpg|jpeg|gif|ico)$/i,
        type: "asset/resource",
        generator: {
          filename: "images/[name][ext]",
        },
      },
      {
        test: /\.(woff(2)?|eot|ttf|otf)$/i,
        type: "asset/resource",
        generator: {
          filename: isProduction
            ? "fonts/[name].[hash][ext]"
            : "fonts/[name][ext]",
        },
      },
    ],
  },

  // Plugins
  plugins: [
    new CleanWebpackPlugin(),
    new MiniCssExtractPlugin({
      filename: "css/[name].css", // Output CSS file
    }),
    new CopyPlugin({
      patterns: [{ from: IMG_DIR, to: BUILD_DIR + "/images" }],
    }),

  ],

  // Development server
  devServer: {
    static: {
      directory: BUILD_DIR,
    },
    compress: true,
    port: 9000,
    open: true,
    hot: true,
    client: {
      overlay: {
        errors: true,
        warnings: true,
      },
    },
  },
};
