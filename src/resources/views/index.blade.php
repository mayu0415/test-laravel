<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
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
    .contact-container {
      width: 700px;
      margin: 40px auto;
      text-align: left;
      background: #fff;
      padding: 40px 60px;
      border-radius: 6px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    label {
      display: inline-block;
      width: 150px;
      font-weight: bold;
      vertical-align: top;
      margin-top: 10px;
    }
    input[type="text"], input[type="email"], textarea, select {
      width: 400px;
      padding: 8px;
      border: 1px solid #c7b8a1;
      border-radius: 3px;
      margin-bottom: 10px;
    }
    .required {
      color: #d97d67;
      font-size: 12px;
      margin-left: 4px;
    }
    .error {
      color: #d97d67;
      font-size: 13px;
      margin-bottom: 5px;
      margin-left: 150px;
    }
    .name-group {
      display: flex;
      gap: 10px;
    }
    .radio-group {
      margin-top: 6px;
    }
    .btn {
      display: block;
      margin: 30px auto 0;
      padding: 10px 25px;
      background-color: #bda18a;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    .btn:hover {
      opacity: 0.8;
    }
  </style>
</head>
<body>
  <header>
    <h1>FashionablyLate</h1>
  </header>
  <div class="contact-container">
    <h2>Contact</h2>
    @if ($errors->any())
      <div class="error">入力内容に誤りがあります。各項目を確認してください。</div>
    @endif
    <form action="{{ route('contact.confirm') }}" method="POST">
      @csrf
      <label>お名前<span class="required">※</span></label>
      <div class="name-group">
        <input type="text" name="first_name" placeholder="例: 山田" value="{{ old('first_name') }}">
        <input type="text" name="last_name" placeholder="例: 太郎" value="{{ old('last_name') }}">
      </div>
      @error('first_name') <div class="error">{{ $message }}</div> @enderror
      @error('last_name') <div class="error">{{ $message }}</div> @enderror
      <label>性別<span class="required">※</span></label>
      <div class="radio-group">
        <input type="radio" name="gender" value="1" {{ old('gender') == 1 ? 'checked' : '' }}> 男性
        <input type="radio" name="gender" value="2" {{ old('gender') == 2 ? 'checked' : '' }}> 女性
        <input type="radio" name="gender" value="3" {{ old('gender') == 3 ? 'checked' : '' }}> その他
      </div>
      @error('gender') <div class="error">{{ $message }}</div> @enderror
      <label>メールアドレス<span class="required">※</span></label>
      <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
      @error('email') <div class="error">{{ $message }}</div> @enderror
      <label>電話番号<span class="required">※</span></label>
      <input type="text" name="tel" placeholder="080-1234-5678" value="{{ old('tel') }}">
      @error('tel') <div class="error">{{ $message }}</div> @enderror
      <label>住所<span class="required">※</span></label>
      <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
      @error('address') <div class="error">{{ $message }}</div> @enderror
      <label>建物名</label>
      <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
      <label>お問い合わせの種類<span class="required">※</span></label>
      <select name="category_id">
        <option value="">選択してください</option>
        <option value="1" {{ old('category_id') == 1 ? 'selected' : '' }}>商品の交換について</option>
        <option value="2" {{ old('category_id') == 2 ? 'selected' : '' }}>返品について</option>
        <option value="3" {{ old('category_id') == 3 ? 'selected' : '' }}>その他</option>
      </select>
      @error('category_id') <div class="error">{{ $message }}</div> @enderror
      <label>お問い合わせ内容<span class="required">※</span></label>
      <textarea name="content" rows="4" placeholder="お問い合わせ内容をご記載ください">{{ old('content') }}</textarea>
      @error('content') <div class="error">{{ $message }}</div> @enderror
      <button type="submit" class="btn">確認画面</button>
    </form>
  </div>
</body>
</html>

