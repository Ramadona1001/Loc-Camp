<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Areas\Models\Area;
use Categories\Models\Category;
use Contacts\Models\Contact;
use Currencies\Models\Currencies;
use Developers\Models\Developer;
use Gallery\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Pages\Models\Page;
use PaymentMethod\Models\PaymentMethod;
use Projects\Models\Project;
use Properties\Models\Properties;
use PropertyFeature\Models\PropertyFeature;
use PropertyType\Models\PropertyType;
use Services\Models\Service;
use Translates\Models\Translate;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = transWord('Home');
        $pages = [];

        $users_count = User::count();


        $components = [
            [$users_count,transWord('Users'),'users','indigo','show_statistics_users'],
        ];

        //Course Category Pie Chart


        return view('index',compact('components','pages','title'));
    }
}
