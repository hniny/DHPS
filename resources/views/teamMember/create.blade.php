@extends('layouts.app')
@section('content')
 <div class="row py-2">
   <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4>Create Team Member</h4>
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
    
      <div class="row">
        <div class="col-12">
          <form action="{{ route('teammembers.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
            @csrf
            @method('POST')
            <div class="form-row">
              <div class="form-group col-3">
                <strong for="name"><span class="text-danger">*</span> Full Name [Mr/Mrs/Miss]<br>&nbsp;နာမည်အပြည့်အစုံ (Mr/Mrs/Miss)</strong>
                <input type="text" name="name" class="form-control" placeholder="Name" required>
              </div>
              
                <div class="form-group col-3">
                  <strong for="home"><span class="text-danger">*</span> Contact Number : Home<br>&nbsp;အိမ်ဆက်သွယ်ရန်နံပါတ် </strong>
                  <input type="text" name="home_number" class="form-control" placeholder="Contact Number : Home" required>
                </div>
                <div class="form-group col-3">
                  <strong for="mobile"><span class="text-danger">*</span> Mobile <br>&nbsp;ဆက်သွယ်ရန်နံပါတ်</strong>
                  <input type="text" name="mobile_number" class="form-control" placeholder="Contact Number : Mobile" required>
                </div>
                
              <div class="form-group col-3">
                <strong for="email"><span class="text-danger">*</span>Email Address <br>&nbsp;အီးမေးလ်လိပ်စာ</strong>
                <input type="email" name="email" class="form-control" placeholder="Email Address" required>
              </div>
      
             
                <div class="form-group col-3">
                  <strong><span class="text-danger">*</span> Department <br>&nbsp;ဌာန</strong>
                  <select name="department_id" id="department" class="form-control" required>
                    <option value="">Select Department</option>
                    @foreach ($departments as $key => $department)
                      <option value="{{ $key }}">{{ $department }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-3">
                  <strong><span class="text-danger">*</span> Position <br>&nbsp;ရာထူး</strong>
                  <select name="position_id" id="position" class="form-control" required>
                    <option value="">Select Position</option>
                    @foreach ($positions as $key => $position)
                      <option value="{{ $key }}">{{ $position }}</option>
                    @endforeach
                  </select>
                </div>
             
      
                <div class="form-group col-md-3">
                  <strong><span class="text-danger">*</span> Starting Date <br>&nbsp;အလုပ်စဝင်သည့်နေ့</strong>
                  <input type="date" name="date_of_employee" id="date_of_employee" class="form-control" required>
                </div>
                <div class="form-group col-3">
                  <strong><span class="text-danger">*</span> Employee ID No <br>&nbsp;၀န်ထမ်း ID နံပါတ်</strong>
                  <input type="text" name="emp_id_no" id="emp_id_no" class="form-control" required>
                </div>
             
     
        <div class="col-xs-3 col-sm-3 col-md-3">
          <div class="form-group">
            <strong><span class="text-danger">*</span>City<br>&nbsp;မြို့</strong>
            <select class="form-control" name="city" id="city" required>
            <option value="">မြို့ရွေးချယ်ပါ</option>
            @foreach ($cities as $key => $city)
                <option value="{{$key}}">{{$city}}</option>
            @endforeach
            </select>
          </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
          <div class="form-group">
            <strong><span class="text-danger">*</span>Zone<br>&nbsp;ဇုံ</strong>
            <select class="form-control" name="zone" id="zone" required>
            <option value="">ဇုံရွေးချယ်ပါ</option>
            </select>
            <!-- <input type="hidden" name="postal_code" id="postal_code"> -->
          </div>
        </div>
    <div class="col-md-6"></div>
              
              {{-- <div class="form-group col-6">
                <strong><span class="text-danger">*</span> Postal Address<br>&nbsp;</strong>
                <textarea name="postal_address" id="postal_address" cols="30" rows="5" class="form-control" required></textarea>
              </div> --}}
      
              <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                  <strong><span class="text-danger">*</span>Applicant National ID Front<br>&nbsp;မှတ်ပုံတင်အရှေ့</strong>
                  <input type="file" class="form-control-file" name="application_id" id="application_id" placeholder="မှတ်ပုံတင်အရှေ့" aria-describedby="fileHelpId" required>
                  <div class="invalid-feedback">
                    မှတ်ပုံတင်အရှေ့ထည့်ပါ...
                  </div>
                </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                  <div class="form-group">
                  <strong><span class="text-danger">*</span>Applicant National ID Back<br>&nbsp;မှတ်ပုံတင်အနောက်</strong>
                  <input type="file" class="form-control-file" name="applicant_id_one" id="applicant_id_one" placeholder="မှတ်ပုံတင်အနောက်" aria-describedby="fileHelpId" required>
                  <div class="invalid-feedback">
                    မှတ်ပုံတင်အနောက်ထည့်ပါ...
                    </div>
                  </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                  <div class="form-group">
                    <strong><span class="text-danger">*</span>Household List Front<br>&nbsp;အိမ်ထောင်စုစာရင်းအရှေ့</strong>
                    <input type="file" class="form-control-file" name="employee_info" id="employee_info" placeholder="အိမ်ထောင်စုစာရင်းအရှေ့" aria-describedby="fileHelpId" required>
                    <div class="invalid-feedback">
                      အိမ်ထောင်စုစာရင်းအရှေ့ထည့်ပါ...
                    </div>
                  </div>
                  </div>
                  <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                    <strong><span class="text-danger">*</span>Household List Back<br>&nbsp;အိမ်ထောင်စုစာရင်းအနောက်</strong>
                    <input type="file" class="form-control-file" name="employee_info_one" id="employee_info_one" placeholder="အိမ်ထောင်စုစာရင်းအနောက်" aria-describedby="fileHelpId" required>
                    <div class="invalid-feedback">
                      အိမ်ထောင်စုစာရင်းအနောက်ထည့်ပါ... 
                    </div>
                    </div>
                  </div>
                  <div class="form-group col-md-12">
                    <strong><span class="text-danger">*</span> Residential Address<br>&nbsp;အိမ်လိပ်စာ</strong>
                    <textarea name="residential_address" id="residential_address" cols="30" rows="5" class="form-control" required></textarea>
                  </div>
          
      
             
            
              {{-- <div class="form-group col-3">
                <strong><span class="text-danger">*</span> Password :</strong>
                <input type="password" name="password" id="password" class="form-control" required>
              </div>
              <div class="form-group col-3">
                <strong><span class="text-danger">*</span> Confirm Password :</strong>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
              </div> --}}
            </div>
    
    <hr>
            <div class="repeater">
              <div class="form-row">
                <div class="form-group col-md-6">
                <strong>Emergency Contact Person<br>&nbsp;အရေးပေါ်ဆက်သွယ်ရန်ပုဂ္ဂိုလ်</strong>
                </div>
                <div class="form-group col-md-6 text-right">
                {{-- <a data-repeater-create href="#" class="btn btn-success pull-right">Add Emergency Contact Person<i class="fa fa-plus" aria-hidden="true"></i></a> --}}
                <input data-repeater-create class="btn btn-success" type="button" value="အရေးပေါ်ဆက်သွယ်ရန်ပုဂ္ဂိုလ်ထည့်ရန်"/>
                </div>
              </div>

              <div data-repeater-list="contact_persons">
                <div data-repeater-item>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <span class="text-secondary"><span class="text-danger">*</span> Mr/Mrs/Miss </span>
                        <input type="text" name="contact_name" id="contact_name" class="form-control" placeholder="Full Name" required>
                    </div>
                    <div class="form-group col-md-4">
                      <span class="text-secondary"><span class="text-danger">*</span> Contact Number/ဆက်သွယ်ရန်ဖုန်းနံပါတ်</span>
                      <input type="text" name="contact_number" id="contact_number" class="form-control" placeholder="ဆက်သွယ်ရန်ဖုန်းနံပါတ်ထည့်ရန်" required>
                    </div>
                    <div class="form-group col-md-3">
                      <span class="text-secondary"><span class="text-danger">*</span> City/မြို့ </span>
                        <input type="text" name="city" id="city" class="form-control" placeholder="မြို့ထည့်ရန်" required>
                    </div>
                    <div class="form-group col-md-1">
                      <input data-repeater-delete class="btn btn-danger mt-4" type="button" value="ဖျက်ရန်" />
                    </div>
                  </div>
                </div>
              </div>

            </div>
    
            
            <div class="form-group col-3">
              <a class="btn btn-secondary" href="{{ route('teammembers.index') }}"> နောက်သို့ </a>
              <button type="submit" class="btn btn-primary">သိမ်းဆည်းသည်</button>
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
                
            },
    });
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
      // $('#postal_code').val('');
    });

    // $('#township').on('change', function () {
    //   var postal_code = $(this).children('option:selected').data('id');
    //   if (postal_code) {
    //     $('#postal_code').val(postal_code);
    //   } else {
    //     $('#postal_code').val('');
    //   }
    // });
    });
  </script>
@endpush