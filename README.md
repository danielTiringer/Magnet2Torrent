# Simple Magnet-2-Torrent client based on an API

I wanted to have a simple app that can convert a *magnet link* to a *.torrent* file easily.
Decided to go with Slim PHP for the backend as this application will require little added logic, and no database.

### Install Docker

To get started, make sure you have Docker installed on your system, and then clone this repository.

### Create a Laravel app

Creating a new Slim PHP application is handled by spinning up a Composer Docker container to generate it.
Find the details about slim applications on the [Slim Framework documentation site](https://www.slimframework.com/docs/v4/start/installation.html).

```sh
docker-compose run --rm composer require slim/slim:"4.*" guzzlehttp/psr7 http-interop/http-factory-guzzle
```
Because containers are run as `root` in base Docker containers, the files created by  the composer script are owned by `root`. To allow local editing of the Laravel application files, change the owner of the files to the current user:
```sh
sudo chown -R $USER:$USER .
```

### Start the containers

From the respository's root run `docker-compose up -d --build`. Open up your browser of choice to [http://localhost:8080](http://localhost:8080) and you should see the app running as intended.

Extra containers have been added that handle Composer and PHPUnit commands without having to have these installed on your local computer or starting another copy of the main image. Use the following command templates from your project root, modifiying them to fit your particular use case:

``` sh
docker-compose run --rm composer update
docker-compose run --rm phpunit tests/
docker-compose run --rm phpunit --filter insert_test_name_here
```

Containers created and their ports (if used) are as follows:

- **php-apache** - `:8080`
- **composer**
- **phpunit**

### Troubleshooting
