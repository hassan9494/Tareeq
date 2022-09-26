<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner scroll-content scroll-scrolly_visible">
        <div class="sidebar-content">

            <ul class="nav nav-primary">

                <li class="nav-item">
                    <a href="{{url('admin/slider')}}">
                        <i class="far fa-images"></i>
                        <span class="sub-item">{{__('Slider')}}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('admin/aboutUs')}}">
                        <i class="far fa-address-card"></i>
                        <span class="sub-item">{{__('About')}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/freetrial')}}">
                        <i class="fas fa-image"></i>
                        <p>{{__('free trial')}}</p>
                    </a>

                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#partners">
                        <i class="far fa-handshake"></i>
                        <p>{{__('partners')}}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="partners">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{url('admin/partners')}}">
                                    <span class="sub-item">{{__('Image')}}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('admin/images')}}">
                                    <span class="sub-item">{{__('Show Images')}}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#feature">
                        <i class="fas fa-align-left"></i>
                        <p>{{__('Feature')}}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="feature">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{url('admin/feature/create')}}">
                                    <span class="sub-item">{{__('Create Feature')}}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('admin/feature/')}}">
                                    <span class="sub-item">{{__('All Features')}}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('admin/featureSetting')}}">
                                    <span class="sub-item">{{__('Feature Setting')}}</span>
                                </a>`
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#testmonial">
                        <i class="fas fa-calendar-alt"></i>
                        <p>{{__('Testimonial')}}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="testmonial">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{url('admin/testmonials/create')}}">
                                    <span class="sub-item">{{__('Create')}}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('admin/testmonials/')}}">
                                    <span class="sub-item">{{__('Testimonials')}}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('admin/testmonialSetting')}}">
                                    <span class="sub-item"> {{__('Setting')}}</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>


{{--                <li class="nav-item">--}}
{{--                    <a data-toggle="collapse" href="#base">--}}
{{--                        <i class="fas fa-layer-group"></i>--}}
{{--                        <p>{{__('Blog')}}</p>--}}
{{--                        <span class="caret"></span>--}}
{{--                    </a>--}}
{{--                    <div class="collapse" id="base">--}}
{{--                        <ul class="nav nav-collapse">--}}
{{--                            <li>--}}
{{--                                <a href="{{url('admin/posts/create')}}">--}}
{{--                                    <span class="sub-item">{{__('Create Post')}}</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="{{url('admin/BlogCategory')}}">--}}
{{--                                    <span class="sub-item">{{__('Blog Category')}}</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="{{url('admin/posts/')}}">--}}
{{--                                    <span class="sub-item">{{__('All Posts')}}</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="{{url('admin/blogCategorySetting')}}">--}}
{{--                                    <span class="sub-item">{{__('Setting')}}</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}

{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </li>--}}
                <li class="nav-item">
                    <a data-toggle="collapse" href="#product">
                        <i class="fa fa-book"></i>
                        <p>{{__('Courses')}}</p>
                        <span class="badge badge-danger">
                            {{$views = App\Order::where('status', 'new')->count()}}
                        </span>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="product">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{url('admin/courses/create')}}">
                                    <span class="sub-item">{{__('Create Course')}}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('admin/courses/')}}">
                                    <span class="sub-item">{{__('All Courses')}}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('admin/categoryProduct')}}">
                                    <span class="sub-item">{{__('Categories')}}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('admin/productSetting')}}">
                                    <span class="sub-item">{{__('Setting')}}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('admin/orders')}}">
                                    <span class="sub-item">{{__('Free Trials')}}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#classes">
                        <i class="fa fa-book-reader"></i>
                        <p>{{__('Classes')}}</p>

                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="classes">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{url('admin/classes/create')}}">
                                    <span class="sub-item">{{__('Create Class')}}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('admin/classes/')}}">
                                    <span class="sub-item">{{__('All Classes')}}</span>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>

{{--                <li class="nav-item">--}}
{{--                    <a data-toggle="collapse" href="#page">--}}
{{--                        <i class="fas fa-file-alt"></i>--}}
{{--                        <p>{{__('Pages')}}</p>--}}
{{--                         <span class="badge badge-danger">--}}
{{--                           {{$views = App\Requests::whereNotNull('page_id')->where('views','==', 0)->count()}}--}}
{{--                        </span>--}}

{{--                        <span class="caret"></span>--}}
{{--                    </a>--}}
{{--                    <div class="collapse" id="page">--}}
{{--                        <ul class="nav nav-collapse">--}}
{{--                            <li>--}}
{{--                                <a href="{{url('admin/pages')}}">--}}
{{--                                    <span class="sub-item">{{__('Pages')}}</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="{{url('admin/pages/create')}}">--}}
{{--                                    <span class="sub-item">{{__('Create page')}}</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="{{url('admin/requestsPage')}}">--}}
{{--                                    <span class="sub-item">{{__('Requests')}}</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </li>--}}

{{--                <li class="nav-item">--}}
{{--                    <a href="{{url('admin/sectionSort')}}">--}}
{{--                        <i class="fas fa-align-center"></i>--}}
{{--                        <p>{{__('sort Sections')}}</p>--}}
{{--                    </a>--}}

{{--                </li>--}}


                <li class="nav-item">
                    <a href="{{url('admin/package')}}">
                        <i class="fas fa-money-bill"></i>
                        <p>{{__('Pricing')}}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/teachers')}}">
                        <i class="fa fa-user"></i>
                        <p>{{__('Teachers')}}</p>
                        <span class="badge badge-danger">
                            {{$views = App\User::where('type', 'teacher')->where('approved', '0')->count()}}
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/students')}}">
                        <i class="fas fa-users"></i>
                        <p>{{__('Students')}}</p>
                        <span class="badge badge-danger">
                            {{$views = App\User::where('type', 'student')->where('approved', '0')->count()}}
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#accounting">
                        <i class="fa fa-book"></i>
                        <p>{{__('Accounting')}}</p>
                        <span class="badge badge-danger">
                            {{$views = App\Models\Voucher::where('type','income')->where('view', '0')->count()}}
                        </span>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="accounting">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{route('admin.voucher.income.all')}}">
                                    <span class="sub-item">{{__('Income')}}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.voucher.all')}}">
                                    <span class="sub-item">{{__('Expense')}}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/jobs')}}">
                        <i class="fas fa-book"></i>
                        <p>{{__('Jobs')}}</p>
                        <span class="badge badge-danger">
                            {{$views = App\Models\Job::where('view','==', 0)->count()}}
                        </span>
                    </a>

                </li>
               <!--  <li class="nav-item">
                    <a href="{{url('admin/message')}}">
                        <i class="fas fa-book"></i>
                        <p>{{__('Messages')}}</p>
                        <span class="badge badge-danger">
                            {{$views = App\Message::where('views','==', 0)->count()}}
                        </span>
                    </a>

                </li> -->


            </ul>
        </div>
    </div>
    <!-- model setting-->

</div>
<!-- End Sidebar -->

