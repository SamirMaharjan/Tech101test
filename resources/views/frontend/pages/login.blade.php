@extends('frontend.layouts.master')
@section('content')
<h2>Stacked form</h2>
<form action="{{route('post_login')}}" method="POST">
  @csrf
    <div class="mb-3 mt-3">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    <div class="mb-3">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
    </div>
    <div class="form-check mb-3">
   
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
      
  @endsection