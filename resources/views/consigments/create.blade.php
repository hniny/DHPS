@extends('layouts.app')
@section('content')
<div class="row py-2">
  <div class="col-md-12">
    <div class="card shadow-sm">
      <div class="card-header">
        Creadit Or Consigment Request Application Form
      </div>
      <div class="card-body">
        
  @if ($errors->any())
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
      <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div class="row mt-3">
  <div class="col-12">
    <form action="{{ route('consigments.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
      <div class="row">
        @csrf
        @method('POST')
        <div class="col-md-12">
          <h4>1. Company Information</h4>
          <div class="form-row">
            <div class="form-group col-md-12">
              <strong>Company Name</strong>
              <select name="company_name" id="company_name" class="form-control" required>
                <option value="">Select Company</option>
                @foreach ($customers as $customer)
                  <option value="{{ $customer->id }}" data-id="{{ $customer->componay_name }}">{{ $customer->componay_name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="name">Name : <span id="user_name"></span></label>
              <input type="hidden" name="user_id" id="user_id">
              <input type="hidden" name="company" id="company">
            </div>
          
            <div class="form-group col-md-6">
              <label for="name">Phone : <span id="user_phone"></span></label>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="name">Main Email Address : <span id="user_email"></span></label>
            </div>
         
            <div class="form-group col-md-6">
              <label for="name">Office Address : <span id="office_address"></span></label>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="name">Delivery Address : <span id="delivery_address"></span></label>
            </div>
          </div>
        </div>
        
      </div>
      <hr>
      <div class="row">
        <div class="col-md-6">
          <h4>2. Preferred Contracts</h4>

          <div class="form-row">
            <div class="col-md-6">
              <label for="">Account Contact :</label>
              <input type="text" name="account_contact" id="account_contact" class="form-control" required>
            </div>
         
            <div class="col-md-6">
              <label for="">Account Email :</label>
              <input type="email" name="account_email" id="account_email" class="form-control" required>
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-6">
              <label for="">Purchasing Contact :</label>
              <input type="text" name="purchasing_contact" id="purchasing_contact" class="form-control" required>
            </div>
         
            <div class="col-md-6">
              <label for="">Purchasing Email :</label>
              <input type="email" name="purchasing_email" id="purchasing_email" class="form-control" required>
            </div>
          </div>

        </div>
        <div class="col-md-6 repeater">
          <h4 class="float-left">3. Directors</h4>
          <input data-repeater-create class="btn btn-success float-right" type="button" value="Add More"/>
          <div data-repeater-list="officers">
          {{-- <h5>Please provide details of company officers:</h5> --}}
            <div data-repeater-item class="form-row" style="clear: both;">
              <div class="form-group col-md-2">
                <label for="">Title</label>
                <input type="text" name="officer_title" id="officer_title" class="form-control" required>
              </div>
            
              <div class="form-group col-md-8">
                <label for="">Name</label>
                <input type="text" name="officer_name" id="officer_name" class="form-control" required>
              </div>
              
              <div class="form-group col-md-2">
                <input data-repeater-delete class="btn btn-danger " type="button" style="margin-top: 30px;" value="Delete" />
              </div>
            </div>
          </div>
        </div>
      </div>
<hr>
      <div class="row repeater">
        <div class="col-md-12">
          <div class="form-row">
            <div class="form-group col-md-6">
              <h4>4. Credit References</h4>
            </div>
            <div class="form-group col-md-6 text-right">
              <input data-repeater-create class="btn btn-success float-right" type="button" value="Add More"/>
            </div>
          </div>
          <div data-repeater-list="credit_ref">
            <div data-repeater-item>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <strong>Company Name</strong>
                  <input type="text" name="credit_ref_company" id="credit_ref_company" class="form-control" placeholder="Company Name" required>
                </div>
                <div class="form-group col-md-3">
                  <strong>Contact Name</strong>
                  <input type="text" name="credit_ref_contact" id="credit_ref_contact" class="form-control" placeholder="Name" required>
                </div>
                <div class="form-group col-md-3">
                  <strong>Phone</strong>
                  <input type="text" name="credit_ref_phone" id="credit_ref_phone" class="form-control" placeholder="Phone" required>
                </div>
                <div class="form-group col-md-2">
                  <strong>Email Address	</strong>
                  <input type="email" name="credit_ref_email" id="credit_ref_email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group col-md-1">
                  <input data-repeater-delete class="btn btn-danger mt-4" type="button" value="Delete" />
                </div>
              </div>
                   
                    
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-12">
              <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="terms_and_condition" required>
                <label class="form-check-label" for="terms_and_condition">accept the Terms and Conditions.</label>
              </div>     
            </div>           
          </div>

          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="">Signature :</label>
              <input type="file" class="form-control-file" name="signature" id="signature">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="">Name :</label>
              <input type="text" class="form-control" name="name" id="name" required>
            </div>
            <div class="form-group col-md-6">
              <label for="">Date :</label>
              <input type="date" class="form-control" name="date" id="date" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-12">
              <a href="{{ route('consigments.index') }}" class="btn btn-secondary">Back</a>
              <button class="btn btn-primary">Save</button>
            </div>
          </div>

        </div>
      </div>
    </form>
  </div>
</div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/repeater.js') }}"></script>
<script src="{{ asset('js/validate.js') }}"></script>
  <script>
    $(document).ready(function () {
      $('.repeater').repeater({
            // (Optional)
            // start with an empty list of repeaters. Set your first (and only)
            // "data-repeater-item" with style="display:none;" and pass the
            // following configuration flag
            
            // (Optional)
            // "defaultValues" sets the values of added items.  The keys of
            // defaultValues refer to the value of the input's name attribute.
            // If a default value is not specified for an input, then it will
            // have its value cleared.
            defaultValues: {
                'text-input': 'foo'
            },
            // (Optional)
            // "show" is called just after an item is added.  The item is hidden
            // at this point.  If a show callback is not given the item will
            // have $(this).show() called on it.
            show: function () {
                $(this).slideDown();
            },
            // (Optional)
            // "hide" is called when a user clicks on a data-repeater-delete
            // element.  The item is still visible.  "hide" is passed a function
            // as its first argument which will properly remove the item.
            // "hide" allows for a confirmation step, to send a delete request
            // to the server, etc.  If a hide callback is not given the item
            // will be deleted.
            hide: function (deleteElement) {
                if(confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            },
            // (Optional)
            // You can use this if you need to manually re-index the list
            // for example if you are using a drag and drop library to reorder
            // list items.
            ready: function (setIndexes) {
                // $dragAndDrop.on('drop', setIndexes);
            },
            // (Optional)
            // Removes the delete button from the first list item,
            // defaults to false.
            // isFirstItemUndeletable: true
        })
      $('#company_name').on('change', function () {
        var company_name = $(this).val();
        var company = $(this).find(':selected').attr('data-id');
        $('#company').val(company);
        if (company_name) {
          $.ajax({
            type: "get",
            url: "/getCustomer?company="+company_name,
            success: function(data) {
              if(data.success = true){
                console.log(data.customer);
                $('#user_name').text(data.customer.user.name);
                $('#user_id').val(data.customer.user.id);
                $('#user_phone').text(data.customer.office_number+", "+data.customer.mobile_number);
                $('#user_email').text(data.customer.user.email)
                $('#office_address').text(data.customer.office_address)
                $('#delivery_address').text(data.customer.delivery_address)
              }
            },
            error: function(data) {
              alert('error');
            }
          });
        }
      });
    });
  </script>
@endpush