@foreach ($freelancers as $freelancer)
                                <div class="col-lg-4 mb-4">
                                    <a href="{{ route('profile.show', $freelancer->id) }}">
                                        <div class="user_profile_main_box p-2">
                                            <div class="d-flex justify-content-between">
                                                <div class="user_img_profile_box">
                                                    @if (isset($freelancer->image))
                                                        <img src="{{ URL::asset('images/' . $freelancer->image) }}"
                                                            alt="">
                                                    @else
                                                        <img src="{{ URL::asset('images/profile.jpg') }}"
                                                            alt="">
                                                    @endif
                                                </div>
                                                <div class="user_live_button"></div>
                                                {{-- <div class="user_ofline_button"></div> --}}
                                                <div class="text-end">
                                                    <div>
                                                        @php(
                                                            $symbols = DB::table('currencies')->where('code', $freelancer->currency)->first()
                                                        )
                                                        @if (isset($freelancer->hourly_rate))
                                                            <span
                                                                class="fs-5 fw-bolder">{{ $symbols->symbol }}{{ $freelancer->hourly_rate }}
                                                                {{ $freelancer->currency }}</span><br>
                                                            <span class="text-end">{{__('per hour')}}</span>
                                                        @else
                                                            <span class="fs-5 fw-bolder"></span><br>
                                                            <span class="text-end"></span>
                                                        @endif
                                                    </div>
                                                    <div class="mt-5">
                                                        <a href="{{ route('chats.index', ['receiver_id' => $freelancer->id]) }}"
                                                            class="btn btn-primary">{{__('Chat')}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <h4>{{ $freelancer->name }}</h4>
                                            </div>

                                            <div class="my-2">
                                                <span><b>{{__('Skills:')}} </b></span>
                                                @php($uSkills = App\Models\marketplace\Marketplace_user_skills::where('user_id', $freelancer->id)->get())
                                                @foreach ($uSkills as $index => $userSkill)
                                                    @if ($index < 4)
                                                        <span>{{ $userSkill->name }}</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div>
                                                <span><b>{{__('About us:')}} </b></span>
                                                <span>{{ Str::limit($freelancer->about, 60, '..more') }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach