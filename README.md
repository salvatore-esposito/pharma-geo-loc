# pharma-geo-loc
### An application that finds all pharmacies at predetermined distance by a user.

#### Follow these steps to run this app:
* git clone https://github.com/salvatore-esposito/pharma-geo-loc.git your-directory
* cd your-directory
* docker-compose run --rm composer install
* docker-compose up -d --build app
* go to http://localhost:8080

#### To enabling development mode:
* docker-compose exec app yarn install
* docker-compose exec app yarn run watch-poll
* Go to http://localhost:3000
