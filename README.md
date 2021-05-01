# Simple Magnet-2-Torrent client based on an API

[![Build Status](https://cloud.drone.io/api/badges/danielTiringer/Magnet2Torrent/status.svg)](https://cloud.drone.io/danielTiringer/Magnet2Torrent)

I wanted to have a simple app that can convert a *magnet link* to a *.torrent* file easily.
Decided to go with Slim PHP for the backend as this application will require little added logic, and no database.

## Learnings

- Getting to know **Slim PHP** (no previous experience with the framework)
- Learn how to integrate templating (**twig**)
- Make a dockerized development environment with **Apache** (usually using Nginx)
- Use various features (e.g. form validation)
- Set up a CI/CD pipeline in **drone.io**

## Usage

### Install Docker

To get started, make sure you have Docker installed on your system, and then clone this repository.

### Create a Slim app

Creating a new Slim PHP application is handled by spinning up a Composer Docker container to generate it.
Find the details about slim applications on the [Slim Framework documentation site](https://www.slimframework.com/docs/v4/start/installation.html).

```sh
docker-compose run --rm composer require slim/slim:"4.*" guzzlehttp/psr7 http-interop/http-factory-guzzle
```
Because containers are run as `root` in base Docker containers, the files created by  the composer script are owned by `root`. To allow local editing of the Slim application files, change the owner of the files to the current user:
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

### Resources

- [Slim PHP documentation](https://www.slimframework.com/docs/v4/)
- [How to add twig views to your Slim application](https://stackoverflow.com/questions/57471005/how-to-add-twig-view-in-slimframework-v4)
