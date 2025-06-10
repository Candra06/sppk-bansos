<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Recipient;
use App\Models\Position;
use App\Models\PositionDetail;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use App\Imports\ProjectImport;
use App\Models\RecipientEvaluation;
use App\Models\Fungsi;
use App\Models\Himpunan;
use App\Models\Variabel;
use Carbon\Carbon;


class RecipientController extends Controller
{
    //
    public function index()
    {
        //
        $data = Recipient::all();
        $title = 'Penerima';

        return view('admin.recipient.index', compact('title','data'));
    }

    public function create()
    {
        //
        $title = 'Penerima';
        $subtitle= 'Tambah Data ';
        $data = (object) [
            'nama' => '',
            'nik' => '',
            'address' => '',
            'gender' => '',
            'type' => 'create',
            'route' => route('recipient.store')
        ];
        return view('admin.recipient.form', compact('title','subtitle', 'data'));
    }

    public function store(Request $request)
    {

        // dd($request);
        try {
            $request->validate([
                'nama' => 'required',
                'nik' => 'required',
                'gender' => 'required',
                'address' => 'required',
            ]);
            Recipient::create([
                'nama' => $request->nama,
                'nik' => $request->nik,
                'gender' => $request->gender,
                'address' => $request->address,
                'bobot' => 0,
            ]);

            return redirect('recipient')->with('Berhasil menambah data!');
        } catch (\Throwable $th) {
            return $th;
            return back()->with('failed', 'Gagal menambah data!' . $th->getMessage());
        }
    }

    public function importData(Request $request)
    {

    }

    public function edit($id)
    {
        //
        $data = Recipient::where('id', $id)->first();
        $data->route = route('recipient.update', $id);
        $title = 'Penerima';
        $subtitle = 'Ubah Data ';
        // return $data;
        return view('admin.recipient.form', compact('data', 'title', 'subtitle'));
    }

    public function update(Request $request, $id)
    {
        //
        $request->validate([
                'nama' => 'required',
                'nik' => 'required',
                'gender' => 'required',
                'address' => 'required',
            ]);
        try {
            $data = ([
                'nama' => $request->nama,
                'nik' => $request->nik,
                'gender' => $request->gender,
                'address' => $request->address,
            ]);

            Recipient::where('id', $id)->update($data);
            return redirect('recipient')->with('success', 'Berhasil mengubah data!');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal mengubah data!');
        }
    }

    public function show($id)
    {
        $data = Recipient::where('id', $id)->first();
        $data->route = route('recipient.index');
        $data->type = 'detail';
        $title = 'Penerima';
        $subtitle = 'Detail Data ';
        $project = Recipient::all();

        $evaluation = RecipientEvaluation::where('recipient_id', $id)->get();

        return view('admin.recipient.form', compact('id', 'data', 'title', 'subtitle', 'evaluation'));
    }

    public function destroy($id)
    {
        //
        Recipient::find($id)->delete();
        return redirect('recipient')->with('success', 'Berhasil hapus data!');
    }

