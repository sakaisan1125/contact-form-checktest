<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;


class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('contact.index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $inputs = $request->all();

        $category = Category::find($inputs['category_id']);
        $category_name = $category ? $category->content : '';

        return view('contact.confirm', compact('inputs', 'category_name'));
    }

    public function store(ContactRequest $request)
    {
        
    if ($request->input('action') === 'back') {
        return redirect('/')->withInput();
    }

    $data = $request->validated();

    $data['tel'] = $data['tel1'] . $data['tel2'] . $data['tel3'];

    unset($data['tel1'], $data['tel2'], $data['tel3'], $data['action']);

    Contact::create($data);

    return view('contact.thanks');
    }

    public function destroy($id)
    {
    $contact = Contact::findOrFail($id);
    $contact->delete();

    return redirect('/admin')->with('message', '削除しました');
    }



}
