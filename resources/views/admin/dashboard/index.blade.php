<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CDashboard</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Custom CSS for centering */
    .center-screen {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh; /* full height of viewport */
    }
  </style>
</head>
<body>

<div class="container center-screen">
  <div>
    <a href="{{ route('admin.books.index') }}" class="text-primary ml-2">Link To Admin Panel</a>
  </div>
</div>

<!-- Bootstrap JS (if needed) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

