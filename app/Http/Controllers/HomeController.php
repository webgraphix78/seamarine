<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

	protected $passwords = [
		// 'aarti',
		// 'AC1234',
		// 'accord@imports',
		// 'ACECHE',
		// 'Line1234',
		// 'ACEGL',
		// 'aceglobal$54',
		// 'Acura1221',
		// 'adslog',

		// 'afpl!4321',
		// 'Akcl!321',
		// 'Allied1234',
		// 'ameera1234',
		// 'amfico',
		// 'arnl123',
		// 'AW1234567',
		// 'asr1234',
		// 'ATL@1234',
		// 'atul@4321',
		// 'avana1221',
		// 'axis',
		// 'BAS123',
		// 'ACNAM',
		// 'baxi123',

		// 'bcsl',
		// 'Bertschi@0828',
		// 'Bhise',
		// 'Bolt',
		// 'broekman123',
		// 'btl@007',
		// 'bulk1517',
		// 'CAL123',
		// 'CAPL',
		// 'cell',
		// 'cey1243',
		// 'clat12345',
		// 'CNG123',
		// 'cc12345',
		// 'Crossover@6969',
		// 'dam09876',
		// 'Dbc@0821',
		// 'deccan1224',
		// 'denhartogh@159',
		// 'DJD@0121',
		// 'dkcpl123',
		// 'test',
		// 'Ebest1221',
		// 'Econ1234',
		// 'elpl1234',
		// 'emkay153',
		// 'Eur123456',
		// 'E-way4321',
		// 'Express',
		// 'express@123',

		// 'fair!1221',
		// 'fak1221',
		// 'fiepl',
		// 'fleet123',
		// 'fcipl',
		// 'fsapl123',
		// 'GENESISINDIA',
		// 'gfs54321',
		// 'Godrej@0819',
		// 'goodc123',
		// 'GoodD1234',
		// 'Gkan1234',
		// 'good12345',
		// 'Vizag1221',
		// 'Log4321',
		// 'GSL@123',
		// 'halc',
		// 'Hoyer4321',
		// 'HTS123',
		// 'HWLPL@123',
		// 'ICL1234567',
		// 'Ind12345',
		// 'Ship0123',
		// 'inn09876',
		// 'James@0826',
		// 'KA1234',
		// 'Kanoo1510',
		// 'kingstar123',
		// 'poonja@123',
		// 'KLL@123',
		// 'org12345',
		// 'ind1221',
		// 'ktn0000',
		// 'lelog',
		// 'les1241',
		// 'LP1234',
		// 'LSCI!1432',
		// 'LTB@123',
		// '123456',

		'mcl1818',
		'MAZD2018',
		'Meeburg@2024',
		'Merc1234',
		'mml@7012',
		'modulux',
		'Mollog123',
		'shipping',
		'MSR123',
		'me1818',
		'NSAC1221',
		'Nashaid1234',
		'NDS0987',
		'npd123',
		'india',
		'NF1234',
		'NHD123',
		'Nichi2211',
		'osunt1234',
		'over123',
		'pan12345',
		'PDP123',
		'pearl',
		'plpl12345',
		'PRF123',
		'PROc',
		'cont1234',
		'qat',
		'qnl',
		'Tainer1511',
		'RAD1234',
		'rav@12345',
		'rav@123456',
		'rav@1234',
		'RSL1234',
		'@RVHPL060720',
		'sc12345',
		'sai@123',
		'sara2906',
		'samuship',
		'seacfs',
		'sls12345',
		'SC2022',
		'SEAHAWK123',
		'seamarine',
		'sea$5152',
		'sfs',
		'Shals123',
		'Sharp1881',
		'shreyas1234',
		'sierra2012',
		'sind@123',
		'SINO123',
		'tank',
		'sky1234',
		'spec1221',
		'stellar',
		'SUM123',
		'Sunstar1234',
		'sutt1234',
		'svlr@001',
		'tci123',
		'TCLPL1234',
		'tul54321',
		'total@123',
		'tf123456',
		'@TP010920',
		'tsgc#123',
		'tul1234',
		'tulsidas@123',
		'umpl1234',
		'Uni4321',
		'Univer1234',
		'VAE123',
		'Dosa',
		'VPB123',
		'yog1234',
		'Zeta2021',
	];
	
	public function getBCryptHash(){
		$hashes = [];
		foreach($this->passwords as $password){
			$hashes[$password] = bcrypt($password);
		}
		return response()->json($hashes);
	}

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
		$component = 'dashboard-component';
		$current_user_id = auth()->id();

		switch(auth()->user()->role_id){
			case 2:
				$all_permissions = "100";
				break;
			default:
				$all_permissions = "111";
				break;
		}
		return view('common.index', compact('component', 'current_user_id', 'all_permissions'));
    }

	public function loadMasters()
    {
		$component = 'all-masters-component';
		return view('common.index', compact('component'));
    }
}
