@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: #fbfbfb;
        }

        @media (min-width: 991.98px) {
            main {
                padding-left: 240px;
            }
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding: 58px 0 0; /* Height of navbar */
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
            width: 240px;
            z-index: 600;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                width: 100%;
            }
        }

        .sidebar .active {
            border-radius: 5px;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
        }

        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: 0.5rem;
            overflow-x: hidden;
            overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
        }
    </style>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
        <div class="position-sticky">
            <div class="list-group list-group-flush mx-3 mt-4">
                <!-- Collapse 1 -->
                <a
                    class="list-group-item list-group-item-action py-2 ripple"
                    aria-current="true"
                    data-mdb-toggle="collapse"
                    href="#collapseExample1"
                    aria-expanded="true"
                    aria-controls="collapseExample1"
                >
                    <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>{{ __('Control Panel') }}</span>
                </a>
                <!-- Collapsed content -->
                <ul id="collapseExample1" class="collapse show list-group list-group-flush">
                    <li class="list-group-item py-1 ">
                        <a href="{{ route('blogs.index') }}" class="text-reset">{{ __('Blogs') }}</a>
                    </li>
                    <li class="list-group-item py-1 ">
                        <a href="{{ route('blogs.create') }}" class="text-reset">{{ __('Add blog') }}</a>
                    </li>
                    <li class="list-group-item py-1">
                        <a href="{{ route('subscribers.index') }}" class="text-reset">{{ __('Subscribers') }}</a>
                    </li>
                    <li class="list-group-item py-1">
                        <a href="{{ route('subscribers.create') }}" class="text-reset">{{ __('Add subscriber') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Sidebar -->

    <!--Main layout-->
    <main style="margin-top: 60px;">
        <div class="container pt-xxl-5">
            <h1> {{ __('Hello admin!') }}</h1>
        </div>
    </main>
    <!--Main layout-->
@endsection
