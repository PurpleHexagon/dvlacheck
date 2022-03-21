## Introduction

Project contains a vehicle check API written in PHP and an SPA frontend written in React.

## Using docker-compose


Docker compose setup has been provided for development and testing purposes only. This currently runs React start and 
uses PHP built in web server and is not fit for production use.

Build and start the image and container using:

```bash
$ docker-compose up -d --build
```

and then visit http://localhost:3000/ for frontend, API can be accessed here http://localhost:8888/api/vehicle/BD18HCC

or run as a CLI tool using the following command

```
docker-compose exec laminas vendor/bin/laminas vehicle:check "BD17 DAA" 
```

## Running Unit Tests

```bash
$ composer test
```

## Running Psalm Static Analysis

```bash
$ composer static-analysis
```

## QA Tools

We provide aliases for each of these tools in the Composer configuration:

```bash
# Run CS checks:
$ composer cs-check
# Fix CS errors:
$ composer cs-fix
# Run PHPUnit tests:
$ composer test
```
