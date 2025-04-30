<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $customers = Customer::paginate(10);
        return Inertia::render('Customers/Index',
        [
            'customers' => $customers
        ]);
    }

    public function create() {
        $options = [
            'method' => 'create',
        ];
        return Inertia::render('Customers/Form',$options);
    }

    public function edit(Customer $customer) {
        $options = [
            'method' => 'edit',
            'customer' => $customer,
        ];
        return Inertia::render('Customers/Form',$options);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store($redirectTo=null)
    {
        $customer = Customer::create(request()->validate([
            'name' => 'required',
            'short_name' => 'required',
            'street' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'email' => 'required|email'
        ]));

        // if this is part of a wizard redirect back to the wizard
        if(request()->has('wizard')) {
            // populate the model into the wizard session data
            $wizard_data = session('wizard');
            $wizard_data['customer'] = $customer;
            session('wizard', $wizard_data);
            return redirect()->back(); // route($wizard_data['origin_route']);
        }
        return redirect()->route("customer.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Customer $customer)
    {
        $customer->update(request()->validate([
            'name' => 'required',
            'short_name' => 'required',
            'street' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'email' => 'required|email'
        ]));
        return redirect()->route('customer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
