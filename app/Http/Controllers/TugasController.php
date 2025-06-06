<?php

namespace App\Http\Controllers;

use tidy;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Tugas;
use App\Exports\tugasExport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class TugasController extends Controller
{
    function index(){
        $user = Auth::user();
        if ($user->jabatan == 'Admin') {
            $data = array(
                'title'             => 'Data Tugas',
                'menuAdminTugas'     => 'active',
                'tugas'              =>Tugas::with('user')->get(),
            );
            return view('admin/tugas/index',$data);
        }else{
            $data = array(
                'title'             => 'Data Tugas',
                'menuKaryawanTugas'     => 'active',
                'tugas'              =>Tugas::with('user')->where('user_id',$user->id)->first(),
            );
            return view('karyawan/tugas/index',$data);
        }
    }

    public function create(){
        $data = array(
            'title'                 => 'Tambah Data Tugas',
            'user'                  => User::where('jabatan','Karyawan')->where('is_tugas',false)->get(),
        );
        return view('admin/tugas/create',$data);
    }


    public function store(Request $request){
        request()->validate([
           'user_id'           => 'required',
           'tugas'             => 'required',
           'tanggal_mulai'     => 'required',
           'tanggal_selesai'   => 'required',
            
        ],[
            'user_id.required'          => 'Nama wajib diisi',
            'tugas.required'            => 'tugas wajib diisi',
            'tanggal_mulai.required'    => 'tanggal mulai wajib di isi',
            'tanggal_selesai.required'  => 'tanggal selesai wajib di isi',

        ]);

        $user = User::findOrFail($request->user_id);
        $tugas = new Tugas;
        $tugas->user_id = $request->user_id;
        $tugas->tugas = $request->tugas;
        $tugas->tanggal_mulai = $request->tanggal_mulai;
        $tugas->tanggal_selesai = $request->tanggal_selesai;
        $tugas->save();


        $user->is_tugas = true;
        $user->save();
        return redirect()->route('tugas')->with('success','Data Berhasil Ditambahkan');

    }

    public function edit($id){
        $data = array(
            'title'                 => 'Edit Data Tugas',
            'menuAdminTugas'        => 'active',
            'tugas'                 =>Tugas::with('user')->findOrFail($id),
        );
        return view('admin/tugas/update',$data);
    }

    public function update(Request $request){
        request()->validate([
           'tugas'             => 'required',
           'tanggal_mulai'     => 'required',
           'tanggal_selesai'   => 'required',
            
        ],[
            'tugas.required'            => 'tugas wajib diisi',
            'tanggal_mulai.required'    => 'tanggal mulai wajib di isi',
            'tanggal_selesai.required'  => 'tanggal selesai wajib di isi',

        ]);

        $tugas = Tugas::findOrFail($request->id);
        $tugas->tugas = $request->tugas;
        $tugas->tugas = $request->tugas;
        $tugas->tanggal_mulai = $request->tanggal_mulai;
        $tugas->tanggal_selesai = $request->tanggal_selesai;
        $tugas->save();

        return redirect()->route('tugas')->with('success','Data Berhasil Ditambahkan');

    }

    public function destroy($id){
        $tugas = Tugas::findOrFail($id);
        $tugas->delete();
        $user = User::where('id',$tugas->user_id)->first();
        $user->is_tugas = false;
        $user->save();

        return redirect()->route('tugas')->with('success','Data Berhasil Dihapus');
    }

    public function excel(){
        $filename = now()->format('d-m-Y_H.i.s').'_user';
        return Excel::download(new tugasExport, 'DataTugas_'.$filename. '.xlsx');
    }

    public function pdf(){
        $user = Auth::user();
        $filename = now()->format('d-m-Y_H.i.s');

        if ($user->jabatan == 'Admin') {
            $data = array(
                'tugas' => Tugas::get(), 
                'tanggal'  =>  now()->format('d-m-Y'),
                'jam'  =>  now()->format('H:i:s'), 
              );
              $pdf = Pdf::loadView('admin/tugas/pdf', $data);
              return $pdf->setPaper('a4', 'landscape')->stream('DataTugas_'.$filename. '.pdf');
        } else {
            $data = array(
                'tanggal'  =>  now()->format('d-m-Y'),
                'jam'  =>  now()->format('H:i:s'),
                'tugas'              =>Tugas::with('user')->where('user_id',$user->id)->first(), 
              );
              $pdf = Pdf::loadView('karyawan/tugas/pdf', $data);
              return $pdf->setPaper('a4', 'portrait')->stream('DataTugas_'.$filename. '.pdf');
        }        
    }

}


