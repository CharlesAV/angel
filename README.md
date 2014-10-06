Usage:
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
        "angel/core": "dev-master"
    }
}
```

# Installation
Largely, we'll ofllow the instructions on https://github.com/JVMartin/angel, but here are a few additions I found useful.

## Config

### Mail
Update the /app/config/mail.php file with our Angel Vision mail server credentials (see an existing AV Laravel project such as Prospera for these credentials).  We mus also input the from 'address' and 'name':

```php
'from' => array('address' => 'admin@mywebsite.com', 'name' => 'My Website'),
```
