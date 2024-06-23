# Computer Based Test with Chat App

## Installation & updates

To install go to your terminal and use this command:

```bash

composer create-project codeigniter4/appstarter <name of your project>

```

then `composer update` whenever there is a new release of the framework.

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

In `Config/Session.php` make sure to use Database Driver to store session

```php
<?php

    namespace Config;

    use CodeIgniter\Config\BaseConfig;
    use CodeIgniter\Session\Handlers\BaseHandler;
    use CodeIgniter\Session\Handlers\DatabaseHandler;

    class Session extends BaseConfig
    {
        public string $driver = DatabaseHandler::class;

        // leave other codes as default
    }

```

And then create a migration using this command:

```bash
php spark make:migration CreateSessionTable
```

Modify the `TIMESTAMP_CreateSessionTable.php` file

```php

    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'VARCHAR', 'constraint' => 128, 'null' => false],
            'ip_address' => ['type' => 'VARCHAR', 'constraint' => 45, 'null' => false],
            'timestamp'  => ['type' => 'INT', 'constraint' => 10, 'unsigned' => true, 'default' => 0, 'null' => false],
            'data'       => ['type' => 'BLOB', 'null' => false],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('timestamp');
        $this->forge->createTable('ci_sessions', true);
    }
    
    public function down()
    {
        $this->forge->dropTable('ci_sessions', true);
    }

```

And then migrate the table:

```bash
php spark make:migration CreateSessionTable
```

## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> - The end of life date for PHP 8.1 will be December 31, 2025.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
