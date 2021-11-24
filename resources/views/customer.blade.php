<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(Session::has('message'))
            <div class="alert mt-4 {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
        @endif
        <div class="card mt-4">
            <div class="card-body">

                <h5 class="card-title">{{ $customer->name }}</h5>
                <p class="card-text">{{ $customer->document }}</p>
                <p class="card-text"><strong>Numbers:</strong> {{ $customer->numbers->count() }}</p>
                <p class="card-text"><strong>Status:</strong> <span class="text-capitalize">{{ config('app.customer_status')[$customer->status] }}</p></span>
                <hr>
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCustomer{{ $customer->id }}"><i class="fa fa-edit"></i> Edit</a>
                <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCustomer{{ $customer->id }}"><i class="fa fa-trash-alt"></i> Delete</a>
            </div>
            @include('components.edit-customer', ['customer' => $customer])
            @include('components.delete-customer', ['customer' => $customer])
        </div>
        <hr>
        <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createNumber">
                    New Number
                </button>

                <!-- Modal -->
                <div class="modal fade" id="createNumber" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="post" action="{{ route('customer.numbers.store', ['customerId' => $customer->id]) }}" class="ajax_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Create Number</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="number" class="form-label">Number</label>
                                        <input type="text" class="form-control" id="number" name="number">
                                    </div>
                                    <div class="mb-3">
                                        <label for="status{{ $customer->status }}" class="form-label">Status</label>
                                        <select class="form-select text-capitalize"  id="status{{ $customer->status }}" name="status">
                                            <option selected value="">-Select</option>
                                            @foreach(config('app.number_status') as $key => $status)
                                                <option value="{{ $key }}">{{ $status }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secudary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success">Create</button>
                                    <input type="hidden" name="api_token" value="{{ auth()->user()->api_token }}">
                                    @csrf
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @if($numbers->count())
                    <hr>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Number</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        @foreach($numbers as $number)
                        <tr>
                            <td>{{ $number->number }}</td>
                            <td class="text-capitalize">{{ config('app.number_status')[$number->status] }}</td>
                            <td>
                                <div class="text-right">
                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editNumber{{ $number->id }}"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteNumber{{ $number->id }}"><i class="fa fa-trash-alt"></i></a>
                                </div>

                                <div class="modal fade" id="deleteNumber{{ $number->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form method="post" action="{{ route('customer.numbers.destroy', ['customerId' => $customer->id, 'numberId' => $number->id]) }}" class="ajax_form">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Number</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="alert alert-danger">Do you really want to delete this number?</div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                    <input type="hidden" name="api_token" value="{{ auth()->user()->api_token }}">
                                                    @csrf
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="modal fade" id="editNumber{{ $number->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="post" action="{{ route('customer.numbers.update', ['customerId' => $customer->id, 'numberId' => $number->id]) }}" class="ajax_form">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Number</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="number{{ $number->id }}" class="form-label">Number</label>
                                                        <input type="text" class="form-control" id="number{{ $number->id }}" name="number" value="{{ $number->number }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="status{{ $number->id }}" class="form-label">Status</label>
                                                        <select class="form-select text-capitalize"  id="status{{ $number->id }}" name="status">
                                                            <option selected value="">-Select</option>
                                                            @foreach(config('app.number_status') as $key => $status)
                                                                <option value="{{ $key }}" {{ $number->status == $key ? 'selected' : '' }}>{{ $status }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="row">
                                                        @foreach($number->number_preferences as $key => $preference)
                                                            <div class="col-md-6">
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input" type="checkbox" id="preference{{ $preference->id }}" name="{{ $preference->name }}" {{ $preference->value ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="preference{{ $preference->id }}">{{ $preference->name }}</label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secudary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success">Salve</button>
                                                    <input type="hidden" name="api_token" value="{{ auth()->user()->api_token }}">
                                                    @csrf
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                 @endif
            </div>
        </div>
    </div>
</x-app-layout>
