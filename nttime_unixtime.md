NTタイムエポック　と UNIXタイムスタンプ
=======================================================

- 日時はWindowsでは NT タイムエポック、UNIX系OSではUNIXタイムスタンプという数値で管理されている



|   |NT タイムエポック|UNIXタイムスタンプ|
|:--|:--|:--|
|単位|100ナノ秒|秒|
|起点|1601/01/01 00:00:00|1970/01/01 00:00:00|
|1970/01/01 00:00:00 +0000 の値|116444736000000000|0|
|1970/01/01 00:00:00 +0900 の値|116444412000000000| |
|確認方法|PowerShell で<br>`(Get-Date "1970/01/01 00:00:00").ToFileTime()`<br> `w32tm /ntte 116444736000000000`| |


## PHP で取得したNTタイムエポックを正常に表示する処理

64bit 値が使われている場合、PHPも64bit版である必要がある


```PHP
<?php

const NT_TIME_UNIX_TIME = 116444736000000000;

// 2020/03/12 8:46:54 +0000
$nt_time = 132284440148643415;

// UNIXタイムスタンプに換算（UNIXタイムスタンプにそろえ、100ナノ秒 → 秒単位に変換）
$nt_time_to_unix_time = ($nt_time - NT_TIME_UNIX_TIME)/10/1000/1000;


var_dump(date('Y-m-d H:i:s T', $nt_time_to_unix_time));

```



### サンプルコード

- [kasue/win-utils-for-php : time_nt_unix.php](https://github.com/kasue/win-utils-for-php/blob/master/src/time_nt_unix.php)