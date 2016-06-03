# Items Api

This is an api to be consumed by web and mobile applications.

## Install the Application

To install this application you must use composer to manage dependencies.  Once composer is install, you will be left with a composer.phar file.

Clone this repository locally.  From inside the application directory, run:

    php /path/to/composer.phar update

Replace `/path/to/composer.phar` with the path to your composer.phar file.  After running the command, all dependencies will be resolved.

Open `/lib/mysql.php` and enter your appropriate mysql database credentials.

You will have to configure your webserver to point traffic to the correct directory.  I have used apache and my configuration is as follows:
`
	<Directory /Users/jimmypitts/dev>
	    AllowOverride FileInfo Options
	</Directory>

	<VirtualHost *:80>
	    ServerName jimmy.dev
	    ServerAlias www.jimmy.dev
	    DocumentRoot "/Users/jimmypitts/dev/varage-api/public"
	    ErrorLog "/private/var/log/apache2/jimmy.dev-error_log"
	    CustomLog "/private/var/log/apache2/jimmy.dev-access_log" common
	</VirtualHost>
`

## Testing

Two .sql scripts exist that will need to be run.  First, run `/database/mysql/schema/item.sql`, followed by `/database/mysql/scripts/data.sql`.  The test cases depend on the state of the database.

## Usage ##

There are two endpoints for the api.  One returns a single item, and the other returns an array of items.

An item has the structure:

```{
	id: int
	title: string
	description: string
	category: string
	price: float
	name: string
	latitude: float
	longitude: float
	status: string
	create_date: int
}```

/api/item/:id - this will return the above structure for the item with the given id.  If the item does not exist, a http 404 status code is returned.

/api/items - this will return an array of all available item.  Additionally there is an ability to filter this list based on the item category and the seller.  These are passed in as query parameters with the keys `seller` and `category`.  For example, `/api/items?category=Sports` would return all the items belonging to the sports category.


