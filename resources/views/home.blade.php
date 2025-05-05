
@extends('layout')
@section('section1')
<div id="mainSlider" class="carousel slide mt-3" data-bs-ride="carousel" style="height: 250px;" >
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('storage/j1.jpg') }}" class="d-block w-100" alt="Slider 1">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('storage/j2.jpg') }}" class="d-block w-100" alt="Slider 2">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('storage/j33.jpg') }}" class="d-block w-100" alt="Slider 3">
    </div>
  </div>
</div>
@endsection