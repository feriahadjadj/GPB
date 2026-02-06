
    <div class="well" id="{{$n['id']}}N" style="padding: 5px;">

        {{-- <h2 class="recap-title float-left">{{$key}}</h2> --}}


        <table id="resultA" class="table resultA table-bordered table-condensed">
            <thead class="thead-dark">

                <tr>
                    <th rowspan=2>Wilaya </th>

                    <th rowspan=2>Montant alloué</th>

                    <th rowspan=2>Montants des engagements cumulés</th>
                    <th rowspan=2>Montant des paiements cumulés </th>
                    <th  rowspan=2>Taux d'engagement</th>
                    <th  rowspan=2>Taux de consommation</th>
                    <th colspan=5>Phase Projet</th>

                    <th rowspan ='2'>Total Projet</th>


                    <th rowspan=2>Projets non lancés (E+P+NL)</th>


                    <th rowspan=2>Taux Projets Non lancés</th>

                </tr>

                <tr>
                    <th>E : Etudes</th>
                    <th>P : Procédures</th>
                    <th>R : Réalisation</th>
                    <th>NL : Non Lancés</th>
                    <th>A : Achevés</th>

                </tr>
            </thead>

            <tbody>
                @foreach ($n as $i => $user)
                @if($i != 'id')
                <tr>

                    <td>
                       <strong>{{$user['name']}}</strong>
                    </td>

                    <td>{{$user['montantAlloue']}}</td>
                    <td>{{$user['montantEC']}}</td>
                    <td>{{$user['montantPC']}}</td>
                    <td>{{$user['tauxEngagement']}}</td>
                    <td>{{$user['tauxConsommation']}}</td>
                    <td>{{$user['E']}}</td>
                    <td>{{$user['P']}}</td>
                    <td>{{$user['R']}}</td>
                    <td>{{$user['NL']}}</td>
                    <td>{{$user['A']}}</td>
                    <td>{{$user['totalP']}}</td>
                    <td>{{$user['projetNL']}}</td>
                    <td>{{$user['tauxProjetNL']}}</td>

                </tr>
                @endif

               @endforeach
                <tr class="projetTot">
                    <td><strong>Total 50 UPW</strong></td>

                    <td>{{$total['montantAlloue']}}</td>
                    <td>{{$total['montantEC']}}</td>
                    <td>{{$total['montantPC']}}</td>
                    <td>{{$total['tauxEngagement']}}</td>
                    <td>{{$total['tauxConsommation']}}</td>
                    <td>{{$total['E']}}</td>
                    <td>{{$total['P']}}</td>
                    <td>{{$total['R']}}</td>
                    <td>{{$total['NL']}}</td>
                    <td>{{$total['A']}}</td>
                    <td>{{$total['totalP']}}</td>
                    <td>{{$total['projetNL']}}</td>
                    <td>{{$total['tauxProjetNL']}}</td>




                </tr>


            </tbody>
        </table>

    </div>
