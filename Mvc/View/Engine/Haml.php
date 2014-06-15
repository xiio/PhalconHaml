<?php

namespace Phalcon\Mvc\View\Engine {

	use Phalcon\Mvc\View\Engine;
	use Phalcon\Mvc\View\EngineInterface;

	include 'haml/HamlParser.class.php';

	/**
	 * Haml integration class
	 *
	 * @author Tomasz Ksionek
	 */
	class Haml extends Engine implements EngineInterface {

		private $_parser;
		private $_content = '';

		public function __construct($view, $di)
		{
			$this->_parser = new \HamlParser($view->getViewsDir());
			$this->_parser->setPath($view->getViewsDir());
			$view->disableLevel(array(
				\Phalcon\Mvc\View::LEVEL_ACTION_VIEW => true,
				\Phalcon\Mvc\View::LEVEL_LAYOUT		 => true,
			));
			parent::__construct($view, $di);
		}

		/**
		 * @param $path
		 * @param $params
		 * @param null $mustClean
		 */
		public function render($path, $params, $mustClean = null)
		{
			$this->_parser->assign('controller', $this->_view->getControllerName());
			$this->_parser->assign('action', $this->_view->getActionName());
			$view_params	 = $this->getView()->getParamsToView();
			$this->_content	 = $this->_parser->fetch($path);
			$this->_view->setContent($this->_content);
		}

	}

}
