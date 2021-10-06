<?php

namespace App\Http\Controllers\Admin\Campaign;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()):
            $categories = Category::get();
            return Datatables($categories)->make(true);
        else:
            return view('category.index');
        endif;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:25|unique:categories,name,NULL,id',
        ]);

        $data = $request->only(["name"]);
        $data['is_active'] = 1;
        $category = Category::create($data);
        return $category;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return $category;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:25|unique:categories,name,'.$id.',id',
        ]);

        $data = $request->only(["name"]);
        $category = Category::whereId($id)->first();
        $category->update($data);

        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if($category):
            if($category->campaigns()->count() > 0):
                return response()->json(['message' => 'Category cannot be delete because it is assigned'],409);
            else:
                $category->delete();
                return response()->json(['message' => 'Category deleted successfully'],200);
            endif;
        else:
            return response()->json(['message' => 'Category not found'],404);
        endif;
    }

    public function updateStatus(Request $request, $id){
        $category = Category::findOrFail($id);
        if($category):
            $category->update(['is_active' => $request->is_active]);
            return response()->json(['status' => Response::$statusTexts[Response::HTTP_OK],'status_code' => Response::HTTP_OK],200);
        else:
            return response()->json(['status' => Response::$statusTexts[Response::HTTP_NOT_FOUND],'status_code' => Response::HTTP_NOT_FOUND],404);
        endif;
    }
}
