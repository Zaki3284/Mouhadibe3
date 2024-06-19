<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Comptabilité App</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
  <style>
    /* Reset default styles */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    /* Global styles */
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
      padding: 20px;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      background: #fff;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .section-title {
      font-size: 24px;
      color: #333;
      margin-bottom: 20px;
    }

    /* Stepper styles */
    .stepper {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
    }

    .step {
      flex: 1;
      text-align: center;
      position: relative;
    }

    .step-icon {
      width: 50px;
      height: 50px;
      background: #f1f1f1;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0 auto;
      color: #999;
      font-size: 20px;
    }

    .step.active .step-icon {
      background: #007bff;
      color: #fff;
    }

    .step p {
      margin-top: 10px;
      color: #999;
    }

    .step.active p {
      color: #007bff;
    }

    /* Form styles */
    .form-step {
      display: none;
    }

    .form-step-active {
      display: block;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    textarea,
    select {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 16px;
    }

    textarea {
      height: 120px;
    }

    button {
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 12px 20px;
      cursor: pointer;
      border-radius: 4px;
      font-size: 16px;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #0056b3;
    }

    /* Card styles for results or details */
    .card {
      background-color: #fff;
      padding: 20px;
      margin-top: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 4px;
    }

    .card-title {
      font-size: 20px;
      color: #333;
      margin-bottom: 10px;
    }

    .card-content {
      color: #666;
    }

    /* Icons */
    .icon {
      font-size: 24px;
      margin-right: 10px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
      .container {
        padding: 10px;
      }
      .step-icon {
        width: 40px;
        height: 40px;
        font-size: 18px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 class="section-title">Comptabilité App</h1>
    <div class="stepper">
      <div class="step active">
        <div class="step-icon"><i class="fas fa-user"></i></div>
        <p>Step 1: Register Comptable</p>
      </div>
      <div class="step">
        <div class="step-icon"><i class="fas fa-building"></i></div>
        <p>Step 2: Create Company</p>
      </div>
    </div>
    <div class="form-step form-step-active">
      <!-- Comptable Registration Form -->
      <form action="/register-comptable" method="POST">
        @csrf
        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit"><i class="fas fa-user-plus"></i> Register Comptable</button>
      </form>
    </div>
    <div class="form-step">
      <!-- Company Creation Form -->
      <form action="/create-company" method="POST">
        @csrf
        <label for="company-name">Company Name:</label>
        <input type="text" id="company-name" name="company-name" required>
        
        <label for="company-address">Company Address:</label>
        <input type="text" id="company-address" name="company-address" required>
        
        <label for="registration-number">Registration Number:</label>
        <input type="text" id="registration-number" name="registration-number" required>
        
        <button type="submit"><i class="fas fa-building"></i> Create Company</button>
      </form>
    </div>
  </div>
</body>
</html>
