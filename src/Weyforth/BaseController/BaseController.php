<?php

namespace Weyforth\BaseController;

use Controller;
use View;

class BaseController extends Controller
{

    protected $layout;


    protected function setupLayout()
    {
        $this->layout = (object) array();
        // $this->layout->title = '';
    }


    protected function layout($name)
    {
        return View::make($name)->with(
            (array) $this->layout
        );
    }


}
