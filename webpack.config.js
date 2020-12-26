const path = require('path')
const { VueLoaderPlugin } = require('vue-loader')

var env = 'development';

module.exports = {
 	mode: 'development',
	entry: './assets/src/js/main.js',
	output: {
		filename: 'main.js',
		path: path.resolve(__dirname, 'dist/js/')
	},
	resolve: {
		modules: ['node_modules'],
		alias: {
			vue: 'vue/dist/vue.js'
		}
	},
	module: {
	rules: [
	  {
	    test: /\.vue$/,
	    loader: 'vue-loader'
	  },
	  {
	    test: /\.js$/,
	    loader: 'babel-loader'
	  },
	  {
	    test: /\.css$/,
	    use: [
	      'vue-style-loader',
	      'css-loader'
	    ]
	  },
	  {
	    test: /\.scss$/,
	    use: [
	      'vue-style-loader',
	      'css-loader',
	      {
	        loader: 'sass-loader',
	        options: {
	          data: '$color: red;'
	        }
	      }
	    ]
	  }
	]
	},
	plugins: [
		new VueLoaderPlugin()
	]
}
