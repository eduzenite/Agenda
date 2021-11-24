<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Inertia\Response
     */
    public function index()
    {
        $customers = Customer::with('numbers')->paginate(12);
        return view('dashboard', ['customers' => $customers]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $customerId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function show(int $customerId)
    {
        $customer = Customer::find($customerId);
        if($customer){
            $numbers = Number::where('customer_id', $customerId)->with('number_preferences')->get();
            return view('customer', ['customer' => $customer, 'numbers' => $numbers]);
        }else{
            abort(404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Http::post(route('api.customers.store'), $request->all());
        return Redirect::back()->with(['message' => 'Customer created successfully.', 'alert-class' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $customerId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $customerId)
    {
        Http::post(route('api.customers.update', ['customerId' => $customerId]), $request->all());
        return Redirect::back()->with(['message' => 'Customer updated successfully.', 'alert-class' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $customerId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, int $customerId)
    {
        Http::delete(route('api.customers.destroy', ['customerId' => $customerId]), $request->all());
        return redirect('customers')->with(['message' => 'Customer deleted successfully.', 'alert-class' => 'alert-success']);
    }
}
