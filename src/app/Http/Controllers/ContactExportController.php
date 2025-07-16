<?php

namespace App\Http\Controllers;

use App\Exports\ContactsExport;
use Maatwebsite\Excel\Facades\Excel;

class ContactExportController extends Controller
{
    public function export()
    {
        return Excel::download(new ContactsExport, 'contacts.xlsx');
    }
}
