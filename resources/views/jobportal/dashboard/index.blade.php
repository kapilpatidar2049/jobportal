@extends('jobportal.layouts.master')
@section('title','Dashboard')
@section('main-container')
@php($changedCurrency = Session::get('changed_currency'))
<h1>{{currency(1, 'USD', $changedCurrency)}}</h1>
@endsection
