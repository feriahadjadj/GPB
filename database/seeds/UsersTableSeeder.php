<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use App\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::truncate();
        DB::table('role_user')->truncate();




        $superAdminRole = Role::where('name', 'superA')->first();
        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();




        $superAdmin = User::create([
            'name'=>'Super Admin',
            'email'=> 'upw.super@admin.com',
            'tel'=> '0000000000',
            'nbWilaya'=>'00',
            'password' => Hash::make('adminadmin')

        ]);
        $superAdmin2 = User::create([
            'name'=>'Super Admin',
            'email'=> 'djemmal@namane.dz',
            'tel'=> '0000000000',
            'nbWilaya'=>'00',
            'password' => Hash::make('Upw@$Projet#20')

        ]);
        $admin = User::create([
            'name'=>'Admin',
            'email'=> 'upw.admin@admin.com',
            'tel'=> '0000000000',
            'nbWilaya'=>'00',
            'password' => Hash::make('adminadmin')

        ]);
        $user = User::create([
            'name'=>'User',
            'email'=> 'upw.user@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'00',
            'password' => Hash::make('adminadmin')

        ]);
        $user1 = User::create([
            'name'=>'01-ADRAR',
            'email'=> 'upw.adrar@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'01',
            'password' => Hash::make('adminadmin')

        ]);$user2 = User::create([
            'name'=>'02-Chlef',
            'email'=> 'upw.chlef@poste.dz',
             'tel'=> '0000000000',
            'nbWilaya'=>'02',
            'password' => Hash::make('adminadmin')

        ]);$user3 = User::create([
            'name'=>'03-LAGHOUAT',
            'email'=> 'upw.laghouat@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'03',
            'password' => Hash::make('adminadmin')

        ]);$user4 = User::create([
            'name'=>'04-OUM-EL-BOUAGUI',
            'email'=> 'upw.oumelbouagui@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'04',
            'password' => Hash::make('adminadmin')

        ]);$user5 = User::create([
            'name'=>'05-BATNA',
            'email'=> 'upw.batna@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'05',
            'password' => Hash::make('adminadmin')

        ]);$user6 = User::create([
            'name'=>'06-BEJAYA',
            'email'=> 'upw.bejaya@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'06',
            'password' => Hash::make('adminadmin')

        ]);$user7 = User::create([
            'name'=>'07-BISKRA',
            'email'=> 'upw.biskra@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'07',
            'password' => Hash::make('adminadmin')

        ]);$user8 = User::create([
            'name'=>'08-BECHAR',
            'email'=> 'upw.bechar@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'08',
            'password' => Hash::make('adminadmin')

        ]);$user9 = User::create([
            'name'=>'09-BLIDA',
            'email'=> 'upw.blida@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'09',
            'password' => Hash::make('adminadmin')

        ]);$user10 = User::create([
            'name'=>'10-BOUIRA',
            'email'=> 'upw.bouira@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'10',
            'password' => Hash::make('adminadmin')

        ]);$user11 = User::create([
            'name'=>'11-TAMENRASSET',
            'email'=> 'upw.tamenrasset@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'11',
            'password' => Hash::make('adminadmin')

        ]);$user12 = User::create([
            'name'=>'12-TBESSA',
            'email'=> 'upw.tbessa@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'12',
            'password' => Hash::make('adminadmin')

        ]);$user13 = User::create([
            'name'=>'13-TLEMCEN',
            'email'=> 'upw.tlemcen@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'13',
            'password' => Hash::make('adminadmin')

        ]);$user14 = User::create([
            'name'=>'14-TIARET',
            'email'=> 'upw.tiaret@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'14',
            'password' => Hash::make('adminadmin')

        ]);$user15 = User::create([
            'name'=>'15-TIZI-OUZOU',
            'email'=> 'upw.tiziouzou@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'15',
            'password' => Hash::make('adminadmin')

        ]);$user161 = User::create([
            'name'=>'16-1-ALGER-EST',
            'email'=> 'upw.alger-est@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'16',
            'password' => Hash::make('adminadmin')

        ]);$user162= User::create([
            'name'=>'16-2-ALGER-CENTRE',
            'email'=> 'upw.alger-centre@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'16',
            'password' => Hash::make('adminadmin')

        ]);$user163 = User::create([
            'name'=>'16-3-ALGER-OUEST',
            'email'=> 'upw.alger-ouest@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'16',
            'password' => Hash::make('adminadmin')

        ]);$user17 = User::create([
            'name'=>'17-DJELFA',
            'email'=> 'upw.djelfa@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'17',
            'password' => Hash::make('adminadmin')

        ]);$user18 = User::create([
            'name'=>'18-JIJEL',
            'email'=> 'upw.jijel@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'18',
            'password' => Hash::make('adminadmin')

        ]);$user19 = User::create([
            'name'=>'19-SETIF',
            'email'=> 'upw.setif@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'19',
            'password' => Hash::make('adminadmin')

        ]);$user20 = User::create([
            'name'=>'20-SAIDA',
            'email'=> 'upw.saida@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'20',
            'password' => Hash::make('adminadmin')

        ]);$user21 = User::create([
            'name'=>'21-SKIKDA',
            'email'=> 'upw.skikda@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'21',
            'password' => Hash::make('adminadmin')

        ]);$user22 = User::create([
            'name'=>'22-SIDI-BEL-ABBES',
            'email'=> 'upw.sidibelabbes@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'22',
            'password' => Hash::make('adminadmin')

        ]);$user23 = User::create([
            'name'=>'23-ANNABA',
            'email'=> 'upw.annaba@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'23',
            'password' => Hash::make('adminadmin')

        ]);$user24 = User::create([
            'name'=>'24-GUELMA',
            'email'=> 'upw.guelma@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'24',
            'password' => Hash::make('adminadmin')

        ]);$user25 = User::create([
            'name'=>'25-CONSTANTINE',
            'email'=> 'upw.constantine@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'25',
            'password' => Hash::make('adminadmin')

        ]);$user26 = User::create([
            'name'=>'26-MEDEA',
            'email'=> 'upw.medea@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'26',
            'password' => Hash::make('adminadmin')

        ]);$user27 = User::create([
            'name'=>'27-MOSTAGANEM',
            'email'=> 'upw.mostaganem@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'27',
            'password' => Hash::make('adminadmin')

        ]);$user28 = User::create([
            'name'=>'28-MSILA',
            'email'=> 'upw.msila@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'28',
            'password' => Hash::make('adminadmin')

        ]);$user29 = User::create([
            'name'=>'29-MASCARA',
            'email'=> 'upw.mascara@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'29',
            'password' => Hash::make('adminadmin')

        ]);$user30 = User::create([
            'name'=>'30-OUARGLA',
            'email'=> 'upw.ouargla@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'30',
            'password' => Hash::make('adminadmin')

        ]);$user31 = User::create([
            'name'=>'31-ORAN',
            'email'=> 'upw.oran@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'31',
            'password' => Hash::make('adminadmin')

        ]);$user32 = User::create([
            'name'=>'32-EL-BAYADH',
            'email'=> 'upw.elbayadh@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'32',
            'password' => Hash::make('adminadmin')

        ]);$user33 = User::create([
            'name'=>'33-ILLIZI',
            'email'=> 'upw.illizi@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'33',
            'password' => Hash::make('adminadmin')

        ]);$user34 = User::create([
            'name'=>'34-BORDJ-BOU-ARRERIDJ',
            'email'=> 'upw.bordjbouarreridj@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'34',
            'password' => Hash::make('adminadmin')

        ]);$user35 = User::create([
            'name'=>'35-BOUMERDES',
            'email'=> 'upw.boumerdes@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'35',
            'password' => Hash::make('adminadmin')

        ]);$user36 = User::create([
            'name'=>'36-EL-TAREF',
            'email'=> 'upw.eltaref@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'36',
            'password' => Hash::make('adminadmin')

        ]);$user37 = User::create([
            'name'=>'37-TINDOUF',
            'email'=> 'upw.tindouf@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'37',
            'password' => Hash::make('adminadmin')

        ]);$user38 = User::create([
            'name'=>'38-TISSEMSILT',
            'email'=> 'upw.tissemsilt@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'38',
            'password' => Hash::make('adminadmin')

        ]);$user39 = User::create([
            'name'=>'39-EL-OUED',
            'email'=> 'upw.eloued@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'39',
            'password' => Hash::make('adminadmin')

        ]);
        $user40 = User::create([
            'name'=>'40-KHENCHELA',
            'email'=> 'upw.khenchela@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'40',
            'password' => Hash::make('adminadmin')

        ]);
        $user41 = User::create([
            'name'=>'41-SOUK-AHRAS',
            'email'=> 'upw.soukahras@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'41',
            'password' => Hash::make('adminadmin')

        ]);
        $user42 = User::create([
            'name'=>'42-TIPAZA',
            'email'=> 'upw.tipaza@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'42',
            'password' => Hash::make('adminadmin')

        ]);
        $user43 = User::create([
            'name'=>'43-MILA',
            'email'=> 'upw.mila@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'43',
            'password' => Hash::make('adminadmin')

        ]);
        $user44 = User::create([
            'name'=>'44-AIN-DEFLA',
            'email'=> 'upw.aindefla@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'44',
            'password' => Hash::make('adminadmin')

        ]);
        $user45 = User::create([
            'name'=>'45-NAAMA',
            'email'=> 'upw.naama@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'45',
            'password' => Hash::make('adminadmin')

        ]);
        $user46 = User::create([
            'name'=>'46-AIN-TIMOUCHENT',
            'email'=> 'upw.aintimouchent@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'46',
            'password' => Hash::make('adminadmin')

        ]);
        $user47 = User::create([
            'name'=>'47-GHARDAIA',
            'email'=> 'upw.ghardaia@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'47',
            'password' => Hash::make('adminadmin')

        ]);
        $user48 = User::create([
            'name'=>'48-GHELIZANE',
            'email'=> 'upw.ghelizane@poste.dz', 'tel'=> '0000000000',
            'nbWilaya'=>'48',
            'password' => Hash::make('adminadmin')


        ]);






        $superAdmin->roles()->attach($superAdminRole);
        $superAdmin2->roles()->attach($superAdminRole);
        $admin->roles()->attach($adminRole);
        $user->roles()->attach($userRole);
        $user1->roles()->attach($userRole);
        $user2->roles()->attach($userRole);
        $user3->roles()->attach($userRole);
        $user4->roles()->attach($userRole);
        $user5->roles()->attach($userRole);
        $user6->roles()->attach($userRole);
        $user7->roles()->attach($userRole);
        $user8->roles()->attach($userRole);
        $user9->roles()->attach($userRole);
        $user10->roles()->attach($userRole);
        $user11->roles()->attach($userRole);
        $user12->roles()->attach($userRole);
        $user13->roles()->attach($userRole);
        $user14->roles()->attach($userRole);
        $user15->roles()->attach($userRole);
        $user161->roles()->attach($userRole);
        $user162->roles()->attach($userRole);
        $user163->roles()->attach($userRole);
        $user17->roles()->attach($userRole);
        $user18->roles()->attach($userRole);
        $user19->roles()->attach($userRole);
        $user20->roles()->attach($userRole);
        $user21->roles()->attach($userRole);
        $user22->roles()->attach($userRole);
        $user23->roles()->attach($userRole);
        $user24->roles()->attach($userRole);
        $user25->roles()->attach($userRole);
        $user26->roles()->attach($userRole);
        $user27->roles()->attach($userRole);
        $user28->roles()->attach($userRole);
        $user29->roles()->attach($userRole);
        $user30->roles()->attach($userRole);
        $user31->roles()->attach($userRole);
        $user32->roles()->attach($userRole);
        $user33->roles()->attach($userRole);
        $user34->roles()->attach($userRole);
        $user35->roles()->attach($userRole);
        $user36->roles()->attach($userRole);
        $user37->roles()->attach($userRole);
        $user38->roles()->attach($userRole);
        $user39->roles()->attach($userRole);
        $user40->roles()->attach($userRole);
        $user41->roles()->attach($userRole);
        $user42->roles()->attach($userRole);
        $user43->roles()->attach($userRole);
        $user44->roles()->attach($userRole);
        $user45->roles()->attach($userRole);
        $user46->roles()->attach($userRole);
        $user47->roles()->attach($userRole);
        $user48->roles()->attach($userRole);



    }
}
