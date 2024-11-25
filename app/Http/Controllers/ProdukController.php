<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Exports\ProdukExport;
use App\Models\Category_produk;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ProdukController extends Controller
{
    public function index(Request $request) {
        if ($request->has('search') || $request->has('category')) {
            if ($request->category == 'all') {
                $data = Produk::where('nama', 'like', '%' . $request->search . '%')->paginate(10);
            }else {
                $query = Produk::query();
                $query->whereRaw('LOWER(nama) like ?', ['%' . strtolower($request->search) . '%']);
                $query->where('category_id', $request->category);
                $data = $query->paginate(10);
            }
        }else {
            $data = Produk::paginate(10);
        }
        return view('produk.index', [
            'data' => $data,
            'category' => Category_produk::all(),
            'category_selected' => $request->category ?? 'all',
            'search_selected' => $request->search ?? ''
        ]);
    } 

    public function create() {
        return view('produk.create', [
            'category' => Category_produk::all()
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'category' => 'required',
            'name' => 'required|string|max:255',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:100',
        ]);
        $fileName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('assets/img/produk'), $fileName);
        }

        DB::statement('insert into produks (image, nama, harga_beli, harga_jual, stok, category_id) values (?, ?, ?, ?, ?, ?)', [$fileName, $request->name, $request->harga_beli, $request->harga_jual, $request->stok, $request->category]);

        return redirect()->route('produks.index')->with('success', 'Data Berhasil Disimpan');
    }

    public function edit($id) {
        return view('produk.edit', [
            'data' => Produk::find($id),
            'category' => Category_produk::all()
        ]);
    }

    public function update(Request $request, $id) {
        // dd($request->all());
        $request->validate([
            'category' => 'required',
            'name' => 'required|string|max:255',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:100',
        ]);
        $fileName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('assets/img/produk'), $fileName);
        }

        DB::statement('update produks set nama = ? , image = ?, harga_beli = ?, harga_jual = ?, stok = ?, category_id = ? where id = ?', [
            $request->name, $fileName, $request->harga_beli, $request->harga_jual, $request->stok, $request->category, $id]);

        return redirect()->route('produks.index')->with('success', 'Data Berhasil Diupdate');

    }

    public function destroy($id) {
        DB::statement('delete from produks where id = ?', [$id]);
        return redirect()->route('produks.index')->with('success', 'Data Berhasil Dihapus');
    }

    public function export(Request $request)
    {
        $filters = [
            'category' => $request->input('category'),
            'name' => $request->input('name')
        ];
        return Excel::download(new ProdukExport($filters), 'produk.xlsx');
    }
}