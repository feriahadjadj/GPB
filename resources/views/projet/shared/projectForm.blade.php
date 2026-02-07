<div class="form-group row">
    <label class="col-sm-5  labelFS">Désignation<span style='color: red;'>*</span> </label>
    <div class="col-sm-7">

        <input name="designation" id="designation" type="text" autocomplete="off" class="form-control" placeholder="NOM" value="{!! $projet->designation ?? '' !!}" required/>

    </div>
</div>

<!-- type de projet -->
<div class="form-group row">
    <label class="col-sm-5  labelFS">Nature du projet<span style='color: red;'>*</span></label>
    <div class="col-sm-7">

        <select name="nature" id="nature" class="form-control">





            @foreach ($natures as $n)
            <option value="{{$n->name}}" @if(isset($projet) && $n->name==$projet->nature) selected @endif>{{$n->name}}</option>

            @endforeach

        </select>

    </div>
</div>

<!-- Financement -->
<div class="form-group row">
    <label class="col-sm-5  labelFS">Financement<span style='color: red;'>*</span></label>
    <div class="col-sm-7">

        <select name="finance" id="finance" class="form-control">

            @foreach ($finances as $f)
            <option value="{{$f->name}}" @if(isset($projet) && $f->name==$projet->finance) selected @endif>{{$f->name}}</option>

            @endforeach


        </select>

    </div>
</div>

<!--montant Alloué-->
<div class="form-group row">
    <label class="col-sm-5  labelFS">Montant Alloué<span style='color: red;'>*</span> </label>
    <div class="col-sm-7">

        <input name="montantAlloue" id="montantAlloue" type="number" min="0" class="form-control" autocomplete="off" step="0.01" placeholder="0.00 DA" value={!! $projet->montantAlloue ?? 0 !!} title="" />

    </div>
</div>

<!--montant des engagements Cumulés-->
<div class="form-group row">
    <label class="col-sm-5  labelFS">Montant des engagements cumulés<span style='color: red;'>*</span> </label>
    <div class="col-sm-7">

        <input name="montantEC" id="montantEC" type="number" min="0"  class="form-control" step="0.01" placeholder="0.00 DA" value={!! $projet->montantEC ?? 0 !!} />
        <span id="erreur-montantEC" style="color:red;font-size:0.8em;"></span>
    </div>
</div>

<!--montant des paiements Cumulés-->
<div class="form-group row">
    <label class="col-sm-5  labelFS">Montant des paiements cumulés<span style='color: red;'>*</span> </label>
    <div class="col-sm-7">

        <input name="montantPC" id="montantPC" type="number" min="0"  class="form-control" step="0.01" placeholder="0.00 DA" value={!! $projet->montantPC ?? 0 !!} onfocusout="checkMontant('montantPC')" />
        <span id="erreur-montantPC" style="color:red;font-size:0.8em;"></span>
    </div>
</div>

<hr style="display: block; border-top: 1px solid #ffce00  !important; width: 70%; " />
<!--                         ODS démarrage                       -->

<h2>ODS démarrage</h2>
<div class=" form-group row">

<label class="col-sm-5  labelFS">Etudes</label>
<div class="col-sm-7">

<div class="row">
<div class="col-sm-5">
<input type="date" min="2000-01-01" name="odsEtude" class="form-control" value='{!! $projet->odsEtude ?? "" !!}' >

</div>

</div>

</div>
</div>
<div class="form-group row">
<label class="col-sm-5  labelFS">Réalisation</label>
<div class="col-sm-7">

<div class="row">
<div class="col-sm-5">
<input type="date" min="2000-01-01" name="odsRealisation" class="form-control"  autocomplete="off" value="{!! $projet->odsRealisation ?? '' !!}" >

</div>

</div>

</div>
</div>


