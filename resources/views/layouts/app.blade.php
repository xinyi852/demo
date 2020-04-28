<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>TrustOcean工作日报系统</title>
    <link href="/bower_components/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="/bower_components/dropzone/dist/dropzone.css" rel="stylesheet">
    <link href="/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
    <link href="/bower_components/slick-carousel/slick/slick.css" rel="stylesheet">
    <link href="/icon_fonts_assets/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
    <link href="/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="/css/main.css?version=4.4.0" rel="stylesheet">
    <script type="text/javascript" src="/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="/js/jquery.dataTables.min.js"></script>
    @yield('script')
    <style>
        div{
            padding: 1px;
        }
    </style>

</head>
<body class="menu-position-side menu-side-left full-screen" style="padding: 20px;height: 100%">
<div class="all-wrapper solid-bg-all" >
    <div class="top-bar color-scheme-offical">
        <!--------------------
        START - Top Menu Controls
        -------------------->
        <div class="top-menu-controls">
            <div class="leapki-lock">
                <span>版本 1.0 beta</span>
            </div>
        </div>
        <!--------------------
        END - Top Menu Controls
        -------------------->
    </div>
    <div class="layout-w">
        <!--------------------
        START - Mobile Menu
        -------------------->
        <div class="menu-mobile menu-activated-on-click color-scheme-dark">
            <div class="mm-logo-buttons-w">
                <a class="mm-logo" href="">
                    <img src="">
                    TrustOcean工作日报管理系统
                </a>
                <div class="mm-buttons">
                    <div class="content-panel-open">
                        <div class="os-icon os-icon-grid-circles"></div>
                    </div>
                    <div class="mobile-menu-trigger">
                        <div class="os-icon os-icon-hamburger-menu-1"></div>
                    </div>
                </div>
            </div>
            <div class="menu-and-user">

                <!--------------------
                START - Mobile Menu List
                -------------------->
                <li class="sub-header">
                    <span>账户管理</span>
                </li>
                <li class="selected">
                    <a href="/client/profile">
                        <div class="icon-w">
                            <i class="icon-user-following"></i>
                        </div>
                        我的资料</a>
                </li>
                <li class="selected">
                    <a href="">
                        <div class="icon-w">
                            <i class="icon-social-google"></i>
                        </div>
                        登陆保护</a>
                </li>
                <li class="selected">
                    <a href="/client/changepassword">
                        <div class="icon-w">
                            <i class="icon-key"></i>
                        </div>
                        修改密码</a>
                </li>
                <li class="selected">
                    <a href="{{ url('/logout') }}">
                        <div class="icon-w">
                            <i class="os-icon os-icon-signs-11"></i>
                        </div>
                        注销系统
                    </a>
                </li>

                <ul class="main-menu">

                    <li class="sub-header">
                        <span>账户管理</span>
                    </li>
                    <li class="selected">
                        <a href="/admin/setting/changepassword">
                            <div class="icon-w">
                                <i class="icon-key"></i>
                            </div>
                            修改密码
                        </a>
                    </li>
                    <li class="selected">
                        <a href="">
                            <div class="icon-w">
                                <i class="os-icon os-icon-signs-11"></i>
                            </div>
                            退出系统
                        </a>
                    </li>

                    <li class="sub-header">
                        <span>证书管理</span>
                    </li>
                    <li class="selected">
                        <a href="/client/digitalcert/list">
                            <div class="icon-w">
                                <i class="icon-speedometer"></i>
                            </div>
                            证书管理</a>
                    </li>

                    <li class="sub-header">
                        <span>账户管理</span>
                    </li>
                    <li class="selected">
                        <a href="/client/profile">
                            <div class="icon-w">
                                <i class="icon-user-following"></i>
                            </div>
                            我的资料</a>
                    </li>
                    <li class="selected">
                        <a href="/client/changepassword">
                            <div class="icon-w">
                                <i class="icon-key"></i>
                            </div>
                            修改密码</a>
                    </li>
                    <li class="selected">
                        <a href="">
                            <div class="icon-w">
                                <i class="os-icon os-icon-signs-11"></i>
                            </div>
                            注销系统
                        </a>
                    </li>
                </ul>

                <!--------------------
                END - Mobile Menu List
                -------------------->
            </div>
        </div>
        <!--------------------
        END - Mobile Menu
        --------------------><!--------------------
        START - Main Menu
        -------------------->
        <div class="menu-w selected-menu-color-light menu-activated-on-hover menu-has-selected-link color-scheme-light color-style-transparent sub-menu-color-light menu-position-side menu-side-left menu-layout-compact sub-menu-style-flyout ration-navbar">

            <div class="logo-w">
                <a class="logo" href="{{url("/tasks")}}">
                    <img src="/userImages/cert77/logo40-40.png">
                    <div class="logo-label">
                        TrustOcean日报管理系统
                    </div>
                </a>
            </div>


            <ul class="main-menu">
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">登录</a></li>
                    <li><a href="{{ url('/register') }}">注册</a></li>
                @else
                        <div class="menu-actions" style="display: block;">
                            <!--user information-->
                            <div class="profile-tile">
                                <div class="profile-tile-meta">

                                    <ul>
                                        <li>
                                            用户: <strong style="text-transform: Lowercase;">{{ Auth::user()->name }} </strong>
                                        </li>
                                        <li>
                                            邮箱账号: <strong style="text-transform: Lowercase;">{{ Auth::user()->email }} </strong>
                                        </li>
                                        <li>
                                            部门: <strong style="text-transform: Lowercase;">{{ Auth::user()->department }} </strong>  <a href="{{url("/logout")}}">退出登录</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <li class="sub-header">
                        <span>日报管理</span>
                    </li>
                    <li class="selected">
                        <a href="{{url("/tasks")}}">
                            <div class="icon-w">
                                <i class="icon-social-google"></i>
                            </div>
                            我的日报</a>
                    </li>
                    <li class="selected">
                        <a href="{{ url('/task/new') }}">
                            <div class="icon-w">
                                <i class="icon-user-following"></i>
                            </div>
                            添加日报</a>
                    </li>

                    @if(Auth::user()->is_admin == 1)
                        <li class="sub-header">
                            <span>日报审批</span>
                        </li>
                        <li class="selected">
                            <a href="">
                                <div class="icon-w">
                                    <i class="icon-social-google"></i>
                                </div>
                                审批今日</a>
                        </li>
                        <li class="selected">
                            <a href="{{ url('/admin/tasks') }}">
                                <div class="icon-w">
                                    <i class="icon-user-following"></i>
                                </div>
                                审批所有</a>
                        </li>
                    @endif
                    <li class="sub-header">
                        <span>账户管理</span>
                    </li>
                    <li class="selected">
                        <a href="{{ url('/user') }}">
                            <div class="icon-w">
                                <i class="icon-user-following"></i>
                            </div>
                            我的信息</a>
                    </li>
                    <li class="selected">
                        <a href="">
                            <div class="icon-w">
                                <i class="icon-social-google"></i>
                            </div>
                            登陆保护</a>
                    </li>
                    <li class="selected">
                        <a href="/client/changepassword">
                            <div class="icon-w">
                                <i class="icon-key"></i>
                            </div>
                            修改密码</a>
                    </li>
                    <li class="selected">
                        <a href="{{ url('/logout') }}">
                            <div class="icon-w">
                                <i class="os-icon os-icon-signs-11"></i>
                            </div>
                            注销系统
                        </a>
                    </li>

                @endif





            </ul>
        </div>
        <!--------------------
        END - Main Menu
        -------------------->
        <div class="content-w">
            <!--------------------
          START - Breadcrumbs
          -------------------->
            <!--------------------
            END - Breadcrumbs
            -------------------->
            <div class="content-i">
                <div class="content-box">
                    @yield('content')
                </div>

            </div>

        </div>

    </div>

    <div class="display-type"></div>

