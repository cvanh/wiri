<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;

// routes used in the mobile app
final class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Display the specified resource.
     */
    public function search(Request $req)
    {
        $s = $req->query('s');
        $companies = Company::where('name', 'like', "%{$s}%")->get();
        $products = Product::where('name', 'like', "%{$s}%")->get();
        return ['search_key' => $s, 'companies' => $companies, 'products' => $products];
    }
}
