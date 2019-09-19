# ActiveCampaign
Paquete para el uso de la API de ActiveCampaign
Contiene métodos personalizados y soporte para laravel **5.x**

## Instalación
Instalación usando Composer.

`composer require talentui33/active-campaign`

Agregar las siguientes variables al archivo **.env**
````
ACTIVECAMPAIGN_API_URL='Your API Url'
ACTIVECAMPAIGN_API_KEY='Your API Key'
````

## Testing
Para el uso de los test se debe de crear la clase **TestCase.php** en el directorio `tests/` y debe de contener la siguiente estructura:

```php
<?php


namespace Tests;


use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected $userEmail = 'User email by default';
    protected function setUp(): void
    {
        parent::setUp();
        $this->app['config']->set('activecampaign.api_url', 'Your API Url');
        $this->app['config']->set('activecampaign.api_key', 'Your API Key');
    }
}
```

