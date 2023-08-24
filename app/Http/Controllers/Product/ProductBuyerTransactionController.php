<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductBuyerTransactionController extends ApiController
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(Request $request,Product $product, User $buyer)
    {
        $rules = [
            'quantity' => 'required|integer|min:1'
        ];
        $this->validate($request, $rules);

        if($buyer->id == $product->seller_id){
            return $this->errorResponse('The buyer must be different from the seller',409);
        }
        if(!$buyer->isVerified()){
            return $this->errorResponse('The buyer must be a verified user',409);
        }
        if(!$product->seller->isVerified()){
            return $this->errorResponse('The seller must be a verified user',409);
        }
        if(!$product->isAvailable()){
            return $this->errorResponse('The product is not available',409);
        }
        if($product->quantity < $request->quantity){
            return $this->errorResponse('The product does not have enough items for this transaction',409);
        }
// we used the transaction method provided by the DB facade to run a set of operations within a database transaction
        return DB::transaction( function () use( $request, $product, $buyer){
            $product->quantity -= $request->quantity;
            $product->save();

            $transaction = Transaction::create([
                'quantity' => $request->quantity,
                'buyer_id' => $buyer->id,
                'product_id' => $product->id
            ]);
            return $this->showOne($transaction, 201);
        });

    }


}
