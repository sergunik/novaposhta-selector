novaposhta-selector
===================

Data generator for NovaPoshta API. Retrieving data for select box: city list, departments list.

# Need Composer
First of all need to get Composer - https://getcomposer.org/download/


# Preparation (3 steps)
Step 1. Set permissions:
```
sh chmod 777 vendor json-data
```

Step 2. Load vendors:
```
php composer.phar install
```

Step 3. Put your own API key into conf.php.
Api key could be generated in my account https://my.novaposhta.ua/


# How to run?

Just run script (approx time: 2 mins):
```
php index.php
```


# That's all :)
All data (_city.json_ and _department.json_) cached in json-data folder.
Open file _form.html_ in browser and check it.


# Keep in mind
If you open _form.html_ localy in Google Chrome – could be problem with cross-domain loading.
Just check in other browser or upload to your server.