# Pet Database Converter

PHP tools to convert rAthena pet_db.txt to JSON (.yml), YAML (.yml), or MySQL (.sql).

# Converting

## Convert to YAML

For converting to YAML is requried Symfony/YAML, this file is not using YAML of PHP's extension. So as long as have composer installed and PHP 7.1.3+, you only need to run `composer intall` in this project's root directory.

### Defaults
* Input: [rathena/db/pre-re/pet_db.txt](https://raw.githubusercontent.com/rathena/rathena/master/db/pre-re/pet_db.txt) and [rathena/db/re/pet_db.txt](https://raw.githubusercontent.com/rathena/rathena/master/db/re/pet_db.txt)
* Output: db/pre-re/pet_db.yml and db/re/pet_db.yml

### Available Arguments
* `-i="filename" : Full path and filename of pet_db.txt as input file
* `-o="filename" : Full path and filename for output file

### Usage
````
php petdb2yml.php
php petdb2yml.php -i="C:/MyDocument/rAthena/db/re/pet_db.txt" -o="pet_db.yml"
````


## Convert to JSON

The created file will be set as JSON but with .yml as file extension. YAML parser is able to read JSON, and by using .yml we don't need to change the file name in source

### Defaults
* Input: [rathena/db/pre-re/pet_db.txt](https://raw.githubusercontent.com/rathena/rathena/master/db/pre-re/pet_db.txt) and [rathena/db/re/pet_db.txt](https://raw.githubusercontent.com/rathena/rathena/master/db/re/pet_db.txt)
* Output: db/pre-re/pet_db.yml and db/re/pet_db.yml

### Available Arguments
* `-i="filename" : Full path and filename of pet_db.txt as input file
* `-o="filename" : Full path and filename for output file

### Usage
````
php petdb2json.php
php petdb2json.php -i="C:/MyDocument/rAthena/db/re/pet_db.txt" -o="pet_db.yml"
````


## Convert to MySQL

### Defaults
* Input: [rathena/db/pre-re/pet_db.txt](https://raw.githubusercontent.com/rathena/rathena/master/db/pre-re/pet_db.txt) and [rathena/db/re/pet_db.txt](https://raw.githubusercontent.com/rathena/rathena/master/db/re/pet_db.txt)
* Output: sql-files/pet_db.sql and sql-files/pet_db_re.sql

### Available Arguments
* `-i="filename" : Full path and filename of pet_db.txt as input file
* `-o="filename" : Full path and filename for output file
* `-o="table_name" : Table name for pet database in rAthena main database

### Usage
````
php petdb2sql.php
php petdb2sql.php -i="C:/MyDocument/rAthena/db/re/pet_db.txt" -o="pet_db.sql" -t="pet_db"
````