</div>

<!-- JavaScripts -->
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>--}}
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>--}}
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
{{--<script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>--}}
<script src="/bower_components/popper.js/dist/umd/popper.min.js"></script>
<script src="/bower_components/moment/moment.js"></script>
<script src="/bower_components/chart.js/dist/Chart.min.js"></script>
<script src="/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="/bower_components/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
<script src="/bower_components/ckeditor/ckeditor.js"></script>
<script src="/bower_components/bootstrap-validator/dist/validator.min.js"></script>
<script src="/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="/bower_components/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
<script src="/bower_components/dropzone/dist/dropzone.js"></script>
<script src="/bower_components/editable-table/mindmup-editabletable.js"></script>
<script src="/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="/bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
<script src="/bower_components/tether/dist/js/tether.min.js"></script>
<script src="/bower_components/slick-carousel/slick/slick.min.js"></script>
<script src="/bower_components/bootstrap/js/dist/util.js"></script>
<script src="/bower_components/bootstrap/js/dist/alert.js"></script>
<script src="/bower_components/bootstrap/js/dist/button.js"></script>
<script src="/bower_components/bootstrap/js/dist/carousel.js"></script>
<script src="/bower_components/bootstrap/js/dist/collapse.js"></script>
<script src="/bower_components/bootstrap/js/dist/dropdown.js"></script>
<script src="/bower_components/bootstrap/js/dist/modal.js"></script>
<script src="/bower_components/bootstrap/js/dist/tab.js"></script>
<script src="/bower_components/bootstrap/js/dist/tooltip.js"></script>
<script src="/bower_components/bootstrap/js/dist/popover.js"></script>
<script src="/js/dataTables.bootstrap4.min.js"></script>
<script src="/js/demo_customizer.js?version=4.4.0"></script>
<script src="/js/clipboard.min.js?version=4.4.0"></script>
<script src="/js/main.js?version=4.4.0"></script>
<script type="text/javascript" href="/js/main.js"></script>
<script type="text/javascript" href="/js/sweetalert.min.js"></script>



</body>
</html>
