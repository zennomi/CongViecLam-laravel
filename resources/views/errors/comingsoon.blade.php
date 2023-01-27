
<!doctype html>
<html>
  <head>
    <title>{{ __('coming_soon') }}</title>
    <style>

        body {
            text-align: center;
            padding: 150px;
        }

        h1 {
            font-size: 50px;
        }

        body {
            font: 20px Helvetica, sans-serif;
            color: #333;
        }

        article {
            display: block;
            text-align: left;
            width: 650px;
            margin: 0 auto;
        }

        a {
            color: #dc8100;
            text-decoration: none;
        }

        a:hover {
            color: #333;
            text-decoration: none;
        }

    </style>
  </head>
  <body>
    <article>
        <h1>{{ __('coming_soon') }}</h1>
        <div>
            <p>{{ __('sorry_for_the_inconvenience') }}</p>
            <p>{{ config('app.name') }}</p>
        </div>
    </article>

  </body>
</html>
