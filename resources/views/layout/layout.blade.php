<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Book shop</title>
    </head>
    <body>
        <nav>
            <ul>
                <li>
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li>
                    <a href="{{ route('home') }}">Gallery</a>
                </li>
                @auth
                    <li>
                        <a href="/store">Add book</a>
                    </li>   
                @endauth
            </ul>
            <ul>
                @auth
                    <li>
                        <a href="">Logout</a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type='submit'> Logout</button>
                        </form>
                    </li>
                @else
                    <li>
                        <a href="{{ route('login') }}">Login</a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}">Register</a>
                    </li>
                @endauth

            </ul>
        </nav>
        @yield('content')
    </body>
</html>