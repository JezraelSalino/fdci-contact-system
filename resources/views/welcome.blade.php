<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body class="bg-body-tertiary">
    <div class="d-flex justify-content-center align-items-center">
        <div class="card p-3" style="width: auto;margin-top: 260px">
            <div class="card-body">
              <h1 class="card-title fw-semi-bold mb-5">Thank you for Registering <span class="fw-bolder"> {{ Auth::user()->name }}!</span></h1>
              <h5 class="text-center mb-5">Welcome to Our Contact System!</h5>
              <center><a href="/contacts" class="btn btn-outline-primary">Continue</a></center>
            </div>
          </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>