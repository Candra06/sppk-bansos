<?php

namespace App\Http\Controllers;

use App\Models\Fungsi;
use App\Models\Himpunan;
use Illuminate\Http\Request;

class FungsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        {
            //
            $data = Fungsi::all();
            $title = ' Fungsi';

            return view('admin.fungsi.index', compact('data', 'title'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        {
            //
            $title = 'Tambah Data Fungsi';
            $data = (object)[
                'himpunan_id'            => '',
                'fungsi'                 => '',
                'bobot'                  => '',
                'type'                   => 'create',
                'route'                  => route('fungsi.store')
            ];
            $himpunan = Himpunan::all();
            return view('admin.fungsi.form', compact('title', 'data', 'himpunan'));

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
                    'himpunan_id'   => 'required',
                    'fungsi'        => 'required',
                    'bobot'         => 'required',
                ]);
                Fungsi::create([
                    'himpunan_id'   => $request->himpunan_id,
                    'fungsi'        => $request->fungsi,
                    'bobot'         => $request->bobot,
                ]);

                return redirect('fungsi')->with ('Berhasil menambah data!');
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
            $data = Fungsi::where('id', $id)->first();
            $data->route = route('fungsi.index');
            $data->type = 'detail';
            $title = 'Detail Data Fungsi';
            $project = Fungsi::all();
            $himpunan = Himpunan::all();

            // code aslinya
            return view('admin.fungsi.form', compact('id', 'data', 'title', 'himpunan'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        {
            //
            $data = Fungsi::where('id', $id)->first();
            $himpunan = Himpunan::all();
            $data->route = route('fungsi.update', $id);
            $title = 'Edit Data Fungsi';
            return view('admin.fungsi.form', compact('data', 'title', 'himpunan'));
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
                'himpunan_id' => 'required',
                'fungsi' => 'required',
                'bobot' => 'required',

            ]);
            try {
                $data = ([
                    'himpunan_id' => $request->himpunan_id,
                    'fungsi' => $request->fungsi,
                    'bobot' => $request->bobot,
                ]);

                Fungsi::where('id', $id)->update($data);
                return redirect('fungsi')->with('success', 'Berhasil mengubah data!');
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
            Fungsi::find($id)->delete();
            return redirect('fungsi')->with('success', 'Berhasil mengubah data!');
        }
    }
}