    public function formPenilaian($id)
    {
        try {
            $variabel = Variabel::all();
            $title = 'Penerima';
            $subtitle='Tambah Penilaian ';
             $grouping = [];
            foreach ($variabel as $item) {
                $himpunan = Himpunan::with('fungsi')->where('variabel_id', $item->id)->get();
                $tmp = [
                    'id' => $item->id,
                    'variabel' => $item->variabel,
                    'variabel_kode' => $item->kode,
                    'himpunan' => $himpunan,
                ];
                array_push($grouping, $tmp);
            }
            $data = (object) [
                'data' => Recipient::where('id', $id)->first(),
                'variabel' => $grouping,
                'type' => 'create',
                'route' => url('submitEvaluation/' . $id)
            ];

            // return $data;
            return view('admin.recipient.evaluation', compact('data', 'title','subtitle'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function submitEvaluation(Request $request, $id)
    {

        try {
            DB::beginTransaction();
            $list = [];
            $highest = [];
            $bobot = 0;
            $i = 0;
            foreach ($request->variabel_id as $is => $item) { //perulangan untuk mencari variabel yang telah diinput
                $himpunan = Fungsi::join('himpunan_fuzzy', 'himpunan_fuzzy.id', 'fungsi_keanggotaan.himpunan_id')
                    ->where('himpunan_fuzzy.variabel_id', $item)
                    ->select('himpunan_fuzzy.himpunan', 'fungsi_keanggotaan.*')
                    ->get(); // mencari data himpunan dari database berdasarkan variabel id yang  diinput

                $input = [];
                foreach ($himpunan as $key => $hm) { // perulangan untuk menentukan tiap himpuan yang cocok dengan inputan
                    $cekIndex = 0;
                    $tmpBobot = 0;

                    $fungsi = str_replace('x', $request->nilai[$is], $hm->fungsi); // melakukan perubahan nilai x pada fungsi dengan nilai yang dimasukkan
                    $condition = $fungsi; // variabel untuk menampung kondisi sementara untuk pengecekan nilai

                    $formula = eval ("if ($condition) { return '1'; } else { return '0'; }"); // pengecekan nilai fungsi jika nilai input memenuhi kondisi pada fungsi maka akan mengembalikan nilai 1 jika tidak memenuhi maka akan mengembalikan nilai 0

                    if (intval($formula) == 1) { // pengecekan jika kondisi benar(bernilai 1) / input memenuhi kriteria salah satu fungsi
                        if (str_contains($hm->bobot, 'x')) { // pengecakan apakah nilai bobot masih berupa rumus atau sudah berupa bilangan bulat
                            $rumus = str_replace('x', $request->nilai[$is], $hm->bobot); // mengisi nilai x pada rumus penentuan bobot dengan nilai input
                            $hasil = eval ('return ' . $rumus . ';'); // eksekusi rumus menggunakan fungsi eval()
                            $tmpBobot = $hasil; // menampung sementara nilai bobot
                        } else { // kondisi jika nilai bobot merupakan bilangan bulat
                            $tmpBobot = $hm->bobot; // menampung sementara nilai bobot
                        }

                        $tmpInput = [ // menampung record yang akan disimpan ke dalam database sebagai history
                            'variabel_id' => $item,
                            'himpunan_id' => $hm->himpunan_id,
                            'himpunan' => $hm->himpunan,
                            'bobot' => $tmpBobot,
                        ];
                        $bobot += $tmpBobot; // menjumlahkan bobot
                        array_push($input, $tmpInput); // menyimpan record history ke dalam array
                    }
                }

                usort($input, function ($first, $second) { // mengurutkan nilai pada bobot dari tertinggi ke terendah
                    return $first['bobot'] < $second['bobot'];
                });
                array_push($highest, $input[0]); // mengambil 1 nilaibobot tertinggi
                array_push($list, $bobot);
            }

            $total = 0;
            $totalBobot = 0;
            $dataTotal = [];
            for ($i = 0; $i < count($highest); $i++) { // melakukan perulangan untuk menyimpan record history penilaian
                $variabel = Variabel::where('id', $request->variabel_id[$i])->first(); // get data tiap variabel berdasarkan id variabel
                $tmpBobot = doubleval($request->nilai[$i]) > $variabel->min && doubleval($request->nilai[$i]) <= $variabel->max ? doubleval($highest[$i]['bobot']) : 0; // melakukan pengecekan apakah nilai input sesuai kriteria perusahaan yang telah ditentukan (min/max) jika sesuai maka nilai bobot akan disimpan dan jika tidak maka nilai bobot akan dirubah menjadi 0

                $tmpBobot = $tmpBobot * 3.0;
                $totalBobot += doubleval($highest[$i]['bobot']);
                $dataTotal[] = $tmpBobot;
                $total += doubleval($tmpBobot); // menjumlahkan total nilai bobot
                RecipientEvaluation::create([ // menyimpan history penilaian
                    'recipient_id' => $id,
                    'variabel_id' => $request->variabel_id[$i],
                    'himpunan_id' => $highest[$i]['himpunan_id'],
                    'bobot' => round(doubleval($tmpBobot)),
                ]);
            }
            Recipient::where('id', $id)->update(['bobot' => doubleval($total/$totalBobot)]); // mengubah bilai bobot pada data karyawan
            DB::commit();

            return redirect('recipient')->with('success', 'Berhasil memberikan penilaian');
            // return ['total bobot asli' => $totalBobot, 'total bobot' => $total, 'bobot tiap variabel' => $highest, 'input' => $request->nilai, 'tmp total' => $dataTotal];
        } catch (\Throwable $th) {

            DB::rollBack();
            return back()->with('error', $th->getMessage());

        }
    }
}
