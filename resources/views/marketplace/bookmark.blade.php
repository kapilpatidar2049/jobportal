@extends('marketplace.layouts.master')
@section('title', 'Bookmarked-Project')
@section('page-title', 'Bookmarked-Project')
@section('body')

<body data-sidebar="colored">@endsection
    @section('content')

        <div class="">
            <div class="container p-4">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">{{__('Project/Contest')}}</th>
                            <th scope="col">{{__('Bids/Entries')}}</th>
                            <th scope="col">{{__('Started')}}</th>
                            <th scope="col">{{__('Price')}}</th>
                        </tr>
                    </thead>
                    <tbody class="bookmark_tbody_box">
                        <tr class="bookmark_tr_box">
                            <td scope="row">
                                <div class="bookmark_main_item_box">
                                    <a href="{{ route('project-details', 1) }}">
                                        <div class="d-flex bookmark_item_box">
                                            <div class="Save_Project_image_box ">
                                                <img src="{{ URL::asset('images/profile.jpg') }}" alt="Project">
                                            </div>
                                            <div>
                                                <h5>{{ __('Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi, velit.') }}
                                                </h5>
                                                <span>{{ __('Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta illo vero omnis eos voluptatem doloribus doloremque ab porro delectus modi, harum laboriosam natus iusto facilis provident cumque fugit deserunt voluptas.Accusamus, error et? Quia impedit odit quam nisi maiores doloremque architecto dolores eaque deserunt dicta tempora ullam ratione dolorem nam molestiae, provident ipsam. Quos soluta perferendis culpa nihil minus animi.') }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </td>
                            <td>{{__('55')}}</td>
                            <td>{{__('Dec-26-2024')}}</td>
                            <td>{{__('$140.00 USD')}}</td>
                           
                        </tr>
                        
                      
                    </tbody>
            </div>
        </div>

    @endsection
    @section('scripts')
    @endsection
