<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function OrderIndex()
    {
        return Inertia::render(
            'Orders/Orders',
            [
            ]
        );
    }
}
