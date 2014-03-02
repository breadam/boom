#  Laravel 4 Asset Management - Beta

**feedback appreciated**

## Contents

- [Overview](#Overview)
- [Installation](#Installation)
- [Configuration](#Configuration)
- [Usage](#Usage)
- [Contributors](#Contributors)

### Overview
	
	Boom is a Laravel 4 package that aims to ease the development of frontend code. 
	
### Installation

	1. Install node.js from 

	2. Add the following to your composer.json `"require-dev"` array 
    	
        `"breadam/boom": "dev-master"`

	3. Add the following to your app/config/app.php `"providers"` array

        `"Breadam\Boom\BoomServiceProvider"`
	
	4. Update composer
        
        `composer update`

### Configuration
	
	1. Publish config file: `php artisan config:publish breadam/boom`
		
	2. Publish templates: `php artisan view:publish breadam/boom`

#### Options

##### boom
	Path to boom folder. Contains package.json, bower.json and gulpfile.js files. Npm and Bower packages will be installed under this directory.
	
	default: app_path() / boom
##### source
	Path to source folder. Your fronted code goes here.
	
	default: app_path() / assets
##### target 
	Path to target folder. Compiled code goes here.
	
	default: public_path() / assets
	
#### Assets

    -- Coming soon --

#### boom:generate
		
	Generates package.json, bower.json, gulpfile.js, base.css, base.scss, base.less files.
	
	Options: 
	    --overwrite, --o
	    --npm 
	    --bower
	    --gulp
	    --css
	    --scss
	    --less

#### boom:install
	
	Install Npm and Bower dependencies. 
	
	Options: 
	    --npm 
	    --bower 
#### boom:update
	
	Update Npm and Bower dependencies. 
	
	Options: 
	    --npm 
	    --bower 	    
#### boom:build
	
	Compile/Build frontend code
	
	Options: 
	    --js
	    --coffee
	    --css
	    --scss
	    --less
#### boom:watch
    Watch for changes in source files and build automatically on change.
    
### Contributors
- breadam : [Github](https://github.com/breadam) | [Twitter](https://twitter.com/breadam) | [Facebook](https://facebook.com/breadam) | [LinkedIn](http://www.linkedin.com/in/breadam)