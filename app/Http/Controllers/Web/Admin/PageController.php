<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 12.07.2020
 * Time: 19:30
 */

namespace App\Http\Controllers\Web\Admin;


use App\Http\Controllers\Web\WebBaseController;

class PageController extends WebBaseController
{

    public function home()
    {
        $this->edited();
        return $this->adminView('pages.home');
    }
}
