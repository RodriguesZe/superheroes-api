# Superheroes code challenge

This is a dockerized MVC application based on Laravel. The main goals were:

* Code that is clean, readable and easy to maintain.
* Organisation of an MVC project.
* Recognize and implement all the patterns/principles possible.
* Code documentation and organization.
* Ensure that the code is tested and ready to deploy to production.


## Endpoints available

* API entry endpoint
    - verb: `GET`
    - url: `/api`
    - description: Returns all the endpoints available in this API.

* List superheroes 
    - verb: `GET`
    - url: `/api/superheroes`
    - description: Returns all superheroes in the database, including all relationships
    
* Search superheroes
    - verb: `GET`
    - url: `/api/superheroes?name={name-here}`
    - description: The "superheroes list" endpoint can also handle a search functionality. It was only implemented a search by hero name (real or character) and by publisher.
       
* Show superheroes details
    - verb: `GET`
    - url: `/api/superheroes/{id}`
    - description: Show a superhero details      
    
* Update superheroes details 
    - verb: `PUT`
    - url: `/api/superheroes/{id}`
    - description: Edit a superhero details
    
    
## Run it locally    

### Requirements
* Docker
* Docker-compose

### Setup

1. Clone repository to <PATH_TO_REPO_ROOT>

2. Boot and run the docker instance by running the following commands:

```zsh
docker-compose build
```

```zsh
docker-compose up
```

3. Set up and populate the database

```
docker-compose exec <php_image_name> php artisan migrate:fresh --seed

# e.g. 
# docker-compose exec app vendor/bin/phpunit
```

4. Access the API by `http://localhost:8888/api`


## Running tests

```zsh
docker-compose exec <php_image_name> vendor/bin/phpunit

# e.g. 
# docker-compose exec app vendor/bin/phpunit
```
