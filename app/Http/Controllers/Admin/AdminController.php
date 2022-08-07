<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Category;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\Grade;
use App\Models\Invoice;
use App\Models\Lesson;
use App\Models\OrderItem;
use App\Models\Post;
use App\Models\Product;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Response;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $viewIndex  = 'admin.pages.dashboard.index';

    public function __construct()
    {
    }


    public function index(Request $request) : View
    {
        $productsCount = Product::count();
        $usersCount = User::count();
        $invoicesCount = Invoice::count();
        return view($this->viewIndex, get_defined_vars());
    }
}
