# PHP's native session wrapper with namespacing
```php
<?php

use Okneloper\Session\Session;

// optional
Session::setDefaultNamespace('My Namespace');

// Start the session if necessay and Iniitialize a session object
$session = Session::newInstance();

$session->username = 'admin';
$session->foo = array('bar', 'baz');

print_r($_SESSION);
```

```
Array
(
    [My Namespace] => Array
        (
            [username] => admin
            [foo] => Array
                (
                    [0] => bar
                    [1] => baz
                )

        )

)
```

```php
$session1 = Session::newInstance('admin');

$session1->username = 'johndoe';
$session1->role = 'manager';

$session2 = Session::newInstance('profile');

$session2->username = 'the_master';
$session2->timestamp = time();

print_r($_SESSION);
```

```
Array
(
    [admin] => Array
        (
            [username] => johndoe
            [role] => manager
        )

    [profile] => Array
        (
            [username] => the_master
            [timestamp] => 1455371559
        )

)

```