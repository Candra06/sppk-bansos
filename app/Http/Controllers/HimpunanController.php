<?php

namespace App\Http\Controllers;

use App\Models\Himpunan;
use App\Models\Variabel;
use Illuminate\Http\Request;

class HimpunanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        {
            //
            $data = Himpunan::all();
            $title = 'Himpunan';

            return view('admin.himpunan.index', compact('data', 'title'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        {
            //
            $title = 'Himpunan';
            $subtitle = 'Tambah Data ';
            $data = (object)[
                'variabel_id'               => '',
                'himpunan'                  => '',
                'type'                   => 'create',
                'route'                  => route('himpunan.store')
            ];
            $variabel = Variabel::all();
            return view('admin.himpunan.form', compact('title','subtitle', 'data', 'variabel'));

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        {

            // dd($request);
            try {
                $request->validate([
                    'variabel_id' => 'required',
                    'himpunan' => 'required',
                ]);
                Himpunan::create([
                    'variabel_id' => $request->variabel_id,
                    'himpunan' => $request->himpunan,
                ]);

                return redirect('himpunan')->with ('Berhasil menambah data!');
            } catch (\Throwable $th) {
                return $th;
                return back()->with('failed', 'Gagal menambah data!'.$th->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        {
            $data = Himpunan::where('id', $id)->first();
            $data->route = route('himpunan.index');
            $data->type = 'detail';
            $title = 'Detail Data Himpunan';
            $project = Himpunan::all();
            $variabel = Variabel::all();

            // code aslinya
            return view('admin.himpunan.form', compact('id', 'data', 'title', 'variabel'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        {
        //
        $data = Himpunan::where('id', $id)->first();
        $variabel = Variabel::all();
        $data->route = route('himpunan.update', $id);
        $title = 'Edit Data Himpunan';
        return view('admin.himpunan.form', compact('data', 'title', 'variabel'));
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        {
            //
            $request->validate([
                'variabel_id' => 'required',
                'himpunan' => 'required',

            ]);
            try {
                $data = ([
                    'variabel_id' => $request->variabel_id,
                    'himpunan' => $request->himpunan,
                ]);

                Himpunan::where('id', $id)->update($data);
                return redirect('himpunan')->with('success', 'Berhasil mengubah data!');
            } catch (\Throwable $th) {
                return back()->with('failed', 'Gagal mengubah data!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        {
            //
            Himpunan::find($id)->delete();
            return redirect('himpunan')->with('success', 'Berhasil mengubah data!');
        }
    }
}
