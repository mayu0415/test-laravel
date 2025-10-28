<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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
        .admin-container {
            width: 90%;
            max-width: 1000px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #6b5b4b;
            margin-bottom: 30px;
        }
        form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="date"], select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            width: 18%;
        }
        button, .reset-btn, .export-btn {
            background-color: #8b7362;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
            cursor: pointer;
        }
        .reset-btn, .export-btn {
            background-color: #d5c3b1;
            color: #6b5b4b;
            text-decoration: none;
            display: inline-block;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #8b7362;
            color: white;
            text-align: left;
            padding: 10px;
        }
        td {
            border-bottom: 1px solid #ddd;
            padding: 10px;
        }
        td a {
            background-color: #e6dbd1;
            color: #6b5b4b;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
        }
        td a:hover {
            opacity: 0.8;
        }
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .pagination a,
        .pagination span {
            color: #6b5b4b;
            padding: 6px 10px;
            text-decoration: none;
        }
        .pagination .active span {
            background-color: #8b7362;
            color: #fff;
            border-radius: 4px;
        }
    </style>
</head>
<body>
<header>
    <h1>FashionablyLate</h1>
    <a href="{{ route('logout') }}">logout</a>
</header>
<div class="admin-container">
    <h2>Admin</h2>
    <form method="GET" action="{{ route('admin.index') }}">
        <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">
        <select name="gender">
            <option value="all">性別</option>
            <option value="1" @selected(request('gender') == 1)>男性</option>
            <option value="2" @selected(request('gender') == 2)>女性</option>
            <option value="3" @selected(request('gender') == 3)>その他</option>
        </select>
        <select name="category_id">
            <option value="">お問い合わせの種類</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                    {{ $category->content }}
                </option>
            @endforeach
        </select>
        <input type="date" name="created_at" value="{{ request('created_at') }}">
        <button type="submit">検索</button>
        <a href="{{ route('admin.index') }}" class="reset-btn">リセット</a>
        <a href="{{ route('admin.export', request()->query()) }}" class="export-btn">エクスポート</a>
    </form>
    <table>
        <thead>
            <tr>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($contacts as $contact)
                <tr>
                    <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                    <td>
                        @if($contact->gender == 1) 男性
                        @elseif($contact->gender == 2) 女性
                        @else その他
                        @endif
                    </td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->category->content ?? ''}}</td>
                    <td><a href="{{ route('admin.show', $contact->id) }}">詳細</a></td>
                </tr>
            @empty
                <tr><td colspan="5" style="text-align:center;">データがありません。</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="pagination">
        {{ $contacts->links() }}
    </div>
</div>
</body>
</html>

