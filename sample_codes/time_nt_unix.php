<?php
// NTエポックタイム（Windows環境で内部的に利用する日時形式： 64bit） と UNIXタイムスタンプの相互変換

class TIME_NT_UNIX
{
    // NTエポックタイムでの 1970/01/01 00:00:00
    //      ここでは時差を考慮していない分、UnixタイムスタンプからNTエポックタイムに変換する際は時差を考慮する必要がある
    //      32bit 向けは秒単位  = 11644441200 秒（ /10/1000/1000)
    //      64bit 向けは100ナノ秒単位：NTエポックタイム形式
    const NT_TIME_UNIX_TIME_32 = 11644441200;
    const NT_TIME_UNIX_TIME_64 = 116444412000000000;

    // NTエポックタイム を書式を適用して表示
    static function convert_nttime_to_datestr($nt_time, $time_format = 'Y-m-d H:i:s T')
    {
        // UNIXタイムスタンプに変換
        $unit_time = self::convert_nttime_to_unixtime($nt_time);

        // NTエポックタイムをUnixタイムスタンプに変換して date 関数
        return date($time_format, $unit_time);
    }
    
    // NTエポックタイムをUNIXタイムスタンプに変換
    static function convert_nttime_to_unixtime($nt_time)
    {
        // UNIXタイムスタンプに換算（UNIXタイムスタンプにそろえ秒単位に変換）
        $nt_time_to_unix_time = (int) ($nt_time - self::NT_TIME_UNIX_TIME_32) ;
        return $nt_time_to_unix_time;
    }


    // Unix タイムスタンプをNTエポックタイムに変換
    //      $offset は時差分を秒単位で入力 +9 なら (9*60*60)
    static function convert_unixtime_to_nttime($unix_time, $offset = 0)
    {
        // UNIX タイムスタンプに時差分を加算
        $unix_time_local = $unix_time + $offset;
        
        // 32bit の場合処理できないため、分岐
        switch(PHP_INT_SIZE)
        {
            // 32bit
            // 秒単位前提で処理し、最後に 0000000 を文字列として付与
            case 4: return　$nt_time = (string) ($unix_time_local + self::NT_TIME_UNIX_TIME_32) . '0000000');

            // 64bit    100ナノ秒単位で計算
            case 8: return　$nt_time = (int) (($unix_time_local*1000*1000*10) + self::NT_TIME_UNIX_TIME_64 );
        }

        return $nt_time;
    }
}


