@extends('templates.template-website', ['title' =>  trans('website.meta.shop-t') , 'description' => trans('website.meta.shop-d')])  


@section('content') 

<div class="clearfix"></div>    
<section class="banner FWrap gray">
  <div class="banner-caption">
    <div class="row">
      <div class="small-12 column">
        <h1>Gestisci i miei dati</h1>
      </div>
    </div>
  </div>
</section>


<section class="o-hidden">

    <div class="clearfix"></div>
    <div class="container pb-50 pt-50">

        <!--end section title -->
        <div class="row about-content">
            <div class="small-12">
                <div>
                    <h3>Come raccogliamo i tuoi dati?</h3>
                    <p class="regular-text">Quando invii una richiesta di contatto o di assistenza tramite questo sito web, i dati che inserisci all'interno dei form vengono conservati ed utilizzati secondo l'informativa di trattamento dei dati accettata prima dell'invio.</p>
                    <br>
                    <h3>Puoi conoscere e gestire i tuoi dati in nostro possesso?</h3>
                    <p class="regular-text">Si, cliccando sui link sottostanti puoi richiederci di conoscere, modificare o cancellare i dati personali che ci hai lasciato. Entro pochi giorni cercheremo di evadere la tua richiesta.</p>
                    <br>
                    <a class="button small" href="mailto:info@celatorito.it?subject=Richiesta di visione dei dati personali conservati" class="btn btn-fill btn-sm">Visiona i dati</a>
                    &nbsp;
                    <a class="button small" href="mailto:info@celatorito.it?subject=Richiesta di modifica dei dati personali conservati" class="btn btn-fill btn-sm">Modifica i dati</a>
                    &nbsp;
                    <a class="button small" href="mailto:info@celatorito.it?subject=Richiesta di eliminazione dei dati personali conservati" class="btn btn-fill btn-sm">Elimina i dati</a>
                </div>
            </div>
            
        </div>
    </div>
</section>

@stop
     

@section('page-script')
 

@stop

