<?php

namespace Core;

use Rakit\Validation\Validator;

class Validation
{
  public static function validate($array, $post = null) {
    $validator = new Validator();

    $validation = $validator->validate(( $post != null) ? $post : $_POST, $array);
    ($validation->fails()) ? response()->json([
      'status' => 'error',
      'message' => $validation->errors()->all()[0]
    ]) : true;
  }
}
