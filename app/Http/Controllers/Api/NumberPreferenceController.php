<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Number;
use App\Models\NumberPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NumberPreferenceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  int  $numberId
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, int $numberId)
    {
        if(!Number::find($numberId)) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'value' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
        }
        $return = new NumberPreference();
        $return->number_id = $numberId;
        $return->name = $request->name;
        $return->value = $request->value;
        $return->save();
        $return->message = 'Created';
        return response()->json($return, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $numberId
     * @param  int  $numberPreferenceId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $numberId, int $numberPreferenceId)
    {
        $return = NumberPreference::where('number_id', $numberId)->find($numberPreferenceId);
        if($return) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'value' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'Bad Request', 'validator' => $validator->errors()], 400);
            }
            $return->number_id = $numberId;
            $return->name = $request->name;
            $return->value = $request->value;
            $return->save();
            $return->message = 'Updated';
            return response()->json($return);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $numberId
     * @param  int  $numberPreferenceId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $numberId, int $numberPreferenceId)
    {
        $return = Number::where('number_id', $numberId)->find($numberPreferenceId);
        if($return){
            $return->delete();
            return response()->json(['message' => 'Deleted']);
        }else{
            return response()->json(['message' => 'Not Found'], 404);
        }
    }
}
