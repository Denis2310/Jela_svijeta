@extends('includes/header')

@section('content')

        <nav class="navbar navbar-light bg-secondary fixed-top">
            <a class="navbar-brand" href="{{route('index')}}">World Meals</a>
        </nav>


        <div class="container-fluid">
            <div class="row query-error-container">

                <!--Glavni sadržaj sa prikazom jela-->
                <div class="col-md-12">

                        <h3 class="text-center mt-100">Something went wrong with database connection!</h3>

                </div>


            </div>
        </div>
    </body>
</html>

@endsection
