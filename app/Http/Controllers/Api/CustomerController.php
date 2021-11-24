<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $return = Customer::paginate();
        return response()->json($return);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'document' => 'required|min:6|max:12',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
        }
        $return = new Customer();
        $return->user_id = Auth::id();
        $return->name = $request->name;
        $return->document = $request->document;
        $return->save();
        $return->message = 'Created';
        return response()->json($return, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $customerId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $customerId)
    {
        $return = Customer::with('numbers')->find($customerId);
        if($return){
            return response()->json($return);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $customerId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $customerId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'document' => 'required|min:6|max:12',
            'status' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
        }
        $return = Customer::find($customerId);
        $return->user_id = Auth::id();
        $return->name = $request->name;
        $return->document = $request->document;
        $return->status = $request->status;
        $return->save();
        return response()->json($return, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $customerId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $customerId)
    {
        $return = Customer::find($customerId);
        if($return){
            $return->delete();
            return response()->json(['message' => 'Deleted']);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }
}
