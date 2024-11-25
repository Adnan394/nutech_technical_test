<?php

namespace App\Exports;

use App\Models\Produk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProdukExport implements FromCollection, WithHeadings
{
    protected $filters;

    // Constructor untuk menerima filter query
    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    /**
     * Query data untuk diekspor
     * 
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Mulai query Produk
        $query = Produk::query();

        // Terapkan filter jika tersedia
        if (!empty($this->filters['category_selected']) || !empty($this->filters['search_selected'])) {
            if ($this->filters['category_selected'] == 'all') {
                $query->where('nama', 'like', '%' . $this->filters['search_selected'] . '%');
            }else {
                $query->where('category_id', $this->filters['category_selected']);
                $query->where('nama', 'like', '%' . $this->filters['search_selected'] . '%');
            }
        }

        return $query->select('id', 'nama', 'category_id', 'harga_beli', 'harga_jual', 'stok')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Category',
            'Harga Beli',
            'Harga Jual',
            'Stok',
        ];
    }
}