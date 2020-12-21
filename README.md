# Developer Challenge
Bienvenido! Los ejercicios requeridos son:

- account [Ver enunciado](account/)
- wordsearch [Ver enunciado](wordsearch/)

En cada carpeta del repositorio podrás ver el README.me de cada ejercicio en donde se encuentra su enunciado. En cada una de ellas, tendrás un archivo para implementar la solución solicitada y otro archivo con los tests.

Para ejecutar los test, podes usar los phpunit que ya están en el repositorio (phpunit-5.7.phar para php5.6/php5.7 y phpunit.phar php7 en adelante) dependiendo la versión de php que tengas instalada. Por ejemplo:
```
./phpunit-5.7.phar account/AccountTest.php
./phpunit-5.7.phar wordsearch/WordSearchTest.php
```
o
```
./phpunit.phar account/AccountTest.php
./phpunit.phar wordsearch/WordSearchTest.php
```
o si tenes problemas con PHPUnit podés correr los test alternativos
```
php account/AccountTestAlt.php
php wordsearch/WordSearchTestAlt.php
```
