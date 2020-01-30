<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/argon-dashboard.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="bg-gradient-primary">
        <div class="header bg-gradient-primary py-7 py-lg-8">
            <div class="container">
                <div class="header-body text-center">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-6">
                            <h1 class="text-white">Sunrise/Sunset</h1>
                            <p class="text-lead text-light">Check what time the sun rises and sets all over the world</p>
                            @if(!$data['status'])
                                <div class="row justify-content-center">
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Error!</strong> There was a problem finding the city, please try again
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <form method="GET">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-alternative" name="city" placeholder="City" value="@unless(empty($city)){{ $city }}@endunless">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <input class="form-control datepicker" placeholder="Select date" type="text" value="@unless(empty($time)){{ $time }}@endunless" name="time">
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <button class="btn btn-default w-100" type="submit">Search</button>
                    </div>
                </div>
            </form>
            <div class="row">
                @foreach($data['data'] as $day)
                    <div class="col p-0">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">{{ $day['name'] }}</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $day['number'] }} {{ $day['month'] }}</span>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">
                                    <span class="text-muted">Sunrise</span>
                                    <span class="text-nowrap">{{ $day['sunrise'] }}</span>
                                </p>
                                <p class="mb-0 text-sm">
                                    <span class="text-muted">Sunset</span>
                                    <span class="text-nowrap">{{ $day['sunset'] }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <script src="{{ asset('js/plugins/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('js/argon-dashboard.min.js?v=1.1.0') }}"></script>
    </body>
</html>
