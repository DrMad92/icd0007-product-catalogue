# Description

Web technologies course project. Product catalogue, table of categories, each category contains list of products. Category and products can be added, removed or edited.

## Students

* Muhammet Madraimov - 191487TAF
* Cem Hasgoren - 184048IVSB

## Installation

Use `composer` for dependency management.  
Composer for Linux/Unix/MacOS: [here](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos)  
Composer for Windows: [here](https://getcomposer.org/doc/00-intro.md#installation-windows)

Linux project setup:  

```bash
git clone https://gitlab.pld.ttu.ee/mumadr/icd0007-product-catalogue/
cd icd0007-product-catalogue
composer install
```

Propel ORM setup:  
For propel database connection settings: [link](http://propelorm.org/documentation/02-buildtime.html#building-the-model)  
For propel `config.php`: [link](http://propelorm.org/documentation/02-buildtime.html#runtime-connection-settings)  

After changing `schema.xml`:  
Rebuild classes:

```bash
./vendor/bin/propel model:build --config-dir propel/ --output-dir lib/ --schema-dir propel/
```  

Rebuild sql commmands:

```bash
./vendor/bin/propel sql:build --config-dir propel/ --output-dir propel/ --schema-dir propel/ --overwrite
```

Rebuild sql database:

```bash
./vendor/bin/propel sql:insert --config-dir propel/ --sql-dir propel/
```