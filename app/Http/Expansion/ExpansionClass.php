<?php

namespace App\Http\Expansion;

use Illuminate\Routing\Controller as BaseController;

class ExpansionClass extends BaseController
{
    public function adminValidation($userRoleId)
    {
        if ($userRoleId == 1 or $userRoleId == 2){
            return true;
        }else{
            return false;
        }
    }
}
