<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Account · persis gambar</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background-color: #f3f5f9;
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            display: flex;
 align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 1.5rem;
        }
        .register-card {
            max-width: 560px;
            width: 100%;
            background-color: #ffffff;
            border-radius: 32px;
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.1), 0 8px 24px -8px rgba(0, 0, 0, 0.05);
            padding: 40px 40px 48px 40px;
        }
        .register-card h1 {
            font-size: 32px;
            font-weight: 600;
            color: #1e293b;
            letter-spacing: -0.3px;
            margin-bottom: 32px;
            line-height: 1.2;
            text-align: left;
        }
        .input-group {
            margin-bottom: 24px;
            width: 100%;
        }
        .input-label {
            display: block;
            font-size: 15px;
            font-weight: 550;
            color: #1e293b;
            margin-bottom: 8px;
            letter-spacing: -0.1px;
        }
        .input-field {
            width: 100%;
            padding: 16px 20px;
            background-color: #ffffff;
            border: 1.5px solid #e2e8f0;
            border-radius: 18px;
            font-size: 16px;
            color: #0f172a;
            outline: none;
            transition: border 0.15s, box-shadow 0.15s;
            font-family: inherit;
        }
        .input-field:focus {
            border-color: #3b7cff;
            box-shadow: 0 0 0 3px rgba(59, 124, 255, 0.08);
        }
        .account-row {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin-top: 16px;
            margin-bottom: 28px;
            font-size: 16px;
            color: #1e293b;
            flex-wrap: wrap;
            gap: 5px;
        }
        .account-text {
            font-weight: 400;
            color: #1e293b;
        }
        .account-link {
            font-weight: 600;
            color: #1e293b;
            text-decoration: none;
            border-bottom: 1.5px solid transparent;
            transition: border-color 0.1s;
        }
        .account-link:hover {
            border-bottom: 1.5px solid #1e293b;
        }
        .register-button {
            width: 100%;
            background-color: #1e293b;
            border: none;
            border-radius: 18px;
            padding: 18px 20px;
            font-size: 18px;
            font-weight: 560;
            color: white;
            cursor: pointer;
            font-family: inherit;
            transition: background-color 0.15s;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.02);
            letter-spacing: 0.2px;
        }
        .register-button:hover {
            background-color: #0f172a;
        }
        /* placeholder dikosongkan, hanya label yang muncul */
        .input-field::placeholder {
            color: transparent; /* benar-benar tidak terlihat */
        }
    </style>
</head>
<body>
    <div class="register-card">
        <h1>Register Account</h1>

        <!-- form dengan method POST, action="#", dan input csrf tiruan (hidden) agar mirip laravel namun tak merusak visual -->
        <form method="POST" action="#">
            <!-- CSRF dummy (hanya untuk hiasan, karena tidak ada backend) -->
            <input type="hidden" name="_token" value="dummycsrf" autocomplete="off">

            <!-- email -->
            <div class="input-group">
                <label class="input-label" for="email">email</label>
                <input class="input-field" id="email" type="email" name="email" required placeholder=" ">
            </div>

            <!-- password -->
            <div class="input-group">
                <label class="input-label" for="password">password</label>
                <input class="input-field" id="password" type="password" name="password" required placeholder=" ">
            </div>

            <!-- full name -->
            <div class="input-group">
                <label class="input-label" for="fullname">full name</label>
                <input class="input-field" id="fullname" type="text" name="fullname" required placeholder=" ">
            </div>

            <!-- create username -->
            <div class="input-group">
                <label class="input-label" for="create_username">create username</label>
                <input class="input-field" id="create_username" type="text" name="create_username" required placeholder=" ">
            </div>

            <!-- no telp -->
            <div class="input-group">
                <label class="input-label" for="phone">no telp</label>
                <input class="input-field" id="phone" type="tel" name="phone" required placeholder=" ">
            </div>

            <!-- address -->
            <div class="input-group">
                <label class="input-label" for="address">address</label>
                <input class="input-field" id="address" type="text" name="address" required placeholder=" ">
            </div>

            <!-- baris "Already have an account? Login" -->
            <div class="account-row">
                <span class="account-text">Already have an account?</span>
                <a href="#" class="account-link">Login</a>
            </div>

            <!-- tombol Register -->
            <button type="submit" class="register-button">Register</button>
        </form>
    </div>
</body>
</html>