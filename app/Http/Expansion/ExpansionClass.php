<?php

namespace App\Http\Expansion;

use App\Http\Controllers\Controller;

class ExpansionClass
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
