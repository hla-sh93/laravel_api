<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Traits\GeneralTrait;

class CategoriesController extends Controller

{
    use GeneralTrait;

    // Show all Categories
    public function index(){

    $categories = Category::select('id','name_'.app()->getLocale().' as name')->get();
    return response()->json($categories);
    }


    // get category by id
    public function getCatById(Request $request)
    {
        $category=Category::find($request->id);
        if(!$category){
          return  $this->ErrMsg('101', 'Sorry we couldn\'t find your domand !' );
            }
        else return $this->ReturnData('category',$category,'done');
    }

}
