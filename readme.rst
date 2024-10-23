###################
What is Digicash
###################

Digicash is a simple and efficient cash book management application built using CodeIgniter 3. It helps users keep track of cash inflows and outflows with an intuitive user interface. The project is designed to be lightweight, easy to use, and easily customizable.

###################
What is CodeIgniter
###################

CodeIgniter is an Application Development Framework - a toolkit - for people
who build web sites using PHP. Its goal is to enable you to develop projects
much faster than you could if you were writing code from scratch, by providing
a rich set of libraries for commonly needed tasks, as well as a simple
interface and logical structure to access these libraries. CodeIgniter lets
you creatively focus on your project by minimizing the amount of code needed
for a given task.

*******************
Release Information
*******************

This repo contains the source code for KasBook. To download the latest stable release, please visit the release page on this repository.


**************************
Changelog and New Features
**************************

For a complete list of all changes and updates, refer to the `changelog.txt` provided with this project.

*******************
Server Requirements
*******************

PHP version 5.6 or newer is recommended.

- PHP version 5.6 or newer
- MySQL/MariaDB database
- Apache/Nginx server
- Composer (optional)

************
Installation
************

1. Clone this repository to your local server:

    ```bash
    git clone https://github.com/nylzara/Digicash.git

2. Create a MySQL database for Digicash, e.g., buku_kas.

3. Import the database from buku_kas.sql to your MySQL database.

4. Configure the database connection in application/config/database.php:

    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'buku_kas',

5. Access the application at http://localhost/Digicash/.


*******
License
*******


This project is licensed under the MIT License. See the LICENSE file for more details.


*********
Resources
*********

-  `User Guide <https://codeigniter.com/docs>`_
-  `Contributing Guide <https://github.com/bcit-ci/CodeIgniter/blob/develop/contributing.md>`_
-  `Language File Translations <https://github.com/bcit-ci/codeigniter3-translations>`_
-  `Community Forums <http://forum.codeigniter.com/>`_
-  `Community Wiki <https://github.com/bcit-ci/CodeIgniter/wiki>`_
-  `Community Slack Channel <https://codeigniterchat.slack.com>`_

Report security issues to our `Security Panel <mailto:security@codeigniter.com>`_
or via our `page on HackerOne <https://hackerone.com/codeigniter>`_, thank you.

***************
Acknowledgement
***************

Special thanks to the contributors of CodeIgniter and the Digicash project, and to the open-source community for their continuous support.