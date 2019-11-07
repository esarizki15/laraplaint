<?php

namespace App\Http\Controllers;

use App\Kategori;
use Illuminate\Http\Request;
use Excel;
use App\Exports\KategoriExport;
use App\Imports\KategoriImport;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateExcelTemplate(){
        return Excel::download(new KategoriExport, 'kategori.xlsx');
    }

    public function importExcel(Request $request){
        //VALIDASI
        $this->validate($request, [
            'import' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('import')) {
            $file = $request->file('import'); //GET FILE
            Excel::import(new KategoriImport, $file); //IMPORT FILE 
            // $filename = time() . '.' . $file->getClientOriginalExtension();
            // $file->storeAs(
            //     'public', $filename
            // );
            // //MEMBUAT JOBS DENGAN MENGIRIMKAN PARAMETER FILENAME
            // ImportJob::dispatch($filename); 
            return redirect()->back()->with(['success' => 'Upload success']);
        }  
        return redirect()->back()->with(['error' => 'Please choose file before']);
    }
    public function index()
    {
        $kategori = Kategori::all();
        return view('kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nama'=>'required|unique:kategoris',
        ]);

        $kategori = Kategori::create($request->all());
        // Session::flash("flash_notification", [
        //     "level"=>"success",
        //     "message"=>"Berhasil menyimpan $kategori->nama"
        // ]);
        alert()->success("Berhasil menyimpan data $kategori->nama sebagai kategori baru", 'Sukses!')->autoclose(2500);
        return redirect()->route('kategori.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {
        $kategori->update($request->all());
        alert()->success("Berhasil mengubah data $kategori->nama", 'Sukses!')->autoclose(2500);

        return redirect()->route('kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        alert()->success("Berhasil menghapus data kategori", 'Sukses!')->autoclose(2500);
        return redirect()->route('kategori.index');
    }
}
