<section class="d-padding home-bottom-slider">
    <div class="top-heading-part">
        <div class="container">
            <div class="row heading-h2 text-center justify-content-center">
                <div class="col-md-9">
                    <h2>Some of smiley Faces</h2>
                    <p>Totam eu vivamus! Doloremque est omnis possimus torquent et tellus provident eaque aptent natoque quos, sapiente voluptatibus earum, pretium vulputate aliqua sapiente.</p>
                </div>

            </div>
        </div>
    </div>
    <div class="bottom-slider">
        @if (count($gallery) > 0)
            <div class="swiper-container">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    @foreach ($gallery as $slide)
                        <div class="swiper-slide">
                            <img src="{{asset('images/gallery_images/'.$slide->img)}}">
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <p class="p-5 text-center">No Slide Found ...</p>
        @endif

    </div>
</section>
