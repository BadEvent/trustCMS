<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\Data;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{

    public function register(Request $request)
    {
        /*************** user auth ******************/
        if (!$request->session()->has('user')) {
            $user = null;
        } else {
            return redirect()->back();
        }
        /*************** user auth ******************/
        $pageTitle = 'Регистрация';

        $data['status'] = false;
        if (!empty(Session::get('status'))) {
            $data['status'] = Session::get('status');
        }

        $data['organizationsName'] = $this->organization::groupBy('name')->pluck('name');
        $data['user'] = null;
        $data['title'] = $pageTitle;
        $data['breadcrumbs'] = [
            [
                'title' => 'Главная',
                'link' => route('index'),
                'active' => false,
            ],
            [
                'title' => $pageTitle,
                'link' => route('register'),
                'active' => true,
            ]
        ];
        return view('auth.register', $data);
    }

    public function registerPost(Request $request): \Illuminate\Http\RedirectResponse
    {
        $userModel = new User;
        $dataModel = new Data;

        $status = [
            'type' => 1,
            'text' => 'Вы успешно зарегистрировались!',
        ];

        $user = $request->all();

        if ($userModel->validationLoginUser($user['login'])) {
            $status = [
                'type' => 2,
                'text' => 'Этот логин уже занят',
            ];
            return redirect()->route('register')->with('status', $status);
        }

        if ($userModel->validationEmailUser($user['email'])) {
            $status = [
                'type' => 2,
                'text' => 'Этот email уже занят',
            ];
            return redirect()->route('register')->with('status', $status);
        }

        //organization
        $organization_id = $this->organizationFunc($user);


        //data
        $userDataFull = [
            'first_name' => $user['firstName'],
            'second_name' => $user['secondName'],
            'phone' => $user['phone'],
            'organization_id' => $organization_id,
        ];
        $dataModel->createData($userDataFull);
        $dataId = $dataModel->getLastData();

        //users
        $userData = [
            'login' => $user['login'],
            'password' => md5($user['password']),
            'email' => $user['email'],
            'data_id' => $dataId[0]->id,
            'role_id' => 4,
        ];
        $userModel->createUser($userData);

        return redirect()->route('register')->with('status', $status);
    }

    public function getAddress(Request $request)
    {
        if (!$this->organization::getAddressByName($request->organizationName)->count()) {
            return ['Введите адрес'];
        }
        return $this->organization::getAddressByName($request->organizationName);
    }

    public function getHousing(Request $request)
    {
        if (!$this->organization::getHousingByNameByAddress($request->organizationName, $request->organizationAddress)->count()) {
            return ['Введите корпус'];
        }
        return $this->organization::getHousingByNameByAddress($request->organizationName, $request->organizationAddress);
    }

    public function getOffice(Request $request)
    {
        if (!$this->organization::getOfficeByNameByHousing($request->organizationName, $request->organizationHousing)->count()) {
            return ['Введите кабинет'];
        }
        return $this->organization::getOfficeByNameByHousing($request->organizationName, $request->organizationHousing);
    }
}
