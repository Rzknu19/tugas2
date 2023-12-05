<?php

namespace App\Http\Controllers;
use App\Models\karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{

    public function index(Request $request){
        $keyword = $request->keyword;
        $baris = 4;
        if(strlen($keyword)){
            $data = Karyawan::where('nip','like',"%$keyword%")
            ->orWhere('nama','like',"%$keyword%")
            ->orWhere('gaji','like',"%$keyword%")
            ->orWhere('departemen','like',"%$keyword%")
            ->orWhere('alamat','like',"%$keyword%")
            ->orWhere('jenis_kelamin','like',"%$keyword%")
            ->paginate($baris);
        }else {
            $data = Karyawan::orderBy('nip','desc')->paginate($baris);
        }
        $nextNIP = $this->generateNextNIP();
        return view ('dashboard')->with('data', $data, 'nextNIP', $nextNIP);
    } 
    public function create(){
        $nextNIP = Karyawan::generateNextNIP();
        return view('create', compact('nextNIP'));
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'nip' => 'required|string|max:255|unique:karyawan',
            'nama' => 'required|string|max:255',
            'gaji' => 'required|numeric',
            'departemen' => 'required|in:IT,Human_Resource,Accountaint,Logistik',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:pria,wanita',
        ]);

        Karyawan::create($validatedData);
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }
    public function edit($id){
        $karyawan = Karyawan::findOrFail($id);
        return view('edit', compact('karyawan'));
    }
    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'gaji' => 'required|numeric',
            'departemen' => 'required|in:IT,Human_Resource,Accountaint,Logistik',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:pria,wanita',
        ]);

        $karyawan = Karyawan::findOrFail($id);
        $karyawan->update($validatedData);

        return redirect()->route('karyawan.index')->with('success', 'Data Karyawan berhasil diperbarui.');
    }
    private function generateNextNIP()
    {
        $latestNIP = Karyawan::latest('id')->value('nip');

        if (!$latestNIP) {
            return '001';
        }

        return str_pad((int) $latestNIP + 1, 3, '0', STR_PAD_LEFT);
    }
    public function destroy($nip)
    {
        $karyawan = Karyawan::find($nip);
        $karyawan->delete();
        return redirect('dashboard');
    }
}
