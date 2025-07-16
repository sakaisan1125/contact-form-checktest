<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('last_name', 'like', "%$keyword%")
                  ->orWhere('first_name', 'like', "%$keyword%")
                  ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$keyword}%"]);
            });
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        if ($request->filled('created_at')) {
        $query->whereDate('created_at', $request->input('created_at'));
        }


        $contacts = $query->with('category')->orderBy('created_at', 'desc')->paginate(7);

        $categories = Category::all();
        

        return view('admin.index', compact('contacts', 'categories'));
    }

    public function export(Request $request): StreamedResponse
    {
    $query = Contact::query();

    if ($request->filled('keyword')) {
        $query->where(function ($q) use ($request) {
            $q->where('last_name', 'like', '%' . $request->keyword . '%')
              ->orWhere('first_name', 'like', '%' . $request->keyword . '%')
              ->orWhere('email', 'like', '%' . $request->keyword . '%');
        });
    }

    if ($request->filled('gender')) {
        $query->where('gender', $request->gender);
    }

    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    if ($request->filled('created_at')) {
        $query->whereDate('created_at', $request->created_at);
    }

    $contacts = $query->with('category')->get();

    $csvHeader = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="contacts.csv"',
    ];

    return response()->streamDownload(function () use ($contacts) {
        $stream = fopen('php://output', 'w');
        fwrite($stream, "\xEF\xBB\xBF");

        fputcsv($stream, ['名前', '性別', 'メールアドレス', '電話番号', '住所', 'お問い合わせ種類', 'お問い合わせ内容', '登録日']);

        foreach ($contacts as $contact) {
            fputcsv($stream, [
                $contact->last_name . ' ' . $contact->first_name,
                $contact->gender === 1 ? '男性' : ($contact->gender === 2 ? '女性' : 'その他'),
                $contact->email,
                $contact->tel,
                $contact->address,
                optional($contact->category)->content,
                $contact->detail,
                $contact->created_at->format('Y-m-d'),
            ]);
        }

        fclose($stream);
    }, 'contacts.csv', $csvHeader);
    }
}
