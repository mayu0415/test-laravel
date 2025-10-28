<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank you</title>
    <style>
        body {
            font-family: "Hiragino Kaku Gothic ProN", sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        /* 背景の Thank you */
        body::before {
            content: "Thank you";
            position: absolute;
            font-size: 200px;
            font-weight: bold;
            color: rgba(240, 235, 230, 0.6);
            z-index: 0;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            white-space: nowrap;
        }
        .thanks-container {
            position: relative;
            text-align: center;
            z-index: 1;
        }
        .thanks-container p {
            font-size: 16px;
            color: #6b4c3b;
            margin-bottom: 30px;
        }
        .thanks-container a {
            display: inline-block;
            text-decoration: none;
            background-color: #6b4c3b;
            color: #fff;
            padding: 8px 30px;
            border-radius: 3px;
            transition: 0.3s;
        }
        .thanks-container a:hover {
            background-color: #8a6b55;
        }
    </style>
</head>
<body>
    <div class="thanks-container">
        <p>お問い合わせありがとうございました</p>
        <a href="{{ route('contact.index') }}">HOME</a>
    </div>
</body>
</html>
