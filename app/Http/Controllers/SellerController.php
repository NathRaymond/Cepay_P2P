<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SellerController extends Controller
{
    public function sellers_list()
    {
        $sellers = Seller::all();

        return response()->json(['sellers' => $sellers], 200);
    }

    public function sellers_by_id($sellerId)
    {
        try {
            $seller = Seller::find($sellerId);

            if (!$seller) {
                return response()->json(['message' => 'Seller not found'], 404);
            }

            return response()->json(['seller' => $seller], 200);
        } catch (\Exception $e) {
            $errorBag = ["message" => $e->getMessage()];
            return response()->json(['message' => 'Error fetching seller', 'error' => $errorBag], 500);
        }
    }


    public function insertSeller(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'price' => 'required',
                'crypto_amount' => 'required',
                'payment_method' => 'required',
                'maximum_limit' => 'required',
                'minimum_limit' => 'required',
            ]);

            if ($validator->fails()) {
                return API_Response(500, false, $validator->errors());
            } else {
                $seller = new Seller();
                $seller->username = $request->input('username');
                $seller->price = $request->input('price');
                $seller->crypto_amount = $request->input('crypto_amount');
                $seller->payment_method = $request->input('payment_method');
                $seller->maximum_limit = $request->input('maximum_limit');
                $seller->minimum_limit = $request->input('minimum_limit');
                $seller->rate = "99%";
                $seller->trades = "700";
                $seller->save();

                $response = ["seller_id" => $seller->id];
                return API_Response(200, $response);
            }
        } catch (\Exception $e) {
            $errorBag = ["message" => $e->getMessage()];
            return API_Response(500, null, $errorBag);
        }
    }
}