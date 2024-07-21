<!doctype html>
<html lang="en">

<head>
    <title>PAGE LOGIN</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('assets/login') }}/css/style.css">

</head>

<body>
     <b><section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                   <h2 class="heading-section text-primary" >LOGIN</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    @yield('content')
                </div>
            </div>
        </div>
    </section></b>

    <script src="{{ asset('assets/login') }}/js/jquery.min.js"></script>
    <script src="{{ asset('assets/login') }}/js/popper.js"></script>
    <script src="{{ asset('assets/login') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/login') }}/js/main.js"></script>

</body>

</html>
