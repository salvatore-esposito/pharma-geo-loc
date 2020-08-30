# pharma-geo-loc
##An application that finds all pharmacies at predetermined distance by an user.

##Follow these steps to run this app:
*git clone https://github.com/salvatore-esposito/pharma-geo-loc.git your-directory
*cd your-directory
*git checkout develop
*docker-compose run --rm composer install
*docker-compose up -d app --build
*go to http://localhost:8080

##To enabling development mode:
*docker-compose exec app yarn install
*docker-compose exec app yarn run watch-poll
*http://localhost:3000
