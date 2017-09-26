<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManajemenAsset extends Model
{
  protected $table = 'manajemen_asset';
  public $timestamps = false;

  protected $fillable = [
      'id',
      'nama',
      'parent',
      'status',
      'keterangan',
      'header'
  ];
}
