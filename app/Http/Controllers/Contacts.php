<?php

namespace App\Http\Controllers;

use App\Models\Contacts as ModelsContacts;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class Contacts extends Controller
{
    public function index()
    {
        return view('contacts');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'number' => ['required', 'numeric', 'digits_between:7,12'],
            'email' => ['required', 'string', 'email', 'max:255']
        ]);

        try {

            $validated['user_id'] = Auth::user()->id;
            ModelsContacts::create($validated);
            return redirect('contacts')->with('success', 'Contact added successfully!');
        } catch (Exception $e) {

            return redirect()->back()->withErrors(['error' => 'An error occurred while saving the contact. Please try again.']);
        }
    }

    public function create()
    {
        return view('add_contact');
    }

    public function display(){
        $contacts = ModelsContacts::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(1);
    
        return view('contacts', compact('contacts'));
    }    
    
    public function edit($id)
    {
        $contact = ModelsContacts::findOrFail($id);
        return view('edit_contact' , compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'number' => ['required', 'numeric', 'digits_between:7,12'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        try {
            $contact = ModelsContacts::find($id);
            $contact->update($validated);
            $contact->user_id = Auth::user()->id;
            $contact->save();
            return redirect('contacts')->with('success', 'Contact Updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while saving the contact. Please try again.']);
        }
    }

    public function destroy($id)
    {
        $contact = ModelsContacts::find($id);
        $contact->delete();

        return response()->json(['success' => 'Contact deleted successfully!']);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        $data = ModelsContacts::where(function ($query) use ($searchTerm) {
            $query->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('company', 'like', '%' . $searchTerm . '%');
        })
        ->where('user_id', Auth::user()->id)
        ->orderBy('created_at', 'desc')
        ->paginate(1);

        return response()->json( [
            'contacts' => $data,
            'searchTerm' => $searchTerm
        ]);
    }
}