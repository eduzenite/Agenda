<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Number;
use App\Models\NumberPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NumberController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  int  $customerId
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $customerId)
    {
        if(!Customer::find($customerId)) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $validator = Validator::make($request->all(), [
            'number' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
        }
        $return = new Number();
        $return->customer_id = $customerId;
        $return->number = $request->number;
        $return->save();
        $return->message = 'Created';

        $numberPreference = new NumberPreference();
        $numberPreference->number_id = $return->id;
        $numberPreference->name = 'auto_attendant';
        $numberPreference->value = 1;
        $numberPreference->save();

        $numberPreference = new NumberPreference();
        $numberPreference->number_id = $return->id;
        $numberPreference->name = 'voicemail_enabled';
        $numberPreference->value = 1;
        $numberPreference->save();


        return response()->json($return, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $customerId
     * @param  int  $numberId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $customerId, int $numberId)
    {
        $return = Number::where('customer_id', $customerId)->find($numberId);
        if($return) {
            $validator = Validator::make($request->all(), [
                'number' => 'required',
                'status' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
            }
            $return->number = $request->number;
            $return->status = $request->status;
            $return->save();
            $return->message = 'Updated';

            $auto_attendant = NumberPreference::where('name', 'auto_attendant')->where('number_id', $numberId)->first();
            $auto_attendant->value = ($request->auto_attendant ? 1 : 0);
            $auto_attendant->save();

            $voicemail_enabled = NumberPreference::where('name', 'voicemail_enabled')->where('number_id', $numberId)->first();
            $voicemail_enabled->value = ($request->voicemail_enabled ? 1 : 0);
            $voicemail_enabled->save();

            return response()->json($return);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $customerId
     * @param  int  $numberId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $customerId, int $numberId)
    {
        $return = Number::where('customer_id', $customerId)->find($numberId);
        if($return){
            $return->delete();
            return response()->json(['message' => 'Deleted']);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }
}
