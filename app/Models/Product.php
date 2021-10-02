<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var string[]
   */
  protected $fillable = [
    'name', 'title', 'slug', 'description', 'price'
  ];

  /**
   * Model db table name
   *
   * @var string
   */
  protected $table = 'products';
}