<hr style=" display: block; border-top: 1px solid #ffce00 !important; width: 70%; " />

   <!--Délai -->

   <h2>Délai</h2>
   <div class="form-group row">
       <label class="col-sm-5  labelFS">Etudes</label>
       <div class="col-sm-7">
           <div class="row">
               <div class="form-check col-sm-4">
                   <input class="form-check-input" type="radio" name="delai" min="0"  id="exampleRadios1" value="jourE" checked >
                   <label class="form-check-label" for="exampleRadios1">
                       Jours
                   </label>
               </div>
               <div class="form-check col-sm-4">
                   <input class="form-check-input" type="radio" name="delai" id="exampleRadios2" value="moisE" @php if(isset($projet) && substr($projet->delaiE,-1)=='m'){echo 'checked';} @endphp>
                   <label class="form-check-label" for="exampleRadios2">
                       Mois
                   </label>
               </div>
               <div class="col-sm-4">
                   <input name="delaiE" id="delaiE" type="number" class="form-control"  min="0" autocomplete="off" maxlength="2" minlength="0" placeholder="000" value={!! substr($projet->delaiE ?? '0000' ,0,-3)  !!} />

               </div>
           </div>
       </div>
   </div>

   <div class="form-group row">
       <label class="col-sm-5  labelFS">Réalisation</label>
       <div class="col-sm-7">
           <div class="row">
               <div class="form-check col-sm-4">
                   <input class="form-check-input" type="radio" name="realisation" id="exampleRadios3" value="jourR" checked >
                   <label class="form-check-label" for="exampleRadios3">
                       Jours
                   </label>
               </div>
               <div class="form-check col-sm-4">
                   <input class="form-check-input" type="radio" name="realisation"  min="0" id="exampleRadios4" value="moisR" @php if(isset($projet) && substr($projet->delaiR,-1)=='m'){echo 'checked';} @endphp>
                   <label class="form-check-label" for="exampleRadios4">
                       Mois
                   </label>
               </div>
               <div class="col-sm-4">
                   <input name="delaiR" id="delaiR" type="number" class="form-control" min="0" autocomplete="off" maxlength="2" minlength="0" placeholder="000" value={!!substr($projet->delaiR ?? '0000',0,-3) !!} />

               </div>
           </div>
       </div>
   </div>


<hr style=" display: block; border-top: 1px solid #ffce00 !important; width: 70%; " />

<!--                         Etat physique                       -->
<div class="form-group row">
    <label class="col-sm-5   labelFS">Etat physique<span style='color: red;'>*</span></label>

    <div class="col-sm-3">
        <select name="etatPhysique" id="etatPhysique" class="form-control" required>
            <option value="NL" @if(isset($projet) && $projet->etatPhysique=="NL") selected @endif>non-lancé</option>
            <option value="E" @if(isset($projet) && $projet->etatPhysique=="E") selected @endif >études</option>
            <option value="P" @if(isset($projet) && $projet->etatPhysique=="P") selected @endif>procédure</option>
            <option value="R" @if(isset($projet) && $projet->etatPhysique=="R") selected @endif>réalisation</option>

            <option value="A" @if(isset($projet) && $projet->etatPhysique=="A") selected @endif>achevé</option>

        </select>

    </div>
    <label class="col-sm-2">Taux d'avancement<span style='color: red;'>*</span></label>
    <div class="col-sm-2">

       <input 
    name="tauxA"
    id="tauxA"
    type="number"
    class="form-control"
    autocomplete="off"
    min="{{ $projet->tauxA ?? 0 }}"
    placeholder="%"
    value="{{ $projet->tauxA ?? 0 }}"
/>

    </div>

</div>

<div class="form-group row">
    <label class="col-sm-5   labelFS">Date de mise en service</label>
    <div class="col-sm-7">

        <div class="row">
            <div class="col-sm-5">

                <input type="date" min="2000-01-01" name="dateMiseEnOeuvre" class="form-control" autocomplete="off" value={!! $projet->dateMiseEnOeuvre ?? '' !!} >

            </div>

        </div>

    </div>
</div>

<hr style=" display: block; border-top: 1px solid #ffce00 !important; width: 70%;margin-top: 5%; " />

<!--              Observations / Contraintes                            -->

<div class="form-group row">
    <label class="col-sm-5  labelFS">Observations / Contraintes et proposition de solutions<span style='color: red;'>*</span> </label>
    <div class="col-sm-7">

        <textarea name="observation" id="observation" type="text" class="form-control" placeholder="Observations / Contraintes et proposition de solutions" value="" style="height: 120%;" required>{!! $projet->observation ?? '' !!}</textarea>

    </div>
</div>

<input type="submit" value="Valider" id='valider' class="btn edit float-right " style="margin:30px 0" />
