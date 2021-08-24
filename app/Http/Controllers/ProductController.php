<?php namespace App\Http\Controllers;
 
use App\Http\Requests;
use App\Http\Controllers\Controller;
 
use Illuminate\Http\Request;
 
class ProductController extends Controller
{
	
	public function index()
    {
		$databaseName = \DB::connection()->getDatabaseName();

    	dd($databaseName);
    	//dd('hello');
    }
}