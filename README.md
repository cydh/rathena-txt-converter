# rAthena TXT Converter

Convert [rAthena](https://github.com/rathena/rathena) TXT DB Files to YAML (.yml) and MySQL (.sql). To convert TXT to pure YML format & file requires PHP 7.1.3+ for [Symfony/Yaml](https://packagist.org/packages/symfony/yaml). Meanwhile, convert to [JSON](http://json.org/) formatted file with .yml file extension, required PHP 5.2.0+.
> "- 08-APR-2005 -- As it turns out, YAML is a superset of the JSON serialization language"

So don't worry, YAML parser can read JSON file, read more about YAML [here](http://yaml.org/).

To use YAML converter (optional, you can use JSON), you need [composer](https://getcomposer.org/download/) installed (PHP 7.1.3+ required)

    composer install
