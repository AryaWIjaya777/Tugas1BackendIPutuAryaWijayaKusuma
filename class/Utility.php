<?php

class Utility
{
  public static function uniqueFilename($original)
  {
    $ext = pathinfo($original, PATHINFO_EXTENSION);
    return time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
  }

  public static function e($str)
  {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
  }
}
