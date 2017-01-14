<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials._head')
    @yield('stylesheets')
</head>
<body>
    @include('partials._nav')
    
    <div class="container-fluid">
        
        @include('partials._message')

        @yield('content')

    </div>
    
    

    @include('partials._javascript')
    @yield('scripts')
    
</body>
</html>