<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-4">
            @if(Session::has('message'))
                <div class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
            @endif

            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCustomer">Create</a>
            @include('components.edit-customer')
        </div>

        <hr>

        <div class="row">
            @foreach($customers as $customer)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $customer->name }}</h5>
                            <p class="card-text">{{ $customer->document }}</p>
                            <p class="card-text"><strong>Numbers:</strong> {{ $customer->numbers->count() }}</p>
                            <p class="card-text"><strong>Status:</strong> <span class="text-capitalize">{{ config('app.customer_status')[$customer->status] }}</p></span>
                            <hr>
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCustomer{{ $customer->id }}"><i class="fa fa-edit"></i> Edit</a>
                            <a href="{{ route('customer', $customer->id) }}" class="btn btn-secondary"><i class="fa fa-info"></i> Details</a>
                            <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCustomer{{ $customer->id }}"><i class="fa fa-trash-alt"></i> Delete</a>
                        </div>
                    </div>
                    @include('components.edit-customer', ['customer' => $customer])
                    @include('components.delete-customer', ['customer' => $customer])
                </div>
            @endforeach

            {{ $customers->links() }}
        </div>
    </div>
</x-app-layout>
