<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierModel extends Model
{
    use HasFactory;

    protected $table = 'm_supplier';        // Define the name of the table
    protected $primaryKey = 'supplier_id';  // Define the primary key
    protected $fillable = ['supplier_kode', 'supplier_nama', 'supplier_alamat'];  // Fillable columns
}
