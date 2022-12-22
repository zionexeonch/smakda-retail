<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Trigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(
            'CREATE TRIGGER `tr_updateSaldoDeposit` AFTER INSERT ON `belanjas`
             FOR EACH ROW BEGIN
                UPDATE data_gurus set sisaSaldo = sisaSaldo + NEW.saldo where nik = NEW.nik;
            END'
        );

        DB::unprepared(
            'CREATE TRIGGER `tr_updateSaldoB3lanja` AFTER INSERT ON `belanjas`
             FOR EACH ROW BEGIN
                UPDATE data_gurus set sisaSaldo = sisaSaldo - NEW.belanja where nik = NEW.nik;
            END'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER trigger');
    }
}
