# Cornerstone Fellowship Bible Church Web Site

## About
Web site theme files for Cornerstone Fellowship Bible Church, a Christian church located in Riverside, CA, United States of America

## Dependencies
- Concrete5 CMS version 5.6.0.2
	- PHP 5.3 with GD, Mod-rewrite
	- MySQL 4
- jQuery version 1.6

## Setup

1. Clone repository:  
	`` git clone git@github.com:ArtesianDesign/cornerstone-bible.git ``
2. Download [Concrete5 v. 5.6.0.2](http://www.concrete5.org/download_file/-/view/44326/8497/)
	- copy ``concrete`` directory from downloaded Cocnrete5 ZIP into ``/public_html``. This is the core app of the Concrete5 CMS. Don't worry, it's in the .gitignore file.
3. Set up the database
	- Create a MySQL database.
	- Obtain latest SQL file and import to your new DB
4. Create ``/public_html/config/site.php`` and enter your database details:   
	``<?php  
	define('DB_SERVER', 'localhost');  
	define('DB_USERNAME', 'your_db_user');  
	define('DB_PASSWORD', 'your_db_password');  
	define('DB_DATABASE', 'your_db_name');  
	define('DIR_REL', '');  
	define('PASSWORD_SALT', 'create_a_crazy_unique_string_here');  
	include('site_settings.php');  
	?>``
5. Edit admin user in database
	- find ``Users`` table, and row where ``uID`` is 1 or ``uName`` is admin
	- change e-mail and enter your md5-hashed password
6. [Download](http://www.cornerstonebible.org/files.20140701.tgz) ``/public_html/files`` and un-tar into ``/public_html``
	- ``tar -xvzf files.20140701.tgz``
	- Check permissions: ``/public_html/files`` and ``/public_html/packages`` should be writable by PHP
7. Setup PHP to serve from the ``public_html`` directory.

## Contributing

### Team Members:
Simple hot-fixes can be committed to ``master``. Any other modifications should be done in a branch.  
``git checkout -b feature_branch_name``  

Commit and push to origin often:  
- First-time push to GitHub: ``git push -u origin feature_branc_name``  
- Subsequent pushes: ``git push origin feature_branc_name``  
- always give clear, concise commit comments


### Non-team-members:  
Fork this repo and submit a pull request with your changes.

## Roadmap
- Upgrade to latest stable Concrete5 core
- Convert to [FireShell](http://getfireshell.com)-based Grunt build system for front-end
	- convert CSS to SASS
	- auto-minify + concatenate CSS and Javascript files for production
- Modify theme to be fully responsive

## Contributors
- Daniel Peterson [dpidan](https://github.com/dpidan)
- Brent Moen [bmoen](https://github.com/bmoen)
- Andrew Householder [aghouseh](https://github.com/aghouseh)

## License
The MIT License (MIT)

Copyright (c) 2010 Artesian Design Inc and Cornerstone Fellowship Bible Church

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.