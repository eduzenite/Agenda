<div class="modal fade" id="deleteCustomer{{ $customer->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('customer.destroy', ['customerId' => $customer->id]) }}" class="ajax_form">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <i class="fa fa-exclamation-triangle"></i>
                        Are you sure you want to delete this customer?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secudary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Delete</button>
                    <input type="hidden" name="api_token" value="{{ auth()->user()->api_token }}">
                    @csrf
                </div>
            </form>
        </div>
    </div>
</div>
