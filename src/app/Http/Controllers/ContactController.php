<?php

namespace App\Http\Controllers;

use Illuminate\Http\ContactRequest;
use App\Http\Model\Contact;

class ContactController extends Controller
{
  public function index()
  {
    return view('index');
  }

    public function confirm(ContactRequest $request)
    {
        $inputs = $request->all();
        return view('confirm', compact('inputs'));
    }

    public function send(Request $request)
    {
        // 「修正」ボタンが押されたとき
        if ($request->input('action') === 'back') {
            return redirect('/')
                ->withInput($request->except('action'));
        }

        // データ保存処理
        Contact::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'email' => $request->email,
            'tel' => $request->tel,
            'address' => $request->address,
            'building' => $request->building,
            'category_id' => $request->category_id,
            'content' => $request->content,
        ]);

        return view('thanks');
    }
}