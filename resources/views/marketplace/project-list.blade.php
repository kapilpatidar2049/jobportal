@foreach ($project as $pItem)
                                <div class="project_main_box">
                                    <div class="container p-4">
                                        <div class="project_heading_box mb-2">
                                            <div class="project_item_small_box">
                                                <h2 class="mb-2">{{ $pItem->name }}</h2>
                                                @php(
                                                    $symbols = DB::table('currencies')->where('code', $pItem->currency)->first()
                                                )
                                                <h6>{{__('Budget')}} {{ $symbols->symbol }}{{ $pItem->min_rate }} - {{ $pItem->max_rate }} {{ $pItem->currency }}</h6>
                                            </div>
                                            <div class="project_item_small_box d-flex">
                                                <div class="me-3">
                                                    @php($bidCount =App\Models\marketplace\Marketplace_bids::where('project_id',$pItem->id)->count())
                                                    <h4>{{$bidCount}} {{__('Bids')}}</h4>
                                                </div>
                                                <div>
                                                <h2 class="mb-2">
                                                    @php($avg_rate = ($pItem->min_rate + $pItem->max_rate) / 2)
                                                    {{ $symbols->symbol }}{{ $avg_rate }} {{ $pItem->currency }}
                                                </h2>
                                                <h6>{{ $pItem->project_rate }} {{__('Rate')}}</h6>
                                               </div>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="{{ route('project-details', $pItem->id) }}">
                                                <p>{{ Str::words($pItem->description, 50, '...more') }}</p>
                                            </a>
                                        </div>
                                        <div class="mb-3">
                                            @php($skills = App\Models\marketplace\Marketplace_project_skills::where('project_id', $pItem->id)->get())
                                            @foreach ($skills as $skill)
                                                <span>{{ Str::words($skill->name, 5, '...more') }}</span>
                                            @endforeach
                                        </div>
                                        <div class="project_rating_box ">
                                            <div class="project_rating_box">
                                                <span class="me-2">{{ $pItem->created_at }}</span>
                                                @php(
                                                    $bookmarks = App\Models\marketplace\Marketplace_bookmarks::where('project_id', $pItem->id)
                                                        ->where('user_id', Auth::user()->id)
                                                        ->first()
                                                )
                                                <span>
                                                    @if ($bookmarks)
                                                        <i class="fa-solid fa-bookmark fs-4 project_bookmark" data-project-id="{{ $pItem->id }}"></i>
                                                    @else
                                                        <i class="fa-regular fa-bookmark fs-4 project_bookmark" data-project-id="{{ $pItem->id }}"></i>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach