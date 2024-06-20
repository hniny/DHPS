@extends('layouts.app')


@section('content')
    <div class="row mt-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Team Member Informations</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <strong>Full Name (Mr/Mrs/Miss):</strong>
        </div>
        <div class="col-md-6">
          {{-- {{ dd($teammember) }} --}}
          <strong>{{ isset($teammember->users) ? $teammember->users->name : '~' }}</strong>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <strong>Department:</strong>
        </div>
        <div class="col-md-6">
            <strong>{{ isset($teammember->departments) ? $teammember->departments->dep_name : '~' }}</strong>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <strong>Position:</strong>
        </div>
        <div class="col-md-6">
            <strong>{{ isset($teammember->positions) ? $teammember->positions->position_name : '~' }}</strong>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <strong>Home Contact Number:</strong>
        </div>
        <div class="col-md-6">
          <strong>{{ $teammember->home_number }}</strong>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <strong>Mobile Contact Number:</strong>
        </div>
        <div class="col-md-6">
          <strong>{{ $teammember->mobile_number }}</strong>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <strong>Login Email Address:</strong>
        </div>
        <div class="col-md-6">
          <strong>{{ isset($teammember->users) ? $teammember->users->email : '~' }}</strong>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <strong>Date Of Employee:</strong>
        </div>
        <div class="col-md-6">
          <strong>{{ $teammember->date_of_employee }}</strong>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <strong>Employee ID No:</strong>
        </div>
        <div class="col-md-6">
          <strong>{{ $teammember->emp_id_no }}</strong>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <strong>Residential Address:</strong>
        </div>
        <div class="col-md-6">
          <strong>{{ $teammember->residential_address }}</strong>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <strong>Office Address/Postal Address:</strong>
        </div>
        <div class="col-md-6">
          <strong>{{ $teammember->zone->name }}</strong>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <strong>Application:</strong>
        </div>
        <div class="col-md-6">
          <img src="{{ asset('customer_files/'.$teammember->application_id) }}" alt="Application ID" style="width: 100px;">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <strong>Employee Info:</strong>
        </div>
        <div class="col-md-6">
          <img src="{{ asset('customer_files/'.$teammember->employee_info) }}" alt="Employee Info" style="width: 100px;">
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <strong>Emergency Contact</strong>
      </div>
    </div>
    @forelse ($teammember->emergency_contacts as $contact)
    <div class="row">
      <div class="col-md-6">
          <strong>Name:</strong>
      </div>
      <div class="col-md-6">
        <strong>{{ $contact->name }}</strong>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
          <strong>Phone:</strong>
      </div>
      <div class="col-md-6">
        <strong>{{ $contact->phone }}</strong>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
          <strong>City:</strong>
      </div>
      <div class="col-md-6">
        <strong>{{ $contact->city }}</strong>
      </div>
    </div>
    @empty
    @endforelse
    <br>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 ">
        <a class="btn btn-secondary" href="{{ route('teammembers.index') }}">Back</a>
        {{-- <button type="submit" class="btn btn-primary">Edit</button> --}}
      </div>
    </div>
@endsection