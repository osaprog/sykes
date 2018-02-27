To run this task, follow these steps:

1. composer install

2. define database parameters under app/config/parameters.yml
```
parameters:
    database_host: 127.0.0.1
    database_port: null
    database_name: sykes_interview
    database_user: root
    database_password: your_passport
```

4. import database sykes_interview

5. php bin/console server:start

6. call the url 127.0.0.1:8000 in the browser