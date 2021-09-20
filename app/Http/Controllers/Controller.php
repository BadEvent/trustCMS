<?php

namespace App\Http\Controllers;

use App\Http\Expansion\ExpansionClass;
use App\Models\Data;
use App\Models\Organization;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public $task;
    public $pageTitle;
    public $status;
    public $user;
    public $userModel;
    public $data;
    public $expansion;
    public $organization;


    public function __construct(Request $request)
    {
        ($request->session()->get('user')) ? $this->user = $request->session()->get('user')[0] : '';
        $this->task = new Task;
        $this->userModel = new User;
        $this->data = new Data;
        $this->organization = new Organization;
        $this->pageTitle = 'page';
        $this->expansion = new ExpansionClass();
        // status: 1-true, 0-false, 2-dont show.
        $this->status = [
            'title' => 'Default',
            'status' => 2
        ];
    }

    public function organizationFunc($data)
    {
        $organization = [
            'name' => $data['organizationName'],
            'address' => $data['address'],
            'housing' => $data['housing'],
            'office' => $data['office'],
        ];
        if ($this->organization->getForRegistration($organization)) {
            return $this->organization->getForRegistration($organization)->id;
        }

        if (!$this->organization->getForRegistration($organization)) {
            $this->organization->createData($organization);
            return $this->organization->getLastData()->id;
        }
    }

}
