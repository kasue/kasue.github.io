<?php

require_once 'time_nt_unix.php';

// テストコード

// 2020/03/12 8:46:54 +0000
$nt_time = 132284440148643415;

// NTエポックタイムをUNIXタイムスタンプに変換
var_dump(TIME_NT_UNIX::convert_nttime_to_unixtime($nt_time));

// NTエポックタイムをUNIXタイムスタンプに変換し、書式付きで表示
var_dump(TIME_NT_UNIX::convert_nttime_to_datestr($nt_time), 'Y-m-d H:i:s T');

// UNIXタイムスタンプをNTエポックタイムに変換
var_dump(TIME_NT_UNIX::convert_unixtime_to_nttime(time(), (9*60*60)));
