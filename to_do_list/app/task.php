<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class task extends Model
{
  public function note()
  {
        //$note= DB::table('task')->insert(['note' => 1]);//
        $note=$tasks->string('note');
  }
}