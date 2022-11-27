<?php

namespace App\Http\Controllers;

use App\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Pagination\Paginator;

class ListingController extends Controller
{
    //all listing
    public function index(){
        return view('listings.index',[
            'listings' => Listing::latest()->filter(request(['tag','search']))->paginate(4)
        ]);
    }

    //single listing
    public function show(Listing $listing){
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    //view listing create form
    public function create(){
        return view('listings.create');
    }
    
    //view listing create form
    public function store(Request $request){
        $formFields = $request->validate([
            'title'         => 'required',
            'company'       => ['required', Rule::unique('listings','company')],
            'location'      => 'required',
            'website'       => 'required',
            'email'         => ['required','email'],
            'tags'          => 'required',
            'desc'          => 'required'
        ]);
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $formFields['user_id'] = auth()->id();
        Listing::create($formFields);
        return redirect('/')->with('message','Listing Created Successfully');
    }

    //Show Edit Form
    public function edit(Listing $listing){
        return view('listings.edit', ['listing'=>$listing]);
    }

    //Update create form
    public function update(Request $request,Listing $listing){
        $formFields = $request->validate([
            'title'         => 'required',
            'company'       => ['required'],
            'location'      => 'required',
            'website'       => 'required',
            'email'         => ['required','email'],
            'tags'          => 'required',
            'desc'          => 'required'
        ]);
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $listing->update($formFields);
        return back()->with('message','Listing Updated Successfully');
    }

    //destroy function
    public function destroy(Listing $listing){
        $listing->delete();
        return redirect('/')->with('message','Listing has been deleted successfully');
    }
}
