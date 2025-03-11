<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Website')</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            display: flex;
            align-items: top;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 20px;
        }
        .info {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .slider {
            width: 100%;
        }
        input[type="range"] {
        -webkit-appearance: none;
        width: 200px;
        height: 10px;
        border-radius: 5px;
        background: linear-gradient(to right, #5fdaff, #42adf0);
        outline: none;
        opacity: 0.9;
        transition: opacity .2s;
        }

        input[type="range"]:hover {
            opacity: 1;
        }

        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            background: #5fdaff;
            border-radius: 50%;
            cursor: pointer;
            transition: 0.3s;
        }

        input[type="range"]::-webkit-slider-thumb:hover {
            background: #5fdaff;
        }

        input[type="range"]::-moz-range-thumb {
            width: 20px;
            height: 20px;
            background: #140adb;
            border-radius: 50%;
            cursor: pointer;
        }

        .button-group {
            display: flex;
            flex-direction: column; 
            gap: 10px; 
            margin-top: 10px;
            width: 100%;
            align-items: center; 
        }

        .skill-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            width: 200px; 
            text-align: center;
        }

        .skill_1 {
            background-color: #ff7e5f;
            color: white;
        }

        .skill_2 {
            background-color: #e74c3c;
            color: white;
        }

        .skill-btn:hover {
            opacity: 0.8;
        }

        .warning-box {
            margin-top: 20px;
            padding: 10px;
            background: #ffcccc;
            border: 2px solid #ff4d4d;
            border-radius: 5px;
            color: #900;
            max-width: 250px;
        }

        .negative-list {
            counter-reset: warning-counter -0; 
            padding-left: 20px;
        }

        .negative-list li {
            list-style: none;
            position: relative;
        }

        .negative-list li::before {
            content: counter(warning-counter);
            counter-increment: warning-counter -1; 
            position: absolute;
            left: -25px;
            font-weight: bold;
            color: red;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            max-width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.3s ease-in-out;
        }

        .modal h3 {
            color: #e74c3c;
        }

        .modal-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 15px;
        }

        .btn-confirm {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-cancel {
            background: gray;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-confirm:hover {
            background: #c0392b;
        }

        .btn-cancel:hover {
            background: #777;
        }

    </style>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
{{-- testing --}}