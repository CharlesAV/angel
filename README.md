# Installation
Largely, we'll follow the instructions on https://github.com/JVMartin/angel, but here are a few additions I found useful.

First, we muts make sure to include a 'repositories' array to define that we're getting the package from a fork:

```js
{
    "repositories":
    [
        {
            "type": "vcs",
            "url": "https://github.com/CharlesAV/angel"
        }
    ],
    "require":
    {
        "laravel/framework": "4.1.*",
        "angel/core": "dev-master"
    },
}
```

Note: make sure you're calling "dev-master". Using 1.0.* doesn't work.

## Config

### Mail
Update the /app/config/mail.php file with our Angel Vision mail server credentials (see an existing AV Laravel project such as Prospera for these credentials).  We mus also input the from 'address' and 'name':

```php
'from' => array('address' => 'admin@mywebsite.com', 'name' => 'My Website'),
```
