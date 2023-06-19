<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="colorlib.com">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form</title>
 
    <!-- Font Icon -->
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/nouislider/nouislider.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        #nextBtn {
            background-color: #4966b1;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 17px;
            font-family: Raleway;
            cursor: pointer;
        }

        #signup-form {
            /* background-color: #ffffff; */
            /* margin: 100px auto; */
            /* font-family: Raleway; */
            /* padding: 40px; */
            /* width: 70%; */
            /* min-width: 300px; */
        }

        .tab {
            display: none;
        }

        .tab1 {
            display: none;
        }

        .step {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbbbbb;
            border: none;
            border-radius: 50%;
            display: inline-block;
            opacity: 0.5;
        }

        .step1 {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbbbbb;
            border: none;
            border-radius: 50%;
            display: inline-block;
            opacity: 0.5;
        }

        .step.active {
            opacity: 1;
        }

        .step1.active {
            opacity: 1;
        }

        /* Mark the steps that are finished and valid: */
        .step.finish {
            background-color: #04AA6D;
        }

        .step1.finish {
            background-color: #04AA6D;
        }
    </style>
</head>


<body>
    <div class="main">
        <div class="container">
            <div>
                <h3>Selected Medinine Businessman Page</h3>
                <div class="fieldset-content">
                    <div class="form-row">
                        <label class="form-label">businessmanId from users table:1</label>
                    </div>
                    <div class="form-row">
                        <label class="form-label">MedicineId from medicinetable:1</label>
                    </div>
                    <div>
                    <a href="{{ route('intake', ['mId' => encrypt(1),'bId'=> encrypt(2),'qId'=>'e63f1159-3900-4ee5-b831-b3ae79e8a42c']) }}" class="btn btn-primary">Next</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
