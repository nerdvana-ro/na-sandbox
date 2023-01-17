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
   * @return The numeric value converted to nanoseconds.
   */
  static function parseDuration(string $s): int {
    if (!preg_match('/^(?P<value>[0-9]+)(?P<unit>s|ms|ns)$/', $s, $match)) {
      Util::dieWithHelp("Invalid duration string '{$s}'.");
    }

    switch ($match['unit']) {
      case 's': $mult = 1000000; break;
      case 'ms': $mult = 1000; break;
      case 'ns': $mult = 1; break;
    }

    return $match['value'] * $mult;
  }
}
