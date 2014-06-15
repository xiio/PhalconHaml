PhalconHaml
===========

PHP Haml parser for Phalcon framwork

Phalcon config
------
First, you need to show Phalcon your new renderer. 
I assume that you have already defined loader and factory:

```
$loader = new \Phalcon\Loader();
$di = new Phalcon\DI\FactoryDefault();
```

Then put following below:

```
//register new namespace:
$loader->registerNamespaces(array(
    //path to place where Mvc directory is
	'Phalcon' => '../app/extends/'
));

//setup view rendere 
$di->set('view', function() {

	$view = new \Phalcon\Mvc\View();
	
	//setup your view files directory
	$view->setViewsDir('../app/views/');

    //register file extension for Haml parser
	$view->registerEngines(array(
		".html.haml" => 'Phalcon\Mvc\View\Engine\Haml'
	));
	return $view;
});
```

