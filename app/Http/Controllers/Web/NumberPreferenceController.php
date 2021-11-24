<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class NumberPreferenceController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $customerId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $customerId)
    {
        Http::post(route('api.customers.numbers.update', ['customerId' => $customerId]), $request->all());
        return Redirect::back()->with(['message' => 'Number updated successfully.', 'alert-class' => 'alert-success']);
    }
}
