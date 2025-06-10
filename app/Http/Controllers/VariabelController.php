<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Variabel;
use Carbon\Carbon;

class VariabelController extends Controller
{

    public function index()
    {
        //
        $data = Variabel::all();
        $title = 'Variabel';

        return view('admin.variabel.index', compact('data', 'title'));
    }

    public function create()
    {
        //
        $title = 'Variabel';
        $subtitle = 'Tambah Data ';
        $data = (object)[
            'variabel'               => '',
            'kode'                   => '',
            'min'                   => '',
            'max'                   => '',
            'type'                   => 'create',
            'route'                  => route('variabel.store')
        ];
        return view('admin.variabel.form', compact('title', 'subtitle','data'));

    }

    public function store(Request $request)
    {
        return $request;
        // dd($request);
        try {
            $request->validate([
                'variabel' => 'required',
                'kode' => 'required',
                'min' => 'required',
                'max' => 'required',
            ]);
            Variabel::create([
                'variabel' => $request->variabel,
                'kode' => $request->kode,
                'min' => $request->min,
                'max' => $request->max,
            ]);

            return redirect('variabel')->with ('Berhasil menambah data!');
        } catch (\Throwable $th) {
            return $th;
            return back()->with('failed', 'Gagal menambah data!'.$th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'variabel' => 'required',
            'kode' => 'required',
            'min' => 'required',
            'max' => 'required',

        ]);
        try {
            $data = ([
                'variabel' => $request->variabel,
                'kode' => $request->kode,
                'min' => $request->min,
                'max' => $request->max,
            ]);

            Variabel::where('id', $id)->update($data);
            return redirect('variabel')->with('success', 'Berhasil mengubah data!');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal mengubah data!');
        }
    }

    public function show($id)
    {
        $data = Variabel::where('id', $id)->first();
        $data->route = route('variabel.index');
        $data->type = 'detail';
        $title = 'Detail Data Variabel';
        $project = Variabel::all();

        // code aslinya
        return view('admin.variabel.form', compact('id', 'data', 'title',));
    }

    public function edit($id)
    {
        //
        $data = Variabel::where('id', $id)->first();
        $data->route = route('variabel.update', $id);
        $title = 'Variabel';
        $subtitle = 'Ubah Data ';
        return view('admin.variabel.form', compact('data', 'title', 'subtitle'));
    }

    public function destroy($id)
    {
        {
            //
            Variabel::find($id)->delete();
            return redirect('variabel')->with('success', 'Berhasil mengubah data!');
        }
    }


}
