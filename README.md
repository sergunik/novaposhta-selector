novaposhta-selector
===================

Data generator for NovaPoshta API. Retrieving data for select box: city list, departments list.

# Need Composer
First of all need to get Composer - https://getcomposer.org/download/


# How to run?
```
sh chmod 777 vendor json-data
php composer.phar install
php index.php
...
```

# That's all :)
All data (_city.json_ and _department.json_) cached in json-data folder.
Open file form.html in browser and check it.


# Keep in mind
If you open form.html localy in Google Chrome – could be problem with cross-domain loading.
Just check in other browser or upload to your server.