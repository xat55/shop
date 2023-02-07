## Тестовое задание 

У вас интернет-магазин "Laravel Shop", в котором продаются разные товары. 
Со временем ассортимент увеличился, и мы открыли несколько городов в которых делаем доставку.

**Нам нужно добавить фильтры, чтобы человек мог посмотреть товары только в нужных категориях и городах**.
В будущем мы планируем внедрять дополнительные фильтрации, поэтому решение должно позволять добавить новые фильтры без изменения таблиц в БД.

**Требования к фильтрации:**
- Фильтр по категории – должен позволять выбрать только одну категорию товаров.
- Фильтр по городу – должен позволять выбрать один или несколько городов, в которых есть нужный товар.
- Можно выбрать категорию и города одновременно.
- Фильтрация должна работать на уровне БД.
- Не использовать кэш для ускорения фильтрации.

**Требования к тестовым данным**
- Необходимо написать seeder, который создаст 50 тысяч товаров, 100 категорий и 30 городов и перелинкует их.
- Названия товаров, категорий и городов могут быть случайными словами или идентификаторами, не нужно тратить на это время.

**Требования к интерфейсу**
- Полностью на ваше усмотрение, это может быть просто селект и список чекбоксов

Для фильтров должны быть написаны тесты, которые проверяют функционал из "требований к фильтрации".


### Как развернуть проект для разработки

Инструкция с использованием Docker (MacOS, Linux):

```bash
git clone git@github.com:sergshumakov/laravel-shop.git && cd laravel-shop

cp .env.example .env

docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
    
./vendor/bin/sail up -d

./vendor/bin/sail artisan key:generate

./vendor/bin/sail artisan migrate --seed

./vendor/bin/sail test
```




