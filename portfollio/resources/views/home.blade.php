@extends('layout.app')
@section('title', 'Home')
@section('content')

@include('component.homebanner')

@include('component.homeservice')

@include('component.HomeCourse')

@include('component.HomeProject')

@include('component.HomeContact')

@include('component.HomeReview')

@endsection

