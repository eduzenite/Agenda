<div class="modal fade" id="editCustomer{{ !empty($customer->id) ? $customer->id : '' }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ !empty($customer->id) ? route('customer.update', ['customerId' => $customer->id]) : route('customer.store') }}" class="ajax_form">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ !empty($customer->id) ? 'Edit Customer' : 'Create Customer' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name{{ !empty($customer->id) ? $customer->id : '' }}">Name</label>
                        <input type="text" class="form-control" id="name{{ !empty($customer->id) ? $customer->id : '' }}" name="name" value="{{ !empty($customer->name) ? $customer->name : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="document{{ !empty($customer->id) ? $customer->id : '' }}">Document</label>
                        <input type="text" class="form-control" id="document{{ !empty($customer->id) ? $customer->id : '' }}" name="document" value="{{ !empty($customer->document) ? $customer->document : '' }}">
                    </div>
                    @if(!empty($customer->id))
                        <div class="mb-3">
                            <label for="document{{ $customer->id }}">Status</label>
                            <select class="form-select text-capitalize"  id="status{{ $customer->id }}" name="status">
                                <option selected value="">-Select</option>
                                @foreach(config('app.customer_status') as $key => $status)
                                    <option value="{{ $key }}" {{ $customer->status == $key ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secudary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">{{ !empty($customer->id) ? 'Edit' : 'Create' }}</button>
                    <input type="hidden" name="api_token" value="{{ auth()->user()->api_token }}">
                    @csrf
                </div>
            </form>
        </div>
    </div>
</div>
