<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">

<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## JWT

'php artisan jwt:secret' or './vendor/bin/sail artisan jwt:secret' command may be required because [tymon/jwt-auth](https://github.com/tymondesigns/jwt-auth) package is used for generating json web tokens.

## Install via composer using Docker and Sail

Make sure that you have installed Docker(and WSL enabled for Windows)

- git clone git@github.com:mgevorg/laravel-react.git
- cd laravel-react
- composer install
- ./vendor/bin/sail up
- ./vendor/bin/sail artisan migrate
- ./vendor/bin/sail artisan jwt:secret
