<head>
    <meta charset="UTF-8">
    <title>UPW</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

<link rel="stylesheet" href="{{asset('dist/style.min.css')}}" />


  </head>
  <body id="login" style="margin-top: 0px" class="eccp fr" dir="ltr">
    <header>
        <div class="row">

          <div class="col-xs-12">
            <div class="heading">
              <div class="text-center">
              <h1>Algérie Poste</h1>
              <p>{{$error}}</p>
              <p>{{$exception}}</p>
              <br>

              <a href="{{URL::previous()}}"><button> Retour</button></a>
              </div>
            </div>
          </div>
        </div>
      </header>






  </body>
  </html>
