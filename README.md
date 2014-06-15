PhalconHaml
===========

PHP Haml parser for Phalcon framwork

Phalcon config
------
First, you need to show Phalcon your new renderer. 
I assume that you have already defined loader and factory:

```php
$loader = new \Phalcon\Loader();
$di = new Phalcon\DI\FactoryDefault();
```

Then put following below:

```php
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
	//set layout file name
	$view->setMainView('layout');
	return $view;
});
```

Now we are done and ready to use Haml with Phalcon.

Render hierarchy
------

PhalconHaml implements own render hierarchy similar to default Phalcon hierarchy.

### Layout

#### Main layout
If we set main view by
```php
$view->setMainView('layout');
```

It means that Phalcon is going to find layout.html.haml file directly in your view directory. PhalconHaml will render only this file.
We always can set custom layout for controller or action just by call setMainView() on view object.

#### Controler layout
If we don't set main view in config file, PhalconHaml will search directly in your view directory for file with controller name. For ex. if you trigger IndexController parser will try to render index.html.haml file from your view directory.

### Content render
PhalconHaml gives you flexibility. You can decide how to organize your views files. By default parser assign two variables: $controller and $action. You can use as you want to include your action or controller view. Use include token a compose view file path:

```php
//include [controlerName]/[actionName][yourExtenstion] file
!! $controller/$action.html
```

# Example

File struct
```
/views
- index -> controler name dir
-- index.html.haml -> main page content
- head.html.haml -> file with header content
- layout.html.haml -> main view file
- menu.html.haml -> menu file
```

layout.html.haml
```haml
!!! 5
%html
	%head
		!! head.html
	%body
	    #menu
	        !! menu.html
		.container-fluid
		    /content
			!! $controller/$action.html
```