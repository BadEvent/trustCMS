<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public $organization;
    /**
     * @var Data
     */
    public $Data;

    public function __construct()
    {
        $this->organization = new Organization;
        $this->Data = new Data;
    }

}
