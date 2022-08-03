6310450662 รัชต์ธร ทรงศรีวิสุทธิ์ (Pound)

6310450522 ธนบดี กังวลกิจ (nax)

6310451448 เอธัส สกุลพิทยาธร (mark)

docker run --rm \
-u "$(id -u):$(id -g)" \
-v $(pwd):/var/www/html \
-w /var/www/html \
laravelsail/php81-composer:latest \
composer install --ignore-platform-reqs

alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'

cp .env.example .env

sail up -d

sail artisan key:generate

sail npm install

sail npm run watch
