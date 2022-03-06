<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    {{-- style script --}}
    <style>
        html::-webkit-scrollbar {
            width: 16px;
        }

        html::-webkit-scrollbar-track {
            background: #000;
        }

        html::-webkit-scrollbar-thumb {
            background: #A4161A;
            border-radius: 5px;
        }
        .notif-warning, .notif-danger, .notif-success {
            width: 100%;
            height: max-content;
            text-align: justify;
            box-sizing: border-box;
            border-radius: 4px;
            padding: 10px 12px;
            display: flex;
            flex-direction: row;
            justify-content: normal;
            gap: 10px;
        }
        .notif-warning {
            background-color: rgba(249, 220, 92, 0.15);
            border: 1px solid rgba(249, 220, 92, 1);
        }

        .notif-danger {
            background-color: rgba(224, 87, 128, 0.15);
            border: 1px solid rgba(224, 87, 128, 1);
        }
        .notif-success {
            background-color: rgba(82, 183, 136, 0.15);
            border: 1px solid rgba(82, 183, 136, 1);
        }
    </style>
    {{-- style and script file --}}
    @yield('css')
</head>
<body>
    <input type="checkbox" id="sidebar-toggle">
    <div class="sidebar">
        <div class="sidebar-header">
            <h3 class="brand">
                <span class="ti-heart-broken"></span>
                <span style="margin-left: 5px;">{{Str::limit(Auth::user()->hospital->name, 12, $end='...')}}</span>
            </h3>
            <label for="sidebar-toggle" class="ti-menu-alt"></label>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="{{route('dashboard')}}">
                        <span class="ti-home"></span>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <span class="ti-share-alt"></span>
                        <span>LogOut</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
    @yield('content')
</body>
</html>