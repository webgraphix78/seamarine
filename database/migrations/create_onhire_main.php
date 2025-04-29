<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('onhire_main', function (Blueprint $table) {
			$table->id();
            $table->integer('onhire_id')->default(0);
			$table->string('bd_x')->nullable();
			$table->integer('bd_x_value')->default(0)->comment('Fortvale,Perolo,Pelican,Other');
			$table->string('bd_other')->nullable();
			$table->integer('bd_butterfly_ball')->default(0)->comment('1=Butterfly,2=Ball,-1=NA');
			$table->string('bd_butterfly_ball_sn')->nullable();
			$table->integer('bd_tir_strip')->default(0)->comment('1=Yes,0=No');
			$table->integer('bd_spacers')->default(0)->comment('0,1,2,3,4');

			$table->string('fv_x')->nullable();
			$table->integer('fv_x_value')->default(0)->comment('Forvale,Perolo,Other');
			$table->string('fv_other')->nullable();
			$table->integer('fv_option')->default(0)->comment('NA,Cleanflow,Highlift,Neatflow,Neatco');
			$table->integer('fv_tir_strip')->default(0)->comment('1=Yes,0=No');

			$table->string('bocp_x')->nullable();
			$table->integer('bocp_x_value')->default(0)->comment('-1=NA,1=4 Bolt Blank,2=6 Bolt Blank,3=8 Bolt Blank');
			$table->string('bocp_3_bsp')->nullable();
			$table->integer('bocp_cap')->default(0)->comment('NA,SS,ALU,PVC,Brass');

			$table->string('rt_x')->nullable();
			$table->integer('rt_type')->default(0)->comment('NA,Pull Cable,Handle,Spring');
			$table->integer('rt_fusible_link')->default(0)->comment('1=Yes,0=No');

			$table->string('td_x')->default(0);
			$table->string('td_dn')->nullable();
			$table->integer('td_dn_value_1')->default(0)->comment('-1=NA,1=4 Bolt Blank,2=6 Bolt Blank,3=8 Bolt Blank');
			$table->integer('td_dn_value_2')->default(0)->comment('Fort Vale,Perolo,Pelican,Other');
			$table->string('td_dn_other')->nullable();
			$table->integer('td_butterfly_ball')->default(0)->comment('1=Butterfly,2=Ball,-1=NA');
			$table->integer('td_tir_strip')->default(0)->comment('1=Yes,0=No');
			$table->integer('td_siphon_tube')->default(0)->comment('1=Yes,0=No');

			$table->string('tl_x')->nullable();
			$table->string('tl_dn')->nullable();
			$table->integer('tl_dn_value_1')->default(0)->comment('-1=NA,1=4 Bolt Blank,2=6 Bolt Blank,3=8 Bolt Blank');
			$table->integer('tl_dn_value_2')->default(0)->comment('Fort Vale,Perolo,Pelican,Other');
			$table->string('tl_dn_other')->nullable();
			$table->integer('tl_butterfly_ball')->default(0)->comment('1=Butterfly,2=Ball,-1=NA');
			$table->integer('tl_tir_strip')->default(0)->comment('1=Yes,0=No');

			$table->string('av_x')->nullable();
			$table->integer('av_value_inch')->default(0)->comment('NA,3/4 Inch,1 Inch,1.5 Inch,2 Inch,2.5 Inch,3 Inch');
			$table->integer('av_value')->default(0)->comment('Fort Vale,Perolo,Pelican,Other');
			$table->string('av_other')->nullable();
			$table->integer('av_butterfly_ball')->default(0)->comment('1=Butterfly,2=Ball,-1=NA');

			$table->integer('avc_type')->default(0)->comment('NA,Bsp,Npt,Quick,Flange');
			$table->integer('avc_tir_strip')->default(0)->comment('1=Yes,0=No');
			$table->integer('avc_cap_blank_v1')->default(0)->comment('NA,Cap,Blank');
			$table->integer('avc_cap_blank_v2')->default(0)->comment('NA,4 Bolt Bank,Cap With Chain,Cable');
			$table->integer('avc_cap_blank_v3')->default(0)->comment('NA,SS,ALU');
			$table->string('avc_air_pressure_gauge')->nullable();

			$table->string('srv1_x')->nullable();
			$table->integer('srv1_value1')->default(0)->comment('Fort Vale,Perolo,Other');
			$table->string('srv1_other')->nullable();
			$table->integer('srv1_value2')->default(0)->comment('NA,Flanged,Threaded');
			$table->integer('srv1_value3')->default(0)->comment('NA,4 Bolt Blank,6 Bolt Blank,8 Bolt Blank');
			$table->string('srv1_pressure')->nullable();
			$table->integer('srv1_vac')->default(0)->comment('NA,6 inch Hg,6.2 inch Hg');
			$table->string('srv1_serial')->nullable();
			$table->integer('srv1_tir_strip')->default(0)->comment('1=Yes,0=No');
			$table->integer('srv1_flame_screen')->default(0)->comment('1=Yes,0=No');

			$table->string('srv2_x')->nullable();
			$table->integer('srv2_value1')->default(0)->comment('Fort Vale,Perolo,Other');
			$table->string('srv2_other')->nullable();
			$table->integer('srv2_value2')->default(0)->comment('NA,Flanged,Threaded');
			$table->integer('srv2_value3')->default(0)->comment('NA,4 Bolt Blank,6 Bolt Blank,8 Bolt Blank');
			$table->string('srv2_pressure')->nullable();
			$table->integer('srv2_vac')->default(0)->comment('NA,6 inch Hg,6.2 inch Hg');
			$table->string('srv2_serial')->nullable();
			$table->integer('srv2_tir_strip')->default(0)->comment('1=Yes,0=No');
			$table->integer('srv2_flame_screen')->default(0)->comment('1=Yes,0=No');

			$table->string('rd1_x')->nullable();
			$table->string('rd1_manufacturer')->nullable();
			$table->string('rd1_bar')->nullable();
			$table->string('rd1_size')->nullable();

			$table->string('rd2_x')->nullable();
			$table->string('rd2_manufacturer')->nullable();
			$table->string('rd2_bar')->nullable();
			$table->string('rd2_size')->nullable();

			$table->string('srv1_mano_x')->nullable();
			$table->string('srv1_mano_value1')->nullable();
			$table->string('srv1_mano_bar')->nullable();

			$table->string('srv2_mano_x')->nullable();
			$table->string('srv2_mano_value')->nullable();
			$table->string('srv2_mano_bar')->nullable();

			$table->integer('gps')->default(0)->comment('1=Yes,0=No');
			$table->integer('camera')->nullable()->comment('1=Yes,0=No');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('onhire_main');
	}
};
