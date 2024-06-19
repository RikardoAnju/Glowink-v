<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Payment Successful</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <!-- Custom CSS -->
  <style>
    .checkout-confirmation .checkmark {
      width: 100px;
      height: 100px;
      margin: 0 auto;
    }

    .checkout-confirmation .checkmark svg {
      width: 100px;
      height: 100px;
      stroke: #4caf50;
      stroke-width: 2;
      stroke-linecap: round;
      stroke-linejoin: round;
      fill: none;
      animation: checkmark 0.5s cubic-bezier(0.65, 0, 0.45, 1) forwards, moveCheckmark 0.5s cubic-bezier(0.65, 0, 0.45, 1) forwards;
    }

    @keyframes checkmark {
      0% {
        stroke-dashoffset: 100;
      }
      100% {
        stroke-dashoffset: 0;
      }
    }

    @keyframes moveCheckmark {
      0% {
        stroke-dasharray: 100;
        stroke-dashoffset: 100;
      }
      50% {
        stroke-dasharray: 100;
        stroke-dashoffset: 50;
      }
      100% {
        stroke-dasharray: 100;
        stroke-dashoffset: 0;
      }
    }
  </style>
</head>
<body>
  <section class="section-wrap pb-5">
    <div class="container text-center">
      <div class="row">
        <div class="col-md-12">
          <div class="checkout-confirmation">
            <h1 class="mb-4">Payment Successful</h1>
            <div class="checkmark">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                <circle cx="26" cy="26" r="25" fill="none" />
                <path fill="none" d="M14 27l5.2 5.2 12-12" />
              </svg>
            </div>
            <p class="mt-4 mb-5">Thank you for your payment. Your order has been successfully processed.</p>
            <a href="{{ route('home') }}" class="btn btn-lg btn-dark">Return to Orders</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Bootstrap JS and jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
