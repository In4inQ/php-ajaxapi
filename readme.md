# PHP Ajax-API
## Step one - create config
```php
namespace Settings;
use Api\AbstractConfig;

class Config extends AbstractConfig{
    
    /**
     * @return array
     */
    protected function getMethods() : array{
        return [
            'do.something' => '\\Methods\\Do\\Something'
        ];
    }
    
}
```

## Step two - create method
```php
namespace Methods\Do\Something;
use Api\AbstractMethod;
use Api\Error;

class Something extends AbstractMethod{

    /**
     * @return array
     */
    protected function getOptions() : array{
        return [
            'someOption' => 'someValue',
            'vars' => [
                'someVar' => [
                    'required' => false,
                    'default' => 228,
                    'type' => 'number'
                ]
            ]
        ];
        
    }
    
    /**
     * @param array $vars
     * @return mixed
     */
    protected function start(array $vars){
        //..do something
        //throw something
        //return something
        
        //for example
        if($vars['someVar'] === 56){
            throw new Error('Bad value');
        }
        
        return 'All OK';
        
    }
    
}
```

### Var Types
```
number, string, array, object, boolean (bool)
```

## Step three - use it (example)
```php
//public.php

use Settings\Config;
use Api\Response;

$response = new Response;
$config = new Config;

$method = $response->getParam('method');
if($config->hasMethod($method)){

    $method = $config->getMethodClass($method);
    $method = new $method;
    
    //next string for example    
    if($method->getOption('someOption') === 'someValue'){
        echo $method->execute($response->get);
    }
    
}

//so
//public.php?method=do.something&someVar=56 -> {"result":null,"error":"Bad value"}
//public.php?method=do.something&someVar=65 -> {"result":"All OK","error":false}
```
