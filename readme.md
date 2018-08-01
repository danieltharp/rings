# Rings
A server manager for Trinity Core

## License
Rings is built using the [Laravel Framework](https://laravel.com) and [Twitter Bootstrap](http://getbootstrap.com/getting-started/#license-faqs) and, as such, is fully licensed under the [MIT License](http://opensource.org/licenses/MIT).

## Current Status
You may view the [Roadmap](https://github.com/pxdnbluesoul/rings/projects/1) for the most up-to-date status.

## Requirements
* PHP >7.1.0, 7.2.x is supported.
* [Composer](https://getcomposer.org/)
* MySQL or MariaDB database (not necessarily on the same machine as the Rings web server.
* Trinity Core (not necessarily on the same machine as the Rings web server. In fact it probably shouldn’t be.)

## Installation
1. Get Rings extracted somewhere your web server can serve from, and configure your Apache Virtual Host as [such](http://laravel-recipes.com/recipes/25/creating-an-apache-virtualhost). Bear in mind if this is a new web server you may need to add index.php to DirectoryIndex in your httpd.conf.
2. From the root of the rings directory: `chmod -R o+w storage` and `chmod -R o+w bootstrap/cache` before proceeding.
3. From the root of the Rings directory: `composer install` to finish the Laravel setup.
4. Edit the `.env` file in the root of the Rings directory and fill out, at a bare minimum, all entries that begin with AUTH_SERVER_ and RINGS_SERVER_. AUTH_SERVER refers to the Trinity Core ‘auth’ database. These could, theoretically, connect to the same database as there are no conflicting names. I would recommend keeping them separate though.
6. From the root of the Rings directory: `php artisan migrate` to create the databases needed for Rings.
5. From the root of the Rings directory: `php artisan rings:install` and enter the name of your server and the details of your first realm’s character and world databases. You can enter the remaining server details via Rings in the Admin Control Panel.

## Help
Please submit any issues to the [GitHub Page](https://github.com/pxdnbluesoul/rings/issues).

## Contributing
Rings is open to pull requests and contributions.

## Donations
Donations are always appreciated and make it more likely that new feature enhancements will be added to Rings. You can use [Paypal](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=BMHTKT3UN6YES) or via Bitcoin to 1KevDD98yMtUwbnbYACDXxrZBz12czWat7.
