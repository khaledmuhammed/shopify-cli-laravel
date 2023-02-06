<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />

    <!-- Ensures that the UI is properly scaled in the Shopify Mobile app -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous">
    <script type="module">
      if (!import.meta.env || !import.meta.env.PROD) {
        // Because the base HTML is rendered in the server side, we need to manually embed the code to enable HMR in our
        // code, so that the vite server is properly enabled to run HMR
        const script = document.createElement('script');
        script.setAttribute('type', "module");
        script.setAttribute('src', "./dev_embed.js");
        document.getElementsByTagName('head')[0].append(script);
      }
    </script>
  </head>
  <body>

    <!-- simple form to validate the shipper on nexus app -->
    <div class="container">
      

      @if(isset($message) && isset($alert))
        <div class="mt-4 alert {{ $alert }}">
            {{ $message }}
        </div>
      @endif
      
      <!-- <img src="https://nexus-express.net/images/settings/1635761673_.png" class="img-fluid" alt="..."> -->
      <h3 class="mt-4">Welcome To NXS app 🎉</h3>
      <div class="p-3 rounded-2 text-bg-danger">Please enter your registered data on NXS Shipping System</div>

      <form name="post-form" id="post-form" class="mt-2" method='post' action="{{route('shipper.login')}}">

        @csrf

        <input type="hidden" id="apiKey" value="{{ config('shopify-app.api_key') }}">
        <input type="hidden" id="shopOrigin" value="{{session('shopify_domain')}}">

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">User Name</label>
          <input type="text" class="form-control" id="exampleInputEmail1"
            aria-describedby="emailHelp" name="name" required="">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control"
            id="exampleInputPassword1" name="password" required="">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

    </div>
    <!-- simple form to validate the shipper on nexus app -->

    <div id="app"><!--index.jsx injects App.jsx here--></div>
  </body>
</html>
