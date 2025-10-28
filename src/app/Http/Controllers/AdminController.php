<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    // 一覧・検索処理
    public function index(Request $request)
    {
        $query = Contact::query()->with('category');
        // 名前・メール・フルネーム検索
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('first_name', 'like', "%{$keyword}%")
                  ->orWhere('last_name', 'like', "%{$keyword}%")
                  ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$keyword}%"])
                  ->orWhere('email', 'like', "%{$keyword}%");
            });
        }
        // 性別検索
        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }
        // カテゴリ検索
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        // 日付検索
        if ($request->filled('created_at')) {
            $query->whereDate('created_at', $request->created_at);
        }
        // ページネーション（7件ずつ）
        $contacts = $query->orderBy('created_at', 'desc')->paginate(7);
        $categories = Category::all();
        return view('admin', compact('contacts', 'categories'));
    }
    // 詳細表示
    public function show($id)
    {
        $contact = Contact::with('category')->findOrFail($id);
        return view('detail', compact('contact'));
    }
    // CSVエクスポート
    public function export(Request $request)
    {
        $query = Contact::query()->with('category');
        // 検索条件を反映したままエクスポート可能
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('first_name', 'like', "%{$keyword}%")
                  ->orWhere('last_name', 'like', "%{$keyword}%")
                  ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$keyword}%"])
                  ->orWhere('email', 'like', "%{$keyword}%");
            });
        }
        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('created_at')) {
            $query->whereDate('created_at', $request->created_at);
        }
        $contacts = $query->get();
        $csv = "お名前,性別,メールアドレス,お問い合わせ種類,登録日\n";
        foreach ($contacts as $contact) {
            $genderText = match($contact->gender) {
                1 => '男性',
                2 => '女性',
                3 => 'その他',
                default => '不明',
            };
            $csv .= "{$contact->last_name}{$contact->first_name},{$genderText},{$contact->email},{$contact->category->content},{$contact->created_at}\n";
        }
        return Response::make($csv, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ]);
    }

        public function destroy($id)
   {
            $contact = Contact::findOrFail($id);
            $contact->delete();

        return redirect()->route('admin.index')->with('success', 'お問い合わせを削除しました。');
    }
}