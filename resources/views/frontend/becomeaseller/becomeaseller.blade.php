<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Become a Seller</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="frontend/css/becomeaseller.css">
</head>

<body>
    <!-- Header Section -->
    <header class="navbar">
        <div class="logo">Your Marketplace</div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Become a Seller on Our Marketplace</h1>
            <p>Reach millions of customers by joining our seller community. Start selling today!</p>
        </div>
    </section>

    <!-- Steps to Become a Seller -->
    <section class="steps-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 step">
                    <i class="fa fa-sign-in-alt"></i>
                    <h3>Sign Up</h3>
                    <p>Create an account with us to get started.</p>
                </div>
                <div class="col-md-4 step">
                    <i class="fa fa-cogs"></i>
                    <h3>Set Up Your Store</h3>
                    <p>Customize your store and list your products.</p>
                </div>
                <div class="col-md-4 step">
                    <i class="fa fa-truck"></i>
                    <h3>Start Selling</h3>
                    <p>Reach customers and start making sales!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Seller Registration Form -->
    <section class="form-container">
        <div class="container">
            <h2>Get Started by Registering as a Seller</h2>
            <form>
                <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <input type="text" class="form-control" id="fullName" placeholder="Enter your full name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="businessName">Business Name</label>
                    <input type="text" class="form-control" id="businessName" placeholder="Enter your business name" required>
                </div>
                <div class="form-group">
                    <label for="businessType">Business Type</label>
                    <select class="form-control" id="businessType" required>
                        <option value="">Select Business Type</option>
                        <option value="individual">Individual</option>
                        <option value="company">Company</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="paymentDetails">Payment Details</label>
                    <input type="text" class="form-control" id="paymentDetails" placeholder="Enter your payment method (e.g., PayPal)" required>
                </div>
                <button type="submit">Submit Application</button>
            </form>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 Your Marketplace. All rights reserved.</p>
    </footer>
</body>

</html>
