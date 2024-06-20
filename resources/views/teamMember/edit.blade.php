@extends('layouts.app')
@section('content')
<div class="row py-2">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4>Edit Team Member</h4>
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
    <form action="{{ route('teammembers.update', $teammember->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
      @csrf
      @method('PUT')
      <div class="form-row">
      <div class="form-group col-3">
        <strong for="name"><span class="text-danger">*</span> Full Name [Mr/Mrs/Miss] <br>&nbsp;နာမည်အပြည့်အစုံ (Mr/Mrs/Miss)</strong>
        <input type="text" name="name" class="form-control" placeholder="Name" value="{{ isset($teammember->users) ? $teammember->users->name : '~' }}" required>
      </div>
        <div class="form-group col-3">
          <strong for="home"><span class="text-danger">*</span> Contact Number : Home <br>&nbsp;အိမ်ဆက်သွယ်ရန်နံပါတ်</strong>
          <input type="text" name="home_number" class="form-control" placeholder="Contact Number : Home" value="{{ $teammember->home_number }}" required>
        </div>
        <div class="form-group col-3">
          <strong for="mobile"><span class="text-danger">*</span> Mobile <br>&nbsp;ဆက်သွယ်ရန်နံပါတ်</strong>
          <input type="text" name="mobile_number" class="form-control" placeholder="Contact Number : Mobile" value="{{ $teammember->mobile_number }}" required>
        </div>
      <div class="form-group col-3">
        <strong for="email"><span class="text-danger">*</span> Email Address  <br>&nbsp;အီးမေးလ်လိပ်စာ</strong>
        <input type="email" name="email" class="form-control" placeholder="Email Address" value="{{ isset($teammember->users) ? $teammember->users->email : '~' }}" required>
      </div>
        <div class="form-group col-3">
          <strong><span class="text-danger">*</span> Department <br>&nbsp;ဌာန</strong>
          <select name="department_id" id="department" class="form-control" required>
            <option value="">Select Department</option>
            @foreach ($departments as $key => $department)
              @if ($key == $teammember->department_id)
              <option value="{{ $key }}" selected>{{ $department }}</option>
              @else
              <option value="{{ $key }}">{{ $department }}</option>
              @endif
            @endforeach
          </select>
        </div>
        <div class="form-group col-3">
          <strong><span class="text-danger">*</span> Position  <br>&nbsp;ရာထူး</strong>
          <select name="position_id" id="position" class="form-control" required>
            <option value="">Select Position</option>
            @foreach ($positions as $key => $position)
              @if ($key == $teammember->position_id)
              <option value="{{ $key }}" selected>{{ $position }}</option>
              @else
              <option value="{{ $key }}">{{ $position }}</option>
              @endif 
            @endforeach
          </select>
        </div>
 

     
        <div class="form-group col-3">
          <strong><span class="text-danger">*</span> Starting Date <br>&nbsp;အလုပ်စဝင်သည့်နေ့</strong>
          <input type="date" name="date_of_employee" id="date_of_employee" class="form-control" value="{{ $teammember->date_of_employee }}" required>
        </div>
        <div class="form-group col-3">
          <strong><span class="text-danger">*</span> Employee ID No<br>&nbsp;၀န်ထမ်း ID နံပါတ်</strong>
          <input type="text" name="emp_id_no" id="emp_id_no" class="form-control" value="{{ $teammember->emp_id_no }}" required>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
          <div class="form-group">
            <strong><span class="text-danger">*</span>City<br>&nbsp;မြို့</strong>
            <select class="form-control" name="city" id="city" required>
            <option value="">မြို့ရွေးချယ်ပါ</option>
            @foreach ($cities as $key => $city)
            @if ($key == $teammember->zone->city->id)
							<option value="{{$key}}" selected>{{$city}}</option>
						@else
							<option value="{{$key}}">{{$city}}</option>
						@endif
                {{-- <option value="{{$key}}">{{$city}}</option> --}}
            @endforeach
            </select>
          </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
          <div class="form-group">
            <strong><span class="text-danger">*</span>Zone<br>&nbsp;ဇုံ</strong>
            <select class="form-control" name="zone" id="zone" required>
              @foreach ($zones as $key => $z)
              @if ($key == $teammember->postal_address)
              <option value="{{ $key }}" selected>{{ $z }}</option>
            @else
              <option value="{{ $key }}">{{ $z }}</option>
            @endif
            @endforeach
            </select>
          </div>
        </div>

      <div class="col-md-6"></div>

      <div class="form-group col-md-3">
        <strong><span class="text-danger">*</span> Applicant Nation Id Front<br>&nbsp;မှတ်ပုံတင်အရှေ့</strong><br>
        <img src="{{ asset('customer_files/'.$teammember->application_id) }}" alt="application_id" class="img-thumbnail mb-1" style="">
        <input type="hidden" name="hidden_image" value="{{ $teammember->application_id }}" /><br>
        <input type="file" name="application_id" id="application_id" class="form-control-file">
      </div>
      <div class="form-group col-md-3">
        <strong><span class="text-danger">*</span> Applicant Nation Id Back<br>&nbsp;မှတ်ပုံတင်အနောက်</strong><br>
        <img src="{{ asset('customer_files/'.$teammember->applicant_id_one) }}" alt="applicant_id_one" class="img-thumbnail mb-1" style="">
        <input type="hidden" name="hidden_image" value="{{ $teammember->applicant_id_one }}" /><br>
        <input type="file" name="applicant_id_one" id="applicant_id_one" class="form-control-file">
      </div>

      <div class="form-group col-md-3">
        <strong><span class="text-danger">*</span> Household List Front<br>&nbsp;အိမ်ထောင်စုစာရင်းအရှေ့</strong><br>
        <img src="{{ asset('customer_files/'.$teammember->employee_info) }}" alt="employee_info" class="img-thumbnail mb-1" style="">
        <input type="hidden" name="hidden_image" value="{{ $teammember->employee_info }}" /><br>
        <input type="file" name="employee_info" id="employee_info" class="form-control-file">
      </div>
      <div class="form-group col-md-3">
        <strong><span class="text-danger">*</span> Household List Back<br>&nbsp;အိမ်ထောင်စုစာရင်းအနောက်</strong><br>
        <img src="{{ asset('customer_files/'.$teammember->employee_info_one) }}" alt="employee_info" class="img-thumbnail mb-1" style="">
        <input type="hidden" name="hidden_image" value="{{ $teammember->employee_info_one }}" /><br>
        <input type="file" name="employee_info" id="employee_info" class="form-control-file">
      </div>
      <div class="form-group col-md-12">
        <strong><span class="text-danger">*</span> Residential Address<br>&nbsp;အိမ်လိပ်စာ</strong>
        <textarea name="residential_address" id="residential_address" cols="30" rows="5" class="form-control" required>{{ $teammember->residential_address }}</textarea>
      </div>
      </div>

      <div class="repeater">
        <div class="form-row">
          <div class="form-group col-12">
            <strong>Emergency Contact Person <br>&nbsp;အရေးပေါ်ဆက်သွယ်ရန်ပုဂ္ဂိုလ်</strong>
            {{-- <a data-repeater-create href="#" class="btn btn-info btn-sm float-right">Add New<i class="fa fa-plus" aria-hidden="true"></i></a> --}}
            <input data-repeater-create class="btn btn-success float-right" type="button" value="အရေးပေါ်ဆက်သွယ်ရန်ပုဂ္ဂိုလ်ထည့်ရန်"/>
          </div>
        </div>
        @foreach ($teammember->emergency_contacts as $person)
          <div class="form-row">
            <div class="form-group col-md-4">
              <span class="text-secondary"><span class="text-danger">*</span> Mr/Mrs/Miss :</span>
              <input type="text" name="contact_name" id="contact_name" class="form-control" value="{{ $person->name }}" readonly required>
            </div>
            <div class="form-group col-md-4">
              <span class="text-secondary"><span class="text-danger">*</span> Contact Number /ဆက်သွယ်ရန်ဖုန်းနံပါတ်</span>
              <input type="text" name="contact_number" id="contact_number" class="form-control" value="{{ $person->phone }}" readonly required>
            </div>
            <div class="form-group col-md-3">
              <span class="text-secondary"><span class="text-danger">*</span> City /မြို့</span>
              <input type="text" name="city" id="city" class="form-control" value="{{ $person->city }}" readonly required>
            </div>
            <div class="form-group col-md-1">
              <input class="btn btn-danger mt-4" type="button" onclick="deleteContact({{ $person->id }})" value="ဖျက်ရန်" />
            </div>
          </div>
          {{-- <div class="form-row">
            <div class="form-group col-3">
              <strong><span class="text-danger">*</span> Mr/Mrs/Miss :</strong>
              <input type="text" name="contact_name" id="contact_name" class="form-control" value="{{ $person->name }}" readonly required>
            </div>

        
              <div class="form-group col-3">
                <strong>Contact Number :</strong>
                <input type="text" name="contact_number" id="contact_number" class="form-control" value="{{ $person->phone }}" readonly required>
              </div>
              <div class="form-group col-3">
                <strong>City :</strong>
                <input type="text" name="city" id="city" class="form-control" value="{{ $person->city }}" readonly required>
              </div>
              <div class="form-group col-3">
                <a type="submit" style="margin-top: 25px;" class="btn btn-danger btn-sm text-white" onclick="deleteContact({{ $person->id }})">Delete</a>
              </div>
      
          </div> --}}
        @endforeach
        <div data-repeater-list="contact_persons">
          <div data-repeater-item>
            <div class="form-row">
              <div class="form-group col-md-4">
                <span class="text-secondary"><span class="text-danger">*</span> Mr/Mrs/Miss :</span>
                <input type="text" name="contact_name" id="contact_name" class="form-control" placeholder="နာမည်အပြည့်အစုံ" required>
              </div>
              <div class="form-group col-md-4">
                <span class="text-secondary"><span class="text-danger">*</span> Contact Number/ဆက်သွယ်ရန်ဖုန်းနံပါတ် :</span>
                <input type="text" name="contact_number" id="contact_number" class="form-control" placeholder="Phone" required>
              </div>
              <div class="form-group col-md-3">
                <span class="text-secondary"><span class="text-danger">*</span> City/မြို့ :</span>
                <input type="text" name="city" id="city" class="form-control" placeholder="မြို့ထည့်ရန်" required>
              </div>
              <div class="form-group col-md-1">
                <input data-repeater-delete class="btn btn-danger mt-4" type="button" value="ဖျက်ရန်" />
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- <div class="form-row">
        <div class="form-group col-3">
          <strong>Password :</strong>
          <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="form-group col-3">
          <strong>Confirm Password :</strong>
          <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>
      </div> --}}

      <div class="form-row">
        <div class="form-group col-3">
          <a class="btn btn-secondary" href="{{ route('teammembers.index') }}"> ပယ်ဖျက်သည်</a>
          <button type="submit" class="btn btn-primary">ပြင်ဆင်သည်</button>
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
            initEmpty: true,
            defaultValues: {
                'text-input': 'foo'
            },
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                if(confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            },
            ready: function (setIndexes) {
                // $dragAndDrop.on('drop', setIndexes);
            },
        })
    });
      function deleteContact(contact_person){
        if (confirm('Are you sure you want to delete this element?')) {
          $.ajax({
            type: "POST",
            url: "/deleteContactPerson",
            data:
            {
              person_id: contact_person,
              _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
              if(result.success = true){
                window.location.reload();
              }
            },
            error: function(result) {
              alert('error');
            }
          }); 
        } 
      }
      $(document).ready(function () {
    $('#city').on('change', function () {
      var city = $(this).children('option:selected').val();
      $.ajax({

        type:'GET',

        url:'/city-zones',

        data:{city:city},

        success:function(data){

          if(data.success) {
            console.log(data);
            $('#zone').html('<option value="">Choose Zone</option>');
            $.each(data.zones, function (index, val) {
              $('#zone').append('<option value="'+val.id+'">'+val.name+'</option>');
            });
          } else {
            $('#zone').html('<option value="">Choose Zone</option>');
          }

        }

      });
      $('#postal_code').val('');
    });
  });
  </script>
@endpush