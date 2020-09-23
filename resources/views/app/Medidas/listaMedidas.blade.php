<!DOCTYPE html>
<html>
<head>
    <title>Relatório Medidas</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


</head>
<body>


<div class="col-md-6">
    @foreach ($academia as $acade)
        <div class="container-fluid">
            <div class="row">
                <div>
                    <h6><b> {{$acade->nome_fant}}</b></h6>
                    Fone: {{formataFoneFixo($acade->telf_acade)}}
                </div>
                <div style="float: right;">
                    End: {{$acade->endr_acade}} <br>
                    E-mail: {{$acade->email_acade}}
                </div>
            </div>
        </div>
    @endforeach
</div>
<br>
<br>

    <hr class="linha">
    <b>Relaçao das Medids</b> <br/>
<div class="container-fluid">


    <div class="row">
        <div>
            Aluno(a) - {{$aluno}}
        </div>
        <div style="float: right;">
            Personal - {{$personal}}
        </div>
    </div>
</div>
<br>
<br>
<div>
    <ul>
        @foreach($medidas as $medida)
            <li> Código               = {{$medida->codg_medd}}</li>
            <li> Data Coleta          = {{formatDateAndTime($medida->data_coleta,'d/m/Y')}}</li>
            <li> Peso                 = {{$medida->peso_aluno}}</li>
            <li> Altura               = {{$medida->altr_aluno}}</li>
            <li> Cintura              = {{$medida->cint_aluno}}</li>
            <li> Quadril              = {{$medida->qudr_aluno}}</li>
            <li> Abdomen              = {{$medida->abdm_aluno}}</li>
            <li> Coxa Direita         = {{$medida->coxa_dirt}}</li>
            <li> Coxa Equerda         = {{$medida->coxa_esqr}}</li>
            <li> Bíceps Direito       = {{$medida->bicp_dirt}}</li>
            <li> Bíceps Essquerdo     = {{$medida->bicp_esqr}}</li>
            <li> Antebraço Direito    = {{$medida->ante_brco_dirt}}</li>
            <li> Antebraço Esquerdo   = {{$medida->ante_brco_esqr}}</li>
            <li> Panturrilha Esquerda = {{$medida->pantr_esqr}}</li>
            <li> Panturrilha Direita  = {{$medida->pantr_dirt}}</li>
        @endforeach
    </ul>

</div>


<footer style="position: absolute; bottom: 0px">
    <hr>
    <div class="text-center">
        Hashtag Soluções <i>Web</i> - Muscle<i>&Fit</i>
    </div>
</footer>

</body>
</html>