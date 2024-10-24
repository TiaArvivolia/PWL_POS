<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StokModel extends Model
{
    use HasFactory;

    protected $table = 't_stok'; // Define the table name
    protected $primaryKey = 'stok_id'; // Define the primary key

    protected $fillable = ['supplier_id', 'barang_id', 'user_id', 'stok_tanggal', 'stok_jumlah']; // Fillable attributes

    // Define the relationship with SupplierModel
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(SupplierModel::class, 'supplier_id', 'supplier_id');
    }

    // Define the relationship with BarangModel
    public function barang(): BelongsTo
    {
        return $this->belongsTo(BarangModel::class, 'barang_id', 'barang_id');
    }

    // Define the relationship with UserModel
    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }
}
