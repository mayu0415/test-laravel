<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | FashionablyLate</title>
    <style>
        body {
            font-family: 'Noto Sans JP', sans-serif;
            background-color: #f3eae1;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #fff;
            padding: 20px;
            text-align: center;
            position: relative;
        }
        header h1 {
            margin: 0;
            font-size: 28px;
            color: #6b5b4b;
        }
        header a {
            position: absolute;
            right: 30px;
            top: 25px;
            color: #b49c8f;
            text-decoration: none;
            border: 1px solid #b49c8f;
            padding: 3px 10px;
            border-radius: 3px;
            font-size: 14px;
        }
        .register-container {
            background-color: #fff;
            width: 400px;
            margin: 60px auto;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .register-container h2 {
            text-align: center;
            color: #6b5b4b;
            margin-bottom: 30px;
        }
        label {
            display: block;
            color: #6b5b4b;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        input::placeholder {
            color: #ccc;
        }
        .error {
            color: #e57373;
            font-size: 13px;
            margin-top: -10px;
            margin-bottom: 10px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #8b7362;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            opacity: 0.9;
        }

        .alert {
            background-color: #fce4e4;
            color: #d32f2f;
            border: 1px solid #f5c2c2;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <header>
        <h1>FashionablyLate</h1>
        <a href="{{ route('login') }}">login</a>
    </header>
    <div class="register-container">
        <h2>Register</h2>
        @if ($errors->any())
            <div class="alert">
              <p>入力内容に誤りがあります。各項目を確認してください。</p>
              <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
              </ul>
            </div>
        @endif
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <label for="name">お名前</label>
            <input type="text" name="name" placeholder="例：山田 太郎" value="{{ old('name') }}">
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
            <label for="email">メールアドレス</label>
            <input type="email" name="email" placeholder="例：test@example.com" value="{{ old('email') }}">
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
            <label for="password">パスワード</label>
            <input type="password" name="password" placeholder="例：coachtech1106">
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
            <button type="submit">登録</button>
        </form>
    </div>
</body>
</html>