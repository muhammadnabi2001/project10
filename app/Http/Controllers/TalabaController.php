<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Talaba;
use Illuminate\Http\Request;

class TalabaController extends Controller
{
    public function talaba()
    {
        //dd(123);
        $talabalar = Talaba::orderBy('id', 'desc')->get();
        return view('talaba', ['talabalar' => $talabalar]);
    }
    public function create(Request $request)
    {
        //dd(123);
        $data = $request->validate([
            'name' => 'required|max:25',
            'age' => 'required|max:50',
            'adress' => 'required',
        ]);

        $talaba = new Talaba();
        $talaba->name = $request->name;
        $talaba->age = $request->age;
        $talaba->adress = $request->adress;
        $talaba->save();
        return redirect()->back()->with('success', 'Ro\'yxatdan o\'tish muvaffaqiyatli yakunlandi!');
    }
    public function update(Request $request, int $id)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required|max:25',
            'age' => 'required|max:50',
            'adress' => 'required',
        ]);

        $talaba = Talaba::findOrFail($id);

        //dd($user);
        $talaba->name = $request->name;
        $talaba->age = $request->age;
        $talaba->adress = $request->adress;

        $talaba->save();

         return redirect('/talaba')->with('success', "Ma'lumot muvvafaqiyatli yangilandi");
    }
    public function delete(int $id)
    {
        //dd($id);
        $talaba=Talaba::findOrFail($id);
        $talaba->delete();
        return redirect('/talaba')->with('success', "Ma'lumot muvvafaqiyatli o'chirildi");
    }
}
