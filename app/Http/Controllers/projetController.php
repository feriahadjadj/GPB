<?php
namespace App\Http\Controllers;

use App\Notifications\userNotification;
use App\Avancement;
use App\Finance;
use App\Nature;
use App\Projet;
use App\Retard;
use App\Role;
use App\user;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\ProjectHistory;

class projetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $natures = Nature::all();
        $finances = Finance::orderBy('name', 'DESC')->get();

        return view('projet/ajouterProjet')
            ->with(['natures' => $natures, 'finances' => $finances]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $natures = Nature::all();
        $finances = Finance::orderBy('name', 'DESC')->get();
        return view('projet/ajouterProjet')
            ->with(['natures' => $natures, 'finances' => $finances]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $id = Auth::user()->id;

        $data = $request->all();

        if ($data['delai'] == 'jourE') {
            $delai = ' j';
        } else {
            $delai = ' m';
        }


    if($data['odsRealisation']!= null && $data['odsEtude']!= null ){
        $dateR = Carbon::parse($data['odsRealisation']);

        if ($data['realisation'] == 'jourR') {
            $r = ' j';
            $data['dateReception'] = $dateR->addDays((int) $data['delaiR'])->format('Y-m-d');
        } else {
            $r = ' m';
            $data['dateReception'] = $dateR->addMonths((int) $data['delaiR'])->format('Y-m-d');
        }

    }else{

        if($data['odsEtude']== null){
            $data['etatPhysique']= "NL";
        }

        if ($data['realisation'] == 'jourR') {
            $r = ' j';

        } else {
            $r = ' m';
        }
    }
    // test


        $data['delaiE'] = $data['delaiE'] . " " . $delai;
        $data['delaiR'] = $data['delaiR'] . " " . $r;
        $data['user_id'] = $id;

        $projet = Projet::create($data);
        $projet->save();

        $avancement = Avancement::create(['projet_id' => $projet->id, 'montantAlloue' => $data['montantAlloue'], 'montantEC' => $data['montantEC'], 'montantPC' => $data['montantPC'],

            'delaiR' => $data['delaiR'], 'etatPhysique' => $data['etatPhysique'], 'tauxA' => $data['tauxA'], 'observation' => $data['observation'],

        ]);

        $avancement->save();

        /* notification */

        $users = User::all();
        foreach ($users as $user) {
            if ($user->roles->contains('name', 'superA')) {
                $user->notify(new userNotification(Auth::user(), $projet, 'ajout', Auth::user()->name . ' a ajouté le projet ' . $projet->designation));

            }
        }

        return redirect(route('projet.gestionprojets', ['id' => $id, 'finance' => 'tout','year'=>Carbon::today()->year]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $data = $request->all();
    $projet = Projet::find($id);

    // ✅ ADD: tracked fields + snapshot BEFORE update
    $tracked = [
        // Projet table fields we want to track
        'finance',
        'delaiE',
        'delaiR',
        'odsEtude',
        'odsRealisation',
        'dateReception',
        'dateMiseEnOeuvre',
        // add more later if needed
    ];
    $before = $projet ? $projet->only($tracked) : [];

    if ($data['delai'] == 'jourE') {
        $delai = ' j';
    } else {
        $delai = ' m';
    }

    if($data['odsRealisation']!= null){

        $dateR = Carbon::parse($data['odsRealisation']);

        if ($data['realisation'] == 'jourR') {
            $r = ' j';
            $data['dateReception'] = $dateR->addDays((int) $data['delaiR'] + (int) $this->delayDays($projet))->format('Y-m-d');
        } else {
            $r = ' m';
            $dateR->addMonths((int) $data['delaiR'])->format('Y-m-d');
            $data['dateReception'] = $dateR->addDays((int) $this->delayDays($projet))->format('Y-m-d');
        }
    }else{
        if ($data['realisation'] == 'jourR') {
            $r = ' j';

        } else {
            $r = ' m';
        }
    }

    $data['delaiE'] = $data['delaiE'] . " " . $delai;
    $data['delaiR'] = $data['delaiR'] . " " . $r;

    $projet->update($data);
    $projet->save();

    // ✅ ADD: snapshot AFTER update + log only changed fields (Projet fields)
    $after = $projet->fresh()->only($tracked);

    foreach ($tracked as $field) {
        $old = array_key_exists($field, $before) ? (string) $before[$field] : null;
        $new = array_key_exists($field, $after)  ? (string) $after[$field]  : null;

        // normalize null/empty
        $oldNorm = ($old === '' ? null : $old);
        $newNorm = ($new === '' ? null : $new);

        if ($oldNorm !== $newNorm) {
            ProjectHistory::create([
                'projet_id'   => $projet->id,
                'user_id'     => Auth::id(), // ✅ uses your existing Auth import
                'action'      => 'updated',
                'field'       => $field,
                'old_value'   => $oldNorm,
                'new_value'   => $newNorm,
                'description' => null,
            ]);
        }
    }

    $av = $request->only(['montantAlloue', 'montantEC', 'montantPC', 'delaiR', 'etatPhysique', 'tauxA', 'observation']);
    $av['projet_id'] = $projet->id;
    $av['delaiR'] = $av['delaiR'] . " " . $r;

    $check = Avancement::where($av)->exists();

    if ($check == false) {
        $avancement = Avancement::create($av);
        $avancement->save();
    }

    // notification -------------------------------------------------------------

    $users = User::all();
    foreach ($users as $user) {
        if ($user->roles->contains('name', 'superA')) {
            $user->notify(new userNotification(Auth::user(), $projet, 'modification', Auth::user()->name . ' a modifié le projet ' . $projet->designation));
        }
    }

    return redirect()
        ->route('projet.voirprojet', $id);
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Projet $projet)
    {

        $projet->avancement()->delete();
        $projet->retards()->delete();
        $projet->delete();

        // notification -------------------------------------------------------------
        $users = User::all();
        foreach ($users as $user) {
            if ($user->roles->contains('name', 'superA')) {
                $user->notify(new userNotification(Auth::user(), $projet, 'suppression',Auth::user()->name . ' a supprimé le projet ' . $projet->designation));
            }
        }

        return redirect(route('projet.gestionprojets', ['id' => Auth::user()->id, 'finance' => 'tout','year'=>Carbon::today()->year]));
    }

    public function deleteA($avancement, $projet_id)
    {

        Avancement::destroy($avancement);

        return redirect()->route('projet.voirprojet', $projet_id);
    }

    public function voirProjet($id)
{
    $projet = Projet::find($id);
    if($projet!=null){
        $natures = Nature::all();
        $finances = Finance::orderBy('name', 'DESC')->get();

        // ✅ ADD: load project histories (latest first)
        $histories = ProjectHistory::where('projet_id', $projet->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('projet/voirProjet')
            ->with([
                'projet' => $projet,
                'natures' => $natures,
                'finances' => $finances,
                'histories' => $histories, // ✅ ADD
            ]);
    }else{
        return redirect()->back()->with('error',"ce projet n'existe pas");
    }
}

    //gestion des projets

    public function gestion(string $id, string $finance,string $year)
    {

        $natures = Nature::orderBy('id', 'DESC')->get();
        $finances = Finance::orderBy('name', 'DESC')->get();
        $count=Auth::user()->roles->where('status', 1)->whereIn('name', ['user','Dipb'])->count();
        $test_auth= $id != Auth::user()->id;

        if ($test_auth && $count>0) {

            return view('admin/users/error');

        } else {
            if ($count==0 && !$test_auth) {

                $id = Role::where(['name' => 'user', 'status' => 1])->first()
                    ->users()
                    ->first()->id;

            }

            $p[] = array();

            foreach ($natures as $i => $n) {
                # code...
              $projets =  Projet::getProjetsByFinanceNature($id, $year, $finance, $n->name);

            //   foreach ($projets as $j => $p1) {
            //       if($p1->etatPhysique == 'NL' && Carbon::parse($p1->created_at)->year != $year ){
            //           // delete projet from array projets
            //         unset($projets[$j] );

            //       }



            //   }
            //   if($projet->odsEtude!= null && $projet->created_at == $year ){


                $p[$i] = $projets;

                $p[$i]->name = $n->name;
            // }

            }
            $p = array_reverse($p);

            $sumMG = Projet::sumMontantG($id, $year, $finance);
            $totPE = Projet::countEtatTotalG($id, $year, $finance);


            return view('projet/gestionProjets')->with([

                'totPE' => $totPE,
                'sumMG' => $sumMG,
                'projetsFN' => $p,
                'id' => $id,
                'finance' => $finance,
                'natures' => $natures,
                'finances' => $finances,
                'year' => $year,

            ]);

        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, ['name' => ['required', 'string', 'max:(5)', 'unique'],

        ]);
    }

    public function notifications()
    {

        $notifications = Auth::user()->Notifications()
            ->paginate(10);

        return view('admin/users/notifications')
            ->with('notifications', $notifications);
    }

    public function markAsReadNotif($id)
    {
        Auth::User()
            ->unreadNotifications
            ->where('id', $id)->markAsRead();
        return 'success';

    }

    public function markAsRead(Request $request)
    {

        $data = $request->all()['data'];
        foreach ($data as $id) {
            Auth::User()
                ->unreadNotifications
                ->where('id', $id)->markAsRead();
        }

        return "success";

    }
    public function deleteNotif(Request $request)
    {

        $data = $request->all()['data'];
        foreach ($data as $id) {
            Auth::User()->Notifications()
                ->where('id', $id)->delete();
        }

        return "success";

    }

    public function recaps($recap_id, $finance,$year)
    {

        switch ($recap_id) {
            case '1':

                $finances = Finance::orderBy('name', 'DESC')->get();
                $users = $this->recap1($finance,$year);
                $total = $this->recap1Total($finance,$year);

                $recapData = ['finance' => $finance, 'finances' => $finances, 'users' => $users, 'total' => $total , 'year' => $year];
                break;
            case '2':
                $users = $this->recap2($year);
                $total = $this->recap2Total($year);
                $recapData = ['finance' => $finance, 'users' => $users, 'total' => $total , 'year' => $year];
                break;

            case '3':
                $users = $this->recap3($year);
                $total = $this->recap3Total($year);
                $recapData = ['finance' => $finance, 'users' => $users, 'total' => $total , 'year' => $year];
                break;

            case '4':
                $natures=Nature::orderBy('id', 'ASC')->get();
                $n = $this->recap4('construction',$year);
                $total = $this->recap4Total('construction',$year);
                $recapData = ['finance' => $finance, 'n' => $n,'natures' => $natures, 'total' => $total , 'year' => $year];
                break;
            default:
                # code...
                break;
        }

        return view('projet/recap' . $recap_id)->with($recapData);
    }

    public function indexRetards($id)
    {

        $retards = Projet::find($id)->retards()
            ->orderBy('date_arret', 'DESC')
            ->get();
        return view('projet/retards')
            ->with(['retards' => $retards, 'id' => $id]);
    }

    public function storeRetard(Request $request, $id)
    {

        $projet = Projet::find($id);

       $data = $request->except('_token', '_method', 'attachment'); 

    if ($request->hasFile('attachment') && $request->file('attachment')->isValid()) { 
        $data['attachment'] = $request->file('attachment')->store('retards', 'public');
    }

        $retard = Retard::create($data);

        $retard->projet()
            ->associate($projet);
        $retard->save();
        $this->receptionDate($projet);

        return redirect()->back()
            ->with('success', 'ODS d\'arret ajoutée avec succes :)');
    }

    public function updateRetard(Request $request, $id)
    {

        $data = $request->except('_token', '_method');

        $retard = Retard::find($id);
        $retard->update($data);
        $retard->save();

        $projet = $retard->projet;
        $this->receptionDate($projet);

        return redirect()->back()
            ->with('success', 'ODS d\'arret mise a jour avec succes :)');
    }

    public function destroyRetard($retardId)
    {
        $retard = Retard::find($retardId);
        $projet = $retard->projet;
        $retard->delete();
        $this->receptionDate($projet);
        return redirect()->back()
            ->with('success', 'ODS d\'arret supprimée avec succes :)');
    }

    public function delayDays(Projet $p)
    {
        $days = 0;
        $retards = $p->retards()
            ->where('type', 'realisation')
            ->get();
        foreach ($retards as $key => $r) {

            $arret = Carbon::parse($r->date_arret);
            $reprise = Carbon::parse($r->date_reprise);
            $days += $arret->diffInDays($reprise);
        }

        return $days;

    }

    public function receptionDate(Projet $p)
    {
        $dateR = Carbon::parse($p->odsRealisation);

        if (substr($p->delaiR, -1) == 'j') {
            $p->dateReception = $dateR->addDays((int) str_replace(' j', '', $p->delaiR) + (int) $this->delayDays($p))->format('Y-m-d');
        } else {
            $dateR->addMonths((int) str_replace(' m', '', $p->delaiR))
                ->format('Y-m-d');
            $p->dateReception = $dateR->addDays((int) $this->delayDays($p))->format('Y-m-d');
        }

        $p->save();
        return $p;

    }

    //-----------------------recap1------------------------

    public function recap1(string $finance,$year)
    {
        $natures = Nature::all();
        $users = User::all();
        foreach ($users as $key => $user) {
            if ($user->roles()->where('status', 1)->first()->name == 'user') {
                foreach ($natures as $i => $n) {
                    # code...
                    $p[$key][$n->name] = Projet::getNbNatureP($finance, $user->id,$year, $n->name);

                }
                $p[$key]['name'] = $user->name;
                $p[$key]['totalP'] = Projet::getNbProjet($user->id,$year, $finance);
                $p[$key]['montantAlloue'] = Projet::sumMontant($user->id,$year, $finance, 'montantAlloue');
                $p[$key]['montantPC'] = Projet::sumMontant($user->id,$year, $finance, 'montantPC');
                $p[$key]['tauxConsommation'] = Projet::tauxConsommation($user->id,$year, $finance);
            }
            # code...
        }
        return $p;
    }

    public function recap1Total(string $finance,$year)
    {
        $natures = Nature::all();

        foreach ($natures as $i => $n) {
            # code...
            $p[$n->name] = Projet::getNbNatureAllP($finance, $n->name,$year);

        }

        $p['totalP'] = Projet::getNbProjetT($finance,$year);
        $p['montantAlloue'] = Projet::montantTotal($finance, 'montantAlloue',$year);
        $p['montantPC'] = Projet::montantTotal($finance, 'montantPC',$year);
        $p['tauxConsommation'] = Projet::tauxConsommationTotal($finance,$year);

        return $p;
    }

    //--------------------------recap2--------------------

    public function recap2($year)
    {

        $users = User::all();
        foreach ($users as $key => $user) {
            if ($user->roles()->where('status', 1)->first()->name == 'user') {

                $p[$key] = Projet::countEtatTotalG($user->id,$year, 'tout');
                $p[$key]['name'] = $user->name;
                $p[$key]['totalP'] = Projet::getNbProjet($user->id,$year, 'tout');
                $p[$key]['projetNL'] = Projet::projetNL($user->id,$year);
                $p[$key]['tauxProjetNL'] = Projet::tauxProjetNL($user->id,$year);

            }
            # code...
        }
        // dd($p);
        return $p;
    }

    public function recap2Total($year)
    {

        $p = Projet::countProjetByEtat($year);
        $p['totalP'] = Projet::getNbProjetT('tout',$year);
        $p['projetNL'] = Projet::totalProjetNL($year);
        $p['tauxProjetNL'] = Projet::tauxTotalProjetNL($year);

        return $p;
    }

    //--------------------------recap3--------------------

    public function recap3($year)
    {

        $users = User::all();
        $natures = Nature::orderBy('id', 'ASC')->get();
        $etat = ['E', 'P', 'R', 'NL', 'A'];
        foreach ($users as $key => $user) {
            if ($user->roles()->where('status', 1)->first()->name == 'user') {

                foreach ($natures as $i => $n) {
                    foreach ($etat as $i => $e) {
                        $p[$key]['nature'][$n->name][$e] = Projet::getCountEtat($user->id,$year, 'tout', $n->name, $e);
                    }
                }
                $p[$key]['name'] = $user->name;
                $p[$key]['totalP'] = Projet::getNbProjet($user->id,$year, 'tout');
            }
        }
        return $p;
    }

    public function recap3Total($year)
    {
        $natures = Nature::orderBy('id', 'ASC')->get();
        $etat = ['E', 'P', 'R', 'NL', 'A'];
        foreach ($natures as $i => $n) {
            foreach ($etat as $i => $e) {
                $p['nature'][$n->name][$e] = Projet::getCountByNatureEtat($n->name, $e,$year);
                $p['tauxNature'][$n->name][$e] = Projet::getRatioNatureEtat($n->name, $e,$year);
                $p['nature'][$n->name]['total'] = Projet::getNbNatureAllP('tout', $n->name,$year);
            }
        }

        $p['totalP'] = Projet::getNbProjetT('tout',$year);
        return $p;
    }

    public function recap4($name,$year)
    {
        $etat = ['E', 'P', 'R', 'NL', 'A'];


        $nature = Nature::where('name',$name)->first();

        $natures = Nature::orderBy('id', 'DESC')->get();
      //dd($nature);
        $users = User::all();
        // foreach ($natures as $key => $nature) {
           $p['id'] = $nature->id;
            foreach ($users as $key => $user) {
                if ($user->roles()->where('status', 1)->first()->name == 'user') {

                   $p[$key]['name'] = $user->name;

                   $p[$key]['montantAlloue'] = Projet::totalMontant($user->id,$year, 'tout', $nature->name, 'montantAlloue');
                   $p[$key]['montantEC'] = Projet::totalMontant($user->id,$year, 'tout', $nature->name, 'montantEC');
                   $p[$key]['montantPC'] = Projet::totalMontant($user->id,$year, 'tout', $nature->name, 'montantPC');

                    if ($p[$key]['montantAlloue'] != 0) {
                        $a =$p[$key]['montantEC'] /$p[$key]['montantAlloue'];
                        $b =$p[$key]['montantPC'] /$p[$key]['montantAlloue'];
                       $p[$key]['tauxEngagement'] = round($a * 100, 2) . " %";
                       $p[$key]['tauxConsommation'] = round($b * 100, 2) . " %";
                    } else {
                       $p[$key]['tauxEngagement'] = '0 %';
                       $p[$key]['tauxConsommation'] = '0 %';
                    }

                    foreach ($etat as $i => $e) {
                       $p[$key][$e] = Projet::getCountEtat($user->id,$year, 'tout', $nature->name, $e);
                    }

                   $p[$key]['totalP'] = Projet::getNbNatureP('tout', $user->id,$year, $nature->name);
                   $p[$key]['projetNL'] = Projet::getCountEtat($user->id,$year, 'tout', $nature->name, 'E') + Projet::getCountEtat($user->id,$year, 'tout', $nature->name, 'P') + Projet::getCountEtat($user->id,$year, 'tout', $nature->name, 'NL');
                    if ($p[$key]['totalP'] != 0) {
                        $a =$p[$key]['projetNL'] /$p[$key]['totalP'];
                       $p[$key]['tauxProjetNL'] = round($a * 100, 2) . " %";
                    } else {
                       $p[$key]['tauxProjetNL'] = '0 %';
                    }

                }
                # code...
            }


        return $p;
    }

    public function recap4Total($name,$year)
    {

        $etat = ['E', 'P', 'R', 'NL', 'A'];

        $nature = Nature::where('name',$name)->first();



        $natures = Nature::orderBy('id', 'DESC')->get();
        $users = User::all();


           $p['montantAlloue'] = Projet::getSumMontantByNature($nature->name, 'montantAlloue',$year);
           $p['montantEC'] = Projet::getSumMontantByNature($nature->name, 'montantEC',$year);
           $p['montantPC'] = Projet::getSumMontantByNature($nature->name, 'montantPC',$year);

            if ($p['montantAlloue'] != 0) {
                $a =$p['montantEC'] /$p['montantAlloue'];
                $b =$p['montantPC'] /$p['montantAlloue'];
               $p['tauxEngagement'] = round($a * 100, 2) . " %";
               $p['tauxConsommation'] = round($b * 100, 2) . " %";
            } else {
               $p['tauxEngagement'] = '0 %';
               $p['tauxConsommation'] = '0 %';
            }

            foreach ($etat as $i => $e) {
               $p[$e] = Projet::getCountByNatureEtat($nature->name, $e,$year);
            }

           $p['totalP'] = Projet::getNbNatureAllP('tout', $nature->name,$year);
           $p['projetNL'] = Projet::getCountByNatureEtat($nature->name, 'E',$year) + Projet::getCountByNatureEtat($nature->name, 'P',$year) + Projet::getCountByNatureEtat($nature->name, 'NL',$year);
            if ($p['totalP'] != 0) {
                $a =$p['projetNL'] /$p['totalP'];
               $p['tauxProjetNL'] = round($a * 100, 2) . " %";
            } else {
               $p['tauxProjetNL'] = '0 %';
            }


        return $p;

    }
    public function recap4SelecteNature($id,$year){

        $name=Nature::where('id',$id)->first()->name;
        $nature = $this->recap4($name,$year);
        $total = $this->recap4Total($name,$year);

       return view('projet.recap4_section')->with(['n'=>$nature,'total'=>$total,'year'=>$year]);


    }

}
