<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    public function list()
    {
        /*$students = array();
        for($i=0;$i<10;$i++){
            $student=array(
                "name"=>"Student ".($i+1),
                "id" =>($i+1),
                "dob" =>"12.12.12"
            );
            $students[] = (object)$student;
        }*/
        // $students = Product::all();


        $data = [
            'page_name' => 'Products',
            'products' =>  Product::all(),
        ];

        return view('pages.products2')->with($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make([], []);

        $request->validate([
            'name' => 'required|min:5|max:100',
            'code' => 'required|min:3|max:6',
            'description' => 'required|min:3|max:10',
            'price' => 'required|min:1|max:10000',
            
        ]);


        $p = new Product();
        $p->p_name = $request->name;
        $p->p_code = $request->code;
        $p->p_desc = $request->description;
        $p->p_category = $request->category;
        $p->p_price = $request->price;
        $p->p_quantity = $request->quantity;
        $p->p_stock_date = $request->stock_date;
        $p->p_rating = $request->rating;
        // $p->p_name = $request->name;
        // $p->p_name = $request->name;
        // $p->p_name = $request->name;
        $p->save();
        


        

       

        
    
       
       

        

        $validator->getMessageBag()->add('message', 'That password is incorrect.');
        return redirect($request -> url())
                    -> withErrors($validator)
                    -> withInput();
    }

    public function delete(Request $request)
    {
        $var = Product::where('id', $request->id)->first();
        $var->delete();
        return redirect()->route('pages.products');
    }
}
