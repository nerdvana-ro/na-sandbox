<?php

/**
 * Miscellaneous string functions.
 **/

class Str {

  /**
   * @return true iff $sub is a prefix of $str.
   **/
  static function startsWith($str, $sub): bool {
    return $sub == substr($str, 0, strlen($sub));
  }

  /**
   * @param string $s A string consisting of digits followed by s (seconds), ms
   * (milliseconds) or ns (nanoseconds).
   * @return The numeric value converted to seconds.
   */
  static function parseDuration(string $s): float {
    if (!preg_match('/^(?P<value>[0-9]+)(?P<unit>s|ms|ns)$/', $s, $match)) {
      Util::dieWithHelp("Invalid duration string '{$s}'.");
    }

    switch ($match['unit']) {
      case 's': $div = 1; break;
      case 'ms': $div = 1000; break;
      case 'ns': $div = 1000000; break;
    }

    return $match['value'] / $div;
  }
}
