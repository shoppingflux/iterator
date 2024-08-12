# Iterator Library

### Installation

```
composer require shoppingfeed/iterator
```

### Contributing

To connect to a php 8.1 container correctly configured

- Create a container : `docker run --name iterator-php -v $PWD:/var/www -d  ghcr.io/shoppingflux/php:8.1-unit`
- Connect to container : `docker exec -it iterator-php bash`

Once connected to the container you can :

- Update composer dependencies : `composer update`
- Run test : `composer test`
