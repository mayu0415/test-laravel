<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
    body {
      font-family: "Hiragino Kaku Gothic ProN", sans-serif;
      background-color: #fffaf8;
      color: #5b4636;
      text-align: center;
    }
    header h1 {
      font-size: 28px;
      margin-top: 30px;
      color: #6b5244;
    }
    table {
      margin: 40px auto;
      border-collapse: collapse;
      width: 700px;
      background: #fff;
    }
    th, td {
      border: 1px solid #d8c6b5;
      padding: 12px 16px;
      text-align: left;
    }
    th {
      background-color: #bda18a;
      color: #fff;
      width: 220px;
    }
    td {
      width: 480px;
    }
    .btn-area {
      margin-top: 30px;
    }
    .btn {
      display: inline-block;
      margin: 0 10px;
      padding: 10px 25px;
      background-color: #bda18a;
      color: #fff;
      border: none;
      border-radius: 4px;
      text-decoration: none;
      cursor: pointer;
    }
    .btn:hover {
      opacity: 0.85;
    }
    .link {
      color: #6b5244;
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <header>
    <h1>FashionablyLate</h1>
  </header>
  <h2>Confirm</h2>
  <form action="{{ route('contact.send') }}" method="POST">
    @csrf
    <table>
      <tr>
        <th>お名前</th>
        <td>{{ $inputs['first_name'] }}　{{ $inputs['last_name'] }}</td>
      </tr>
      <tr>
        <th>性別</th>
        <td>
          @if ($inputs['gender'] == 1)
            男性
          @elseif ($inputs['gender'] == 2)
            女性
          @else
            その他
          @endif
        </td>
      </tr>
      <tr>
        <th>メールアドレス</th>
        <td>{{ $inputs['email'] }}</td>
      </tr>
      <tr>
        <th>電話番号</th>
        <td>{{ $inputs['tel'] }}</td>
      </tr>
      <tr>
        <th>住所</th>
        <td>{{ $inputs['address'] }}</td>
      </tr>
      <tr>
        <th>建物名</th>
        <td>{{ $inputs['building'] }}</td>
      </tr>
      <tr>
        <th>お問い合わせの種類</th>
        <td>
          @if ($inputs['category_id'] == 1)
            商品の交換について
          @elseif ($inputs['category_id'] == 2)
            返品について
          @else
            その他
          @endif
        </td>
      </tr>
      <tr>
        <th>お問い合わせ内容</th>
        <td>{{ $inputs['content'] }}</td>
      </tr>
    </table>
    {{-- hiddenで全データを再送 --}}
    @foreach ($inputs as $key => $value)
      <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach
    <div class="btn-area">
      <button type="submit" name="action" value="submit" class="btn">送信</button>
      <button type="submit" name="action" value="back" class="link">修正</button>
    </div>
  </form>
  </body>
</html>