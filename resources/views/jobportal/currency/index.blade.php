@extends('jobportal.layouts.master')
@section('title', 'Currencies')
@section('main-container')
    <div class="dashboard-card">
        @component('jobportal.components.breadcumb', ['thirdactive' => 'active'])
            @slot('heading')
                {{ __('Currencies') }}
            @endslot
            @slot('menu1')
                {{ __('Project Settings') }}
            @endslot
            @slot('menu2')
                {{ __('Currencies') }}
            @endslot
            @slot('button')
            <div class="col-md-6 col-lg-6">
                <div class="widget-button">
                    {{-- @can('currency.view') --}}
                        <a type="button" class="btn btn-primary me-2" title="{{ __('Add') }}"
                            data-bs-toggle="modal" data-bs-target="#bulk_delete"><i class="flaticon-plus"></i>
                            {{ __('Add') }}</a>
                    {{-- @endcan
                    @can('currency.create') --}}
                        <a href="javascript:void(0)" type="button" class="btn btn-secondary me-2"
                            title="{{ __('Enter Key') }}" data-bs-toggle="modal" data-bs-target="#enterkey"><i
                                class="flaticon-key"></i> {{ __('Enter Key') }}</a>
                    {{-- @endcan

                    @can('currency.edit') --}}
                        <a href="{{ route('update_currency') }}" type="button" title="{{ __('Update Currency') }}"
                            class="btn btn-danger"><i class="flaticon-refresh"></i> {{ __('Update Currency') }}</a>
                    {{-- @endcan --}}
                </div>
            </div>
            @endslot
        @endcomponent
        <div class="contentbar ">
            <!-- form code start -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="client-area">
                        <div class="table-responsive">
                            <!-- table code start-->
                            @include('jobportal.layouts.flash_msg')
                            <table class="table data-table display nowrap " id="example">
                                <thead>
                                    <tr>
                                        <th>{{ __('#') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Code') }}</th>
                                        <th>{{ __('Symbol') }}</th>
                                        <th>{{ __('Format') }}</th>
                                        <th>{{ __('Exchange Rate') }}</th>
                                        <th>{{ __('Default') }}</th>
                                        @can('currency.delete')
                                            <th>{{ __('Action') }}</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody id="sortable-table">
                                    @if (isset($currency))
                                        @foreach ($currency as $data)
                                            <tr>
                                                <td class="py-1">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    {{ $data->name }}
                                                </td>
                                                <td>
                                                    {{ $data->code }}
                                                </td>
                                                <td>
                                                    {{ $data->symbol }}
                                                </td>
                                                <td>
                                                    {{ $data->format }}
                                                </td>
                                                <td>
                                                    {{ $data->exchange_rate }}
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input status11 toggle-switch"
                                                            type="checkbox" role="switch"
                                                            id="statusToggle{{ $data->id }}" name="default"
                                                            data-id="{{ $data->id }}" value="1"
                                                            {{ $data->default == 1 ? 'checked' : '' }}>
                                                    </div>
                                                </td>
                                                @can('currency.delete')
                                                    <td>
                                                        <div class="dropdown action-dropdown">
                                                            <a class="dropdown-toggle" href="javascript:void(0)" role="button"
                                                                title="{{ __('Action') }}" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="flaticon-dots"></i>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li>

                                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#exampleModal{{ $data->id }}"
                                                                        title="{{ __('Delete') }}"><i
                                                                            class="flaticon-delete"></i>
                                                                        {{ __('Delete') }}</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                @endcan
                                            </tr>
                                            <!--- model Start --->
                                            <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                {{ __('Are You Sure ?') }}</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>{{ __('Do you really want to delete') }} ?
                                                                {{ __('This process cannot be undone.') }}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="post"
                                                                action="{{ url('admin/currency/' . $data->id . '/delete') }}"
                                                                class="pull-right">
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                                <button type="reset" class="btn btn-secondary"
                                                                    title="{{ __('No') }}"
                                                                    data-bs-dismiss="modal">{{ __('No') }}</button>
                                                                <button type="submit" title="{{ __('Yes') }}"
                                                                    class="btn btn-primary">{{ __('Yes') }}</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- model end -->
                                        @endforeach
                                        <!-- loop  Print data show end -->
                                    @endif
                                </tbody>
                            </table>
                            <!-- table code end  -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="enterkey" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <a href="https://openexchangerates.org/signup/free" target="_black"
                            title="{{ __('Get Your OPEN EXCHANGE RATE KEY From Here') }}"><i
                                class="flaticon-key me-2"></i>{{ __(' Get Your OPEN EXCHANGE RATE KEY From Here ') }}</a>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('exchange.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-8">
                                    <label for="OPEN_EXCHANGE_RATE_KEY"
                                        class="form-label">{{ __('OPEN EXCHANGE RATE KEY') }}</label>
                                    <span class="required">*</span>
                                </div>
                                <div class="col-lg-4">
                                    <div class="suggestion-icon float-end">
                                        <div class="tooltip-icon">
                                            <div class="tooltip">
                                                <div class="credit-block">
                                                    <small
                                                        class="recommended-font-size">{{ __(' It will be used to fetch exchange rates of currencies. ') }}</small>
                                                </div>
                                            </div>
                                            <span class="float-end"><i class="flaticon-info"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input class="form-control @error('OPEN_EXCHANGE_RATE_KEY') is-invalid @enderror"
                                type="password" name="OPEN_EXCHANGE_RATE_KEY"
                                placeholder="{{ __('Enter Your OPEN EXCHANGE RATE KEY') }}" value="{{ $openKey }}"
                                id="OPEN_EXCHANGE_RATE_KEY">
                            @error('OPEN_EXCHANGE_RATE_KEY')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                            <div class="form-control-icon"><i class="flaticon-key"></i></div>
                        </div>
                        <button type="submit" class="btn btn-primary float-end">{{ __('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--- currency Modal start -->
    <div class="modal fade" id="bulk_delete" tabindex="-1" aria-labelledby="bulkDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('currency.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="bulkDeleteLabel">{{ __('Add Currency') }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="code" class="form-label">{{ __('Currency (ISO Code 3)') }}<span
                                class="required">*</span></label>
                        <input
                            class="form-control form-control-lg form-control-padding_15 @error('code') is-invalid @enderror"
                            type="text" name="code" id="code"
                            placeholder="{{ __('Please Enter Currency (ISO Code 3)') }}" aria-label="title">
                        @error('code')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('No') }}</button>
                        <button type="submit" class="btn btn-primary"
                            title="{{ __('Create') }}">{{ __('Create') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- currency Modal end -->
@endsection
