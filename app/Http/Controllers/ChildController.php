<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    public function familystructure()
    {
        $children = auth()->user()->children;
        return view('family.familystructure', compact('children'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        auth()->user()->children()->create([
            'name' => $request->input('name'),
        ]);
        
        return redirect()->route('familystructure')->with('success', 'Child added successfully!');
    }
    
    public function destroy($id)
    {
        //dd($id);
        $child = Child::findOrFail($id);
        $child->delete();
    
        return redirect()->route('familystructure')->with('success', 'Child deleted successfully!');
    }

}
