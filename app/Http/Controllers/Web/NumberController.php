<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class NumberController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $customerId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, int $customerId)
    {
        Http::post(route('api.customers.numbers.store', ['customerId' => $customerId]), $request->all());
        return Redirect::back()->with(['message' => 'Number created successfully.', 'alert-class' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $customerId
     * @param  int $numberId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $customerId, int $numberId)
    {
        Http::post(route('api.customers.numbers.update', ['customerId' => $customerId, 'numberId' => $numberId]), $request->all());
        return Redirect::back()->with(['message' => 'Number updated successfully.', 'alert-class' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $customerId
     * @param  int $numberId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, int $customerId, int $numberId)
    {
        Http::delete(route('api.customers.numbers.destroy', ['customerId' => $customerId, 'numberId' => $numberId]), $request->all());
        return Redirect::back()->with(['message' => 'Number deleted successfully.', 'alert-class' => 'alert-success']);
    }
}
