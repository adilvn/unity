@extends('visitor.layout.mainlayout')
@section('title', 'All Donators')
@section('content')
    <section class="inner_header gestures">
        <div class="container">
            <h2>Our Donators</h2>
            <p class="text-white">It’s no secret that what goes around comes around. Offer a kind gesture to someone in need and let that altruistic energy flow. A cup of coffee, some groceries, or just a safe place to sleep; you have the power to make a positive difference in someone's life.</p>
        </div>
    </section>

    <section class="donators_wrapp d-padding">
        <div class="container">
            <form action="{{route('search-donators')}}" method="POST">
                @csrf
                <div class="search_wrapp">
                    <input type="search" class="form-control" placeholder="Search Donators" name="search_text">
                    <button type="submit" class="search_btn"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <div class="row">
                @if (count($users) > 0)
                    @foreach ($users as $user)
                        <div class="col-lg-4 col-sm-6">
                            <div class="donator_box">
                                <div class="donators_info">
                                    <div class="donators_img">
                                        <img src="
                                        @if ($user->profile_pic == null)
                                            https://eu.ui-avatars.com/api/?name={{$user->fname}}+{{$user->lname}}&background=1c252c&color=fff&size=256
                                        @else
                                            {{asset('images/profile_images/'.$user->profile_pic)}}
                                        @endif" alt="">
                                    </div>
                                    <h4>{{$user->fname." ".$user->lname}}</h4>
                                    <span class="unity-user">
                                        {{Str::upper($user->username)}}
                                    </span>
                                </div>
                                <ul class="likes_wrapp">
                                    <li><a href="javascript:void(0)" class="donate"><img src="images/donate.png" alt="">{{\App\Models\Order::where('donator_id', $user->id)->sum('qty')}}</a></li>
                                    <li><a href="javascript:void(0)" class="likes"><img src="images/like.png" alt="">{{\App\Models\Message::where('donator_id', $user->id)->count()}}</a></li>
                                </ul>
                                <div class="thank_wrapp">
                                    <button type="button" class="say-thanks" data-id="{{$user->id}}" data-bs-toggle="modal" data-bs-target="#donatorModal">
                                        Say thanks!<i class="far fa-smile ms-1"></i>
                                    </button>
                                </div>
                                <div class="modal fade" id="donatorModal" tabindex="-1" aria-labelledby="donatorModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{route('send-message')}}" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="donatorModalLabel">Send Your Message To Donators</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="text" id="donator_id" name="donator_id" value="" hidden>
                                                    <div class="form-floating">
                                                        <textarea class="form-control" placeholder="Write Your Message" rows="5" name="message">{{old('message')}}</textarea>
                                                        <label for="Review">Write Your Message</label>
                                                    </div>
                                                    <div class="thank_wrapp">
                                                        <button type="submit" class="say-thanks">Send Message</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="p-5 text-center">No Donator Found ...</p>
                @endif
            </div>
            <div class="pagination justify-content-center mt-4">
                {{ $users->links() }}
        </div>
        </div>
    </section>
    @include('visitor.inc.cta')
    @include('visitor.inc.gallery')
@endsection
@section('bodyExtra')
    <script>
        $('#donatorModal').on('shown.bs.modal', function(e) {
            var link = $(e.relatedTarget),
                modal = $(this),
                id = link.data("id");
            modal.find("#donator_id").val(id);
        });
    </script>
    <script>
        @if (Session::has('message-send-success'))
            toastr.options =
            {
                "timeOut": "3000",
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ Session::get('message-send-success') }}");
        @endif
        @if (Session::has('message-send-error'))
            toastr.options =
            {
                "timeOut": "3000",
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ Session::get('message-send-error') }}");
        @endif
    </script>
@endsection
