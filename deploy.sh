git pull

npm i

sudo rm -f /dist/css/build.*
sudo rm -f /dist/js/bundle.js
sudo npm run js
sudo npm run css

yes | php composer.phar install
yes | php composer.phar dump-autoload