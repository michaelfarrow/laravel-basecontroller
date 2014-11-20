<?php

namespace Weyforth\BaseController;

use Controller;
use View;
use Str;

abstract class BaseController extends Controller
{

    protected $layout;


    protected function controllerType()
    {
        $class = join('', array_slice(explode('\\', get_called_class()), -1));
        $type = Str::lower(str_replace('Controller', '', $class));

        return $type;
    }

    protected function controllerNamespace()
    {
        $namespace = join('', array_slice(explode('\\', get_called_class()), -2, 1));
        $namespace = Str::lower($namespace);

        return $namespace;
    }

    protected function templateLayout()
    {
        $callers = debug_backtrace();

        $namespace = $this->controllerNamespace();
        $type = $this->controllerType();
        $function = $callers[1]['function'];

        $this->layout->controllerType = $type;
        $this->layout->pageId = Str::camel($namespace.' '.$type.' '.$function);

        return $this->layout($namespace . '.' . $type . '.' . $function);
    }

    protected function setupLayout()
    {
        $this->layout = (object) array();
    }


    protected function layout($name)
    {
        return View::make($name)->with(
            (array) $this->layout
        );
    }


}
