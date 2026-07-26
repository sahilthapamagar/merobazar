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
            'registration_number' => 'required|string|max:255',
            'citizenship_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file uploads
        $citizenshipPhotoPath = null;
        if ($request->hasFile('citizenship_photo')) {
            $citizenshipPhotoPath = $request->file('citizenship_photo')->store('seller-documents/citizenship', 'public');
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('seller-documents/registration', 'public');
        }

        // Process the validated data
        $seller = new Seller;
        $seller->name = $request->name;
        $seller->email = $request->email;
        $seller->shop_name = $request->shop_name;
        $seller->contact = $request->contact;
        $seller->registration_number = $request->registration_number;
        $seller->citizenship_photo = $citizenshipPhotoPath;
        $seller->image = $imagePath;
        $seller->save();
        toast('Seller request submitted successfully! Wait for the Response.', 'success');

        return redirect()->route('home');
    }

    public function index()
    {
        return view('frontend.seller_form');
    }
}
