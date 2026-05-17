<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function seller_request(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:sellers,email',
            'shop_name' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
        ]);

        // Process the validated data
        $seller = new Seller;
        $seller->name = $request->name;
        $seller->email = $request->email;
        $seller->shop_name = $request->shop_name;
        $seller->contact = $request->contact;
        $seller->save();
        toast('Seller request submitted successfully!', 'success');

        return redirect()->back();
    }
}
