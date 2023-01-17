<?php

/**
 * Parses command-line arguments and assigns static properties.
 **/

class Opt {
  public static ?string $myself = null; // PHP script name
  public static ?int $time = null;      // time limit in nanoseconds
  public static ?string $program = null; // program to sandbox
  public static array $programArgs = []; // arguments to pass to the program

  /**
   * Main parser function.
   **/
  static function parse(array $argv) {
    self::$myself = array_shift($argv); // PHP script name

    // parse options up to and including the program
    while (!empty($argv) && !self::$program) {
      switch ($token = array_shift($argv)) {
        case '-h':
        case '--help':
          self::usage();

        case '-t':
        case '--time':
          self::$time = Str::parseDuration(array_shift($argv));
          break;

        default:
          if (Str::startsWith($token, '-')) {
            Util::dieWithHelp("Unknown option '$token'.");
          } else {
            self::$program = $token;
          }
      }
    }

    // ensure the program name is set
    if (!self::$program) {
      Util::dieWithHelp('No program specified.');
    }

    // parse arguments to pass to the program
    if (!empty($argv)) {
      if (array_shift($argv) !== '--') {
        Util::dieWithHelp("Missing separator '--' after program name.");
      }
      self::$programArgs = $argv;
    }

  }

  /**
   * Prints usage info and exists.
   */
  static function usage() {
    print file_get_contents(__DIR__ . '/../doc/usage.txt');
    exit;
  }

}
