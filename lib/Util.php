<?php

/**
 * Miscellaneous functions.
 **/

class Util {

  /**
   * Prints an error message and exists.
   *
   * @param string $message The message to print, in printf syntax.
   * @param $arguments Arguments for $message.
   */
  static function die(string $message, ...$arguments) {
    vprintf($message, $arguments);
    printf("\n");
    exit(1);
  }

  /**
   * Same as die(), but also shows how to get additional help.
   */
  static function dieWithHelp(string $message, ...$arguments) {
    vprintf($message, $arguments);
    printf(" Please run '%s --help' for usage info.", Opt::$myself);
    printf("\n");
    exit(1);
  }

  static function spawnJail() {
    $uid = posix_getuid();
    $gid = posix_getgid();
  }

  static function wait() {
    $endTime = (Opt::$wallTime)
      ? (microtime(true) + Opt::$wallTime)
      : null;

    while (true) {

      // check wall time limit if enforced
      if ($endTime && (microtime(true) > $endTime)) {
        return 'Wall time limit exceeded.';
      }

    }
  }
}
