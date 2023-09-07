
@include('layouts.blog.header')
@include('layouts.blog.nav')
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <h1>Clean Blog</h1>
                            <span class="subheading">A Blog Theme by Start Bootstrap</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content-->
        <div class="container blog px-4 px-lg-5">
            @csrf
            <div class="row gx-4 gx-lg-5 ">
                <div class=" col-md-10 col-lg-8 col-xl-8">
                    <div class="blog-posts">
                        @include('blog.data')
                    </div>
                </div>
               <div class="col-md-2 col-lg-4 col-xl-4  pt-5">
                 @include('layouts.blog.rightside')
               </div>
            </div>
        </div>

        @include('layouts.blog.footer')

